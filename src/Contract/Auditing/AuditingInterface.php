<?php

namespace Rami\EntityKitBundle\Contract\Auditing;

interface AuditingInterface
{

    public function getCreatedAt(): ?\DateTimeImmutable;

    public function setCreatedAt(\DateTimeImmutable $createdAt): static;

    public function getUpdatedAt(): ?\DateTimeImmutable;

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static;

    public function getCreatedBy(): ?string;

    public function setCreatedBy(string $createdBy): static;

    public function getUpdatedBy(): ?string;

    public function setUpdatedBy(string $updatedBy): static;
}
