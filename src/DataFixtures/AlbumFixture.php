<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Album;
use App\Utils\TokenGenerator;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AlbumFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 2; $i++) {
            $album = new Album();
            $album->setTitle('Mutter_' . $i);
            $album->setArtist($this->getReference('album_'.$i));
            $album->setCover('https://i.ytimg.com/vi/M5knSnZPQHM/hqdefault.jpg');
            $album->setDescription('Released: 2 April 2001 _' . $i);
            $album->setToken(TokenGenerator::generate(6));
            $album->addSong($this->getReference('album_song_' . $i));
            $manager->persist($album);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            ArtistFixture::class,
            SongFixture::class,
        ];
    }
}
