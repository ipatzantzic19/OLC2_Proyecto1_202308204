<?php

namespace Golampi\Traits;

trait ErrorHandler
{
    private array $errors = [];

    protected function addError(string $type, string $description, int $line, int $column): void
    {
        $this->errors[] = [
            'type' => $type,
            'description' => $description,
            'line' => $line,
            'column' => $column
        ];
    }

    protected function addLexicalError(string $description, int $line, int $column): void
    {
        $this->addError('Léxico', $description, $line, $column);
    }

    protected function addSyntacticError(string $description, int $line, int $column): void
    {
        $this->addError('Sintáctico', $description, $line, $column);
    }

    protected function addSemanticError(string $description, int $line, int $column): void
    {
        $this->addError('Semántico', $description, $line, $column);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function clearErrors(): void
    {
        $this->errors = [];
    }
}
