<?php declare(strict_types = 1);
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
    public const VERSION = '0.1.0-alpha';

    public static $validActions = ['remove'];

    public $elementsToWatch  = [];

    private $dom;
    private $domFile;
    private $modifiedDom;

    use FileValidation;

    public function __construct(string $dom, string $config)
    {
        if (self::isValid($dom) === FALSE) {
            throw new \Exception('Invalid DOM file.');
        }

        $this->domFile     = $dom;

        try {
            Config::validate($config);
            $this->elementsToWatch = get_object_vars(Config::$config->elements);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function process()
    {
        $nodesToProcess = [];

        $this->dom = new \DOMDocument();
        $this->dom->loadHTMLFile($this->domFile);

        foreach ($this->elementsToWatch as $element => $definition) {
            if (!isset($definition->action)) {
                throw new \Exception('Undefined action for element ' . $element);
            }

            if (!in_array($definition->action, self::$validActions)) {
                throw new \Exception('Invalid action ' . $definition->action . ' for element ' . $element);
            }

            $list = $this->dom->getElementsByTagName($element);

            foreach($list as $item) {
                $nodesToProcess[] = $item;
            }

            foreach ($nodesToProcess as $node) {
                if ($definition->action === 'remove'){
                    if (!isset($definition->attributes)) {
                        $node->parentNode->removeChild($node);
                    } else {
                        foreach ($definition->attributes as $attr) {
                            if ($node->hasAttribute($attr)) {
                                $node->removeAttribute($attr);
                            }
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
