<?php

namespace App\Entity\Traits;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
 
#[UniqueEntity('name')]
#[UniqueEntity('slug')]
trait HasNameTrait 
{
    #[ORM\Column(length: 30, unique: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]

    private ?string $slug = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
    public function computeSlug(SluggerInterface $slugger, bool $update=false)
    {
        if (!$this->slug || '-' === $this->slug || $update) {
            
            $this->slug = (string) $slugger->slug((string) $this)->lower();
        }
    }
    public function __toString()
    {
        return $this->name;
    }

}