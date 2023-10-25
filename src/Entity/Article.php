<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    use HasIdTrait;
    use HasNameTrait;
    Use TimestampableEntity;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'article')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $usr = null;

    #[ORM\ManyToMany(targetEntity: PhotoArticle::class, inversedBy: 'articles')]
    private Collection $photo;

    #[ORM\ManyToOne(inversedBy: 'article')]
    private ?User $username = null;

    public function __construct()
    {
        $this->photo = new ArrayCollection();
    }

   

   
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, PhotoArticle>
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(PhotoArticle $photo): static
    {
        if (!$this->photo->contains($photo)) {
            $this->photo->add($photo);
        }

        return $this;
    }

    public function removePhoto(PhotoArticle $photo): static
    {
        $this->photo->removeElement($photo);

        return $this;
    }



   

   
  
}
