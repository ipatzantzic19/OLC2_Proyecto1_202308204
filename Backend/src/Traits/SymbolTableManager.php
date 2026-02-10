<?php

namespace Golampi\Traits;

trait SymbolTableManager
{
    private array $symbolTable = [];
    private int $currentScope = 0;
    private array $scopeStack = [];

    protected function enterScope(string $scopeName): void
    {
        $this->currentScope++;
        $this->scopeStack[] = [
            'id' => $this->currentScope,
            'name' => $scopeName,
            'symbols' => []
        ];
    }

    protected function exitScope(): void
    {
        if (!empty($this->scopeStack)) {
            $scope = array_pop($this->scopeStack);
            foreach ($scope['symbols'] as $symbol) {
                $this->symbolTable[] = $symbol;
            }
        }
    }

    protected function addSymbol(
        string $identifier,
        string $type,
        string $scope,
        $value,
        int $line,
        int $column
    ): bool {
        if ($this->symbolExistsInCurrentScope($identifier)) {
            return false;
        }

        $symbol = [
            'identifier' => $identifier,
            'type' => $type,
            'scope' => $scope,
            'value' => $value,
            'line' => $line,
            'column' => $column
        ];

        if (!empty($this->scopeStack)) {
            $this->scopeStack[count($this->scopeStack) - 1]['symbols'][] = $symbol;
        } else {
            $this->symbolTable[] = $symbol;
        }

        return true;
    }

    protected function symbolExistsInCurrentScope(string $identifier): bool
    {
        if (empty($this->scopeStack)) {
            foreach ($this->symbolTable as $symbol) {
                if ($symbol['identifier'] === $identifier && $symbol['scope'] === 'global') {
                    return true;
                }
            }
            return false;
        }

        $currentScope = $this->scopeStack[count($this->scopeStack) - 1];
        foreach ($currentScope['symbols'] as $symbol) {
            if ($symbol['identifier'] === $identifier) {
                return true;
            }
        }
        return false;
    }

    protected function findSymbol(string $identifier): ?array
    {
        for ($i = count($this->scopeStack) - 1; $i >= 0; $i--) {
            foreach ($this->scopeStack[$i]['symbols'] as $symbol) {
                if ($symbol['identifier'] === $identifier) {
                    return $symbol;
                }
            }
        }

        foreach ($this->symbolTable as $symbol) {
            if ($symbol['identifier'] === $identifier) {
                return $symbol;
            }
        }

        return null;
    }

    protected function getCurrentScopeName(): string
    {
        if (empty($this->scopeStack)) {
            return 'global';
        }
        return $this->scopeStack[count($this->scopeStack) - 1]['name'];
    }

    public function getSymbolTable(): array
    {
        $allSymbols = $this->symbolTable;
        
        foreach ($this->scopeStack as $scope) {
            $allSymbols = array_merge($allSymbols, $scope['symbols']);
        }
        
        return $allSymbols;
    }

    public function clearSymbolTable(): void
    {
        $this->symbolTable = [];
        $this->scopeStack = [];
        $this->currentScope = 0;
    }
}