<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Artist;
use App\Entity\Album;
use App\Entity\Song;
use App\Utils\TokenGenerator;

class ArtistFixture extends Fixture
{
    public const TOKEN_LENGTH = 6;

    public function load(ObjectManager $manager)
    {
        $content = file_get_contents("https://gist.githubusercontent.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe/raw/8d61579f7d0b32ba128ffbf1481e03f4f6722e17/artist-albums.json");
        $data = json_decode($content, true);
        
        if (!$data) {
            throw new RuntimeException("error occured during handling data");
        }

        foreach($data as $key => $artistData)
        {
            $artist = new Artist();
            $artist->setName($artistData['name']);
            $artist->setToken(TokenGenerator::generate(self::TOKEN_LENGTH));
            
            foreach($artistData['albums'] as $albumData)
            {   
                // add album data
                $album = $this->addAlbum($albumData);
                $artist->addAlbum($album);
                $manager->persist($album);
                foreach($albumData['songs'] as $songData)
                {
                    // add song data
                    $song = $this->addSong($songData);
                    $song->setAlbum($album);
                    $album->addSong($song);
                    $manager->persist($song);
                }
            }
            $manager->persist($artist);
        }
        $manager->flush();        

    }

    private function addAlbum(array $data): Album
    {
        $album = new Album();
        $album->setTitle($data['title']);
        $album->setCover($data['cover']);
        $album->setDescription($data['description']);
        $album->setToken(TokenGenerator::generate(self::TOKEN_LENGTH));
        return $album;
    }

    private function addSong(array $data): Song
    {
        $song = new Song();
        $song->setTitle($data['title']);
        $song->setLength($data['length']);
        return $song;
    }
}
