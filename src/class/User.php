<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Permission.php';
require_once "{$link}";

class User
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var string
     */
    private $birth_date;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Permission
     */
    private $permission;

    /**
     * @var int
     */
    private $points;

    /**
     * User constructor.
     * @param int $id
     * @param string $last_name
     * @param string $first_name
     * @param string $pseudo
     * @param string $birth_date
     * @param string $email
     * @param Permission $permission
     * @param int $points
     */
    public function __construct(int $id, string $last_name, string $first_name, string $pseudo, string $birth_date, string $email, Permission $permission, int $points)
    {
        $this->id = $id;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->pseudo = $pseudo;
        $this->birth_date = $birth_date;
        $this->email = $email;
        $this->permission = $permission;
        $this->points = $points;
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
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    /**
     * @param string $birth_date
     */
    public function setBirthDate(string $birth_date)
    {
        $this->birth_date = $birth_date;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return Permission
     */
    public function getPermission(): Permission
    {
        return $this->permission;
    }

    /**
     * @param Permission $permission
     */
    public function setPermission(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points)
    {
        $this->points = $points;
    }


}