<?php

namespace Golampi\Traits;

trait SymbolTableManager
{
    protected array $symbolTable = [];
    protected int $currentScope = 0;
    protected array $scopeStack = [];
    private array $reportingSymbolTable = []; // Para el reporte en orden

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
            // El array $this->symbolTable ya no se usa para el reporte final,
            // pero mantenemos la lógica por si se usa en otro lugar.
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
        // Verificar duplicados solo en el scope actual
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

        // Añadir al scope actual para la resolución
        if (!empty($this->scopeStack)) {
            $this->scopeStack[count($this->scopeStack) - 1]['symbols'][] = $symbol;
        } else {
            // Scope global
            $this->symbolTable[] = $symbol;
        }

        // Añadir a la tabla de reporte para mantener el orden de declaración
        $this->reportingSymbolTable[] = $symbol;

        return true;
    }

    /**
     * Añade una ocurrencia/instancia de un símbolo (no realiza comprobación de duplicados).
     * Útil para registrar cada uso (por ejemplo llamadas a funciones) con su posición.
     */
    protected function addSymbolOccurrence(
        string $identifier,
        string $type,
        string $scope,
        $value,
        int $line,
        int $column
    ): void {
        $symbol = [
            'identifier' => $identifier,
            'type' => $type,
            'scope' => $scope,
            'value' => $value,
            'line' => $line,
            'column' => $column
        ];

        // Añadir al scope actual para la resolución
        if (!empty($this->scopeStack)) {
            $this->scopeStack[count($this->scopeStack) - 1]['symbols'][] = $symbol;
        } else {
            $this->symbolTable[] = $symbol;
        }

        // Añadir a la tabla de reporte para mantener el orden de declaración
        $this->reportingSymbolTable[] = $symbol;
    }

    protected function symbolExistsInCurrentScope(string $identifier): bool
    {
        if (empty($this->scopeStack)) {
            // Estamos en scope global
            foreach ($this->symbolTable as $symbol) {
                if ($symbol['identifier'] === $identifier && $symbol['scope'] === 'global') {
                    return true;
                }
            }
            return false;
        }

        // Estamos en un scope anidado
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
        // Buscar desde el scope más interno hacia afuera
        for ($i = count($this->scopeStack) - 1; $i >= 0; $i--) {
            foreach ($this->scopeStack[$i]['symbols'] as $symbol) {
                if ($symbol['identifier'] === $identifier) {
                    return $symbol;
                }
            }
        }

        // Buscar en la tabla global
        foreach ($this->symbolTable as $symbol) {
            if ($symbol['identifier'] === $identifier) {
                return true;
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
        // Devolver la tabla que mantiene el orden de declaración.
        return $this->reportingSymbolTable;
    }

    public function clearSymbolTable(): void
    {
        $this->symbolTable = [];
        $this->scopeStack = [];
        $this->currentScope = 0;
        $this->reportingSymbolTable = [];
    }
}