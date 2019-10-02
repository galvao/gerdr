<?php declare(strict_types = 1);
namespace Gerdr;

/**
 * Gerdr - Manipulate DOM HTML trees
 *
 * @author Er Galvao Abbott <galvao@php.net>
 * @link https://github.com/galvao/gerdr
 * @license MIT
 */

trait FileValidation
{
    private static function isValid(string $file): bool
    {
        if (!is_file($file)) {
            return FALSE;
        }

        if (!is_readable($file)) {
            return FALSE;
        }

        return TRUE;
    }
}
