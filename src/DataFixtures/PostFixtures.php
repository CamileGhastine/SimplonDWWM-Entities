<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Entity\Post;
use App\DataFixtures\TagFixtures;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();

            $post->setTitle('titre' . $i)
                ->setDescription('description' . $i)
                ->setuser($this->getReference('user' . rand(0, 4)));

                for($j=0; $j<3; $j++) {
                $post->addTag($this->getReference('tag' . rand(0, 9)));
                } 

            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
