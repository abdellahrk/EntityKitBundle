<?php

namespace Rami\EntityKitBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait SluggedTrait
{
    #[ORM\Column(type: 'string')]
    public ?string $slug = null;

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;
        return $this;
    }
}