<?php

namespace App\Model;

use DateTime;

class AnimalModel
{
    private string $name;
    private string $slug;
    
    public function getName() : string
    {
        return $this->name;
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function setName(string $name) 
    {
        $this->name = $name;
    }

    public function setSlug(string $slug) 
    {
       $this->slug = $slug;
    }
    


}
