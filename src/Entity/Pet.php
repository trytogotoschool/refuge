<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\PetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: PetRepository::class)]
class Pet
{
   use HasIdTrait;
   use HasNameTrait;
   use TimestampableEntity;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birth = null;

    #[ORM\Column()]
    private ?int $gender = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column( nullable: true)]
    private ?bool $adopt = null;

    #[ORM\Column( nullable: true)]
    private ?bool $online = null;

    #[ORM\ManyToOne(inversedBy: 'pet')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $usr = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'pets')]
    private Collection $tag;

    #[ORM\OneToMany(mappedBy: 'pet', targetEntity: Photo::class)]
    private Collection $photo;

    

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->photo = new ArrayCollection();
    }


 

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(?\DateTimeInterface $birth): static
    {
        $this->birth = $birth;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(?int $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isAdopt(): ?bool
    {
        return $this->adopt;
    }

    public function setAdopt(bool $adopt): static
    {
        $this->adopt = $adopt;

        return $this;
    }

    public function isOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): static
    {
        $this->online = $online;

        return $this;
    }

    public function getUsr(): ?User
    {
        return $this->usr;
    }

    public function setUsr(?User $usr): static
    {
        $this->usr = $usr;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photo->contains($photo)) {
            $this->photo->add($photo);
            $photo->setPet($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photo->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getPet() === $this) {
                $photo->setPet(null);
            }
        }

        return $this;
    }

   

    
}
