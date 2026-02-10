# 📘 Guía de Implementación - Continuación

## ✅ Estado Actual

### Completado

#### Estructura Base
- ✅ Gramática ANTLR completa (Golampi.g4)
- ✅ Configuración de Composer
- ✅ Estructura de directorios modular

#### Runtime
- ✅ `Value` - Sistema de tipos
- ✅ `Environment` - Manejo de scopes

#### Traits Implementados
- ✅ `ErrorHandler` - Manejo de errores
- ✅ `SymbolTableManager` - Tabla de símbolos
- ✅ `ArithmeticOperations` - Todas las operaciones aritméticas
- ✅ `RelationalOperations` - Comparaciones y lógica
- ✅ `ExpressionVisitor` - Visita de expresiones básicas
- ✅ `DeclarationVisitor` - Declaración de variables
- ✅ `StatementVisitor` - Sentencias básicas

#### Visitors
- ✅ `BaseVisitor` - Clase base con funciones embebidas
- ✅ `GolampiVisitor` - Visitor principal usando traits

#### Sistema de Pruebas
- ✅ Script de prueba mejorado con formateo de reportes
- ✅ Manejo de errores léxicos, sintácticos y semánticos
- ✅ Generación de reportes formateados
- ✅ 3 archivos de prueba de ejemplo

### Funcionalidad Probada

✅ Declaración de variables con tipo explícito
✅ Operaciones aritméticas (suma, resta, multiplicación, división, módulo)
✅ Operaciones relacionales (==, !=, >, <, >=, <=)
✅ Operaciones lógicas (&&, ||, !) con cortocircuito
✅ Función `fmt.Println()`
✅ Detección de errores semánticos:
   - Variables no declaradas
   - Redeclaración de variables
   - Incompatibilidad de tipos

## 🎯 Siguiente Fase: Control de Flujo

### Crear ControlFlowVisitor.php

```php
<?php
namespace Golampi\Traits;

trait ControlFlowVisitor
{
    /**
     * Visita sentencia if-else
     */
    public function visitIfElse($context) {
        // Implementar
    }

    /**
     * Visita sentencia if-else-if
     */
    public function visitIfElseIf($context) {
        // Implementar
    }

    /**
     * Visita sentencia for tradicional
     */
    public function visitForTraditional($context) {
        // Implementar con scope local
    }

    /**
     * Visita sentencia for-while
     */
    public function visitForWhile($context) {
        // Implementar
    }

    /**
     * Visita sentencia for infinito
     */
    public function visitForInfinite($context) {
        // Implementar
    }

    /**
     * Visita sentencia switch
     */
    public function visitSwitchStatement($context) {
        // Implementar
    }

    /**
     * Visita break
     */
    public function visitBreakStatement($context) {
        // Usar excepciones de control de flujo
    }

    /**
     * Visita continue
     */
    public function visitContinueStatement($context) {
        // Usar excepciones de control de flujo
    }

    /**
     * Visita return
     */
    public function visitReturnStatement($context) {
        // Usar excepciones de control de flujo
    }
}
```

### Excepciones de Control de Flujo

Crear `src/Runtime/ControlFlowException.php`:

```php
<?php
namespace Golampi\Runtime;

class BreakException extends \Exception {}
class ContinueException extends \Exception {}
class ReturnException extends \Exception {
    public function __construct(public readonly Value $value) {
        parent::__construct();
    }
}
```

## 📋 Plan de Implementación por Prioridad

### Fase 1: Control de Flujo (3-5 días)
- [ ] Crear `ControlFlowVisitor` trait
- [ ] Crear excepciones de control de flujo
- [ ] Implementar `if-else`
- [ ] Implementar `for` (tradicional, while, infinito)
- [ ] Implementar `switch-case`
- [ ] Implementar `break`, `continue`, `return`
- [ ] Crear pruebas para control de flujo

### Fase 2: Asignaciones (1-2 días)
- [ ] Crear `AssignmentVisitor` trait
- [ ] Implementar asignación simple (`x = 10`)
- [ ] Implementar asignaciones compuestas (`+=`, `-=`, etc.)
- [ ] Implementar declaración corta (`:=`)
- [ ] Crear pruebas para asignaciones

### Fase 3: Funciones (3-5 días)
- [ ] Crear `FunctionVisitor` trait
- [ ] Implementar hoisting de funciones
- [ ] Implementar declaración de funciones
- [ ] Implementar llamadas a funciones
- [ ] Implementar paso de parámetros
- [ ] Implementar múltiples retornos
- [ ] Implementar recursión
- [ ] Crear pruebas para funciones

### Fase 4: Arreglos (3-5 días)
- [ ] Crear `ArrayVisitor` trait
- [ ] Implementar declaración de arreglos
- [ ] Implementar inicialización de arreglos
- [ ] Implementar acceso a elementos
- [ ] Implementar asignación a elementos
- [ ] Implementar arreglos multidimensionales
- [ ] Integrar `len()` para arreglos
- [ ] Crear pruebas para arreglos

### Fase 5: Punteros (2-3 días)
- [ ] Crear `PointerVisitor` trait
- [ ] Implementar operador `&` (dirección)
- [ ] Implementar operador `*` (desreferencia)
- [ ] Implementar paso por referencia
- [ ] Crear pruebas para punteros

### Fase 6: Constantes (1 día)
- [ ] Implementar declaración de constantes
- [ ] Validar inmutabilidad
- [ ] Crear pruebas para constantes

### Fase 7: API Backend (2-3 días)
- [ ] Crear `public/index.php`
- [ ] Implementar endpoint POST para código
- [ ] Manejar errores HTTP
- [ ] Generar respuesta JSON
- [ ] Crear endpoint para reportes

### Fase 8: Frontend (5-7 días)
- [ ] Crear estructura HTML
- [ ] Implementar editor de código (CodeMirror o similar)
- [ ] Implementar botones de acción
- [ ] Implementar consola de salida
- [ ] Conectar con backend
- [ ] Implementar descarga de reportes
- [ ] Agregar estilos CSS

## 🧪 Estrategia de Pruebas

### Para cada característica:

1. **Crear archivo .golampi de prueba**
2. **Ejecutar con el sistema de pruebas**
3. **Verificar salida esperada**
4. **Verificar tabla de símbolos**
5. **Verificar detección de errores**

### Ejemplo de flujo de prueba:

```bash
# 1. Crear test4.golampi con if-else
# 2. Ejecutar
php test/test.php test/test4.golampi

# 3. Verificar salida
# 4. Verificar errores (si aplica)
# 5. Iterar hasta funcionar correctamente
```

## 💡 Tips de Implementación

### 1. Manejo de Scopes en Control de Flujo

```php
public function visitForTraditional($context) {
    // Crear nuevo scope para el for
    $this->enterScope('for_' . $context->getStart()->getLine());
    
    try {
        // Visitar declaración de variable del for
        // Visitar condición
        // Visitar bloque
        
    } catch (BreakException $e) {
        // Salir del bucle
    } catch (ContinueException $e) {
        // Continuar siguiente iteración
    } finally {
        $this->exitScope();
    }
}
```

### 2. Evaluación de Condiciones

```php
private function evaluateCondition($context): bool {
    $value = $this->visit($context);
    
    if (!$value instanceof Value) {
        $this->addSemanticError(
            "La condición debe ser una expresión válida",
            $context->getStart()->getLine(),
            $context->getStart()->getCharPositionInLine()
        );
        return false;
    }
    
    return $value->toBool();
}
```

### 3. Funciones con Hoisting

```php
// En visitProgram, primero recolectar todas las funciones
private function collectFunctions($context) {
    for ($i = 0; $i < $context->getChildCount(); $i++) {
        $child = $context->getChild($i);
        if ($child instanceof FunctionDeclarationContext) {
            $name = $child->ID()->getText();
            $this->functions[$name] = $child;
        }
    }
}
```

## 🎨 Ejemplo de Prueba Completa

```golampi
// test4.golampi - Control de flujo
func main() {
    var x int32 = 10
    var y int32 = 20
    
    // If-else
    if x < y {
        fmt.Println("x es menor que y")
    } else {
        fmt.Println("x es mayor o igual que y")
    }
    
    // For tradicional
    for i := 0; i < 5; i += 1 {
        fmt.Println("Iteración:", i)
    }
    
    // For como while
    var contador int32 = 0
    for contador < 3 {
        fmt.Println("Contador:", contador)
        contador = contador + 1
    }
}
```

## 📊 Checklist de Validación

Antes de considerar completada cada fase, verificar:

- [ ] Código limpio y documentado
- [ ] Sin errores de PHP
- [ ] Traits correctamente implementados
- [ ] Pruebas exitosas
- [ ] Tabla de símbolos correcta
- [ ] Detección de errores funcionando
- [ ] Compatibilidad con especificación del proyecto

## 🚀 Comandos Útiles

```bash
# Regenerar parser después de cambios en gramática
java -jar antlr-4.13.1-complete.jar -Dlanguage=PHP -visitor -no-listener Golampi.g4 -o generated/

# Regenerar autoload después de agregar traits
composer dump-autoload -o

# Ejecutar prueba específica
php test/test.php test/test4.golampi

# Verificar sintaxis PHP
php -l src/Traits/NuevoTrait.php
```

## 📖 Recursos de Consulta

- **Especificación del Proyecto**: EnunciadoProyecto1.pdf
- **Gramática**: Golampi.g4
- **Tablas de Compatibilidad**: Sección 3.3.6 del proyecto
- **Control de Flujo**: Sección 3.3.9 del proyecto
- **Funciones**: Sección 3.3.12 del proyecto

---

**Siguiente acción recomendada**: Empezar con la Fase 1 (Control de Flujo) creando el trait `ControlFlowVisitor` y las excepciones de control de flujo.