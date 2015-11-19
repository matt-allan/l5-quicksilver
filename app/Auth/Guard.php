<?php

namespace App\Auth;

use Quicksilver\Domain\Customer;
use Quicksilver\Domain\User;

class Guard implements \Quicksilver\Application\Auth\Guard
{
    /**
     * Gets the current logged in user.
     *
     * @return User
     */
    public function user()
    {
        // This is just a temp hack until I actually implement this.
        // @todo
        return app('Quicksilver\Domain\Customer\Repository')->find(1);
    }
}