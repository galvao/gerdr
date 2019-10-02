<?php declare(strict_types = 1);
namespace Gerdr;

/**
 * Gerdr - Manipulate DOM HTML trees
 *
 * @author Er Galvao Abbott <galvao@php.net>
 * @link https://github.com/galvao/gerdr
 * @license MIT
 */

class Config
{
    public static $config;

    public static function validate(string $file): void
    {
        if (self::isValid($file) === FALSE) {
            throw new \Exception('Invalid config file.');
        }

        try {
            self::$config = json_decode(file_get_contents($file), FALSE, 512, JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    use FileValidation;
}
