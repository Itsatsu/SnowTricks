<?php

namespace App\DataFixtures;

use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies():array
    {
        return [
            UserFixtures::class,
            TricksFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $media = new Media();
            $media->setName($i.'.jpg');
            $media->setStorage('/assets/images/'.$i.'.jpg');
            $media->setTricks($this->getReference('tricks' . $i));
            $media->setUser($this->getReference('user' . $i));
            $media->setCreatedAt(new \DateTimeImmutable());
            $media->setIsMain(true);
            $media->setIsVideo(false);
            $manager->persist($media);
        }
        for ($i = 10; $i > 0; $i--) {
            $media = new Media();
            $media->setName($i.'.jpg');
            $media->setStorage('/assets/videos/'.$i.'.jpg');
            $media->setTricks($this->getReference('tricks' . $i));
            $media->setUser($this->getReference('user' . $i));
            $media->setCreatedAt(new \DateTimeImmutable());
            $media->setIsMain(false);
            $media->setIsVideo(false);
            $manager->persist($media);
        }

        $manager->flush();
    }
}
