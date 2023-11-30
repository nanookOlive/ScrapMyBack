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

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?int $minimumAge = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $releaseAt = null;

    #[ORM\Column(nullable: true)]
    private ?float $rating = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column]
    private ?int $playerMin = null;

    #[ORM\Column(nullable: true)]
    private ?int $playerMax = null;

    #[ORM\Column(length: 50)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $longDescription = null;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'games')]
    private Collection $author;

    #[ORM\ManyToMany(targetEntity: Illustrator::class, inversedBy: 'games')]
    private Collection $illustrator;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'games')]
    private Collection $type;

    #[ORM\ManyToMany(targetEntity: Theme::class, inversedBy: 'games')]
    private Collection $theme;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Editor $editor = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Bibliogame::class, orphanRemoval: true)]
    private Collection $bibliogames;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->illustrator = new ArrayCollection();
        $this->type = new ArrayCollection();
        $this->theme = new ArrayCollection();
        $this->bibliogames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getMinimumAge(): ?int
    {
        return $this->minimumAge;
    }

    public function setMinimumAge(?int $minimumAge): static
    {
        $this->minimumAge = $minimumAge;

        return $this;
    }

    public function getReleaseAt(): ?\DateTimeImmutable
    {
        return $this->releaseAt;
    }

    public function setReleaseAt(?\DateTimeImmutable $releaseAt): static
    {
        $this->releaseAt = $releaseAt;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getPlayerMin(): ?int
    {
        return $this->playerMin;
    }

    public function setPlayerMin(int $playerMin): static
    {
        $this->playerMin = $playerMin;

        return $this;
    }

    public function getPlayerMax(): ?int
    {
        return $this->playerMax;
    }

    public function setPlayerMax(?int $playerMax): static
    {
        $this->playerMax = $playerMax;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

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

    public function setLongDescription(?string $longDescription): static
    {
        $this->longDescription = $longDescription;

        return $this;
    }
    public function __toString()
    {
        return ucwords($this->getTitle());
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->author->contains($author)) {
            $this->author->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->author->removeElement($author);

        return $this;
    }

    /**
     * @return Collection<int, Illustrator>
     */
    public function getIllustrator(): Collection
    {
        return $this->illustrator;
    }

    public function addIllustrator(Illustrator $illustrator): static
    {
        if (!$this->illustrator->contains($illustrator)) {
            $this->illustrator->add($illustrator);
        }

        return $this;
    }

    public function removeIllustrator(Illustrator $illustrator): static
    {
        $this->illustrator->removeElement($illustrator);

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Type $type): static
    {
        if (!$this->type->contains($type)) {
            $this->type->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->type->removeElement($type);

        return $this;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getTheme(): Collection
    {
        return $this->theme;
    }

    public function addTheme(Theme $theme): static
    {
        if (!$this->theme->contains($theme)) {
            $this->theme->add($theme);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): static
    {
        $this->theme->removeElement($theme);

        return $this;
    }

    public function getEditor(): ?Editor
    {
        return $this->editor;
    }

    public function setEditor(?Editor $editor): static
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * @return Collection<int, Bibliogame>
     */
    public function getBibliogames(): Collection
    {
        return $this->bibliogames;
    }

    public function addBibliogame(Bibliogame $bibliogame): static
    {
        if (!$this->bibliogames->contains($bibliogame)) {
            $this->bibliogames->add($bibliogame);
            $bibliogame->setGame($this);
        }

        return $this;
    }

    public function removeBibliogame(Bibliogame $bibliogame): static
    {
        if ($this->bibliogames->removeElement($bibliogame)) {
            // set the owning side to null (unless already changed)
            if ($bibliogame->getGame() === $this) {
                $bibliogame->setGame(null);
            }
        }

        return $this;
    }
}
