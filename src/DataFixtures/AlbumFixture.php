<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Album;
use App\Utils\TokenGenerator;

class AlbumFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $album = new Album();
        $album->setTitle('Mutter');
        $album->setCover('https://i.ytimg.com/vi/M5knSnZPQHM/hqdefault.jpg');
        $album->setDescription('Released: 2 April 2001');
        $album->setToken(TokenGenerator::generate(6));
        
        $manager->persist($album);

        $manager->flush();
    }
}
