<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Artist;
use App\Utils\TokenGenerator;

class ArtistFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $artist = new Artist();
        $artist->setName('Rammstein');
        $artist->setToken(TokenGenerator::generate(6));
        
        $manager->persist($artist);

        $manager->flush();
    }
}
