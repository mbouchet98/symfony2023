<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Personne::class, mappedBy="categorie")
     */
    private $listePersonnes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCategorie;

    public function __construct()
    {
        $this->listePersonnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getListePersonnes(): Collection
    {
        return $this->listePersonnes;
    }

    public function addListePersonne(Personne $listePersonne): self
    {
        if (!$this->listePersonnes->contains($listePersonne)) {
            $this->listePersonnes[] = $listePersonne;
            $listePersonne->setCategorie($this);
        }

        return $this;
    }

    public function removeListePersonne(Personne $listePersonne): self
    {
        if ($this->listePersonnes->removeElement($listePersonne)) {
            // set the owning side to null (unless already changed)
            if ($listePersonne->getCategorie() === $this) {
                $listePersonne->setCategorie(null);
            }
        }

        return $this;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }
}
