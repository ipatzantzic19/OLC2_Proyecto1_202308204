# Guía de Implementación - Paso a Paso

## 🎯 Objetivo
Implementar un intérprete funcional de Golampi usando ANTLR4, PHP y el patrón Visitor.

## 📝 Checklist de Implementación

### Fase 1: Configuración ✅
- [x] Crear gramática Golampi.g4
- [x] Crear estructura de carpetas
- [x] Implementar clases base (Value, Environment)
- [x] Crear traits (ErrorHandler, SymbolTableManager)
- [x] Configurar composer.json

### Fase 2: Generación del Parser
- [ ] Descargar ANTLR 4.13.1
- [ ] Ejecutar generación: `java -jar antlr-4.13.1-complete.jar -Dlanguage=PHP -visitor -no-listener Golampi.g4 -o generated/`
- [ ] Verificar archivos generados en `generated/`

### Fase 3: Implementación del Visitor

#### 3.1 Conectar el Visitor Generado
```php
// src/Visitor/GolampiVisitor.php
require_once __DIR__ . '/../../generated/GolampiVisitor.php';

class GolampiVisitor extends \GolampiVisitor {
    // Tu código aquí
}
```

#### 3.2 Implementar Métodos Visit (en orden de prioridad)

##### Nivel 1: Expresiones Básicas
- [ ] `visitIntLiteral()` - Literales enteros
- [ ] `visitFloatLiteral()` - Literales flotantes
- [ ] `visitStringLiteral()` - Literales string
- [ ] `visitBoolLiteral()` - true/false
- [ ] `visitNilLiteral()` - nil
- [ ] `visitRuneLiteral()` - Caracteres

##### Nivel 2: Expresiones Aritméticas
- [ ] `visitAdditive()` - Suma y resta
- [ ] `visitMultiplicative()` - Multiplicación, división, módulo
- [ ] `visitUnary()` - Negación unaria
- [ ] `visitGroupedExpression()` - Paréntesis

##### Nivel 3: Variables
- [ ] `visitIdentifier()` - Referencias a variables
- [ ] `visitVarDeclSimple()` - Declaración de variables
- [ ] `visitVarDeclWithInit()` - Declaración con inicialización
- [ ] `visitShortVarDeclaration()` - Declaración corta `:=`
- [ ] `visitAssignment()` - Asignación a variables

##### Nivel 4: Expresiones Lógicas y Relacionales
- [ ] `visitEquality()` - == y !=
- [ ] `visitRelational()` - >, <, >=, <=
- [ ] `visitLogicalAnd()` - && (con cortocircuito)
- [ ] `visitLogicalOr()` - || (con cortocircuito)

##### Nivel 5: Funciones Embebidas
- [ ] `visitFunctionCall()` - Llamada a funciones
- [ ] Implementar `fmt.Println()` ✅ (ya está en BaseVisitor)
- [ ] Implementar `len()` ✅
- [ ] Implementar `now()` ✅
- [ ] Implementar `substr()` ✅
- [ ] Implementar `typeOf()` ✅

##### Nivel 6: Control de Flujo
- [ ] `visitIfStatement()` - Condicionales
- [ ] `visitIfElse()` - If-else
- [ ] `visitForTraditional()` - For tradicional
- [ ] `visitForWhile()` - For como while
- [ ] `visitForInfinite()` - For infinito
- [ ] `visitBreakStatement()` - Break
- [ ] `visitContinueStatement()` - Continue

##### Nivel 7: Bloques y Scope
- [ ] `visitBlock()` - Bloques de código
- [ ] Implementar manejo de scopes
- [ ] Implementar tabla de símbolos

##### Nivel 8: Funciones Usuario
- [ ] `visitFunctionDeclaration()` - Declaración de funciones
- [ ] Implementar hoisting de funciones
- [ ] `visitReturnStatement()` - Return
- [ ] Implementar paso de parámetros por valor
- [ ] Implementar múltiples retornos

##### Nivel 9: Arreglos
- [ ] `visitArrayLiteral()` - Literales de arreglos
- [ ] `visitArrayAccess()` - Acceso a elementos
- [ ] `visitArrayAssignment()` - Asignación a elementos
- [ ] Implementar arreglos multidimensionales

##### Nivel 10: Punteros (Avanzado)
- [ ] `visitAddressOf()` - Operador &
- [ ] `visitDereference()` - Operador *
- [ ] Implementar paso por referencia

### Fase 4: API y Frontend
- [ ] Crear `public/index.php` - Endpoint API
- [ ] Implementar manejo de errores en API
- [ ] Crear respuesta JSON estructurada
- [ ] Desarrollar interfaz HTML/CSS
- [ ] Implementar editor de código
- [ ] Conectar frontend con backend

### Fase 5: Reportes
- [ ] Generar reporte de errores (HTML/CSV)
- [ ] Generar tabla de símbolos (HTML/CSV)
- [ ] Implementar descarga de reportes

### Fase 6: Testing
- [ ] Crear casos de prueba para expresiones
- [ ] Crear casos de prueba para variables
- [ ] Crear casos de prueba para control de flujo
- [ ] Crear casos de prueba para funciones
- [ ] Crear casos de prueba para arreglos

## 🔨 Ejemplo de Implementación

### Ejemplo: visitIntLiteral

```php
public function visitIntLiteral($ctx) {
    $text = $ctx->INT32()->getText();
    $value = (int)$text;
    
    // Agregar a tabla de símbolos si es necesario
    // Registrar en reportes si es necesario
    
    return Value::int32($value);
}
```

### Ejemplo: visitAdditive

```php
public function visitAdditive($ctx) {
    // Obtener operandos
    $left = $this->visit($ctx->multiplicative(0));
    
    // Visitar cada operación adicional
    $multiplicativeCount = $ctx->multiplicative()->count();
    for ($i = 1; $i < $multiplicativeCount; $i++) {
        $operator = $ctx->getChild($i * 2 - 1)->getText(); // '+' o '-'
        $right = $this->visit($ctx->multiplicative($i));
        
        if ($operator === '+') {
            $left = $this->performAddition($left, $right);
        } else {
            $left = $this->performSubtraction($left, $right);
        }
        
        // Verificar errores de tipo
        if ($left->isNil()) {
            $this->addSemanticError(
                "Operación inválida entre tipos incompatibles",
                $ctx->start->getLine(),
                $ctx->start->getCharPositionInLine()
            );
        }
    }
    
    return $left;
}
```

### Ejemplo: visitVarDeclWithInit

```php
public function visitVarDeclWithInit($ctx) {
    $line = $ctx->start->getLine();
    $column = $ctx->start->getCharPositionInLine();
    
    // Obtener lista de identificadores
    $ids = [];
    foreach ($ctx->idList()->ID() as $idNode) {
        $ids[] = $idNode->getText();
    }
    
    // Obtener tipo
    $type = $this->visit($ctx->type());
    
    // Evaluar expresiones
    $values = [];
    foreach ($ctx->expressionList()->expression() as $expr) {
        $values[] = $this->visit($expr);
    }
    
    // Verificar que coincidan las cantidades
    if (count($ids) !== count($values)) {
        $this->addSemanticError(
            "Número de variables no coincide con número de valores",
            $line, $column
        );
        return null;
    }
    
    // Declarar variables
    for ($i = 0; $i < count($ids); $i++) {
        $id = $ids[$i];
        $value = $values[$i];
        
        // Verificar que no exista
        if ($this->environment->exists($id)) {
            $this->addSemanticError(
                "Variable '$id' ya fue declarada",
                $line, $column
            );
            continue;
        }
        
        // Verificar tipo
        if ($value->getType() !== $type) {
            $this->addSemanticError(
                "Tipo incompatible: se esperaba $type pero se obtuvo {$value->getType()}",
                $line, $column
            );
        }
        
        // Agregar al entorno
        $this->environment->define($id, $value);
        
        // Agregar a tabla de símbolos
        $this->addSymbol(
            $id,
            $type,
            $this->getCurrentScopeName(),
            $value->getValue(),
            $line,
            $column
        );
    }
    
    return null;
}
```

## 🎓 Tips de Implementación

1. **Empieza simple**: Implementa primero literales y expresiones básicas
2. **Prueba incremental**: Después de cada método, crea una prueba
3. **Usa print debugging**: Agrega `var_dump()` para ver qué recibe cada método
4. **Revisa el árbol**: Usa TestRig de ANTLR para visualizar el árbol sintáctico
5. **Maneja errores**: Siempre verifica tipos y nulos antes de operar

## 📚 Recursos Útiles

- **Documentación ANTLR PHP**: https://github.com/antlr/antlr4/blob/master/doc/php-target.md
- **Referencia de Go**: https://go.dev/ref/spec
- **Tabla de compatibilidad de tipos**: Ver documento del proyecto

## 🚀 Comandos Rápidos

```bash
# Generar parser
java -jar antlr-4.13.1-complete.jar -Dlanguage=PHP -visitor -no-listener Golampi.g4 -o generated/

# Ejecutar prueba
php examples/test.php

# Ver árbol sintáctico (necesita compilar a Java primero)
java org.antlr.v4.gui.TestRig Golampi program -gui < examples/test1.golampi
```
