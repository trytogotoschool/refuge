<?php
namespace App\EntityListener;

use App\Entity\Animal;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Animal::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Animal::class)]
class AnimalEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
    ) {
    }

    public function prePersist(Animal $animal, LifecycleEventArgs $event)
    {
        $animal->computeSlug($this->slugger);
    }

    public function preUpdate(Animal $animal, LifecycleEventArgs $event)
    {
 
        $animal->computeSlug($this->slugger, true);
    }
}