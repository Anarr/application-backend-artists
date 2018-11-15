<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SongRepository")
 */
class Song
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    public $title;

    /**
     * @ORM\Column(type="string", length=10)
     */
    public $length;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Album", inversedBy = "songs")
     */
    private $album;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(string $length): self
    {
        $this->length = $length;

        return $this;
    }


     /**
     * Set album.
     *
     * @param \App\Entity\Album|null $album
     *
     * @return Song
     */
    public function setAlbum(\App\Entity\Album $album): self
    {
        $this->album = $album;
        return $this;
    }
     /**
     * Get album.
     *
     * @return \App\Entity\Album|null
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
