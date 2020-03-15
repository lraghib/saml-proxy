<?php


namespace App\Security\Heimdall;

use App\HttpClient\HeimdallClient;
use App\Security\Heimdall\Model\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @var HeimdallClient
     */
    protected $heimdall;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * UserProvider constructor.
     * @param HeimdallClient $heimdall
     * @param LoggerInterface|null $logger
     */
    public function __construct(HeimdallClient $heimdall, LoggerInterface $logger)
    {
        $this->heimdall = $heimdall;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsername($username)
    {
        $user = $this->heimdall->getUserByLdapUidNumber($username);
        if (!$user) {
            $this->logger->debug(sprintf('User %s not found', $username));
            throw new UsernameNotFoundException(sprintf('User %s not found', $username));
        }

        try {
            $userContracts = $this->heimdall->getUserContracts($user);
            $user->setUserContracts($userContracts);
        } catch (\Exception $e) {
            $this->logger->debug(
                sprintf('Exception occurred when loading user %s permissions : %s', $username, $e->getMessage())
            );
            throw $e;
        }

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}