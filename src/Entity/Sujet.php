<?php

namespace App\Entity;

use App\Repository\SujetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: SujetRepository::class)]
class Sujet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formatSujet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tailleBaguette = null;

    #[ORM\ManyToOne(inversedBy: 'sujets')]
    private ?baguette $baguette = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $taillePP = null;

    #[ORM\ManyToOne(inversedBy: 'sujets')]
    private ?PassePartout $passePartout = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tailleVerre = null;

    #[ORM\ManyToOne(inversedBy: 'sujets')]
    private ?Verre $verre = null;

    #[ORM\Column(nullable: true)]
    private ?float $montantTotal = null;

    #[ORM\Column(nullable: true)]
    private ?float $accompte = null;

    #[ORM\ManyToOne(inversedBy: 'sujets', cascade:['persist'])]
    private ?Commande $commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getFormatSujet(): ?string
    {
        return $this->formatSujet;
    }

    public function setFormatSujet(?string $formatSujet): static
    {
        $this->formatSujet = $formatSujet;

        return $this;
    }

    public function getTailleBaguette(): ?string
    {
        return $this->tailleBaguette;
    }

    public function setTailleBaguette(?string $tailleBaguette): static
    {
        $this->tailleBaguette = $tailleBaguette;

        return $this;
    }

    public function getBaguette(): ?baguette
    {
        return $this->baguette;
    }

    public function setBaguette(?baguette $baguette): static
    {
        $this->baguette = $baguette;

        return $this;
    }

    public function getTaillePP(): ?string
    {
        return $this->taillePP;
    }

    public function setTaillePP(?string $taillePP): static
    {
        $this->taillePP = $taillePP;

        return $this;
    }

    public function getPassePartout(): ?PassePartout
    {
        return $this->passePartout;
    }

    public function setPassePartout(?PassePartout $passePartout): static
    {
        $this->passePartout = $passePartout;

        return $this;
    }

    public function getTailleVerre(): ?string
    {
        return $this->tailleVerre;
    }

    public function setTailleVerre(?string $tailleVerre): static
    {
        $this->tailleVerre = $tailleVerre;

        return $this;
    }

    public function getVerre(): ?Verre
    {
        return $this->verre;
    }

    public function setVerre(?Verre $verre): static
    {
        $this->verre = $verre;

        return $this;
    }

    public function getMontantTotal(): ?float
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(?float $montantTotal): static
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function getAccompte(): ?float
    {
        return $this->accompte;
    }

    public function setAccompte(?float $accompte): static
    {
        $this->accompte = $accompte;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }
}
