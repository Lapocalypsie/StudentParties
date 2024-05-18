<?php

namespace App\Entity;

use App\Repository\DjRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DjRepository::class)]
class Dj
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?int $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $portfolio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateSoiree = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasMaterial = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbSpeaker = null;

    #[ORM\Column(nullable: true)]
    private ?int $powerSpeaker = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(?int $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getPortfolio(): ?string
    {
        return $this->portfolio;
    }

    public function setPortfolio(?string $portfolio): static
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    public function getDateSoiree(): ?\DateTimeInterface
    {
        return $this->dateSoiree;
    }

    public function setDateSoiree(?\DateTimeInterface $dateSoiree): static
    {
        $this->dateSoiree = $dateSoiree;

        return $this;
    }

    public function hasMaterial(): ?bool
    {
        return $this->hasMaterial;
    }

    public function setHasMaterial(?bool $hasMaterial): static
    {
        $this->hasMaterial = $hasMaterial;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getNbSpeaker(): ?int
    {
        return $this->nbSpeaker;
    }

    public function setNbSpeaker(?int $nbSpeaker): static
    {
        $this->nbSpeaker = $nbSpeaker;

        return $this;
    }

    public function getPowerSpeaker(): ?int
    {
        return $this->powerSpeaker;
    }

    public function setPowerSpeaker(?int $powerSpeaker): static
    {
        $this->powerSpeaker = $powerSpeaker;

        return $this;
    }
}
