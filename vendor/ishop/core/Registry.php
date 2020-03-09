<?php


namespace ishop;


class Registry
{
    use TSingletone;
    protected static $properties = [];

    public static function setProperty(string $name, $value): void
    {
        self::$properties[$name] = $value;
    }

    public function getProperty(string $name)
    {
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        return null;
    }

    public function getPropeties()
    {
        return self::$properties;
    }
}