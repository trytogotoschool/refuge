<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
 
    use HasIdTrait;
    use HasNameTrait;
    use TimestampableEntity;

    #[ORM\ManyToMany(targetEntity: Pet::class, mappedBy: 'tag')]
    private Collection $pets;

    public function __construct()
    {
        $this->pets = new ArrayCollection();
    }

    /**
     * @return Collection<int, Pet>
     */
    public function getPets(): Collection
    {
        return $this->pets;
    }

    public function addPet(Pet $pet): static
    {
        if (!$this->pets->contains($pet)) {
            $this->pets->add($pet);
            $pet->addTag($this);
        }

        return $this;
    }

    public function removePet(Pet $pet): static
    {
        if ($this->pets->removeElement($pet)) {
            $pet->removeTag($this);
        }

        return $this;
    }
}
