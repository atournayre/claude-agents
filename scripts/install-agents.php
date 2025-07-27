<?php

declare(strict_types=1);

/**
 * Install Claude Code agents from atournayre/claude-agents package
 * 
 * This script automatically copies agents to the project's .claude/agents/ directory
 * and handles conflicts with existing agents.
 */

class AgentInstaller
{
    private string $vendorDir;
    private string $projectRoot;
    private string $targetDir;
    private array $config;
    
    public function __construct()
    {
        $this->vendorDir = dirname(__DIR__);
        
        // When installed via Composer, the structure is:
        // project/vendor/atournayre/claude-agents/scripts/install-agents.php
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
    
    public function install(): void
    {
        echo "🤖 Installing Claude Code agents...\n";
        
        $this->ensureTargetDirectory();
        $installedCount = 0;
        $skippedCount = 0;
        
        foreach ($this->config['agents'] ?? [] as $agentPath) {
            $sourcePath = $this->vendorDir . '/' . $agentPath;
            $agentName = basename($agentPath);
            $targetPath = $this->targetDir . '/' . $agentName;
            
            if (!file_exists($sourcePath)) {
                echo "⚠️  Agent not found: {$agentPath}\n";
                continue;
            }
            
            if (file_exists($targetPath)) {
                echo "🔄 Agent already exists, checking for updates: {$agentName}\n";
                
                if ($this->shouldUpdate($sourcePath, $targetPath)) {
                    copy($sourcePath, $targetPath);
                    echo "✅ Updated: {$agentName}\n";
                    $installedCount++;
                } else {
                    echo "⏭️  Skipped (no changes): {$agentName}\n";
                    $skippedCount++;
                }
            } else {
                copy($sourcePath, $targetPath);
                echo "✅ Installed: {$agentName}\n";
                $installedCount++;
            }
        }
        
        echo "\n🎉 Installation complete!\n";
        echo "📊 Installed: {$installedCount} agents\n";
        echo "📊 Skipped: {$skippedCount} agents\n";
        echo "📁 Location: {$this->targetDir}\n";
        
        $this->showUsageInfo();
    }
    
    private function ensureTargetDirectory(): void
    {
        if (!is_dir($this->targetDir)) {
            if (!mkdir($this->targetDir, 0755, true)) {
                throw new RuntimeException("Failed to create directory: {$this->targetDir}");
            }
            echo "📁 Created directory: {$this->targetDir}\n";
        }
    }
    
    private function shouldUpdate(string $sourcePath, string $targetPath): bool
    {
        $sourceHash = md5_file($sourcePath);
        $targetHash = md5_file($targetPath);
        
        return $sourceHash !== $targetHash;
    }
    
    private function showUsageInfo(): void
    {
        echo "\n📚 Available agents:\n";
        echo "- php-standards-enforcer: PHP 8.2+ standards and PSR compliance\n";
        echo "- phpstan-error-resolver: Surgical PHPStan level 9 error resolution\n";
        echo "- quality-assurance-enforcer: Comprehensive QA tools integration\n";
        echo "- symfony-6-4-optimizer: Symfony 6.4 LTS best practices\n";
        echo "- ddd-architect: Domain-Driven Design architecture patterns\n";
        echo "- entity-creator-specialist: Doctrine entities with DDD principles\n";
        echo "- testing-specialist: TDD with PHPUnit 10 and InMemory objects\n";
        echo "- And more...\n\n";
        echo "💡 Use Claude Code Task tool to invoke agents:\n";
        echo "   Example: Use the phpstan-error-resolver agent when resolving type errors\n";
    }
}

try {
    $installer = new AgentInstaller();
    $installer->install();
    exit(0);
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}