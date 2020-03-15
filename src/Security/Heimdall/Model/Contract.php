<?php

namespace App\Security\Heimdall\Model;

class Contract
{
    use CreatedUpdatedDeletedTrait;

    /**
     * @var Metadata[]
     */
    protected $contractMetadatas = [];

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $label;

    /**
     * @return Metadata[]
     */
    public function getContractMetadatas(): array
    {
        return $this->contractMetadatas;
    }

    /**
     * @param Metadata[] $contractMetadatas
     *
     * @return self
     */
    public function setContractMetadatas(array $contractMetadatas): self
    {
        $this->contractMetadatas = $contractMetadatas;

        return $this;
    }

    /**
     * @param Metadata $metadata
     *
     * @return $this
     */
    public function addContractMetadata(Metadata $metadata): self
    {
        $this->contractMetadatas[] = $metadata;

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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

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
}
