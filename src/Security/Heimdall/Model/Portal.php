<?php

namespace App\Security\Heimdall\Model;

class Portal
{
    use CreatedUpdatedDeletedTrait;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $shortDescription;

    /**
     * @var string|null
     */
    protected $longDescription;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string|null
     */
    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    /**
     * @param string|null $longDescription
     */
    public function setLongDescription(?string $longDescription): void
    {
        $this->longDescription = $longDescription;
    }
}
