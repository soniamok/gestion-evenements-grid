<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\Organisateur;
use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;
    public function __construct( UserPasswordEncoderInterface $encoder)
    {
        $this-> encoder= $encoder;
    }
    public function load(ObjectManager $manager)
    {
        //creation de l'utilisateur
        $toto = new User();
        $toto->setEmail("toto@toto.fr");
        $toto->setNom("TOTO");
        $toto->setPrenom("Toto");
        $hash = $this->encoder->encodePassword($toto, "toto");
        $toto->setPassword($hash);
        $manager->persist($toto);
        //les organisateurs
        $fab = new Organisateur();
        $fab->setNom("Fabrique du numerique");
        $manager->persist($fab);
        //les événements
        $couscous = new Evenement();
        $couscous->setDate(new DateTime("2021-06-18"));
        $couscous->setTitre("couscousParty");
        $couscous->setLieuEvenement("Hélioparc bâtiment Monge");
        $couscous->setDescription("une couscous Party");
        $couscous->setImageSrc("images/couscous.png");
        $couscous->setOrganisateur($fab);
        $couscous->setNbDePlace(30);

        $apero = new Evenement;
        $apero->setDate(new DateTime("2021-07-15"));
        $apero->setTitre("un apéro chez Mohamed");
        $apero->setLieuEvenement("Hélioparc bâtiment Monge");
        $apero->setOrganisateur($fab);
        $apero->setDescription("une apero Party");
        $apero->setImageSrc("images/couscous.png");
        $apero->setNbDePlace(350);
        $manager->persist($apero);
        
        
        //les inscriptions
        $couscous->addUser($toto);
        $manager->persist($couscous);
        
        $manager->flush();
    }
}
