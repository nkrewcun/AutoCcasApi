<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * TODO: Security on post, put and delete
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce"})
     */
    private $source;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce"})
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}
