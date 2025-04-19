<?php
/*
 * Copyright (c) 2025.
 *
 * This file is part of the Entity Kit Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\EntityKitBundle\Entity\LoggedEntity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

class LoggedEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $objectId = null;

    #[ORM\Column(type: Types::STRING)]
    protected ?string $objectClass = null;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $version = null;

    #[ORM\Column(type: Types::STRING)]
    protected ?string $loggedBy = null;

    #[ORM\Column(type: Types::JSON)]
    protected ?array $oldData = null;

    #[ORM\Column(type: Types::JSON)]
    protected ?array $data = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    /**
     * @param int|null $objectId
     * @return LoggedEntity
     */
    public function setObjectId(?int $objectId): LoggedEntity
    {
        $this->objectId = $objectId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getObjectClass(): ?string
    {
        return $this->objectClass;
    }

    /**
     * @param string|null $objectClass
     * @return LoggedEntity
     */
    public function setObjectClass(?string $objectClass): LoggedEntity
    {
        $this->objectClass = $objectClass;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * @param int|null $version
     * @return LoggedEntity
     */
    public function setVersion(?int $version): LoggedEntity
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLoggedBy(): ?string
    {
        return $this->loggedBy;
    }

    /**
     * @param string|null $loggedBy
     * @return LoggedEntity
     */
    public function setLoggedBy(?string $loggedBy): LoggedEntity
    {
        $this->loggedBy = $loggedBy;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getOldData(): ?array
    {
        return $this->oldData;
    }

    /**
     * @param array|null $oldData
     * @return LoggedEntity
     */
    public function setOldData(?array $oldData): LoggedEntity
    {
        $this->oldData = $oldData;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     * @return LoggedEntity
     */
    public function setData(?array $data): LoggedEntity
    {
        $this->data = $data;
        return $this;
    }
}