<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * TODO: Security on all operations
 * @ApiResource(
 *      collectionOperations = {
 *          "get" = {
 *              "path" = "/admin/garages",
 *              "normalization_context" = {"groups" = {"getGaragesForAdmin"}}
 *          },
 *          "post" = {
 *              "denormalization_context" = {"groups" = {"postPutGarage"}}
 *          }
 *      },
 *      itemOperations = {
 *          "get" = {
 *              "normalization_context" = {"groups" = {"getGarage"}}
 *          },
 *          "admin_get" = {
 *              "path" = "/admin/garages/{id}",
 *              "requirements" = {"id"="\d+"},
 *              "method" = "GET",
 *              "normalization_context" = {"groups" = {"getGarageForAdmin"}}
 *          },
 *          "put" = {
 *              "denormalization_context" = {"groups" = {"postPutGarage"}}
 *          },
 *          "delete"
 *      }
 *  )
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GarageRepository::class)
 */
class Garage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"getGarage", "getGaragesForAdmin", "getGarageForAdmin"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getGarage", "getGaragesForAdmin", "getGarageForAdmin", "postPutGarage"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"getGarage", "getGaragesForAdmin", "getGarageForAdmin", "postPutGarage"})
     */
    private $numeroTel;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class, inversedBy="garages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"getGarage", "getGaragesForAdmin", "getGarageForAdmin", "postPutGarage"})
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="garage", orphanRemoval=true)
     * @ApiSubresource
     */
    private $annonces;

    /**
     * @ORM\ManyToOne(targetEntity=Professionnel::class, inversedBy="garages")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"getGaragesForAdmin", "getGarageForAdmin", "postPutGarage"})
     */
    private $professionnel;

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

    public function getNumeroTel(): ?string
    {
        return $this->numeroTel;
    }

    public function setNumeroTel(string $numeroTel): self
    {
        $this->numeroTel = $numeroTel;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

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
            $annonce->setGarage($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->contains($annonce)) {
            $this->annonces->removeElement($annonce);
            // set the owning side to null (unless already changed)
            if ($annonce->getGarage() === $this) {
                $annonce->setGarage(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getProfessionnel(): ?Professionnel
    {
        return $this->professionnel;
    }

    public function setProfessionnel(?Professionnel $professionnel): self
    {
        $this->professionnel = $professionnel;

        return $this;
    }


}
