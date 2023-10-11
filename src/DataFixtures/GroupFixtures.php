<?php

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class GroupFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies():array
    {
        return [
            UserFixtures::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {
        $name = ["Grabes", "Rotation", "Flips", "Rotations désaxées ", "Slides", "One foot tricks", "Old school"];
        $description = ["Un grab consiste à attraper la planche avec la main pendant le saut.",
            " Le principe est d'effectuer une rotation horizontale pendant le saut, puis d'attérir en position switch ou normal.",
            "Un flip est une rotation verticale pendant le saut.",
            "Une rotation désaxée est une rotation horizontale pendant le saut, mais avec un désaxage du corps par rapport à la planche.",
            "Un slide consiste à glisser sur une barre de slide.",
            "Un one foot consiste à enlever un pied de la planche pendant le saut.",
            "Old school désigne un style de freestyle qui fait penser au freestyle des années 1980"
        ];
        foreach ($name as $key => $value) {
            $group = new Group();
            $group->setName($value);
            $group->setDescription($description[$key]);
            $group->setUser($this->getReference('user' . $key));
            $manager->persist($group);
            $this->addReference($value, $group);
            var_dump($value);
        }

        $manager->flush();
    }
}
