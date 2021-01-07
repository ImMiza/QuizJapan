<?php


class Permission
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
     * @var bool
     */
    private $admin_access;

    /**
     * Permission constructor.
     * @param int $id
     * @param string $name
     * @param bool $admin_access
     */
    public function __construct(int $id, string $name, bool $admin_access)
    {
        $this->id = $id;
        $this->name = $name;
        $this->admin_access = $admin_access;
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
     * @return bool
     */
    public function hasAdminAccess(): bool
    {
        return $this->admin_access;
    }

    /**
     * @param bool $admin_access
     */
    public function setAdminAccess(bool $admin_access)
    {
        $this->admin_access = $admin_access;
    }

}