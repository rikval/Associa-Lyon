<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Initiative", mappedBy="categorie", orphanRemoval=true)
     */
    private $initiative;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proposition", mappedBy="categorie", orphanRemoval=true)
     */
    private $propositions;

    public function __construct()
    {
        $this->initiative = new ArrayCollection();
        $this->propositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Initiative[]
     */
    public function getInitiative(): Collection
    {
        return $this->initiative;
    }

    public function addInitiative(Initiative $initiative): self
    {
        if (!$this->initiative->contains($initiative)) {
            $this->initiative[] = $initiative;
            $initiative->setCategorie($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiative->contains($initiative)) {
            $this->initiative->removeElement($initiative);
            // set the owning side to null (unless already changed)
            if ($initiative->getCategorie() === $this) {
                $initiative->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Proposition[]
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Proposition $proposition): self
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions[] = $proposition;
            $proposition->setCategorie($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): self
    {
        if ($this->propositions->contains($proposition)) {
            $this->propositions->removeElement($proposition);
            // set the owning side to null (unless already changed)
            if ($proposition->getCategorie() === $this) {
                $proposition->setCategorie(null);
            }
        }

        return $this;
    }
}
