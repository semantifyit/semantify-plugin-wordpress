<?php

/**
 * Class Registry
 */
abstract class Registry
{
    /**
     * @var array
     */
    protected static $_data = array();

    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        self::$_data[$key] = $value;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        if (array_key_exists($key, self::$_data)) {
            return self::$_data[$key];
        }

        return $default;
    }
}
