<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Edition::class, inversedBy="livres")
     */
    private $edition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLivre;

    /**
     * @ORM\Column(type="text")
     */
    private $resumerLivre;

    /**
     * @ORM\ManyToMany(targetEntity=Personne::class, inversedBy="livres")
     */
    private $personnes;

    public function __construct()
    {
        $this->edition = new ArrayCollection();
        $this->personnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Edition>
     */
    public function getEdition(): Collection
    {
        return $this->edition;
    }

    public function addEdition(Edition $edition): self
    {
        if (!$this->edition->contains($edition)) {
            $this->edition[] = $edition;
        }

        return $this;
    }

    public function removeEdition(Edition $edition): self
    {
        $this->edition->removeElement($edition);

        return $this;
    }

    public function getNomLivre(): ?string
    {
        return $this->nomLivre;
    }

    public function setNomLivre(string $nomLivre): self
    {
        $this->nomLivre = $nomLivre;

        return $this;
    }

    public function getResumerLivre(): ?string
    {
        return $this->resumerLivre;
    }

    public function setResumerLivre(string $resumerLivre): self
    {
        $this->resumerLivre = $resumerLivre;

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        $this->personnes->removeElement($personne);

        return $this;
    }
}
