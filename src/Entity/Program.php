<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $synopsis;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $poster;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'programs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category;

    #[ORM\OneToMany(mappedBy: 'program', targetEntity: Saison::class)]
    private Collection $saisons;

    #[ORM\ManyToMany(targetEntity: Actor::class, mappedBy: 'programs')]
    #[ORM\JoinTable(name: 'actors_programs')]
    private Collection $actors;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    public function __construct()
    {
        $this->saisons = new ArrayCollection();
        $this->actors = new ArrayCollection();
    }

    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(Saison $saison): self
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons[] = $saison;
            $saison->setSaison($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): self

    {
        if ($this->saison->removeElement($saison)) {
            // set the owning side to null (unless already changed)
            if ($saison->getSaison() === $this) {
                $saison->setSaison(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
            $actor->addProgram($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        if ($this->actors->removeElement($actor)) {
            $actor->removeProgram($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
