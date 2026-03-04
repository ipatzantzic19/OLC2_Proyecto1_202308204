<?php

namespace Golampi\Traits;

trait ErrorHandler
{
    /** @var list<array{type:string,description:string,line:int,column:int}> */
    private array $errors = [];

    public const ERROR_TYPE_LEXICAL = 'Léxico';
    public const ERROR_TYPE_SYNTACTIC = 'Sintáctico';
    public const ERROR_TYPE_SEMANTIC = 'Semántico';

    protected function addError(string $type, string $description, int $line, int $column): void
    {
        $this->errors[] = [
            'type' => $type,
            'description' => trim($description),
            'line' => $line,
            'column' => $column
        ];
    }

    protected function addLexicalError(string $description, int $line, int $column): void
    {
        $this->addError(self::ERROR_TYPE_LEXICAL, $this->normalizeAntlrMessage($description), $line, $column);
    }

    protected function addSyntacticError(string $description, int $line, int $column): void
    {
        $this->addError(self::ERROR_TYPE_SYNTACTIC, $this->normalizeAntlrMessage($description), $line, $column);
    }

    protected function addSemanticError(string $description, int $line, int $column): void
    {
        $this->addError(self::ERROR_TYPE_SEMANTIC, $description, $line, $column);
    }

    protected function addAntlrError(
        \Antlr\Antlr4\Runtime\Recognizer $recognizer,
        string $description,
        int $line,
        int $column
    ): void {
        if ($this->isLexerRecognizer($recognizer)) {
            $this->addLexicalError($description, $line, $column);
            return;
        }

        $this->addSyntacticError($description, $line, $column);
    }

    protected function isLexerRecognizer(\Antlr\Antlr4\Runtime\Recognizer $recognizer): bool
    {
        return str_contains(strtolower(get_class($recognizer)), 'lexer');
    }

    protected function normalizeAntlrMessage(string $message): string
    {
        $normalized = trim($message);

        if (preg_match('/^token recognition error at:\s*(.+)$/i', $normalized, $matches) === 1) {
            return 'Token no reconocido en ' . $matches[1];
        }

        if (preg_match('/^extraneous input\s+(.+)\s+expecting\s+(.+)$/i', $normalized, $matches) === 1) {
            return 'Entrada extra ' . $matches[1] . '; se esperaba ' . $this->normalizeExpectedTokens($matches[2]);
        }

        if (preg_match('/^missing\s+(.+)\s+at\s+(.+)$/i', $normalized, $matches) === 1) {
            return 'Falta ' . $matches[1] . ' en ' . $this->normalizeExpectedTokens($matches[2]);
        }

        if (preg_match('/^mismatched input\s+(.+)\s+expecting\s+(.+)$/i', $normalized, $matches) === 1) {
            return 'Entrada no válida ' . $matches[1] . '; se esperaba ' . $this->normalizeExpectedTokens($matches[2]);
        }

        if (preg_match('/^no viable alternative at input\s+(.+)$/i', $normalized, $matches) === 1) {
            return 'No hay una alternativa válida para la entrada ' . $matches[1];
        }

        return strtr($normalized, [
            'token recognition error at:' => 'Token no reconocido en',
            'extraneous input' => 'Entrada extra',
            'mismatched input' => 'Entrada no válida',
            'no viable alternative at input' => 'No hay una alternativa válida para la entrada',
            'expecting' => 'se esperaba',
            'missing' => 'falta',
            '<EOF>' => 'fin de archivo',
        ]);
    }

    private function normalizeExpectedTokens(string $expected): string
    {
        return str_replace('<EOF>', 'fin de archivo', $expected);
    }

    /** @return list<array{type:string,description:string,line:int,column:int}> */
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
