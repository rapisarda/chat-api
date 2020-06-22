<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i= 1; $i < 10; $i++) {
            $user = new User();
            $user->setEmail("user{$i}@test.com");
            $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$Rp47FEbCNphBsqv03pTCtA$QDDz+IPUqCNkcioNrGNMl2lRCXRurgBXqrr3mw2Jqx4');
            $manager->persist($user);
        }

        $manager->flush();
    }
}
