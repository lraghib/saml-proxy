<?php

namespace App\Security\Heimdall\Model;

class UserContract
{
    use CreatedUpdatedDeletedTrait;

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var Contract
     */
    protected $contract;

    /**
     * @var ContractArea[]
     */
    protected $contractAreas = [];

    /**
     * @var UserContractService[]
     */
    protected $userContractServices = [];

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     *
     * @return self
     */
    public function setUser(string $user): self
    {
        $this->user = $user;

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
     * @return Contract
     */
    public function getContract(): Contract
    {
        return $this->contract;
    }

    /**
     * @param Contract $contract
     *
     * @return self
     */
    public function setContract(Contract $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * @return ContractArea[]
     */
    public function getContractAreas(): array
    {
        return $this->contractAreas;
    }

    /**
     * @param ContractArea[] $contractAreas
     *
     * @return self
     */
    public function setContractAreas(array $contractAreas): self
    {
        $this->contractAreas = $contractAreas;

        return $this;
    }

    /**
     * @param ContractArea $contractArea
     *
     * @return $this
     */
    public function addContractArea(ContractArea $contractArea): self
    {
        $this->contractAreas[] = $contractArea;

        return $this;
    }

    /**
     * @return UserContractService[]
     */
    public function getUserContractServices()
    {
        return $this->userContractServices;
    }

    /**
     * @param UserContractService[] $userContractServices
     *
     * @return self
     */
    public function setUserContractServices(array $userContractServices): self
    {
        $this->userContractServices = $userContractServices;

        return $this;
    }

    /**
     * @param UserContractService $userContractService
     *
     * @return self
     */
    public function addUserContractService(UserContractService $userContractService): self
    {
        $this->userContractServices[] = $userContractService;

        return $this;
    }
}
