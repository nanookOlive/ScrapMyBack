<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $nom = null;

    #[ORM\Column(length: 1000)]
    private ?string $image = null;

    #[ORM\Column(length: 500)]
    private ?string $editeur = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $age = null;

    #[ORM\ManyToMany(targetEntity: GameType::class, mappedBy: 'Game')]
    private Collection $gameTypes;

    #[ORM\Column(length: 1000)]
    private ?string $shortDescription = null;

    #[ORM\Column(length: 5000)]
    private ?string $longDescription = null;

    #[ORM\ManyToMany(targetEntity: Theme::class, mappedBy: 'Game')]
    private Collection $yes;

    public function __construct()
    {
        $this->gameTypes = new ArrayCollection();
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): static
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, GameType>
     */
    public function getGameTypes(): Collection
    {
        return $this->gameTypes;
    }

    public function addGameType(GameType $gameType): static
    {
        if (!$this->gameTypes->contains($gameType)) {
            $this->gameTypes->add($gameType);
            $gameType->addGame($this);
        }

        return $this;
    }

    public function removeGameType(GameType $gameType): static
    {
        if ($this->gameTypes->removeElement($gameType)) {
            $gameType->removeGame($this);
        }

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(string $longDescription): static
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Theme $ye): static
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->addGame($this);
        }

        return $this;
    }

    public function removeYe(Theme $ye): static
    {
        if ($this->yes->removeElement($ye)) {
            $ye->removeGame($this);
        }

        return $this;
    }
}
