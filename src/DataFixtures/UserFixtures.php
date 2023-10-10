<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@test.fr');
            $user->setPassword(password_hash('pass', PASSWORD_DEFAULT));
            $user->setToken(null);
            $user->setUsername('username' . $i);
            $user->setFirstName('firstname' . $i);
            $user->setLastName('lastname' . $i);
            $user->setRoles(['ROLE_USER']);
            $user->setPhotoPath('/assets/images/avatar.jpg');
            $user->setPhotoName('Avatar par défaut');
            $manager->persist($user);
            $this->addReference('user'. $i , $user);
        }
        $manager->flush();
    }

}
