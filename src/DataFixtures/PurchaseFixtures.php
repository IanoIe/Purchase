<?php

namespace App\DataFixtures;

use App\Entity\Purchase;
use App\Entity\User;
use App\DataFixtures\UserFixtures;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PurchaseFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $purchase = new Purchase();
        $purchase->setStoreName('Carrefour');
        $purchase->setProductName('2kg Banana');
        $purchase->setUnitPrice('5.0');
        $purchase->setQuantity('2');
        $purchase->setTotalPrice('10.5');
        $purchase->setDate(new DateTime('2025-06-30'));

        $purchase->setUser($this->getReference(UserFixtures::TEST_USER, User::class));
        $manager->persist($purchase);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
