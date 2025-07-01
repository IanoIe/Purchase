<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const TEST_USER = 'TEST_USER';
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('Jean Pierre');
        $user->setEmail('jean@hotmail.com');
        $user->setPassword('$2y$13$uDChN0X4mAXK.NmLJImTXuXdLiNET2f684cYTu6SKpcjos5wzr/6C');
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);
        $this->addReference(self::TEST_USER, $user);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user_group'];
    }
}
