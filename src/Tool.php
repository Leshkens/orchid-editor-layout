<?php

declare(strict_types=1);

namespace Leshkens\OrchidEditorJsLayout;


class Tool
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $config = [];

    /**
     * @var array|bool
     */
    public $inlineToolbar = true;

    /**
     * @param string $name
     *
     * @return Tool
     */
    public static function make(string $name): self
    {
        $static = new static;

        $static->name = $name;

        return $static;
    }

    /**
     * @param array $config
     *
     * @return Tool
     */
    public function config(array $config = []): self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @param array|bool $inlineToolbar
     *
     * @return Tool
     */
    public function inlineToolbar($inlineToolbar): self
    {
        $this->inlineToolbar = $inlineToolbar;

        return $this;
    }

//    /**
//     * @return Tool
//     */
//    public function shortcut(): self
//    {
//        return $this;
//    }
//
//    /**
//     * @return Tool
//     */
//    public function toolbox(): self
//    {
//        return $this;
//    }

//    /**
//     * @return string
//     */
//    public function __toString(): string
//    {
//
//    }


    /**
     * @return array
     */
    public function serialize(): array
    {
        return get_object_vars($this);
    }
}
