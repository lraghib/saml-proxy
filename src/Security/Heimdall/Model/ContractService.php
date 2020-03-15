<?php

namespace App\Security\Heimdall\Model;

class ContractService
{
    use CreatedUpdatedDeletedTrait;

    /**
     * @var string
     */
    protected $contract;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var Service
     */
    protected $service;

    /**
     * @return string
     */
    public function getContract(): string
    {
        return $this->contract;
    }

    /**
     * @param string $contract
     *
     * @return self
     */
    public function setContract(string $contract): self
    {
        $this->contract = $contract;

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
     * @return Service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * @param Service $service
     *
     * @return self
     */
    public function setService(Service $service): self
    {
        $this->service = $service;

        return $this;
    }
}
