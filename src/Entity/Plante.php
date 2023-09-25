<?php

namespace App\Entity;

use App\Repository\PlanteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanteRepository::class)]
class Plante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $familleBotanique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $origin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeDeFeuillage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $frequenceArrosage = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $tailleMature = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $periodeFloraison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $utilisation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieuCultive = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleurFleur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $climat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $exposition = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $besoinEau = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resistanceFroid = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $niveauSoin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $natureTerre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $humiditeSol = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phSol = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $croissance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamilleBotanique(): ?string
    {
        return $this->familleBotanique;
    }

    public function setFamilleBotanique(?string $familleBotanique): static
    {
        $this->familleBotanique = $familleBotanique;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getTypeDeFeuillage(): ?string
    {
        return $this->typeDeFeuillage;
    }

    public function setTypeDeFeuillage(?string $typeDeFeuillage): static
    {
        $this->typeDeFeuillage = $typeDeFeuillage;

        return $this;
    }

    public function getFrequenceArrosage(): ?string
    {
        return $this->frequenceArrosage;
    }

    public function setFrequenceArrosage(?string $frequenceArrosage): static
    {
        $this->frequenceArrosage = $frequenceArrosage;

        return $this;
    }

    public function getTailleMature(): ?string
    {
        return $this->tailleMature;
    }

    public function setTailleMature(?string $tailleMature): static
    {
        $this->tailleMature = $tailleMature;

        return $this;
    }

    public function getPeriodeFloraison(): ?string
    {
        return $this->periodeFloraison;
    }

    public function setPeriodeFloraison(?string $periodeFloraison): static
    {
        $this->periodeFloraison = $periodeFloraison;

        return $this;
    }

    public function getUtilisation(): ?string
    {
        return $this->utilisation;
    }

    public function setUtilisation(?string $utilisation): static
    {
        $this->utilisation = $utilisation;

        return $this;
    }

    public function getLieuCultive(): ?string
    {
        return $this->lieuCultive;
    }

    public function setLieuCultive(?string $lieuCultive): static
    {
        $this->lieuCultive = $lieuCultive;

        return $this;
    }

    public function getCouleurFleur(): ?string
    {
        return $this->couleurFleur;
    }

    public function setCouleurFleur(?string $couleurFleur): static
    {
        $this->couleurFleur = $couleurFleur;

        return $this;
    }

    public function getClimat(): ?string
    {
        return $this->climat;
    }

    public function setClimat(?string $climat): static
    {
        $this->climat = $climat;

        return $this;
    }

    public function getExposition(): ?string
    {
        return $this->exposition;
    }

    public function setExposition(?string $exposition): static
    {
        $this->exposition = $exposition;

        return $this;
    }

    public function getBesoinEau(): ?string
    {
        return $this->besoinEau;
    }

    public function setBesoinEau(?string $besoinEau): static
    {
        $this->besoinEau = $besoinEau;

        return $this;
    }

    public function getResistanceFroid(): ?string
    {
        return $this->resistanceFroid;
    }

    public function setResistanceFroid(?string $resistanceFroid): static
    {
        $this->resistanceFroid = $resistanceFroid;

        return $this;
    }

    public function getNiveauSoin(): ?string
    {
        return $this->niveauSoin;
    }

    public function setNiveauSoin(?string $niveauSoin): static
    {
        $this->niveauSoin = $niveauSoin;

        return $this;
    }

    public function getNatureTerre(): ?string
    {
        return $this->natureTerre;
    }

    public function setNatureTerre(?string $natureTerre): static
    {
        $this->natureTerre = $natureTerre;

        return $this;
    }

    public function getHumiditeSol(): ?string
    {
        return $this->humiditeSol;
    }

    public function setHumiditeSol(?string $humiditeSol): static
    {
        $this->humiditeSol = $humiditeSol;

        return $this;
    }

    public function getPhSol(): ?string
    {
        return $this->phSol;
    }

    public function setPhSol(?string $phSol): static
    {
        $this->phSol = $phSol;

        return $this;
    }

    public function getCroissance(): ?string
    {
        return $this->croissance;
    }

    public function setCroissance(?string $croissance): static
    {
        $this->croissance = $croissance;

        return $this;
    }
}
