<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Card.php';
require_once "{$link}";

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Theme.php';
require_once "{$link}";

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'User.php';
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
     * @var string
     */
    private $background_name;

    /**
     * @var Card[]
     */
    private $cards;

    /**
     * @var string[]
     */
    private $themes;

    /**
     * @var User
     */
    private $creator;

    /**
     * CardPackage constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $background_name
     * @param string $image_name
     * @param Card[] $cards
     * @param string[] $themes
     * @param User $creator
     */
    public function __construct(int $id, string $name, string $description, string $background_name, string $image_name, array $cards, array $themes, User $creator)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image_name = $image_name;
        $this->background_name = $background_name;
        $this->cards = $cards;
        $this->themes = $themes;
        $this->creator = $creator;
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
    public function getBackgroundName(): string
    {
        return $this->background_name;
    }

    /**
     * @param string $background_name
     */
    public function setBackgroundName(string $background_name)
    {
        $this->background_name = $background_name;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return "http:\\\\quizjapan" . DIRECTORY_SEPARATOR . "ressources" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . $this->getImageName();
    }

    /**
     * @return string
     */
    public function getBackgroundFullPath(): string
    {
        return "\\\\quizjapan" . DIRECTORY_SEPARATOR . "ressources" . DIRECTORY_SEPARATOR . "backgrounds" . DIRECTORY_SEPARATOR . $this->getBackgroundName();
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
     * @return string[]
     */
    public function getThemes(): array
    {
        return $this->themes;
    }

    /**
     * @param string[] $themes
     */
    public function setThemes(array $themes)
    {
        $this->themes = $themes;
    }

    /**
     * @return User
     */
    public function getCreator(): User
    {
        return $this->creator;
    }

    /**
     * @param User $creator
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;
    }
}