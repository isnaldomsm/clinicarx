<?php

namespace Rx\Auth;


class AccessControl
{
    const NONE          = 0;
    const ADMIN_READ    = 1;
    const ADMIN_WRITE   = 2;
    const ADMIN_EXECUTE = 4;
    const USER_READ     = 8;
    const USER_WRITE    = 16;
    const USER_EXECUTE  = 32;
    const GUEST_READ    = 64;
    const GUEST_WRITE   = 128;
    const GUEST_EXECUTE = 256;
    const ALL           = 511;

    /**
     * @var int Armazena as configurações de permissões da classe
     */
    private $_permissions;

    public function __construct()
    {
        $this->_permissions = self::ADMIN_READ | self::ADMIN_WRITE |
            self::ADMIN_EXECUTE | self::USER_READ | self::GUEST_READ;
    }

    public function toInt()
    {
        return $this->_permissions;
    }

    public function enableAdminRead()
    {
        $this->_permissions |= self::ADMIN_READ;
    }

    public function disableAdminRead()
    {
        //TODO: Implementar disableAdminRead
    }

    public function enableAdminWrite()
    {
        $this->_permissions |= self::ADMIN_WRITE;
    }

    public function disableAdminWrite()
    {
        //TODO: Implementar disableAdminWrite
    }

    public function enableAdminExecute()
    {
        $this->_permissions |= self::ADMIN_EXECUTE;
    }

    public function disableAdminExecute()
    {
        //TODO: Implementar disableAdminExecute
    }

    public function enableUserRead()
    {
        $this->_permissions |= self::USER_READ;
    }

    public function disableUserRead()
    {
        //TODO: Implementar disableUserRead
    }

    public function enableUserWrite()
    {
        $this->_permissions |= self::USER_WRITE;
    }

    public function disableUserWrite()
    {
        //TODO: Implementar disableUserWrite
    }

    public function enableUserExecute()
    {
        $this->_permissions |= self::USER_EXECUTE;
    }

    public function disableUserExecute()
    {
        //TODO: Implementar disableUserExecute
    }

    public function enableGuestRead()
    {
        $this->_permissions |= self::GUEST_READ;
    }

    public function disableGuestRead()
    {
        //TODO: Implementar disableGuestRead
    }

    public function enableGuestWrite()
    {
        $this->_permissions |= self::GUEST_WRITE;
    }

    public function disableGuestWrite()
    {
        //TODO: Implementar disableGuestWrite
    }

    public function enableGuestExecute()
    {
        $this->_permissions |= self::GUEST_EXECUTE;
    }

    public function disableGuestExecute()
    {
        //TODO: Implementar disableGuestExecute
    }

    public function enableAll()
    {
        $this->_permissions = self::ALL;
    }

    public function disableAll()
    {
        $this->_permissions = self::NONE;
    }
}
