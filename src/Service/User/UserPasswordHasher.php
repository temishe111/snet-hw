<?php

namespace App\Service\User;

class UserPasswordHasher
{
    const SALT = 'snet_application';

    /**
     * @param string $password
     * @return string
     */
    public function hash(string $password): string
    {
        return password_hash(self::SALT . $password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $hash
     * @param string $password
     * @return bool
     */
    public function isPasswordValid(string $hash, string $password): bool
    {
        return password_verify(self::SALT . $password, $hash);
    }
}
