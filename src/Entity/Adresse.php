<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $num_rue = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    private ?Ville $ville = null;

    #[ORM\OneToMany(mappedBy: 'adresse', targetEntity: Fournisseur::class)]
    private Collection $fournisseurs;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    private ?CodesPostaux $codespostaux = null;

    #[ORM\OneToMany(mappedBy: 'adresse', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->fournisseurs = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function __toString()    // Oblige la chaine à retourner un string
    {
        return $this->num_rue;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumRue(): ?string
    {
        return $this->num_rue;
    }

    public function setNumRue(?string $num_rue): static
    {
        $this->num_rue = $num_rue;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Fournisseur>
     */
    public function getFournisseurs(): Collection
    {
        return $this->fournisseurs;
    }

    public function addFournisseur(Fournisseur $fournisseur): static
    {
        if (!$this->fournisseurs->contains($fournisseur)) {
            $this->fournisseurs->add($fournisseur);
            $fournisseur->setAdresse($this);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): static
    {
        if ($this->fournisseurs->removeElement($fournisseur)) {
            // set the owning side to null (unless already changed)
            if ($fournisseur->getAdresse() === $this) {
                $fournisseur->setAdresse(null);
            }
        }

        return $this;
    }

    public function getCodespostaux(): ?CodesPostaux
    {
        return $this->codespostaux;
    }

    public function setCodespostaux(?CodesPostaux $codespostaux): static
    {
        $this->codespostaux = $codespostaux;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setAdresse($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAdresse() === $this) {
                $user->setAdresse(null);
            }
        }

        return $this;
    }
}
