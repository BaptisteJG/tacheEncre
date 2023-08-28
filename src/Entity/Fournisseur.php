<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'fournisseurs', cascade:['persist'])]
    private ?Adresse $adresse = null;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: Verre::class)]
    private Collection $verre;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: Baguette::class)]
    private Collection $baguette;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: PassePartout::class)]
    private Collection $passePartout;

    public function __construct()
    {
        $this->verre = new ArrayCollection();
        $this->baguette = new ArrayCollection();
        $this->passePartout = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

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

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Verre>
     */
    public function getVerre(): Collection
    {
        return $this->verre;
    }

    public function addVerre(Verre $verre): static
    {
        if (!$this->verre->contains($verre)) {
            $this->verre->add($verre);
            $verre->setFournisseur($this);
        }

        return $this;
    }

    public function removeVerre(Verre $verre): static
    {
        if ($this->verre->removeElement($verre)) {
            // set the owning side to null (unless already changed)
            if ($verre->getFournisseur() === $this) {
                $verre->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Baguette>
     */
    public function getBaguette(): Collection
    {
        return $this->baguette;
    }

    public function addBaguette(Baguette $baguette): static
    {
        if (!$this->baguette->contains($baguette)) {
            $this->baguette->add($baguette);
            $baguette->setFournisseur($this);
        }

        return $this;
    }

    public function removeBaguette(Baguette $baguette): static
    {
        if ($this->baguette->removeElement($baguette)) {
            // set the owning side to null (unless already changed)
            if ($baguette->getFournisseur() === $this) {
                $baguette->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PassePartout>
     */
    public function getPassePartout(): Collection
    {
        return $this->passePartout;
    }

    public function addPassePartout(PassePartout $passePartout): static
    {
        if (!$this->passePartout->contains($passePartout)) {
            $this->passePartout->add($passePartout);
            $passePartout->setFournisseur($this);
        }

        return $this;
    }

    public function removePassePartout(PassePartout $passePartout): static
    {
        if ($this->passePartout->removeElement($passePartout)) {
            // set the owning side to null (unless already changed)
            if ($passePartout->getFournisseur() === $this) {
                $passePartout->setFournisseur(null);
            }
        }

        return $this;
    }
}
