<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Animal
{ 
    use HasIdTrait;
    use HasNameTrait;
 

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Pet::class)]
    private Collection $pets;
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    protected $createdAt;

    public function __construct()
    {
        $this->pets = new ArrayCollection();
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTimeImmutable();
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
            $pet->setAnimal($this);
        }

        return $this;
    }

    public function removePet(Pet $pet): static
    {
        if ($this->pets->removeElement($pet)) {
            // set the owning side to null (unless already changed)
            if ($pet->getAnimal() === $this) {
                $pet->setAnimal(null);
            }
        }

        return $this;
    }
}
