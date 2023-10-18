<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;


class TricksFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [UserFixtures::class, GroupFixtures::class];
    }
    public function load(ObjectManager $manager): void
    {
        $fileSysteme = new Filesystem();
        $fileSysteme->remove('public/assets/images/triks');
        mkdir('public/assets/images/triks');

        $tricks =[
            ["name" => "Mute", "description" => "Le Mute est une figure classique en snowboard qui allie style et technique. C'est l'une des saisies de planche les plus emblématiques, et elle a été popularisée par le snowboarder professionnel Jake Burton Carpenter. La particularité du Mute réside dans la saisie de la planche effectuée pendant un saut, ce qui ajoute une touche de créativité et d'élégance à la figure.Voici comment exécuter un Mute en snowboard.Élan et saut : Comme pour la plupart des figures de snowboard, tout commence par un bon élan et un saut contrôlé depuis une rampe, un kicker ou un autre élément de la piste. Le rider doit acquérir suffisamment de vitesse pour s'élever dans les airs.Saisie Mute : Au sommet du saut, le snowboarder commence à plier les genoux et à tirer une de ses jambes vers la poitrine. Généralement, la main opposée à la jambe tirée est utilisée pour saisir la carre de la planche, entre les fixations. Cette saisie crée une position caractéristique, où la planche est maintenue devant le corps, près de la poitrine.Extension et style : Pendant la saisie Mute, le rider doit garder le dos droit, le regard vers l'avant et maintenir la planche près de la poitrine. Cela ajoute un élément de style distinctif à la figure.Rotation (facultatif) : Si le snowboarder souhaite ajouter une rotation à la figure, il peut le faire en effectuant une rotation de 180, 360, ou plus pendant le saut, tout en maintenant la saisie Mute. La combinaison d'une saisie Mute avec une rotation ajoute un niveau de complexité supplémentaire.Réception : L'atterrissage est une partie cruciale de la figure. Le rider doit anticiper la fin de la rotation (si elle a été ajoutée) et fléchir ses genoux pour amortir l'impact, puis se préparer à glisser en douceur sur la piste.Le Mute est une figure élégante qui demande de la précision, de la coordination, et une bonne maîtrise de l'équilibre. Les snowboarders apprécient cette figure pour son style unique, mais il est essentiel de s'entraîner en toute sécurité, de porter l'équipement de protection nécessaire, et de progresser graduellement pour atteindre un niveau de compétence suffisant. Lorsqu'il est exécuté avec grâce, le Mute devient une véritable démonstration du talent des riders et ajoute une dimension artistique au snowboard freestyle.",
                "group" => "Grabes", "user" => "user0",],
            ["name" => "Sad", "description" => "Le 'Sad' (prononcé 'saaad') est une figure avancée en snowboard qui impressionne par son niveau de difficulté et sa technicité. Cette manœuvre combine une rotation horizontale avec une saisie particulière de la planche, donnant au rider une apparence caractéristique de 'tristesse' d'où son nom. Voici comment exécuter un 'Sad' en snowboard .Élan et saut : Comme pour la plupart des figures de snowboard, tout commence par un élan puissant et un saut depuis une rampe, un kicker ou une autre caractéristique de la piste. Le rider doit acquérir suffisamment de vitesse pour obtenir une hauteur suffisante dans les airs.Rotation horizontale : Au sommet du saut, le snowboarder commence à effectuer une rotation horizontale de 360 degrés, soit un tour complet. Cela signifie que le rider tourne autour de son axe tout en restant parallèle à la surface de la neige.Saisie du 'Sad' : La caractéristique principale du 'Sad' est la saisie particulière de la planche. Le rider saisit la carre de la planche entre les fixations avec la main avant, tandis que la main arrière est étendue vers l'arrière. La planche est maintenue devant le corps, au niveau de la taille ou des hanches.Position et style : Pendant la rotation et la saisie 'Sad', le rider doit maintenir une position solide et équilibrée. Il est important de garder le dos droit et de contrôler la vitesse de rotation pour atterrir en toute sécurité.Réception : L'atterrissage est un aspect critique de la figure. Le rider doit anticiper la fin de la rotation, fléchir les genoux pour amortir l'impact, puis glisser en douceur sur la piste.Le 'Sad' est une figure exigeante qui requiert une excellente coordination entre les mouvements du corps et la manipulation de la planche. Les snowboarders expérimentés l'apprécient pour son style unique et sa technicité. Comme pour toutes les figures avancées, il est essentiel de s'entraîner en toute sécurité, de porter un équipement de protection adéquat, et de progresser graduellement pour éviter les blessures. Lorsqu'elle est exécutée avec succès, la figure 'Sad' est une véritable démonstration du talent des riders dans le domaine du snowboard freestyle.",
                "group" => "Grabes", "user" => "user1",],
            ["name"=>"180", "description"=>"Le '180' est l'une des figures de base en snowboard, mais elle est cruciale pour établir les fondements du snowboard freestyle. Cette figure consiste en une rotation horizontale de 180 degrés (un demi-tour) réalisée en l'air. Le '180' est une première étape essentielle pour les snowboarders qui souhaitent évoluer vers des figures plus avancées. Voici comment exécuter un '180' en snowboard :Élan et saut : Commencez par générer de la vitesse en glissant sur la piste ou en utilisant une rampe ou un kicker. Une fois que vous avez suffisamment de vitesse, fléchissez légèrement les genoux pour prendre de l'élan et préparez-vous à sauter.Rotation horizontale : Au moment du saut, utilisez vos épaules et vos hanches pour effectuer une rotation horizontale de 180 degrés, soit un demi-tour. Vous devez pivoter autour de votre axe longitudinal, en gardant votre regard fixé sur l'endroit où vous souhaitez atterrir.Position de base : Assurez-vous de garder une position de base pendant la rotation. Gardez votre dos droit, les épaules parallèles à la piste et fléchissez légèrement vos genoux pour conserver votre équilibre.Réception : Anticipez le moment où vous atteindrez la position de 180 degrés de rotation et préparez-vous à l'atterrissage. Fléchissez les genoux pour amortir l'impact.Atterrissage : Lorsque vous atteignez les 180 degrés, atterrissez en douceur en engageant vos carres de manière à éviter de déraper. Gardez votre regard fixé sur la piste.Le '180' est un mouvement fondamental en snowboard, essentiel pour établir des bases solides en freestyle. Il est souvent utilisé comme préparation pour des figures plus avancées, car il vous permet de développer la rotation, l'équilibre et la maîtrise de l'atterrissage. En progressant dans le snowboard freestyle, les riders combinent souvent plusieurs '180' pour réaliser des figures plus complexes, comme les '360', '540', ou même des rotations plus élevées. C'est une figure idéale pour les débutants qui souhaitent se lancer dans le freestyle, car elle offre un excellent point de départ pour développer leurs compétences en rotation et en équilibre.",
                "group"=>"Rotation", "user"=>"user2",],
            ["name"=>"360", "description"=>"Le '360' est une figure de snowboard qui consiste en une rotation horizontale complète de 360 degrés (un tour complet) réalisée en l'air. Voici comment exécuter un '360' en snowboard de manière simple :Élan et saut : Pour commencer, prenez de l'élan en descendant la piste ou en utilisant une rampe ou un saut. Une fois que vous avez suffisamment de vitesse, pliez vos genoux pour prendre de l'élan, puis sautez.Rotation horizontale : Au moment du saut, tournez votre corps horizontalement pour effectuer une rotation complète de 360 degrés. Cela signifie que vous faites un tour complet autour de votre propre axe, tout en gardant les épaules parallèles à la piste.Position de base : Assurez-vous de maintenir une position de base pendant la rotation. Gardez le dos droit et fléchissez légèrement les genoux pour rester équilibré en l'air.Réception : Anticipez le moment où vous atteindrez les 360 degrés de rotation et préparez-vous à atterrir. Fléchissez vos genoux pour amortir l'impact.Atterrissage : Une fois la rotation de 360 degrés terminée, atterrissez en douceur en engageant les carres de votre planche pour éviter de déraper.Le '360' est une figure de snowboard intermédiaire qui demande un peu de pratique pour la maîtriser, mais il est essentiel pour développer vos compétences en rotation et préparer le terrain pour des figures plus avancées.",
                "group"=>"Rotation", "user"=>"user3",],
            ["name"=>"Le Lincoln", "description"=>"Le 'Lincoln' est une figure de snowboard qui implique une rotation horizontale de 540 degrés (un tour et demi) en l'air, suivie d'une saisie particulière de la planche. Voici comment réaliser un 'Lincoln' en snowboard de manière simple :Élan et saut : Débutez en prenant de l'élan depuis une rampe, un kicker ou un autre élément de la piste. L'objectif est de gagner suffisamment de vitesse pour vous élever dans les airs.Rotation horizontale : Au sommet du saut, effectuez une rotation horizontale de 540 degrés, soit un tour et demi. Cela signifie que vous pivoterez autour de votre axe longitudinal tout en restant parallèle à la surface de la neige.Saisie du 'Lincoln' : Pendant la rotation, tendez une de vos mains vers le sol et saisissez la carre de la planche entre les fixations, de manière à ce que la planche soit tenue sous votre bras.Position et style : Pendant la rotation et la saisie 'Lincoln,' maintenez une position solide avec le dos droit et les épaules parallèles à la piste. Cela ajoute un élément de style distinctif à la figure.Réception : Anticipez le moment où vous atteindrez les 540 degrés de rotation et préparez-vous à atterrir. Fléchissez vos genoux pour amortir l'impact.Atterrissage : Une fois la rotation de 540 degrés achevée, atterrissez en douceur en engageant les carres de votre planche pour éviter de déraper.Le 'Lincoln' est une figure avancée en snowboard qui combine rotation et saisie de la planche. Il demande de la coordination et de la précision, ainsi qu'une bonne maîtrise de l'atterrissage. Les riders apprécient cette figure pour son style unique, mais il est important de s'entraîner en toute sécurité, de porter l'équipement de protection approprié et de progresser graduellement pour éviter les blessures. Une fois maîtrisé, le 'Lincoln' devient une démonstration de la créativité et de la technicité des snowboarders dans le monde du freestyle.",
                "group"=>"Flips", "user"=>"user4",],
            ["name"=>"Le Japan", "description"=>"Le 'Japan' est une figure de snowboard qui combine une rotation horizontale avec une saisie spécifique de la planche, créant un style distinctif. Cette figure est appréciée pour son esthétique et sa technicité. Voici comment réaliser un 'Japan' en snowboard de manière simple :Élan et saut : Commencez par prendre de l'élan depuis une rampe, un kicker ou un autre élément de la piste pour obtenir suffisamment de vitesse. Ensuite, fléchissez vos genoux pour prendre de l'élan et préparez-vous à sauter.Rotation horizontale : Au sommet du saut, effectuez une rotation horizontale de 180 degrés (un demi-tour). Cela signifie que vous tournerez autour de votre axe longitudinal, tout en restant parallèle à la surface de la neige.Saisie 'Japan' : Pendant la rotation, utilisez votre main avant pour saisir l'arrière de la planche, près de la carre arrière, tout en étendant la jambe opposée. La jambe non saisie doit être tendue vers l'avant, ce qui crée une position caractéristique de 'Japan'.Position et style : Pendant la rotation et la saisie 'Japan', assurez-vous de garder le dos droit et les épaules parallèles à la piste. Maintenez une position esthétique pour ajouter du style à votre figure.Réception : Anticipez le moment où vous atteindrez la position de 180 degrés de rotation et préparez-vous à l'atterrissage. Fléchissez les genoux pour amortir l'impact.Atterrissage : Une fois la rotation de 180 degrés terminée, atterrissez en douceur en engageant vos carres de manière à éviter de déraper.Le 'Japan' est une figure appréciée pour son style unique et sa technicité. Elle nécessite une coordination précise entre la rotation et la saisie de la planche. Il est important de s'entraîner en toute sécurité, de porter l'équipement de protection approprié, et de progresser graduellement pour maîtriser cette figure. Une fois exécuté avec succès, le 'Japan' démontre l'habileté et l'esthétique des snowboarders dans le domaine du freestyle.",
                "group"=>"Grabes", "user"=>"user5",],
            ["name"=>"Le Truck Driver", "description"=>"Le truck driver est une figure de snowboard particulièrement impressionnante et stylée, qui met en valeur la dextérité du rider ainsi que sa capacité à jongler avec sa planche tout en effectuant des rotations aériennes. Cette manœuvre est très prisée des snowboarders expérimentés et des freestyleurs chevronnés, car elle combine à la fois une rotation horizontale de 1080 degrés et une saisie de la planche pendant le saut.Pour réaliser un truck driver, voici les étapes essentielles :Élan et saut : Tout commence par un bon élan sur une rampe ou un saut naturel. Le rider doit générer suffisamment de vitesse et de pop pour s'élever dans les airs.Rotation horizontale : Au sommet du saut, le snowboarder commence la rotation horizontale de 1080 degrés, soit trois tours complets, en combinant des rotations avant et arrière. Cela signifie que le rider tourne autour de son axe tout en restant parallèle à la surface de la neige.Saisie de la planche : Pendant la rotation, le rider saisit le côté de sa planche opposé à sa direction de rotation, généralement avec une main, tandis que l'autre main est tendue. Cette saisie ajoute un style distinctif à la figure et exige une grande agilité.Maintien de l'équilibre : Pendant la rotation et la saisie de la planche, le snowboarder doit garder un équilibre parfait pour éviter une chute. La rotation doit être contrôlée et fluide.Retour à la position normale : Une fois la rotation de 1080 degrés complète, le rider relâche sa planche et se prépare à l'atterrissage.Réception : L'atterrissage est crucial pour la réussite de la figure. Le rider doit anticiper la fin de la rotation et fléchir ses genoux pour amortir l'impact, puis glisser en douceur sur la piste.Le truck driver est une figure avancée qui nécessite une bonne dose de pratique et de confiance en soi. Il exige une grande coordination entre les mouvements du corps et la manipulation de la planche, ce qui en fait une figure spectaculaire à voir et à exécuter. Cependant, il est essentiel de s'entraîner avec prudence, de porter un équipement de protection adéquat, et de progresser graduellement pour éviter les blessures. Une fois maîtrisé, le truck driver devient une véritable démonstration de l'habileté et de la créativité des snowboarders dans le monde du freestyle.",
                "group"=>"Grabes", "user"=>"user6",],
            ["name"=>"le wildecat", "description"=>"Le 'Wildcat' est une figure avancée en snowboard qui se caractérise par une rotation horizontale combinée à un flip en arrière. C'est une manœuvre spectaculaire qui nécessite une solide technique de saut et une grande maîtrise de l'air. Voici comment exécuter un 'Wildcat' en snowboard de manière simple :Élan et saut : Débutez en prenant de l'élan depuis une rampe, un kicker ou une autre caractéristique de la piste. L'objectif est de gagner suffisamment de vitesse pour vous élever dans les airs.Rotation horizontale : Au sommet du saut, commencez une rotation horizontale de 360 degrés, soit un tour complet, autour de votre axe longitudinal. Cette rotation doit être effectuée de manière contrôlée.Flip en arrière : Pendant la rotation de 360 degrés, engagez un flip en arrière, ce qui signifie que vous effectuez un retournement en arrière en tournant autour de l'axe transversal de votre corps.Réception : Anticipez le moment où vous atteindrez la fin de la rotation horizontale et du flip en arrière, et préparez-vous à l'atterrissage.Atterrissage : Lorsque vous avez effectué la rotation et le flip, atterrissez en douceur en pliant les genoux pour amortir l'impact. Gardez vos épaules parallèles à la piste pour éviter de tourner de manière inattendue.Le 'Wildcat' est une figure avancée qui combine une rotation horizontale avec un flip en arrière, ce qui nécessite une excellente coordination et une maîtrise du timing. Comme pour toutes les figures avancées, l'entraînement en toute sécurité est essentiel, ainsi que le port de l'équipement de protection approprié. Une fois maîtrisé, le 'Wildcat' est une démonstration impressionnante de l'habileté des snowboarders dans le domaine du freestyle.",
                "group"=>"Flips", "user"=>"user7",],
            ["name"=>"Le Front Flip", "description"=>"Le 'Front Flip' est une figure spectaculaire en snowboard qui consiste en un retournement en avant complet en l'air. C'est une manœuvre avancée qui nécessite une excellente technique de saut et une bonne maîtrise de l'air. Voici comment réaliser un 'Front Flip' en snowboard de manière simple :Élan et saut : Pour commencer, prenez de l'élan depuis une rampe, un kicker ou une autre caractéristique de la piste. Assurez-vous d'avoir suffisamment de vitesse pour vous élever dans les airs.Rotation en avant : Au sommet du saut, commencez la rotation en avant en vous penchant vers l'avant et en basculant la tête en direction de vos genoux. Vous devrez basculer vers l'avant tout en gardant votre planche et vos pieds sous vous.Flip en avant : Dans le mouvement, engagez un flip en avant, ce qui signifie que vous effectuez un retournement complet en avant autour de l'axe longitudinal de votre corps.Position et style : Veillez à garder le dos droit et à maintenir une position compacte tout au long du flip en avant. Gardez les épaules parallèles à la piste.Réception : Anticipez le moment où vous atteindrez la fin du flip en avant et préparez-vous à l'atterrissage.Atterrissage : Une fois le flip en avant terminé, atterrissez en douceur en fléchissant vos genoux pour amortir l'impact. Gardez un œil sur la piste pour un atterrissage précis.Le 'Front Flip' est une figure avancée qui nécessite une excellente coordination et une bonne maîtrise du timing pour réussir. Comme pour toutes les figures avancées en snowboard, l'entraînement en toute sécurité est essentiel, tout comme le port de l'équipement de protection approprié. Une fois maîtrisé, le 'Front Flip' est une démonstration impressionnante de l'habileté des snowboarders dans le domaine du freestyle.",
                "group"=>"Flips", "user"=>"user8",],
            ["name"=>"Le Back Flip", "description"=>"Le 'Back Flip' en snowboard est une figure aérienne avancée qui consiste en un flip en arrière, c'est-à-dire une rotation postérieure autour de l'axe transversal du corps. Cette manœuvre est impressionnante mais exige une excellente maîtrise de l'équilibre, de la rotation et du timing. Voici comment exécuter un 'Back Flip' en snowboard de manière simple :Élan et saut : Pour commencer, prenez de l'élan depuis une rampe, un kicker ou une autre caractéristique de la piste. Vous devez acquérir suffisamment de vitesse pour obtenir une bonne hauteur dans les airs.Rotation arrière : Au sommet du saut, engagez un flip en arrière, ce qui signifie que vous effectuez une rotation postérieure autour de l'axe transversal de votre corps.Position du corps : Durant le flip en arrière, gardez votre corps groupé en repliant vos genoux vers votre poitrine et en enroulant vos épaules vers l'arrière pour faciliter la rotation.Réception : Anticipez le moment où vous atteindrez la fin du flip en arrière, et préparez-vous à l'atterrissage.Atterrissage : Lorsque vous avez terminé la rotation en arrière, atterrissez en douceur en pliant vos genoux pour amortir l'impact. Gardez vos épaules parallèles à la piste pour éviter de tourner de manière inattendue.Le 'Back Flip' est une figure avancée qui exige une excellente coordination, une maîtrise du timing et une grande confiance en soi. Comme pour toutes les figures avancées, l'entraînement en toute sécurité et le port de l'équipement de protection approprié sont essentiels. Une fois maîtrisé, le 'Back Flip' est une démonstration impressionnante de l'habileté des snowboarders dans le domaine du freestyle.",
                "group"=>"Flips", "user"=>"user9",],
            ["name"=>"Le Stalefish", "description"=>"Le 'Stalefish' est une figure de snowboard qui associe une rotation horizontale avec une saisie distinctive de la planche. Cette figure est appréciée pour son style et sa technicité. Voici comment réaliser un 'Stalefish' en snowboard de manière simple :Élan et saut : Commencez par prendre de l'élan depuis une rampe, un kicker, ou une autre caractéristique de la piste. Vous avez besoin de suffisamment de vitesse pour vous élever dans les airs.Rotation horizontale : Au sommet du saut, commencez une rotation horizontale de 180 degrés (un demi-tour) en tournant autour de votre axe longitudinal. Vous devez maintenir vos épaules parallèles à la piste.Saisie 'Stalefish' : Pendant la rotation, utilisez votre main arrière pour saisir le talon de la planche entre les fixations, en étendant votre jambe opposée. La planche est maintenue derrière vous, près de votre dos.Position et style : Assurez-vous de garder le dos droit et de maintenir une position équilibrée pendant la rotation. Le 'Stalefish' est apprécié pour son style caractéristique.Réception : Anticipez le moment où vous atteindrez la fin de la rotation de 180 degrés et préparez-vous à l'atterrissage.Atterrissage : Une fois la rotation terminée, atterrissez en douceur en fléchissant vos genoux pour amortir l'impact. Gardez vos épaules parallèles à la piste pour un atterrissage stable.Le 'Stalefish' est une figure de snowboard appréciée pour son style unique et sa technicité. Elle demande une bonne coordination entre la rotation et la saisie de la planche. Il est important de s'entraîner en toute sécurité, de porter l'équipement de protection approprié, et de progresser graduellement pour maîtriser cette figure. Une fois exécuté avec succès, le 'Stalefish' est une démonstration impressionnante de l'habileté des snowboarders dans le domaine du freestyle.",
                "group"=>"Grabes", "user"=>"user0",],
            ["name"=>"Le Tail Grabes", "description"=>"Le 'Tail Grab' est une figure de snowboard classique qui met en avant la saisie de la partie arrière de la planche (le 'tail' en anglais) pendant un saut. Cette figure est l'une des premières que les snowboarders apprennent généralement, et elle est une base essentielle pour de nombreuses autres figures de snowboard. Voici comment exécuter un 'Tail Grab' de manière simple :Élan et saut : Démarrez en prenant de l'élan depuis une pente, une rampe, ou un kicker. Vous devez avoir suffisamment de vitesse pour réaliser un saut en toute sécurité.Saut et élévation : Au sommet du saut, fléchissez légèrement les genoux pour obtenir de l'élévation. Vous devrez plier les jambes et redresser le haut du corps pour élever vos pieds vers l'arrière.Saisie du 'Tail Grab' : Tendez une main vers l'arrière pour saisir la partie arrière de votre planche, le 'tail', généralement situé à l'extrémité de votre planche. Vous devrez plier vos jambes et tirer vos pieds vers l'arrière pour rapprocher la planche de votre main.Position et style : Assurez-vous de garder le dos droit et de maintenir une position équilibrée pendant le saut. Le style et l'élégance sont importants pour un 'Tail Grab' réussi.Réception : Anticipez le moment où vous atteindrez le sommet de votre saut et préparez-vous à l'atterrissage.Atterrissage : Lorsque vous avez réussi à saisir le 'tail' de la planche, atterrissez en douceur en pliant les genoux pour amortir l'impact. Veillez à garder vos épaules parallèles à la piste pour un atterrissage stable.Le 'Tail Grab' est l'une des figures de snowboard de base et constitue souvent la première étape pour les riders qui souhaitent se lancer dans le freestyle. C'est une figure amusante à apprendre et elle peut être le point de départ pour développer des compétences en saisie de planche et d'autres figures plus avancées. Une fois maîtrisé, le 'Tail Grab' peut être exécuté avec style, ajoutant une touche personnelle au snowboard.",
                "group"=>"Grabes", "user"=>"user1",],
            ["name"=>"Le Seat belt", "description"=>"Le 'Seat Belt' est une figure de snowboard qui combine une rotation horizontale avec une saisie particulière de la planche. Cette figure est appréciée pour son style unique et sa technicité. Voici comment réaliser un 'Seat Belt' en snowboard de manière simple :Élan et saut : Commencez par prendre de l'élan depuis une rampe, un kicker ou une autre caractéristique de la piste. Vous avez besoin de suffisamment de vitesse pour vous élever dans les airs.Rotation horizontale : Au sommet du saut, commencez une rotation horizontale de 180 degrés (un demi-tour) en tournant autour de votre axe longitudinal. Vous devez garder vos épaules parallèles à la piste.Saisie 'Seat Belt' : Pendant la rotation, tendez une main derrière vous pour saisir la partie avant de la planche, le 'nose', entre les fixations, en laissant l'autre main tendue vers l'avant. Cette saisie crée une position caractéristique de 'Seat Belt.'Position et style : Assurez-vous de garder le dos droit et de maintenir une position équilibrée pendant la rotation. Le 'Seat Belt' est apprécié pour son style distinctif.Réception : Anticipez le moment où vous atteindrez la fin de la rotation de 180 degrés et préparez-vous à l'atterrissage.Atterrissage : Lorsque la rotation de 180 degrés est terminée, atterrissez en douceur en fléchissant vos genoux pour amortir l'impact. Veillez à garder vos épaules parallèles à la piste pour un atterrissage stable.Le 'Seat Belt' est une figure de snowboard qui demande une bonne coordination entre la rotation et la saisie de la planche. Comme pour toutes les figures de snowboard, il est important de s'entraîner en toute sécurité, de porter l'équipement de protection approprié, et de progresser graduellement pour maîtriser cette figure. Une fois exécuté avec succès, le 'Seat Belt' est une démonstration impressionnante de l'habileté des snowboarders dans le domaine du freestyle.",
                "group"=>"Grabes", "user"=>"user2",],
            ["name"=>"Le Safety", "description"=>"Le 'Safety' est une figure de snowboard qui combine une rotation horizontale avec une saisie spécifique de la planche, créant un style unique. Voici comment réaliser un 'Safety' en snowboard de manière simple :Élan et saut : Débutez en prenant de l'élan depuis une rampe, un kicker, ou une autre caractéristique de la piste. Vous avez besoin de suffisamment de vitesse pour vous élever dans les airs.Rotation horizontale : Au sommet du saut, commencez une rotation horizontale de 540 degrés (un tour et demi) en tournant autour de votre axe longitudinal. Gardez vos épaules parallèles à la piste.Saisie 'Safety' : Pendant la rotation, utilisez votre main arrière pour saisir la carre avant de la planche, entre les fixations, tandis que vous tendez la jambe opposée vers l'arrière. Cette saisie crée une position caractéristique de 'Safety.'Position et style : Assurez-vous de maintenir une position équilibrée et un dos droit pendant la rotation. Le 'Safety' est apprécié pour son style distinctif.Réception : Anticipez le moment où vous atteindrez la fin de la rotation de 540 degrés et préparez-vous à l'atterrissage.Atterrissage : Lorsque la rotation de 540 degrés est terminée, atterrissez en douceur en fléchissant vos genoux pour amortir l'impact. Veillez à garder vos épaules parallèles à la piste pour un atterrissage stable.Le 'Safety' est une figure de snowboard qui demande une coordination précise entre la rotation et la saisie de la planche. Comme pour toutes les figures de snowboard, il est important de s'entraîner en toute sécurité, de porter l'équipement de protection approprié, et de progresser graduellement pour maîtriser cette figure. Une fois exécuté avec succès, le 'Safety' est une démonstration impressionnante de l'habileté des snowboarders dans le domaine du freestyle.",
                "group"=>"Grabes", "user"=>"user3",],
            ["name"=>"Le Rocket air", "description"=>"Le 'Rocket Air' est une figure de snowboard qui combine une rotation horizontale avec une saisie particulière de la planche. Cette figure est appréciée pour son style unique et son élégance. Voici comment réaliser un 'Rocket Air' en snowboard de manière simple :Élan et saut : Commencez par prendre de l'élan depuis une rampe, un kicker, ou une autre caractéristique de la piste. Vous avez besoin de suffisamment de vitesse pour vous élever dans les airs.Rotation horizontale : Au sommet du saut, commencez une rotation horizontale de 180 degrés (un demi-tour) en tournant autour de votre axe longitudinal. Assurez-vous de garder vos épaules parallèles à la piste.Saisie 'Rocket Air' : Pendant la rotation, tendez une main derrière vous pour saisir le talon de la planche entre les fixations, en laissant l'autre main tendue vers l'avant. Cette saisie crée une position caractéristique de 'Rocket Air.'Position et style : Assurez-vous de maintenir une position équilibrée avec le dos droit pendant la rotation. Le 'Rocket Air' est apprécié pour son style unique.Réception : Anticipez le moment où vous atteindrez la fin de la rotation de 180 degrés et préparez-vous à l'atterrissage.Atterrissage : Lorsque la rotation de 180 degrés est terminée, atterrissez en douceur en fléchissant vos genoux pour amortir l'impact. Veillez à garder vos épaules parallèles à la piste pour un atterrissage stable.Le 'Rocket Air' est une figure de snowboard qui demande une coordination précise entre la rotation et la saisie de la planche. Comme pour toutes les figures de snowboard, il est important de s'entraîner en toute sécurité, de porter l'équipement de protection approprié, et de progresser graduellement pour maîtriser cette figure. Une fois exécuté avec succès, le 'Rocket Air' est une démonstration impressionnante de l'habileté des snowboarders dans le domaine du freestyle.",
                "group"=>"Grabes", "user"=>"user4",],
        ];
        $i = 0;

        foreach ($tricks as $trick){

            $objTrick = new Tricks();
            $objTrick->setName($trick['name']);
            $objTrick->setDescription($trick['description']);
            $objTrick->setPictureStorage('a');
            $objTrick->setCategorie($this->getReference($trick['group']));
            $objTrick->setCreatedAt(new \DateTimeImmutable());
            $objTrick->setUser($this->getReference($trick['user']));
            $manager->persist($objTrick);
            $this->addReference("tricks".$i , $objTrick);


            $i++;
        }
        $manager->flush();
        for ($i = 0; $i < 15; $i++) {
            $trick = $this->getReference('tricks' . $i)->getId();
            if ($i % 2 == 0)
            {
                $objTrick->setUpdatedAt(new \DateTimeImmutable('2023-10-14'));
            }
            $cheminDossier = 'public/assets/images/triks/'.$trick;
            if (!is_dir($cheminDossier))
            {
                mkdir($cheminDossier);
                mkdir($cheminDossier.'/media');
                copy('public/assets/images/cover.jpg', $cheminDossier.'/cover.jpg');
                $tricksRepository = $manager->getRepository(Tricks::class);
                $objTrick = $tricksRepository->find($trick);
                $objTrick->setPictureStorage('/assets/images/triks/'.$trick.'/cover.jpg');
                $manager->persist($objTrick);
                $manager->flush();
            }
        }
    }
}
