<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Song;

class SongFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 5; $i++) { 
            $length = $this->generateLength();
            $song = new Song();
            $song->setTitle('Mutter_' . $i);
            $song->setLength($length);
            $manager->persist($song);
    
            $manager->flush();
            $this->addReference('album_song_' . $i, $song);
        }
    }

    /**
     * generate song length randomly
     * @return string
     */
    private function generateLength(): string
    {
        return rand(1, 5) . ':' . rand(10, 60);
    }
}
