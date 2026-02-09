# Golampi Interpreter - Backend

Intérprete del lenguaje Golampi desarrollado con ANTLR4 y PHP usando el patrón Visitor.

## 📋 Requisitos

- PHP >= 8.0
- Java Runtime Environment (para ANTLR)
- Composer
- ANTLR 4.13.1

## 🚀 Configuración Inicial

### 1. Descargar ANTLR

```bash
cd ~/Downloads
wget https://www.antlr.org/download/antlr-4.13.1-complete.jar
# O descárgalo manualmente desde: https://www.antlr.org/download.html
```

### 2. Mover ANTLR al directorio del proyecto

```bash
cp ~/Downloads/antlr-4.13.1-complete.jar /ruta/al/proyecto/
```

### 3. Generar el Parser desde la gramática

```bash
java -jar antlr-4.13.1-complete.jar -Dlanguage=PHP -visitor -no-listener Golampi.g4 -o generated/
```

Este comando generará:
- `GolampiLexer.php` - Analizador léxico
- `GolampiParser.php` - Analizador sintáctico
- `GolampiVisitor.php` - Interfaz del visitor (base)
- Otras clases de contexto

### 4. Instalar dependencias de PHP

```bash
composer install
```

## 📁 Estructura del Proyecto

```
golampi-interpreter/
├── Golampi.g4                    # Gramática ANTLR4
├── composer.json                 # Configuración de Composer
├── antlr-4.13.1-complete.jar    # JAR de ANTLR (descargar)
├── generated/                    # Código generado por ANTLR (auto)
│   ├── GolampiLexer.php
│   ├── GolampiParser.php
│   └── GolampiVisitor.php (interfaz)
├── src/
│   ├── Traits/
│   │   ├── ErrorHandler.php         # Trait para manejo de errores
│   │   └── SymbolTableManager.php   # Trait para tabla de símbolos
│   ├── Runtime/
│   │   ├── Value.php                # Clase para valores en runtime
│   │   └── Environment.php          # Entorno de variables
│   └── Visitor/
│       ├── BaseVisitor.php          # Visitor base con traits
│       └── GolampiVisitor.php       # Implementación del visitor
└── public/
    └── index.php                     # Punto de entrada API
```

## 🔧 Uso

### Generar parser cuando modificas la gramática

```bash
composer generate-parser
# O manualmente:
java -jar antlr-4.13.1-complete.jar -Dlanguage=PHP -visitor -no-listener Golampi.g4 -o generated/
```

### Implementar el Visitor

El archivo `src/Visitor/GolampiVisitor.php` debe extender el `GolampiVisitor` generado por ANTLR.

Después de generar el parser, deberás:

1. Hacer que `GolampiVisitor` extienda la clase generada:

```php
// En src/Visitor/GolampiVisitor.php
namespace Golampi\Visitor;

use Golampi\Runtime\Value;

// Importar el visitor generado
require_once __DIR__ . '/../../generated/GolampiVisitor.php';

class GolampiVisitor extends \GolampiVisitor // Clase generada
{
    use \Golampi\Traits\ErrorHandler;
    use \Golampi\Traits\SymbolTableManager;
    
    // Implementar métodos visit*
    
    public function visitProgram($ctx) {
        // Tu implementación
    }
    
    public function visitIntLiteral($ctx) {
        return Value::int32((int)$ctx->INT32()->getText());
    }
    
    // ... más métodos
}
```

## 📊 Características Implementadas

### ✅ Base del Sistema

- [x] Gramática ANTLR4 completa de Golampi
- [x] Sistema de tipos con Value
- [x] Entorno de variables (Environment)
- [x] Trait para manejo de errores
- [x] Trait para tabla de símbolos
- [x] Funciones embebidas (fmt.Println, len, now, substr, typeOf)

### 🔨 Operaciones Implementadas

- [x] Operadores aritméticos con tabla de compatibilidad
- [x] Operadores relacionales
- [x] Operadores lógicos con cortocircuito
- [x] Manejo de nil

### 📝 Pendiente de Implementar

- [ ] Métodos visit* para cada regla de la gramática
- [ ] Declaración de variables y constantes
- [ ] Estructuras de control (if, switch, for)
- [ ] Funciones y llamadas
- [ ] Arreglos
- [ ] Punteros y referencias
- [ ] Generación de reportes

## 🎯 Próximos Pasos

1. **Generar el parser**: Ejecuta ANTLR sobre `Golampi.g4`
2. **Conectar el visitor**: Modifica `GolampiVisitor.php` para extender la clase generada
3. **Implementar visit methods**: Implementa un método `visit*` por cada regla de la gramática
4. **Crear API endpoint**: Desarrolla `public/index.php` para recibir código fuente
5. **Probar con casos simples**: Empieza con expresiones aritméticas simples

## 📚 Referencias

- [ANTLR4 Documentation](https://github.com/antlr/antlr4/blob/master/doc/index.md)
- [ANTLR4 PHP Target](https://github.com/antlr/antlr4/blob/master/doc/php-target.md)
- [Gramática de Go](https://go.dev/ref/spec)

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