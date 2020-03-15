<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @var bool
     */
    protected $errorRedirect;

    /**
     * @var string
     */
    protected $errorAuthorizationRedirectHost;

    /**
     * @var string
     */
    protected $errorDefaultRedirectHost;

    /**
     * ExceptionSubscriber constructor.
     *
     * @param bool $errorRedirect
     * @param string $errorAuthorizationRedirectHost
     * @param string $errorDefaultRedirectHost
     */
    public function __construct(
        bool $errorRedirect,
        string $errorAuthorizationRedirectHost,
        string $errorDefaultRedirectHost
    ) {
        $this->errorRedirect = $errorRedirect;
        $this->errorAuthorizationRedirectHost = $errorAuthorizationRedirectHost;
        $this->errorDefaultRedirectHost = $errorDefaultRedirectHost;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException'
        ];
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        if (!$this->errorRedirect) {
            return;
        }

        $exception = $event->getThrowable();

        if (
            $exception instanceof AccessDeniedException ||
            $exception instanceof AccessDeniedHttpException ||
            $exception instanceof \RuntimeException
        ) {
            $event->setResponse(new RedirectResponse($this->errorAuthorizationRedirectHost));
        } else {
            $event->setResponse(new RedirectResponse($this->errorDefaultRedirectHost));
        }
    }
}