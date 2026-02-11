<?php

namespace Golampi\Visitor;

use Golampi\Runtime\Value;
use Golampi\Runtime\Environment;
use Golampi\Traits\ErrorHandler;
use Golampi\Traits\SymbolTableManager;

/**
 * Clase base que será extendida por el visitor generado por ANTLR
 * Implementa funcionalidad común y funciones embebidas
 */
require_once __DIR__ . '/../../generated/GolampiVisitor.php';
require_once __DIR__ . '/../../generated/GolampiBaseVisitor.php';

abstract class BaseVisitor extends \GolampiBaseVisitor
{
    use ErrorHandler;
    use SymbolTableManager;

    protected Environment $environment;
    protected array $output = [];
    protected array $functions = [];

    public function __construct()
    {
        $this->environment = new Environment();
        $this->initBuiltinFunctions();
    }

    /**
     * Inicializa las funciones embebidas del lenguaje
     */
    private function initBuiltinFunctions(): void
    {
        // fmt.Println
        $this->functions['fmt.Println'] = function(...$args) {
            $output = [];
            foreach ($args as $arg) {
                if ($arg instanceof Value) {
                    $output[] = $arg->toString();
                } else {
                    $output[] = (string)$arg;
                }
            }
            $result = implode(' ', $output);
            $this->output[] = $result;
            return Value::nil();
        };

        // Registrar el espacio de nombres `fmt` como una variable especial
        $this->environment->define('fmt', Value::string('namespace'));
        $this->addSymbol('fmt.Println', 'function', 'global', Value::nil(), 0, 0);

        // len
        $this->functions['len'] = function($arg) {
            if ($arg instanceof Value) {
                if ($arg->getType() === 'string') {
                    return Value::int32(strlen($arg->getValue()));
                }
            }
            return Value::nil();
        };

        // now
        $this->functions['now'] = function() {
            return Value::string(date('Y-m-d H:i:s'));
        };

        // substr
        $this->functions['substr'] = function($str, $start, $length) {
            if ($str instanceof Value && $str->getType() === 'string') {
                $startVal = $start instanceof Value ? $start->getValue() : $start;
                $lengthVal = $length instanceof Value ? $length->getValue() : $length;
                $result = substr($str->getValue(), $startVal, $lengthVal);
                return Value::string($result);
            }
            return Value::nil();
        };

        // typeOf
        $this->functions['typeOf'] = function($arg) {
            if ($arg instanceof Value) {
                return Value::string($arg->getType());
            }
            return Value::string('unknown');
        };
    }

    /**
     * Obtiene la salida del programa
     */
    public function getOutput(): array
    {
        return $this->output;
    }

    /**
     * Limpia la salida
     */
    public function clearOutput(): void
    {
        $this->output = [];
    }

    /**
     * Obtiene la salida como string
     */
    public function getOutputString(): string
    {
        return implode("\n", $this->output);
    }

    /**
     * Registra una función definida por el usuario
     */
    protected function defineFunction(string $name, callable $func): void
    {
        $this->functions[$name] = $func;
    }

    /**
     * Obtiene una función (builtin o definida por usuario)
     */
    protected function getFunction(string $name): ?callable
    {
        return $this->functions[$name] ?? null;
    }

    /**
     * Verifica si una función existe
     */
    protected function functionExists(string $name): bool
    {
        return isset($this->functions[$name]);
    }
}