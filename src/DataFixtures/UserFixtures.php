<?php
namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserFixtures extends Fixture
{
    private $encoder;
    /**
     * UserFixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setFirstname("Ewen");
        $admin->setLastname("Launay");
        $admin->setEmail("ewenlaunay@gmail.com");
        $admin->setPassword($this->encoder->encodePassword($admin, 'azerty'));
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);
        $this->addReference("Ewen", $admin);
        $john = new User();
        $john->setFirstname("John");
        $john->setLastname("Smith");
        $john->setEmail("johnsmith@gmail.com");
        $john->setPassword($this->encoder->encodePassword($john, 'azerty'));
        $john->setRoles(["ROLE_USER"]);
        $manager->persist($john);
        $this->addReference("John", $john);
        $manager->flush();
    }
}

