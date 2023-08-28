<?php

namespace App\Entity;

use App\Repository\BaguetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BaguetteRepository::class)]
class Baguette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'baguettes')]
    private ?TypesCadres $typesCadres = null;

    #[ORM\ManyToOne(inversedBy: 'baguettes')]
    private ?Couleur $couleur = null;

    #[ORM\ManyToOne(inversedBy: 'baguette')]
    private ?Fournisseur $fournisseur = null;

    #[ORM\OneToMany(mappedBy: 'baguette', targetEntity: Sujet::class)]
    private Collection $sujets;

    #[ORM\ManyToMany(targetEntity: Matiere::class, inversedBy: 'baguettes')]
    private Collection $matiere;

    public function __construct()
    {
        $this->sujets = new ArrayCollection();
        $this->matiere = new ArrayCollection();
    }

    public function __toString()    // Oblige la chaine à retourner un string
    {
        return $this->libelle;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTypesCadres(): ?TypesCadres
    {
        return $this->typesCadres;
    }

    public function setTypesCadres(?TypesCadres $typesCadres): static
    {
        $this->typesCadres = $typesCadres;

        return $this;
    }

    public function getCouleur(): ?Couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?Couleur $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return Collection<int, Sujet>
     */
    public function getSujets(): Collection
    {
        return $this->sujets;
    }

    public function addSujet(Sujet $sujet): static
    {
        if (!$this->sujets->contains($sujet)) {
            $this->sujets->add($sujet);
            $sujet->setBaguette($this);
        }

        return $this;
    }

    public function removeSujet(Sujet $sujet): static
    {
        if ($this->sujets->removeElement($sujet)) {
            // set the owning side to null (unless already changed)
            if ($sujet->getBaguette() === $this) {
                $sujet->setBaguette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getMatiere(): Collection
    {
        return $this->matiere;
    }

    public function addMatiere(Matiere $matiere): static
    {
        if (!$this->matiere->contains($matiere)) {
            $this->matiere->add($matiere);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): static
    {
        $this->matiere->removeElement($matiere);

        return $this;
    }
}
