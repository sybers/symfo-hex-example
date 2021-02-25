<?php

namespace App\Application\Repository;

use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserRepositoryInterface extends PasswordUpgraderInterface
{
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void;
}
