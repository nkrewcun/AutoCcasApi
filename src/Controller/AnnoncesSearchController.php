<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnoncesSearchController extends AbstractController
{
    private $annonceRepository;

    public function __construct(AnnonceRepository $annonceRepository)
    {
        $this->annonceRepository = $annonceRepository;
    }

    public function __invoke(): \stdClass
    {
        $data = new \stdClass();
        $data->prixMax = $this->annonceRepository->findMaxPrice()[0]['prix'];
        $data->prixMin = $this->annonceRepository->findMinPrice()[0]['prix'];
        $data->kilometrageMax = $this->annonceRepository->findMaxKilometrage()[0]['kilometrage'];
        $data->kilometrageMin = $this->annonceRepository->findMinKilometrage()[0]['kilometrage'];
        $data->anneeCirculationMax = $this->annonceRepository->findMaxAnneeCirculation()[0]['anneeMiseCirculation'];
        $data->anneeCirculationMin = $this->annonceRepository->findMinAnneeCirculation()[0]['anneeMiseCirculation'];
        return $data;
    }
}
