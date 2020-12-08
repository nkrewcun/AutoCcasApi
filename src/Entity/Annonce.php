<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Controller\AnnoncesSearchController;

/**
 * @ApiResource(
 *      collectionOperations = {
 *          "get" = {
 *              "normalization_context" = {"groups" = {"getAnnoncesForIndex"}},
 *              "pagination_enabled" = false,
 *          },
 *          "post" = {
 *              "denormalization_context" = {"groups" = {"postPutFullAnnonce"}},
 *              "security"="is_granted('ROLE_USER')"
 *          },
 *          "search_annonces"={
 *              "method"="GET",
 *              "path"="/annonces/search",
 *              "controller"=AnnoncesSearchController::class,
 *              "pagination_enabled" = false,
 *              "filters" = {},
 *              "openapi_context" = {
 *                  "summary" = "Retrieves the values for the search filters",
 *              },
 *          },
 *      },
 *      itemOperations = {
 *          "get" = {
 *              "normalization_context" = {"groups" = {"getFullAnnonce"}}
 *          },
 *          "get_for_edit" = {
 *              "path" = "/annonces/for_edit/{id}",
 *              "requirements" = {"id"="\d+"},
 *              "method" = "GET",
 *              "normalization_context" = {"groups" = {"getAnnonceForEdit"}},
 *              "security"="(is_granted('ROLE_USER') and object.getGarage().getProfessionnel() == user) or is_granted('ROLE_ADMIN')"
 *          },
 *          "admin_get" = {
 *              "path" = "/admin/annonces/{id}",
 *              "requirements" = {"id"="\d+"},
 *              "method" = "GET",
 *              "normalization_context" = {"groups" = {"getAnnonceForAdmin"}},
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "put" = {
 *              "denormalization_context" = {"groups" = {"postPutFullAnnonce"}},
 *              "security"="(is_granted('ROLE_USER') and object.getGarage().getProfessionnel() == user) or is_granted('ROLE_ADMIN')"
 *          },
 *          "delete" = {"security"="(is_granted('ROLE_USER') and object.getGarage().getProfessionnel() == user) or is_granted('ROLE_ADMIN')"},
 *      },
 *     subresourceOperations={
 *          "api_garages_annonces_get_subresource"= {
 *              "method"="GET",
 *              "normalization_context"={"groups"={"getAnnoncesForIndex"}}
 *          }
 *     }
 *  )
 * @ApiFilter(OrderFilter::class, properties={"datePublication": "DESC"})
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "getAnnonceForEdit"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce"})
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Groups({"getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"getAnnoncesForIndex", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $descriptionCourte;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $anneeMiseCirculation;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="float")
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $prix;

    /**
     * @ORM\Column(type="date")
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $datePublication;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="annonces", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $modele;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     * @Groups ({"getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $garage;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCarburant::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $carburant;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="annonce", orphanRemoval=true, cascade={"persist"})
     * @Groups({"getAnnoncesForIndex", "getFullAnnonce", "getAnnonceForAdmin", "postPutFullAnnonce", "getAnnonceForEdit"})
     */
    private $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $reference ? $this->reference = $reference : $this->reference = uniqid();

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionCourte(): ?string
    {
        return $this->descriptionCourte;
    }

    public function setDescriptionCourte(string $descriptionCourte): self
    {
        $this->descriptionCourte = $descriptionCourte;

        return $this;
    }

    public function getAnneeMiseCirculation(): ?int
    {
        return $this->anneeMiseCirculation;
    }

    public function setAnneeMiseCirculation(int $anneeMiseCirculation): self
    {
        $this->anneeMiseCirculation = $anneeMiseCirculation;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getCarburant(): ?TypeCarburant
    {
        return $this->carburant;
    }

    public function setCarburant(?TypeCarburant $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setAnnonce($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getAnnonce() === $this) {
                $photo->setAnnonce(null);
            }
        }

        return $this;
    }
}
