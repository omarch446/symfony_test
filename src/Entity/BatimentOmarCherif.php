<?php

namespace App\Entity;

use App\Repository\BatimentOmarCherifRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BatimentOmarCherifRepository::class)]
class BatimentOmarCherif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nbEtage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $DateConstraction = null;

    #[ORM\Column]
    private ?bool $Disponible = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbEtage(): ?int
    {
        return $this->nbEtage;
    }

    public function setNbEtage(int $nbEtage): static
    {
        $this->nbEtage = $nbEtage;

        return $this;
    }

    public function getDateConstraction(): ?\DateTime
    {
        return $this->DateConstraction;
    }

    public function setDateConstraction(\DateTime $DateConstraction): static
    {
        $this->DateConstraction = $DateConstraction;

        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->Disponible;
    }

    public function setDisponible(bool $Disponible): static
    {
        $this->Disponible = $Disponible;

        return $this;
    }
}
