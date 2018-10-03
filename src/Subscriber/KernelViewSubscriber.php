<?php

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class KernelViewSubscriber
 */
class KernelViewSubscriber implements EventSubscriberInterface
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }
    
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => 'kernelEventsView',
        ];
    }

    /**
     * Simple Kernel Events View
     *
     * @param GetResponseForControllerResultEvent $event
     */
    public function kernelEventsView(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();

        $json = $this->serializer->serialize($result, 'json', array_merge(array(
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ), []));

        return new JsonResponse($json, 200, [], true);
    }
}
