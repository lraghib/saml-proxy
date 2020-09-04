<?php


namespace App\Security\Heimdall\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Hslavich\OneloginSamlBundle\Security\User\SamlUserInterface;

class User implements UserInterface, SamlUserInterface
{
    use CreatedUpdatedDeletedTrait;

    const ROLE_PREFIX = 'ROLE_';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var string|null
     */
    protected $username;

    /**
     * @var string|null
     */
    protected $ldapDn;

    /**
     * @var string|null
     */
    protected $ldapUidNumber;

    /**
     * @var string|null
     */
    protected $suezGid;

    /**
     * @var string|null
     */
    protected $civility;

    /**
     * @var string|null
     */
    protected $lastName;

    /**
     * @var string|null
     */
    protected $firstName;

    /**
     * @var string|null
     */
    protected $function;

    /**
     * @var string|null
     */
    protected $phone;

    /**
     * @var string|null
     */
    protected $mobilePhone;

    /**
     * @var UserContract[]
     */
    protected $userContracts = [];

    /**
     * Filled by injection in heimdall user provider
     *
     * @var string|null
     */
    protected $samlGroupAttribute;

    /**
     * Filled by setSamlAttributes with hslavitch onelogin bundle
     *
     * @var string[]
     */
    protected $samlGroupRoles = [];

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
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * @param string|null $username
     * @return self
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        $roles = ['ROLE_USER'];

        if ($this->getType()) {
            $roles[] = sprintf('%s%s', self::ROLE_PREFIX, strtoupper($this->getType()));
        }

        $roles = array_merge($roles, $this->getSamlGroupRoles());

        foreach ($this->getServices() as $service) {
            if (!$service->getPortal()) {
                continue;
            }

            $roles[] = sprintf(
                '%s%s_%s',
                self::ROLE_PREFIX,
                strtoupper($service->getPortal()->getCode()),
                strtoupper($service->getCode())
            );
        }

        return $roles;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getLdapDn(): ?string
    {
        return $this->ldapDn;
    }

    /**
     * @param string|null $ldapDn
     */
    public function setLdapDn(?string $ldapDn): void
    {
        $this->ldapDn = $ldapDn;
    }

    /**
     * @return string|null
     */
    public function getLdapUidNumber(): ?string
    {
        return $this->ldapUidNumber;
    }

    /**
     * @param string|null $ldapUidNumber
     */
    public function setLdapUidNumber(?string $ldapUidNumber): void
    {
        $this->ldapUidNumber = $ldapUidNumber;
    }

    /**
     * @return string|null
     */
    public function getSuezGid(): ?string
    {
        return $this->suezGid;
    }

    /**
     * @param string|null $suezGid
     */
    public function setSuezGid(?string $suezGid): void
    {
        $this->suezGid = $suezGid;
    }

    /**
     * @return string|null
     */
    public function getCivility(): ?string
    {
        return $this->civility;
    }

    /**
     * @param string|null $civility
     */
    public function setCivility(?string $civility): void
    {
        $this->civility = $civility;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getFunction(): ?string
    {
        return $this->function;
    }

    /**
     * @param string|null $function
     */
    public function setFunction(?string $function): void
    {
        $this->function = $function;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    /**
     * @param string|null $mobilePhone
     */
    public function setMobilePhone(?string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }

    /**
     * @param UserContract[] $userContracts
     *
     * @return self
     */
    public function setUserContracts(array $userContracts): self
    {
        $this->userContracts = $userContracts;

        return $this;
    }

    /**
     * @return UserContract[]
     */
    public function getUserContrats(): array
    {
        return $this->userContracts;
    }

    /**
     * @param UserContract $userContract
     *
     * @return self
     */
    public function addUserContrat(UserContract $userContract): self
    {
        $this->userContracts[] = $userContract;

        return $this;
    }

    /**
     * @return UserContractService[]
     */
    public function getUserContractServices(): array
    {
        return (array) array_merge([], ...array_map(function (UserContract $userContract) {
            return $userContract->getUserContractServices();
        }, $this->getUserContrats()));
    }

    /**
     * @return ContractService[]
     */
    public function getContractServices(): array
    {
        return (array) array_merge([], ...array_map(function (UserContractService $userContractService) {
            return $userContractService->getContractServices();
        }, $this->getUserContractServices()));
    }

    /**
     * @return Service[]
     */
    public function getServices(): array
    {
        return (array) array_map(function (ContractService $contractService) {
            return $contractService->getService();
        }, $this->getContractServices());
    }

    /**
     * @param array $attributes
     */
    public function setSamlAttributes(array $attributes)
    {
        if (!$this->samlGroupAttribute) {
            return;
        }

        if (empty($attributes[$this->samlGroupAttribute])) {
            return;
        }

        foreach ($attributes[$this->samlGroupAttribute] as $group) {
            $role = sprintf('%sGROUP_%s', self::ROLE_PREFIX, strtoupper($group));
            $this->addSamlGroupRole($role);
        }
    }

    /**
     * @return string|null
     */
    public function getSamlGroupAttribute(): ?string
    {
        return $this->samlGroupAttribute;
    }

    /**
     * @param string|null $samlGroupAttribute
     */
    public function setSamlGroupAttribute(?string $samlGroupAttribute): void
    {
        $this->samlGroupAttribute = $samlGroupAttribute;
    }

    /**
     * @return string[]
     */
    public function getSamlGroupRoles(): array
    {
        return $this->samlGroupRoles;
    }

    /**
     * @param string[] $samlGroupRoles
     */
    public function setSamlGroupRoles(array $samlGroupRoles): void
    {
        $this->samlGroupRoles = $samlGroupRoles;
    }

    /**
     * @param string $role
     */
    public function addSamlGroupRole(string $role): void
    {
        $this->samlGroupRoles[] = $role;
    }
}
