<?php

namespace App\Security\Heimdall\Model;

use App\Security\Heimdall\Model\ComplexObjectSerializingTrait;
use App\Security\Heimdall\Model\ContractService;
use App\Security\Heimdall\Model\TimeStampedModelTrait;
use DateTime;
use Symfony\Component\PropertyAccess\PropertyAccess;

class UserContractService
{
    use CreatedUpdatedDeletedTrait;

    /**
     * @var string
     */
    protected $userContract;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var ContractService[]
     */
    protected $contractServices = [];

    /**
     * @return string
     */
    public function getUserContract(): string
    {
        return $this->userContract;
    }

    /**
     * @param string $userContract
     *
     * @return self
     */
    public function setUserContract(string $userContract): self
    {
        $this->userContract = $userContract;

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
     * @return ContractService[]
     */
    public function getContractServices(): array
    {
        return $this->contractServices;
    }

    /**
     * @param ContractService[] $contractServices
     *
     * @return self
     */
    public function setContractServices(array $contractServices): self
    {
        $this->contractServices = $contractServices;

        return $this;
    }

    /**
     * @param ContractService $contractService
     *
     * @return $this
     */
    public function addContractService(ContractService $contractService): self
    {
        $this->contractServices[] = $contractService;

        return $this;
    }
}
