<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;
use Golampi\Runtime\Environment;
use Golampi\Exceptions\ReturnException;

/**
 * Trait para el manejo de funciones de usuario:
 * hoisting, declaración, ejecución, parámetros, recursión.
 */
trait FunctionVisitor
{
    // =========================================================
    //  HOISTING / REGISTRO
    // =========================================================

    /**
     * Registra una función de usuario en el mapa de funciones.
     * Se llama durante el primer pase de visitProgram (hoisting).
     */
    protected function registerUserFunction($funcDecl): void
    {
        $funcName  = $funcDecl->ID()->getText();
        $paramDefs = $this->extractParamDefs($funcDecl);

        // Registrar en tabla de símbolos (solo la declaración)
        $this->addSymbol(
            $funcName,
            'function',
            'global',
            Value::nil(),
            $funcDecl->getStart()->getLine(),
            $funcDecl->getStart()->getCharPositionInLine()
        );

        // Capturar el ambiente global en el momento del registro
        // para que la función siempre ejecute en el scope correcto
        $globalEnv    = $this->environment;
        $capturedDecl = $funcDecl;

        // Registrar como callable (closure que delega a executeUserFunction)
        $this->functions[$funcName] = function () use (
            $funcName, $capturedDecl, $paramDefs, $globalEnv
        ) {
            $args = func_get_args();
            return $this->executeUserFunction(
                $funcName, $capturedDecl, $paramDefs, $args, $globalEnv
            );
        };
    }

    // =========================================================
    //  EJECUCIÓN DE MAIN
    // =========================================================

    /**
     * Ejecuta la función main.
     */
    protected function executeMain($funcDecl): void
    {
        // Registrar main en tabla de símbolos
        $this->addSymbol(
            'main',
            'function',
            'global',
            Value::nil(),
            $funcDecl->getStart()->getLine(),
            $funcDecl->getStart()->getCharPositionInLine()
        );

        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        $this->enterScope('function:main');

        try {
            $this->executeBlock($funcDecl->block());
        } catch (ReturnException $e) {
            // main no retorna valores; ignorar
        } finally {
            $this->exitScope();
            $this->environment = $parentEnv;
        }
    }

    // =========================================================
    //  EJECUCIÓN DE FUNCIÓN DE USUARIO
    // =========================================================

    /**
     * Ejecuta una función de usuario con los argumentos dados.
     */
    public function executeUserFunction(
        string $funcName,
        $funcDecl,
        array $paramDefs,
        array $args,
        Environment $globalEnv
    ): Value {
        $prevEnv   = $this->environment;
        $funcEnv   = new Environment($globalEnv);
        $this->environment = $funcEnv;
        $this->enterScope('function:' . $funcName);

        try {
            // ── Vincular parámetros ──────────────────────────────────
            foreach ($paramDefs as $idx => $paramDef) {
                $argValue = $args[$idx] ?? $this->getDefaultValue($paramDef['type']);

                $this->environment->define($paramDef['name'], $argValue);

                $symbolType = $paramDef['isPointer']
                    ? '*' . $paramDef['type']
                    : $paramDef['type'];

                $this->addSymbol(
                    $paramDef['name'],
                    $symbolType,
                    'function:' . $funcName,
                    $argValue,
                    $funcDecl->getStart()->getLine(),
                    0
                );
            }

            // ── Ejecutar cuerpo ──────────────────────────────────────
            $this->executeBlock($funcDecl->block());

            return Value::nil();

        } catch (ReturnException $e) {
            return $e->getReturnValue();
        } finally {
            $this->exitScope();
            $this->environment = $prevEnv;
        }
    }

    // =========================================================
    //  HELPERS
    // =========================================================

    /**
     * Ejecuta el contenido de un bloque en el ambiente actual.
     * Comparte la misma lógica que visitBlock pero sin crear
     * un ambiente hijo adicional ni un scope extra.
     */
    protected function executeBlock($blockCtx): void
    {
        // Los hijos 0 y getChildCount()-1 son las llaves { y }
        for ($i = 1; $i < $blockCtx->getChildCount() - 1; $i++) {
            $child = $blockCtx->getChild($i);
            if ($child instanceof \Antlr\Antlr4\Runtime\ParserRuleContext) {
                $this->visit($child);
            }
        }
    }

    /**
     * Extrae las definiciones de parámetros de una declaración de función.
     * Soporta parámetros normales e ID type y punteros * ID type.
     *
     * @return array<int, array{name:string, type:string, isPointer:bool}>
     */
    private function extractParamDefs($funcDecl): array
    {
        $params   = [];
        $paramList = $funcDecl->parameterList();

        if ($paramList === null) {
            return $params;
        }

        foreach ($paramList->parameter() as $param) {
            // El primer token es '*' para PointerParameter, ID para NormalParameter
            $isPointer = ($param->getStart()->getText() === '*');
            $paramName = $param->ID()->getText();
            $paramType = $this->extractType($param->type());

            $params[] = [
                'name'      => $paramName,
                'type'      => $paramType,
                'isPointer' => $isPointer,
            ];
        }

        return $params;
    }
}