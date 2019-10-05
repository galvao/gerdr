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

class Gerdr
{
    use FileValidation;

    public const VERSION = '0.1.0-alpha';

    public $elementsToWatch  = [];

    private $dom;
    private $domFile;
    private $modifiedDom;
    private $sign;

    public function __construct(string $dom, string $config, bool $signed = false)
    {
        if (self::isValid($dom) === false) {
            throw new \Exception('Invalid DOM file.');
        }

        $this->domFile = $dom;

        try {
            Config::validate($config);
            $this->elementsToWatch = get_object_vars(Config::$config->elements);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        $this->sign = $signed;
    }

    public function process()
    {
        $nodesToProcess = [];

        $this->dom = new \DOMDocument();
        $this->dom->loadHTMLFile($this->domFile);

        foreach ($this->elementsToWatch as $element => $definition) {
            $list = $this->dom->getElementsByTagName($element);

            foreach ($list as $item) {
                $nodesToProcess[] = $item;
            }

            foreach ($nodesToProcess as $node) {
                $parentNode = $node->parentNode;

                if ($this->sign === true) {
                    $parentNode->insertBefore($this->dom->createComment(' Node manipulated by Gerdr '), $node);
                }

                if ($definition->action === 'comment') {
                    $newNode = $node->cloneNode();
                    $newNodeSrc = $this->dom->saveHTML($newNode);
                    $parentNode->replaceChild($this->dom->createComment($newNodeSrc), $node);

                    continue;
                }

                if ($definition->action === 'remove') {
                    if (!isset($definition->attributes)) {
                        $parentNode->removeChild($node);
                        continue;
                    }

                    foreach ($definition->attributes as $attr) {
                        if ($node->hasAttribute($attr)) {
                            $node->removeAttribute($attr);
                        }
                    }
                }
            }
        }
    }

    public function getModifiedDom(): string
    {
        return (string)$this->dom->saveHTML();
    }
}
