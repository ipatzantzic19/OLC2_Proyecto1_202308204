<?php

namespace Golampi\Runtime;

class Value
{
    private string $type;
    private $value;

    public function __construct(string $type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function isNil(): bool
    {
        return $this->type === 'nil' || $this->value === null;
    }

    public function toBool(): bool
    {
        if ($this->isNil()) return false;
        if ($this->type === 'bool') return $this->value;
        if ($this->type === 'int32') return $this->value !== 0;
        if ($this->type === 'float32') return $this->value !== 0.0;
        if ($this->type === 'string') return $this->value !== '';
        return true;
    }

    public function toString(): string
    {
        if ($this->isNil()) return 'nil';
        if ($this->type === 'bool') return $this->value ? 'true' : 'false';
        if ($this->type === 'rune') return "'" . chr($this->value) . "'";
        if ($this->type === 'string') return $this->value;
        return (string)$this->value;
    }

    public static function nil(): Value
    {
        return new Value('nil', null);
    }

    public static function int32(int $value): Value
    {
        return new Value('int32', $value);
    }

    public static function float32(float $value): Value
    {
        return new Value('float32', $value);
    }

    public static function bool(bool $value): Value
    {
        return new Value('bool', $value);
    }

    public static function string(string $value): Value
    {
        return new Value('string', $value);
    }

    public static function rune(int $value): Value
    {
        return new Value('rune', $value);
    }
}
