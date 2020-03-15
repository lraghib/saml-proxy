<?php

namespace App\Security\Heimdall\Model;

class Area
{
    use CreatedUpdatedDeletedTrait;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var string
     */
    protected $client;

    /**
     * @var Metadata[]
     */
    protected $areaMetadatas = [];

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $label;

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @param string $client
     *
     * @return self
     */
    public function setClient(string $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Metadata[]
     */
    public function getAreaMetadatas(): array
    {
        return $this->areaMetadatas;
    }

    /**
     * @param Metadata[] $areaMetadatas
     *
     * @return self
     */
    public function setAreaMetadatas(array $areaMetadatas): self
    {
        $this->areaMetadatas = $areaMetadatas;

        return $this;
    }

    /**
     * @param Metadata $metadata
     *
     * @return $this
     */
    public function addAreaMetadata(Metadata $metadata): self
    {
        $this->areaMetadatas[] = $metadata;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     *
     * @return self
     */
    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedBy(): string 
    {
        return $this->updatedBy;
    }

    /**
     * @param string $updatedBy
     *
     * @return self
     */
    public function setUpdatedBy(string $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime $deletedAt
     *
     * @return self
     */
    public function setDeletedAt(DateTime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}