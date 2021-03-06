<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\SaisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'integer')]
    private ?int $nombre;

    #[ORM\Column(type: 'integer')]
    private ?int $annee;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\ManyToOne(targetEntity: Program::class, inversedBy: 'saisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Program $program;

    #[ORM\OneToMany(mappedBy: 'saison', targetEntity: Episode::class)]
    private Collection $episodes;

    public function __construct()
    {
        $this->episodes = new ArrayCollection();
    }

    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): self
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes[] = $episode;
            $episode->setCategory($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): self
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getCategory() === $this) {
                $episode->setCategory(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

        return $this;
    }
}
