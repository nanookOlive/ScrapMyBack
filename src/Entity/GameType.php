<?php

namespace App\Entity;

use App\Repository\GameTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameTypeRepository::class)]
#[UniqueEntity('name')]
class GameType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Unique]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Game::class, inversedBy: 'gameTypes')]
    private Collection $Game;

    public function __construct()
    {
        $this->Game = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGame(): Collection
    {
        return $this->Game;
    }

    public function addGame(Game $game): static
    {
        if (!$this->Game->contains($game)) {
            $this->Game->add($game);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        $this->Game->removeElement($game);

        return $this;
    }
}
