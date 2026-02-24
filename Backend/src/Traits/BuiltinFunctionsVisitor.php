<?php
// Backend/src/Traits/BuiltinFunctionsVisitor.php

namespace Golampi\Traits;

use Golampi\Runtime\Value;

/**
 * Trait para registrar y manejar funciones embebidas (built-in) del lenguaje Golampi.
 * Funciones: fmt.Println, len, now, substr, typeOf
 */
trait BuiltinFunctionsVisitor
{
    protected function initBuiltinFunctions(): void
    {
        $this->registerFmtPrintln();
        $this->registerLen();
        $this->registerNow();
        $this->registerSubstr();
        $this->registerTypeOf();
    }

    // ── fmt.Println ────────────────────────────────────────────────
    // Imprime uno o más valores separados por espacios + salto de línea
    private function registerFmtPrintln(): void
    {
        $this->functions['fmt.Println'] = function (...$args) {
            $parts = [];
            foreach ($args as $arg) {
                if ($arg instanceof Value) {
                    $parts[] = $this->valueToOutputString($arg);
                } else {
                    $parts[] = (string) $arg;
                }
            }
            $this->output[] = implode(' ', $parts);
            return Value::nil();
        };

        // Registrar namespace fmt
        $this->environment->define('fmt', Value::string('namespace'));
    }

    // ── len ────────────────────────────────────────────────────────
    // Retorna longitud de string (mb_strlen para Unicode) o de arreglo
    private function registerLen(): void
    {
        $this->functions['len'] = function ($arg) {
            if (!$arg instanceof Value) {
                return Value::nil();
            }

            if ($arg->getType() === 'string') {
                // mb_strlen para soporte Unicode correcto
                return Value::int32(mb_strlen($arg->getValue(), 'UTF-8'));
            }

            if ($arg->getType() === 'array') {
                // Solo la primera dimensión (igual que Go)
                return Value::int32($arg->getValue()['size']);
            }

            return Value::nil();
        };
    }

    // ── now ────────────────────────────────────────────────────────
    // Retorna fecha y hora actual en formato YYYY-MM-DD HH:MM:SS
    private function registerNow(): void
    {
        $this->functions['now'] = function () {
            return Value::string(date('Y-m-d H:i:s'));
        };
    }

    // ── substr ─────────────────────────────────────────────────────
    // Extrae subcadena: substr(s, inicio, longitud)
    // Error si índices inválidos → retorna nil
    private function registerSubstr(): void
    {
        $this->functions['substr'] = function ($str, $start, $length) {
            if (!$str instanceof Value || $str->getType() !== 'string') {
                return Value::nil();
            }

            $s      = $start  instanceof Value ? (int) $start->getValue()  : (int) $start;
            $l      = $length instanceof Value ? (int) $length->getValue() : (int) $length;
            $strLen = mb_strlen($str->getValue(), 'UTF-8');

            // Índices inválidos → nil (error semántico de runtime)
            if ($s < 0 || $l < 0 || ($s + $l) > $strLen) {
                return Value::nil();
            }

            return Value::string(mb_substr($str->getValue(), $s, $l, 'UTF-8'));
        };
    }

    // ── typeOf ─────────────────────────────────────────────────────
    // Retorna el tipo de una variable como string
    // int32, float32, bool, string, rune, array, pointer
    private function registerTypeOf(): void
    {
        $this->functions['typeOf'] = function ($arg) {
            if (!$arg instanceof Value) {
                return Value::string('unknown');
            }

            // Para arreglos podría retornar el tipo del elemento también
            if ($arg->getType() === 'array') {
                $data        = $arg->getValue();
                $elementType = $data['elementType'] ?? 'unknown';
                return Value::string('[]' . $elementType);
            }

            return Value::string($arg->getType());
        };
    }
}