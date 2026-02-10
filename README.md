# 🚀 Intérprete Golampi - Versión Refactorizada

## 📋 Descripción

Intérprete del lenguaje Golampi implementado con:
- **ANTLR 4.13.1** para análisis léxico y sintáctico
- **PHP 8.0+** como lenguaje de implementación
- **Patrón Visitor** con **Traits** para organización modular

## 🏗️ Arquitectura Refactorizada

### Estructura de Directorios

```
golampi-refactored/
├── Golampi.g4                          # Gramática ANTLR
├── composer.json                       # Configuración de Composer
├── README.md                           # Este archivo
│
├── src/
│   ├── Traits/                         # Traits modulares
│   │   ├── ArithmeticOperations.php    # Operaciones aritméticas
│   │   ├── RelationalOperations.php    # Operaciones relacionales
│   │   ├── ExpressionVisitor.php       # Visita de expresiones
│   │   ├── DeclarationVisitor.php      # Visita de declaraciones
│   │   ├── StatementVisitor.php        # Visita de sentencias
│   │   ├── ErrorHandler.php            # Manejo de errores
│   │   └── SymbolTableManager.php      # Tabla de símbolos
│   │
│   ├── Runtime/                        # Sistema de runtime
│   │   ├── Value.php                   # Valores tipados
│   │   └── Environment.php             # Entorno de variables
│   │
│   └── Visitor/                        # Visitor pattern
│       ├── BaseVisitor.php             # Clase base con funciones embebidas
│       └── GolampiVisitor.php          # Visitor principal (usa todos los traits)
│
├── test/                               # Archivos de prueba
│   ├── test.php                        # Script de prueba mejorado
│   ├── test1.golampi                   # Prueba básica
│   ├── test2.golampi                   # Prueba con errores
│   └── test3.golampi                   # Prueba de operaciones
│
├── generated/                          # Archivos generados por ANTLR (crear)
└── public/                             # Frontend (crear después)
```

### Ventajas de la Refactorización

✅ **Modularidad**: Cada trait maneja una responsabilidad específica
✅ **Mantenibilidad**: Archivos más pequeños y enfocados
✅ **Reutilización**: Los traits pueden usarse en otras clases
✅ **Legibilidad**: Código más organizado y fácil de entender
✅ **Escalabilidad**: Fácil agregar nuevas funcionalidades

## 🔧 Instalación

### 1. Instalar Dependencias PHP

```bash
composer install
```

### 2. Descargar ANTLR 4.13.1

```bash
wget https://www.antlr.org/download/antlr-4.13.1-complete.jar
```

### 3. Generar el Parser

```bash
java -jar antlr-4.13.1-complete.jar \
     -Dlanguage=PHP \
     -visitor \
     -no-listener \
     Golampi.g4 \
     -o generated/
```

### 4. Generar el Autoload

```bash
composer dump-autoload -o
```

## 🧪 Ejecutar Pruebas

### Ejecutar archivo específico

```bash
php test/test.php test/test1.golampi
```

### Ejecutar prueba por defecto

```bash
php test/test.php
```

## 📊 Salida del Sistema de Pruebas

El sistema de pruebas muestra:

1. **Información del archivo**
   - Nombre, tamaño y número de líneas

2. **Salida del programa**
   - Resultado de `fmt.Println()` y otras salidas

3. **Reporte de errores**
   - Tabla formateada con errores léxicos, sintácticos y semánticos
   - Línea y columna de cada error

4. **Tabla de símbolos**
   - Identificadores declarados
   - Tipos, ámbitos y valores
   - Ubicación en el código

5. **Resumen**
   - Total de errores
   - Total de símbolos
   - Estado final de la ejecución
   - Tiempo de ejecución

## 📝 Ejemplo de Salida

```
====================================================================================================
                    INTÉRPRETE GOLAMPI - SISTEMA DE PRUEBAS
====================================================================================================

📄 Archivo: test1.golampi
📊 Tamaño: 142 caracteres
📝 Líneas: 7

====================================================================================================
RESULTADOS DE LA EJECUCIÓN
====================================================================================================
Estado: ✅ Ejecución completada exitosamente
Tiempo de ejecución: 12.45 ms

----------------------------------------------------------------------------------------------------
📤 SALIDA DEL PROGRAMA:
----------------------------------------------------------------------------------------------------
La suma es: 30

========================================================================================================================
TABLA DE SÍMBOLOS
========================================================================================================================
Identificador        Tipo            Ámbito          Valor                          Línea    Columna 
------------------------------------------------------------------------------------------------------------------------
fmt                  namespace       global          namespace                      0        0       
fmt.Println          function        global          nil                            0        0       
x                    int32           global          10                             3        4       
y                    int32           global          20                             4        4       
result               int32           global          30                             5        4       
========================================================================================================================

====================================================================================================
RESUMEN
====================================================================================================
Total de errores: 0
Total de símbolos: 5
Estado final: ✅ EXITOSO
====================================================================================================
```

## 🎯 Traits Implementados

### ArithmeticOperations
- `performAddition()` - Suma con tabla de compatibilidad
- `performSubtraction()` - Resta
- `performMultiplication()` - Multiplicación (incluye repetición de strings)
- `performDivision()` - División con manejo de división por cero
- `performModulo()` - Módulo

### RelationalOperations
- `performComparison()` - Comparaciones relacionales
- `compareEquality()` - Igualdad/Desigualdad
- `compareRelational()` - Mayor/Menor
- `performLogicalAnd()` - AND con cortocircuito
- `performLogicalOr()` - OR con cortocircuito

### ExpressionVisitor
- `visitIntLiteral()`, `visitFloatLiteral()`, `visitStringLiteral()`
- `visitTrueLiteral()`, `visitFalseLiteral()`, `visitNilLiteral()`
- `visitAdditive()`, `visitMultiplicative()`
- `visitEquality()`, `visitRelational()`
- `visitLogicalAnd()`, `visitLogicalOr()`
- `visitGroupedExpression()`

### DeclarationVisitor
- `visitVarDeclSimple()` - Declaración sin inicialización
- `visitVarDeclWithInit()` - Declaración con inicialización
- `visitIdentifier()` - Referencias a variables
- `extractType()` - Extracción de tipos
- `getDefaultValue()` - Valores por defecto

### StatementVisitor
- `visitProgram()` - Programa principal
- `visitDeclaration()` - Declaraciones
- `visitBlock()` - Bloques de código
- `visitFuncDeclSingleReturn()` - Funciones
- `visitFunctionCall()` - Llamadas a función
- `visitExpressionStatement()` - Sentencias de expresión

### ErrorHandler
- `addError()`, `addLexicalError()`, `addSyntacticError()`, `addSemanticError()`
- `getErrors()`, `hasErrors()`, `clearErrors()`

### SymbolTableManager
- `enterScope()`, `exitScope()`
- `addSymbol()`, `symbolExistsInCurrentScope()`, `findSymbol()`
- `getCurrentScopeName()`, `getSymbolTable()`, `clearSymbolTable()`

## ✨ Funciones Embebidas

- `fmt.Println(...args)` - Imprime en consola
- `len(string|array)` - Longitud
- `now()` - Fecha y hora actual (YYYY-MM-DD HH:MM:SS)
- `substr(string, start, length)` - Subcadena
- `typeOf(value)` - Tipo de una variable

## 🔜 Próximos Pasos

### Implementar traits adicionales:
1. **ControlFlowVisitor** - if, switch, for, break, continue
2. **FunctionVisitor** - Declaración y llamada de funciones usuario
3. **ArrayVisitor** - Arreglos y acceso a elementos
4. **PointerVisitor** - Punteros y referencias

### Crear el Frontend:
1. Editor de código
2. Botones de acción
3. Consola de salida
4. Descarga de reportes

## 📚 Recursos

- **ANTLR4 Documentation**: https://github.com/antlr/antlr4
- **ANTLR PHP Target**: https://github.com/antlr/antlr4/blob/master/doc/php-target.md
- **Go Language Specification**: https://go.dev/ref/spec

## 🎓 Créditos

**Universidad San Carlos de Guatemala**  
**Curso**: Organización de Lenguajes y Compiladores 2  
**Proyecto**: Intérprete Golampi

---

**Nota**: Este es el código base refactorizado. Continúa la implementación siguiendo la guía en IMPLEMENTATION.md

## 🐛 Debug

Para ver el árbol sintáctico generado (útil para debug):

```bash
java -jar antlr-4.13.1-complete.jar -Dlanguage=PHP Golampi.g4
javac Golampi*.java
java org.antlr.v4.gui.TestRig Golampi program -gui < test.golampi
```

## 📄 Licencia

Proyecto académico - Universidad San Carlos de Guatemala

java -jar Backend/antlr-4.13.1-complete.jar -Dlanguage=PHP -visitor -no-listener Backend/Golampi.g4 -o generated/