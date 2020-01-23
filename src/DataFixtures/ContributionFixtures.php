<?php

namespace App\DataFixtures;

use App\Entity\Contribution;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ContributionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $contribution1 = new Contribution();
        $contribution1->setAmount(5500.00);
        $contribution1->setUser($this->getReference("John"));
        $contribution1->setProject($this->getReference("lesyeuxdanslebus"));
        $this->addReference("contribution1", $contribution1);
        $manager->persist($contribution1);
    }
        /**
         * @inheritDoc
         */
        public
        function getDependencies()
        {
            return [
                UserFixtures::class,
                ProjectFixtures::class
            ];
        }

}