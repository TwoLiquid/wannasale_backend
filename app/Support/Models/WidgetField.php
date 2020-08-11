<?php

namespace App\Support\Models;

class WidgetField
{
    private $name;
    private $title;
    private $type;
    private $position;
    private $placeholder = null;
    private $options = null;

    /**
     * WidgetField constructor.
     * @param string $name
     * @param string $title
     * @param string $type
     * @param null|string $placeholder
     * @param array|null $options
     * @param int $position
     */
    public function __construct(
        string $name,
        string $title,
        string $type,
        ?string $placeholder,
        ?array $options,
        int $position
    )
    {
        $this->name = $name;
        $this->title = $title;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->options = $options;
        $this->position = $position;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name'          => $this->name,
            'title'         => $this->title,
            'type'          => $this->type,
            'placeholder'   => $this->placeholder,
            'options'       => $this->options,
            'position'      => $this->position
        ];
    }

    /**
     * @return null|string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return WidgetField
     */
    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return WidgetField
     */
    public function setTitle(string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType() : ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return WidgetField
     */
    public function setType(string $type) : self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPlaceholder() : ?string
    {
        return $this->placeholder;
    }

    /**
     * @param null|string $placeholder
     * @return WidgetField
     */
    public function setPlaceholder(?string $placeholder) : self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getOptions() : ?array
    {
        return $this->options;
    }

    /**
     * @param array|null $options
     * @return WidgetField
     */
    public function setOptions(?array $options) : self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosition() : ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return WidgetField
     */
    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }
}