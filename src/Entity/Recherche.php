<?php

namespace App\Entity;

use App\Repository\RechercheRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RechercheRepository::class)]

class Recherche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list'])]
    private ?string $numeroReclammation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['list'])]
    private ?string $numeroLigne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroReclammation(): ?string
    {
        return $this->numeroReclammation;
    }

    public function setNumeroReclammation(string $numeroReclammation): static
    {
        $this->numeroReclammation = $numeroReclammation;

        return $this;
    }

    public function getNumeroLigne(): ?string
    {
        return $this->numeroLigne;
    }

    public function setNumeroLigne(?string $numeroLigne): static
    {
        $this->numeroLigne = $numeroLigne;

        return $this;
    }
}
