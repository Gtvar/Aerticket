<?php

namespace App\Subscriber;

use App\Annotation\Controller\Rest\View;
use App\DTO\Response\ResponseInterface;
use App\Exception\Subscriber\UnableResolveViewAnnotationException;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * KernelViewSubscriber constructor.
     *
     * @param SerializerInterface $serializer
     * @param Reader              $annotationReader
     */
    public function __construct(SerializerInterface $serializer, Reader  $annotationReader)
    {
        $this->serializer = $serializer;
        $this->annotationReader = $annotationReader;
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

        if (!$result instanceof ResponseInterface) {
            return;
        }

        $request = $event->getRequest();
        try {
            $viewAnnotation = $this->getViewAnnotation($request);
        } catch (UnableResolveViewAnnotationException $e) {
            return;
        }

        $options = [
            'groups' => $viewAnnotation->getSerializerGroups(),
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ];

        $json = $this->serializer->serialize($result, 'json', $options);

        $response =  new JsonResponse($json, $viewAnnotation->getStatusCode(), [], true);

        $event->setResponse($response);
    }

    /**
     * Get view annotation
     *
     * @param Request $request
     *
     * @return View
     *
     * @throws UnableResolveViewAnnotationException
     */
    protected function getViewAnnotation(Request $request): View
    {
        $controllerName = $request->attributes->get('_controller');

        if (!$controllerName) {
            throw new UnableResolveViewAnnotationException();
        }

        [$controller, $action] = explode('::', $controllerName);

        if (!$controller || !$action) {
            throw new UnableResolveViewAnnotationException();
        }

        try {
            $reflectionClass = new \ReflectionClass($controller);
        } catch (\ReflectionException $e) {
            throw new UnableResolveViewAnnotationException();
        }

        $reflectionMethod = $reflectionClass->getMethod($action);
        $viewAnnotation = $this->annotationReader
            ->getMethodAnnotation($reflectionMethod, View::class);

        if (!$viewAnnotation instanceof View) {
            throw new UnableResolveViewAnnotationException();
        }

        return $viewAnnotation;
    }
}
