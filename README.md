# Claude Agents Collection by Atournayre

A comprehensive collection of specialized Claude Code agents for modern PHP development, covering architecture patterns, frameworks, testing, and code quality.

## 🎯 Overview

This package provides reusable Claude Code agents that can be used across multiple projects to enforce best practices, automate code analysis, and provide expert guidance for complex development tasks.

## 📦 Installation

### Option 1: Manual Installation (Temporary)
```bash
# Clone or copy the agents directory to your project
cp -r atournayre-claude-agents/agents/* .claude/agents/
```

### Option 2: Composer Package (Future)
```bash
composer require atournayre/claude-agents
```

## 🔧 Available Agents

### PHP Development
- **`php-standards-enforcer`** - Enforces PHP 8.2+ standards, strict types, and PSR compliance
- **`phpstan-error-resolver`** - Surgical resolution of PHPStan level 9 errors with type annotations
- **`quality-assurance-enforcer`** - Comprehensive QA tools integration (PHPStan, PHP-CS-Fixer, Rector)

### Symfony Framework
- **`symfony-6-4-optimizer`** - Symfony 6.4 LTS best practices and performance optimization
- **`symfony-migration-specialist`** - Handles Symfony version migrations and deprecation fixes

### Domain-Driven Design
- **`ddd-architect`** - DDD architecture patterns with RAD (Rapid Application Development)
- **`entity-creator-specialist`** - Creates Doctrine entities following DDD principles
- **`value-object-designer`** - Designs immutable Value Objects with business validation
- **`exception-hierarchy-designer`** - Creates comprehensive domain exception hierarchies

### Messaging & Architecture
- **`message-messagehandler-architect`** - CQRS patterns and Symfony Messenger architecture
- **`dependency-injection-architect`** - Advanced DI patterns with Symfony 6.4
- **`elegant-objects-enforcer`** - Enforces Elegant Object principles in PHP

### Collections & Testing
- **`collection-specialist`** - Domain-specific collections with business methods
- **`testing-specialist`** - TDD principles with PHPUnit 10 and InMemory objects

### Framework Integration
- **`atournayre-framework-specialist`** - Expert in atournayre/framework v2 primitives and patterns

## 🚀 Usage

Each agent is a specialized AI assistant that can be invoked using the Claude Code Task tool:

```markdown
Use the [agent-name] agent when [specific context].

Examples:
- "I'm getting PHPStan level 9 errors" → use `phpstan-error-resolver`
- "Need to create a DDD entity" → use `entity-creator-specialist`
- "Optimizing Symfony performance" → use `symfony-6-4-optimizer`
```

## 📋 Agent Categories

### 🔵 Architecture & Design
Focus on software architecture patterns, SOLID principles, and design best practices.

### 🟢 Framework Integration
Specialized knowledge for Symfony, Doctrine, and modern PHP frameworks.

### 🟡 Code Quality
Static analysis, code style, testing, and quality assurance automation.

### 🟣 Domain Modeling
DDD patterns, entity design, value objects, and business logic encapsulation.

## 🔄 Integration Workflow

1. **Project Setup**: Copy relevant agents to `.claude/agents/` directory
2. **Agent Selection**: Choose appropriate agent based on your task
3. **Task Execution**: Use Claude Code Task tool with selected agent
4. **Quality Validation**: Run project QA tools to validate changes

## 📖 Agent Structure

Each agent follows a consistent structure:
```yaml
---
name: agent-name
description: Brief description with usage examples
color: agent-color
---

# Specialized prompt and instructions
```

## 🎯 Best Practices

### When to Use Specific Agents
- **Complex Type Issues** → `phpstan-error-resolver`
- **New Entity Creation** → `entity-creator-specialist`
- **Performance Optimization** → `symfony-6-4-optimizer`
- **Architecture Refactoring** → `ddd-architect`
- **Test Implementation** → `testing-specialist`

### Agent Combination
Agents can be used in sequence for complex tasks:
1. `ddd-architect` for design
2. `entity-creator-specialist` for implementation
3. `testing-specialist` for test coverage
4. `quality-assurance-enforcer` for validation

## 🔧 Customization

### Project-Specific Adaptations
For project-specific needs, create custom agents in your project's `.claude/agents/` directory that extend or modify the base agents.

### Configuration
Some agents support configuration through project-specific files:
- PHPStan configuration: `phpstan.neon`
- PHP-CS-Fixer: `.php-cs-fixer.php`
- Rector: `rector.php`

## 📚 Documentation

### Agent Reference
Each agent includes:
- **Purpose**: What the agent specializes in
- **Context**: When to use the agent
- **Examples**: Real-world usage scenarios
- **Tools**: Available commands and integrations

### Framework Integration
- **Symfony 6.4 LTS**: Optimized for long-term support version
- **Doctrine ORM**: Entity mapping and repository patterns
- **PHPUnit 10**: Modern testing approaches with InMemory patterns

## 🤝 Contributing

### Adding New Agents
1. Create agent in appropriate category directory
2. Follow the established YAML frontmatter format
3. Include comprehensive examples and usage patterns
4. Test with real-world scenarios

### Improving Existing Agents
1. Analyze agent performance in real projects
2. Gather feedback from development teams
3. Update patterns and best practices
4. Maintain backward compatibility

## 📄 License

MIT License - See [LICENSE](LICENSE) file for details.

## 🏗️ Roadmap

- [ ] Composer package distribution
- [ ] Auto-installation scripts
- [ ] IDE integration guides
- [ ] Extended framework support
- [ ] Community agent contributions

---

**Built for modern PHP development teams who value code quality, architectural excellence, and development efficiency.**