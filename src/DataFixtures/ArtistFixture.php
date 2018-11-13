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
        for ($i = 0; $i < 2; $i++) {
            $artist = new Artist();
            $artist->setName('Rammstein_'.$i);
            $artist->setToken(TokenGenerator::generate(6));
    
            $manager->persist($artist);
            $manager->flush();            
            $this->addReference('album_' . $i, $artist);
        }
    }
}
