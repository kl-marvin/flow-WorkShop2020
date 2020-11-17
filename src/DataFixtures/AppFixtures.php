<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
       $user = new User();
       $user->setEmail("admin@laposte-cergy.fr");
       $user->setPassword($this->encoder->encodePassword($user, 'laposte'));
       $user->setRoles(['ROLE_ADMIN']);
       $user->setCompagnyName("La Poste Cergy");
       $manager->persist($user);
       $manager->flush();
    }
}
