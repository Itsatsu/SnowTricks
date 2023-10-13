<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class TricksFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [UserFixtures::class, GroupFixtures::class];
    }
    public function load(ObjectManager $manager): void
    {
        $tricks =[
            ["name" => "Mute", "description" => "Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.",
                "group" => "Grabes", "image" => "mute.jpg", "video" => "https://www.youtube.com/embed/2g3E-KZ_HYg", "user" => "user0",],
            ["name" => "Sad", "description" => "Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.",
                "group" => "Grabes", "image" => "sad.jpg", "video" => "https://www.youtube.com/embed/2g3E-KZ_HYg", "user" => "user1",],
            ["name"=>"180", "description"=>"Le principe consiste à faire un demi-tour pendant le saut, puis à retomber en position normale.",
                "group"=>"Rotation", "image"=>"180.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user2",],
            ["name"=>"360", "description"=>"Le principe consiste à faire trois demi-tours pendant le saut, puis à retomber en position normale.",
                "group"=>"Rotation", "image"=>"360.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user3",],
            ["name"=>"Le Lincoln", "description"=>"Rotation la tête en bas, en fait imagine que tu prends le saut mais quand tu sautes tu penches 
                la tête vers la droite (ou la gauche) et la tête passe ensuite dessous toi les skis dessous, comme si on était posé sur le kick et qu'on
                 voyait ta tête décrire un mouvement circulaire dans l'espace",
                "group"=>"Flips", "image"=>"lincoln.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user4",],
            ["name"=>"Le Japan", "description"=>"Saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.",
                "group"=>"Grabes", "image"=>"japan.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user5",],
            ["name"=>"Le Truck Driver", "description"=>"Saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).",
                "group"=>"Grabes", "image"=>"truckdriver.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user6",],
            ["name"=>"le wildecat", "description"=>"Un Wildcat est un Backflip qui garde la planche parallèle à la trajectoire, tu fais donc une sorte de Flip 'latéral' sans perte de vitesse.",
                "group"=>"Flips", "image"=>"wildecat.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user7",],
            ["name"=>"Le Front Flip", "description"=>"Flip vers l'avant.", "group"=>"Flips", "image"=>"frontflip.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user8",],
            ["name"=>"Le Back Flip", "description"=>"Flip vers l'arrière.", "group"=>"Flips", "image"=>"backflip.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user9",],
            ["name"=>"Le Stalefish", "description"=>"Saisie de la carre backside de la planche, entre les deux pieds, avec la main arrière.",
                "group"=>"Grabes", "image"=>"stalefish.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user0",],
            ["name"=>"Le Tail Grabes", "description"=>"Saisie de la partie arrière de la planche, avec la main arrière.",
                "group"=>"Grabes", "image"=>"tailGrabes.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user1",],
            ["name"=>"Le Seat belt", "description"=>"Saisie du carre frontside à l'arrière avec la main avant.",
                "group"=>"Grabes", "image"=>"seatbelt.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user2",],
            ["name"=>"Le Safety", "description"=>"Saisie de la carre backside de la planche entre les deux pieds avec la main arrière.",
                "group"=>"Grabes", "image"=>"safety.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user3",],
            ["name"=>"Le Rocket air", "description"=>"Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.",
                "group"=>"Grabes", "image"=>"rocketair.jpg", "video"=>"https://www.youtube.com/embed/2g3E-KZ_HYg", "user"=>"user4",],
        ];
        $i = 0;

        foreach ($tricks as $trick){

            $objTrick = new Tricks();

            $objTrick->setName($trick['name']);

            $objTrick->setDescription($trick['description']);
            $objTrick->setPictureStorage('/assets/images/'.$i.'.jpg');
            $objTrick->setCategorie($this->getReference($trick['group']));

            //manque image et video
            $objTrick->setCreatedAt(new \DateTimeImmutable());
            $objTrick->setUser($this->getReference($trick['user']));
            $manager->persist($objTrick);
            $this->addReference("tricks".$i , $objTrick);
            $i++;
        }
        $manager->flush();
    }
}
