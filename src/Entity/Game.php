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
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $editeur = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nbJoueursMin = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nbJoueursMax = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $age = null;

    #[ORM\Column(length: 1000)]
    private ?string $image = null;

    #[ORM\Column(length: 1000)]
    private ?string $shortDescription = null;

    
    #[ORM\ManyToMany(targetEntity: Auteur::class, mappedBy: 'game')]
    private Collection $auteurs;

    #[ORM\ManyToMany(targetEntity: Dessinateur::class, mappedBy: 'game')]
    private Collection $dessinateurs;

    #[ORM\ManyToMany(targetEntity: Theme::class, mappedBy: 'game')]
    private Collection $themes;

    #[ORM\ManyToMany(targetEntity: Type::class, mappedBy: 'game')]
    private Collection $types;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $longDescription = null;

    

   
    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
        $this->dessinateurs = new ArrayCollection();
        $this->themes = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->user = new ArrayCollection();
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

    public function getNbJoueursMin(): ?int
    {
        return $this->nbJoueursMin;
    }

    public function setNbJoueursMin(int $nbJoueursMin): static
    {
        $this->nbJoueursMin = $nbJoueursMin;

        return $this;
    }

    public function getNbJoueursMax(): ?int
    {
        return $this->nbJoueursMax;
    }

    public function setNbJoueursMax(int $nbJoueursMax): static
    {
        $this->nbJoueursMax = $nbJoueursMax;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

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
    public function __toString(){

        $this->getName();
    }

    /**
     * @return Collection<int, Auteur>
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(Auteur $auteur): static
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs->add($auteur);
            $auteur->addGame($this);
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): static
    {
        if ($this->auteurs->removeElement($auteur)) {
            $auteur->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Dessinateur>
     */
    public function getDessinateurs(): Collection
    {
        return $this->dessinateurs;
    }

    public function addDessinateur(Dessinateur $dessinateur): static
    {
        if (!$this->dessinateurs->contains($dessinateur)) {
            $this->dessinateurs->add($dessinateur);
            $dessinateur->addGame($this);
        }

        return $this;
    }

    public function removeDessinateur(Dessinateur $dessinateur): static
    {
        if ($this->dessinateurs->removeElement($dessinateur)) {
            $dessinateur->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): static
    {
        if (!$this->themes->contains($theme)) {
            $this->themes->add($theme);
            $theme->addGame($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): static
    {
        if ($this->themes->removeElement($theme)) {
            $theme->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->addGame($this);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        if ($this->types->removeElement($type)) {
            $type->removeGame($this);
        }

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
            $user->addGame($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function getLongDescritption(): ?string
    {
        return $this->longDescritption;
    }

    public function setLongDescritption(string $longDescritption): static
    {
        $this->longDescritption = $longDescritption;

        return $this;
    }
}
