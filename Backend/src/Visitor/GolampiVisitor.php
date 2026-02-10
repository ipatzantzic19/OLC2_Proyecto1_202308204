<?php

namespace Golampi\Visitor;

use Golampi\Runtime\Value;
use Golampi\Traits\ArithmeticOperations;
use Golampi\Traits\RelationalOperations;
use Golampi\Traits\ExpressionVisitor;
use Golampi\Traits\DeclarationVisitor;
use Golampi\Traits\StatementVisitor;

/**
 * Visitor principal del intérprete de Golampi
 * Usa traits para organizar la funcionalidad
 */
class GolampiVisitor extends BaseVisitor
{
    use ArithmeticOperations;
    use RelationalOperations;
    use ExpressionVisitor;
    use DeclarationVisitor;
    use StatementVisitor;

    public function __construct()
    {
        parent::__construct();

        // Registrar el espacio de nombres `fmt` en el environment
        // No agregarlo a la tabla de símbolos aquí para mantener el orden correcto
    }
}