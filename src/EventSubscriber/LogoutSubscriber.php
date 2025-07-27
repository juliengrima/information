<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class LogoutSubscriber implements EventSubscriberInterface
{
    public function __construct(private RequestStack $requestStack) {}

    public static function getSubscribedEvents(): array
    {
        return [
            LogoutEvent::class => 'onLogoutSuccess',
        ];
    }

    public function onLogoutSuccess(LogoutEvent $event): void
    {
        $request = $this->requestStack->getMainRequest();
        $redirectUrl = $request->query->get('redirect') ?? '/';

        $event->setResponse(new RedirectResponse($redirectUrl));
    }
}