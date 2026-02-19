<?php

namespace Golampi\Traits;

trait SymbolTableManager
{
    protected array $symbolTable = [];
    protected int $currentScope = 0;
    protected array $scopeStack = [];
    private int $declarationOrder = 0; //  Para mantener el orden

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
            // Agregar símbolos del scope cerrado a la tabla principal
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
            'column' => $column,
            'order' => $this->declarationOrder++ //  Asignar orden de declaración
        ];

        // Añadir al scope actual
        if (!empty($this->scopeStack)) {
            $this->scopeStack[count($this->scopeStack) - 1]['symbols'][] = $symbol;
        } else {
            // Scope global
            $this->symbolTable[] = $symbol;
        }

        return true;
    }

    /**
     *  Actualiza el valor de un símbolo existente en la tabla
     */
    protected function updateSymbolValue(string $identifier, $newValue): bool
    {
        // Buscar en scopes anidados (desde el más reciente hacia atrás)
        for ($i = count($this->scopeStack) - 1; $i >= 0; $i--) {
            $symbols = &$this->scopeStack[$i]['symbols'];
            
            for ($j = 0; $j < count($symbols); $j++) {
                if ($symbols[$j]['identifier'] === $identifier) {
                    //  Actualizar el valor
                    $symbols[$j]['value'] = $newValue;
                    return true;
                }
            }
        }

        // Buscar en la tabla global
        for ($i = 0; $i < count($this->symbolTable); $i++) {
            if ($this->symbolTable[$i]['identifier'] === $identifier) {
                // Actualizar el valor
                $this->symbolTable[$i]['value'] = $newValue;
                return true;
            }
        }

        return false;
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
        //  Ordenar por el campo 'order' antes de retornar
        $table = $this->symbolTable;
        
        usort($table, function($a, $b) {
            return $a['order'] <=> $b['order'];
        });
        
        // Remover el campo 'order' antes de retornar
        return array_map(function($symbol) {
            unset($symbol['order']);
            return $symbol;
        }, $table);
    }

    public function clearSymbolTable(): void
    {
        $this->symbolTable = [];
        $this->scopeStack = [];
        $this->currentScope = 0;
        $this->declarationOrder = 0;
    }
}