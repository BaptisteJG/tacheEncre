<?php

namespace App\Entity;

use App\Repository\TypesCadresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypesCadresRepository::class)]
class TypesCadres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'typesCadres', targetEntity: Baguette::class)]
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
            $baguette->setTypesCadres($this);
        }

        return $this;
    }

    public function removeBaguette(Baguette $baguette): static
    {
        if ($this->baguettes->removeElement($baguette)) {
            // set the owning side to null (unless already changed)
            if ($baguette->getTypesCadres() === $this) {
                $baguette->setTypesCadres(null);
            }
        }

        return $this;
    }
}
