<?php

namespace Rami\EntityKitBundle\TimeStamp;

interface TimeStampedInterface
{
    public function getCreatedAt(): ?\DateTimeImmutable;
    public function setCreatedAt(\DateTimeImmutable $createdAt): static;

    public function getUpdatedAt(): ?\DateTimeImmutable;
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static;
}