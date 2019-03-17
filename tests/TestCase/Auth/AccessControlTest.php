<?php

namespace Rx\Test\TestCase\Auth;

use Rx\Auth\AccessControl;
use PHPUnit\Framework\TestCase;

class AccessControlTest extends TestCase
{
    public function testNewInstanceReturnsDefaultValue()
    {
        $access = new AccessControl();
        $default = AccessControl::ADMIN_READ | AccessControl::ADMIN_WRITE |
            AccessControl::ADMIN_EXECUTE | AccessControl::USER_READ |
            AccessControl::GUEST_READ;

        $this->assertEquals($default, $access->toInt());
    }

    public function testEnableAllAttributesShouldWork()
    {
        $access = new AccessControl();

        $access->disableAll();
        $this->assertEquals(AccessControl::NONE, $access->toInt());

        $access->enableAdminRead();
        $access->enableAdminWrite();
        $access->enableAdminExecute();
        $access->enableUserRead();
        $access->enableUserWrite();
        $access->enableUserExecute();
        $access->enableGuestRead();
        $access->enableGuestWrite();
        $access->enableGuestExecute();

        $this->assertEquals(AccessControl::ALL, $access->toInt());
    }

    public function testDisableAllAttributesShouldWork()
    {
        $access = new AccessControl();

        $access->enableAll();
        $this->assertEquals(AccessControl::ALL, $access->toInt());

        $access->disableAdminRead();
        $access->disableAdminWrite();
        $access->disableAdminExecute();
        $access->disableUserRead();
        $access->disableUserWrite();
        $access->disableUserExecute();
        $access->disableGuestRead();
        $access->disableGuestWrite();
        $access->disableGuestExecute();

        $this->assertEquals(AccessControl::NONE, $access->toInt());
    }
}
