<?php

namespace App\Entity;

use App\Repository\CouleurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouleurRepository::class)]
class Couleur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelle = null;

    #[ORM\OneToOne(mappedBy: 'couleur', cascade: ['persist', 'remove'])]
    private ?PassePartout $passePartout = null;

    #[ORM\OneToMany(mappedBy: 'couleur', targetEntity: Baguette::class)]
    private Collection $baguettes;

    public function __construct()
    {
        $this->baguettes = new ArrayCollection();
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

    public function getPassePartout(): ?PassePartout
    {
        return $this->passePartout;
    }

    public function setPassePartout(?PassePartout $passePartout): static
    {
        // unset the owning side of the relation if necessary
        if ($passePartout === null && $this->passePartout !== null) {
            $this->passePartout->setCouleur(null);
        }

        // set the owning side of the relation if necessary
        if ($passePartout !== null && $passePartout->getCouleur() !== $this) {
            $passePartout->setCouleur($this);
        }

        $this->passePartout = $passePartout;

        return $this;
    }

    /**
     * @return Collection<int, Baguette>
     */
    public function getBaguettes(): Collection
    {
        return $this->baguettes;
    }

    public function addBaguette(Baguette $baguette): static
    {
        if (!$this->baguettes->contains($baguette)) {
            $this->baguettes->add($baguette);
            $baguette->setCouleur($this);
        }

        return $this;
    }

    public function removeBaguette(Baguette $baguette): static
    {
        if ($this->baguettes->removeElement($baguette)) {
            // set the owning side to null (unless already changed)
            if ($baguette->getCouleur() === $this) {
                $baguette->setCouleur(null);
            }
        }

        return $this;
    }
}
