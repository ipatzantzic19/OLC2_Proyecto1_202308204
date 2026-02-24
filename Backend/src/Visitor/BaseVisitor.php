<?php

namespace Golampi\Visitor;

use Golampi\Runtime\Value;
use Golampi\Runtime\Environment;
use Golampi\Traits\ErrorHandler;
use Golampi\Traits\SymbolTableManager;

/**
 * Clase base del visitor Golampi.
 * Inicializa funciones embebidas y provee utilidades comunes.
 */
require_once __DIR__ . '/../../generated/GolampiVisitor.php';
require_once __DIR__ . '/../../generated/GolampiBaseVisitor.php';

abstract class BaseVisitor extends \GolampiBaseVisitor
{
    use ErrorHandler;
    use SymbolTableManager;

    protected Environment $environment;
    protected array       $output    = [];
    protected array       $functions = [];

    public function __construct()
    {
        $this->environment = new Environment();
        $this->initBuiltinFunctions();
    }

    // =========================================================
    //  FUNCIONES EMBEBIDAS
    // =========================================================

    private function initBuiltinFunctions(): void
    {
        // ── fmt.Println ───────────────────────────────────────────
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

        // Registrar 'fmt' como namespace especial
        $this->environment->define('fmt', Value::string('namespace'));

        // ── len ──────────────────────────────────────────────────
        // Soporta strings Y arreglos (cualquier dimensión)
        $this->functions['len'] = function ($arg) {
            if (!$arg instanceof Value) {
                return Value::nil();
            }

            if ($arg->getType() === 'string') {
                return Value::int32(strlen($arg->getValue()));
            }

            if ($arg->getType() === 'array') {
                // Retorna el tamaño de la primera dimensión
                return Value::int32($arg->getValue()['size']);
            }

            return Value::nil();
        };

        // ── now ──────────────────────────────────────────────────
        $this->functions['now'] = function () {
            return Value::string(date('Y-m-d H:i:s'));
        };

        // ── substr ───────────────────────────────────────────────
        $this->functions['substr'] = function ($str, $start, $length) {
            if (!$str instanceof Value || $str->getType() !== 'string') {
                return Value::nil();
            }

            $s = $start  instanceof Value ? $start->getValue()  : (int) $start;
            $l = $length instanceof Value ? $length->getValue() : (int) $length;

            if ($s < 0 || $l < 0 || $s + $l > strlen($str->getValue())) {
                return Value::nil();
            }

            return Value::string(substr($str->getValue(), $s, $l));
        };

        // ── typeOf ───────────────────────────────────────────────
        $this->functions['typeOf'] = function ($arg) {
            if (!$arg instanceof Value) {
                return Value::string('unknown');
            }

            if ($arg->getType() === 'array') {
                return Value::string('array');
            }

            return Value::string($arg->getType());
        };
    }

    // =========================================================
    //  CONVERSIÓN A STRING PARA SALIDA
    // =========================================================

    /**
     * Convierte cualquier Value en su representación de cadena para la consola.
     * Maneja arreglos de forma recursiva.
     */
    protected function valueToOutputString(Value $val): string
    {
        if ($val->getType() === 'array') {
            // Delegar al trait ArrayVisitor si está disponible
            if (method_exists($this, 'arrayToString')) {
                return $this->arrayToString($val, false);
            }
            // Fallback simple
            $data  = $val->getValue();
            $parts = [];
            foreach ($data['elements'] as $el) {
                $parts[] = $this->valueToOutputString($el);
            }
            return '[' . implode(' ', $parts) . ']';
        }

        return $val->toString();
    }

    // =========================================================
    //  GESTIÓN DE FUNCIONES
    // =========================================================

    protected function defineFunction(string $name, callable $func): void
    {
        $this->functions[$name] = $func;
    }

    protected function getFunction(string $name): ?callable
    {
        return $this->functions[$name] ?? null;
    }

    protected function functionExists(string $name): bool
    {
        return isset($this->functions[$name]);
    }

    // =========================================================
    //  SALIDA
    // =========================================================

    public function getOutput(): array
    {
        return $this->output;
    }

    public function clearOutput(): void
    {
        $this->output = [];
    }

    public function getOutputString(): string
    {
        return implode("\n", $this->output);
    }
}