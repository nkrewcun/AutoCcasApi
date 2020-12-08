<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeCarburantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * TODO: Security on post, put and delete
 * @ApiResource(
 *     attributes={"pagination_enabled"=false}
 * )
 * @ORM\Entity(repositoryClass=TypeCarburantRepository::class)
 */
class TypeCarburant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "getAnnonceForEdit", "postPutFullAnnonce"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "getAnnonceForEdit", "postPutFullAnnonce"})
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="carburant")
     */
    private $annonces;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setCarburant($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->contains($annonce)) {
            $this->annonces->removeElement($annonce);
            // set the owning side to null (unless already changed)
            if ($annonce->getCarburant() === $this) {
                $annonce->setCarburant(null);
            }
        }

        return $this;
    }
}
