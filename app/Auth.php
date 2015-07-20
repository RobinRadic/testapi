<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App;


class Auth extends \Dingo\Api\Auth\Auth
{
    /** @return \App\User; */
    public function getUser($authenticate = true)
    {
        return parent::getUser($authenticate);
    }

    /** @return \App\User; */
    public function user($authenticate = true)
    {
        return parent::user($authenticate);
    }


}
