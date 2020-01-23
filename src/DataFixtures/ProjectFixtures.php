<?php
namespace App\DataFixtures;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $goodgirl = new Project();
        $goodgirl->setName("Good Girl");
        $goodgirl->setImage("project1.jpg");
        $goodgirl->setExcerpt("Ce film parle de...");
        $goodgirl->setDescription("Lorem ipsum dolor sit amet,...");
        $goodgirl->setGoal(5500.00);
        $goodgirl->setUser($this->getReference("John"));
        $goodgirl->addCategory($this->getReference('category-film'));
        $manager->persist($goodgirl);
        $this->addReference("goodgirl", $goodgirl);
        $lesyeuxdanslebus = new Project();
        $lesyeuxdanslebus->setName("Les yeux dans le bus");
        $lesyeuxdanslebus->setImage("placeholder.jpg");
        $lesyeuxdanslebus->setExcerpt("Revivez la grande épopée de l'équipe de France de football lors du mondial de football 2010.");
        $lesyeuxdanslebus->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit.");
        $lesyeuxdanslebus->setGoal(5500.00);
        $lesyeuxdanslebus->setUser($this->getReference("John"));
        $lesyeuxdanslebus->addCategory($this->getReference("category-film"));
        $lesyeuxdanslebus->addCategory($this->getReference("category-sport"));
        $manager->persist($lesyeuxdanslebus);
        $this->addReference("lesyeuxdanslebus", $lesyeuxdanslebus);
        $dabado = new Project();
        $dabado->setName("Dabado");
        $dabado->setImage("project3.jpg");
        $dabado->setExcerpt("Un jeu fantastique peint à la main. Plongez dans des aventures extra-ordinaires !");
        $dabado->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit.");
        $dabado->setGoal(5500.00);
        $dabado->setUser($this->getReference("John"));
        $dabado->addCategory($this->getReference("category-jeux"));
        $manager->persist($dabado);
        $this->addReference("dabado", $dabado);
        $doosh = new Project();
        $doosh->setName("DOOSH");
        $doosh->setImage("project4.jpg");
        $doosh->setExcerpt("Venez m'accompagner dans mon projet de création musicale avec clip vidéo !");
        $doosh->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit.");
        $doosh->setGoal(5500.00);
        $doosh->setUser($this->getReference("John"));
        $doosh->addCategory($this->getReference("category-musique"));
        $doosh->addCategory($this->getReference("category-film"));
        $manager->persist($doosh);
        $this->addReference("doosh", $doosh);
        $manager->flush();
    }
    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class
        ];
    }
}