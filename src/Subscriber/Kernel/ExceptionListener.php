<?php

namespace App\Subscriber\Kernel;

use App\Validator\Exception\InvalidParamsException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class ExceptionListener
 */
class ExceptionListener implements EventSubscriberInterface
{
    private const DEFAULT_STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * ExceptionListener constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onException',
        ];
    }

    /**
     * Exception event handler.
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onException(GetResponseForExceptionEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $exception = $event->getException();
        if ($exception instanceof InvalidParamsException) {
            return;
        }

        $data = $this->getExceptionData($exception);
        $response = new JsonResponse($data, $this->getStatusCode($exception));
        $event->setResponse($response);
    }

    /**
     * Get Exception data
     *
     * @param \Exception $exception
     *
     * @return array
     */
    private function getExceptionData(\Exception $exception): array
    {
        $code = $exception->getCode() ?: $this->getStatusCode($exception);

        return [
            'code' => (string) $code,
            'message' => $this->translator->trans($exception->getMessage(), [], 'exception'),
        ];
    }

    /**
     * Get StatusCode
     *
     * @param \Exception $exception
     *
     * @return int
     */
    private function getStatusCode(\Exception $exception): int
    {
        return $exception instanceof HttpException ? $exception->getStatusCode() : self::DEFAULT_STATUS_CODE;
    }
}
