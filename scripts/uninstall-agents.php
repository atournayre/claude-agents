<?php

declare(strict_types=1);

/**
 * Uninstall Claude Code agents from atournayre/claude-agents package
 * 
 * This script removes agents that were installed by this package,
 * while preserving project-specific agents.
 */

class AgentUninstaller
{
    private string $vendorDir;
    private string $projectRoot;
    private string $targetDir;
    private array $config;
    
    public function __construct()
    {
        $this->vendorDir = dirname(__DIR__);
        
        // When installed via Composer, the structure is:
        // project/vendor/atournayre/claude-agents/scripts/uninstall-agents.php
        // So we need to go up 4 levels: scripts -> claude-agents -> atournayre -> vendor -> project
        $this->projectRoot = dirname($this->vendorDir, 3);
        $this->targetDir = $this->projectRoot . '/.claude/agents';
        
        // Load composer.json config
        $composerPath = $this->vendorDir . '/composer.json';
        if (!file_exists($composerPath)) {
            throw new RuntimeException('composer.json not found');
        }
        
        $composer = json_decode(file_get_contents($composerPath), true);
        $this->config = $composer['extra']['claude-agents'] ?? [];
    }
    
    public function uninstall(): void
    {
        echo "🗑️  Uninstalling Claude Code agents...\n";
        
        if (!is_dir($this->targetDir)) {
            echo "📁 No agents directory found, nothing to uninstall\n";
            return;
        }
        
        $removedCount = 0;
        $preservedCount = 0;
        
        foreach ($this->config['agents'] ?? [] as $agentPath) {
            $agentName = basename($agentPath);
            $targetPath = $this->targetDir . '/' . $agentName;
            
            if (file_exists($targetPath)) {
                if ($this->isPackageAgent($targetPath, $agentPath)) {
                    unlink($targetPath);
                    echo "🗑️  Removed: {$agentName}\n";
                    $removedCount++;
                } else {
                    echo "🔒 Preserved (modified): {$agentName}\n";
                    $preservedCount++;
                }
            }
        }
        
        echo "\n🎉 Uninstallation complete!\n";
        echo "📊 Removed: {$removedCount} agents\n";
        echo "📊 Preserved: {$preservedCount} agents\n";
        
        $this->checkEmptyDirectory();
    }
    
    private function isPackageAgent(string $targetPath, string $originalAgentPath): bool
    {
        $sourcePath = $this->vendorDir . '/' . $originalAgentPath;
        
        if (!file_exists($sourcePath)) {
            // Source doesn't exist, safe to remove
            return true;
        }
        
        $sourceHash = md5_file($sourcePath);
        $targetHash = md5_file($targetPath);
        
        // Only remove if the file hasn't been modified
        return $sourceHash === $targetHash;
    }
    
    private function checkEmptyDirectory(): void
    {
        $files = glob($this->targetDir . '/*');
        
        if (empty($files)) {
            echo "📁 Agents directory is empty, removing it\n";
            rmdir($this->targetDir);
            
            // Check if .claude directory is also empty
            $claudeDir = dirname($this->targetDir);
            $claudeFiles = glob($claudeDir . '/*');
            
            if (empty($claudeFiles)) {
                echo "📁 .claude directory is empty, removing it\n";
                rmdir($claudeDir);
            }
        } else {
            echo "📁 Keeping agents directory (contains other files)\n";
        }
    }
}

try {
    $uninstaller = new AgentUninstaller();
    $uninstaller->uninstall();
    exit(0);
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}