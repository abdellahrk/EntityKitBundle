<?php

namespace Rami\EntityKitBundle\Infra\Interfaces\TimeStamped;

interface TimeStampedInterface
{
    public function getCreatedAt(): ?\DateTimeImmutable;
    public function setCreatedAt(\DateTimeImmutable $createdAt): static;

    public function getUpdatedAt(): ?\DateTimeImmutable;
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static;
}