<?php

declare(strict_types=1);

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
    use FileValidation;

    public static $config;
    public static $validActions = ['remove'];

    public static function validate(string $file): void
    {
        if (self::isValid($file) === false) {
            throw new \Exception('Invalid config file.');
        }

        try {
            self::$config = json_decode(file_get_contents($file), false, 512, JSON_THROW_ON_ERROR);

            foreach (self::$config->elements as $element => $definition) {
                if (!isset($definition->action)) {
                    throw new \Exception('Undefined action for element ' . $element);
                }

                if (!in_array($definition->action, self::$validActions)) {
                    throw new \Exception('Invalid action ' . $definition->action . ' for element ' . $element);
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
