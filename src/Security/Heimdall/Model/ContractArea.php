<?php

namespace App\Security\Heimdall\Model;

class ContractArea
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
     * @var Area
     */
    protected $area;

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
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     *
     * @return self
     */
    public function setArea($area): self
    {
        $this->area = $area;

        return $this;
    }
}
