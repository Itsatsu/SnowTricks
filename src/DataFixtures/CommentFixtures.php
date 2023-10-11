<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class CommentFixtures extends Fixture implements DependentFixtureInterface
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
    for($i = 0; $i < 8; $i++) {
            $comment = new Comment();
            $comment->setContent('comment' . $i);
            $comment->setCreatedAt(new \DateTimeImmutable());
            $comment->setUser($this->getReference('user' . $i));
            $comment->setTricks($this->getReference('tricks' . $i));
            $manager->persist($comment);
        }

        $manager->flush();
    }
}
