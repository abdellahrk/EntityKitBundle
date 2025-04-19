<?php

namespace Rami\EntityKitBundle\Entity\Traits;

trait SluggedTrait
{
    protected ?string $slug = null;

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