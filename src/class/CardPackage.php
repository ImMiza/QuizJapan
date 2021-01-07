<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Card.php';
require_once "{$link}";

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Theme.php';
require_once "{$link}";

class CardPackage
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image_name;

    /**
     * @var Card[]
     */
    private $cards;

    /**
     * @var Theme
     */
    private $theme;

    /**
     * CardPackage constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $image_name
     * @param Card[] $cards
     * @param Theme $theme
     */
    public function __construct(int $id, string $name, string $description, string $image_name, array $cards, Theme $theme)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->$image_name = $image_name;
        $this->cards = $cards;
        $this->theme = $theme;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getImageName(): string
    {
        return $this->image_name;
    }

    /**
     * @param string $image_name
     */
    public function setImageName(string $image_name)
    {
        $this->image_name = $image_name;
    }

    /**
     * @return string
     */
    public function getImageFullPath(): string
    {
        $path = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "ressources" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
        $path = str_replace("\\", "/", $path);
        return $path . $this->getImageName();
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param Card[] $cards
     */
    public function setCards(array $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return Theme
     */
    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * @param Theme $theme
     */
    public function setTheme(Theme $theme)
    {
        $this->theme = $theme;
    }
}