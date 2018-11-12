<?php

namespace App\Subscriber\Kernel;

use App\Validator\Exception\InvalidParamsException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidatorExceptionListener
 */
class ValidatorExceptionListener implements EventSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var NameConverterInterface
     */
    private $nameConverter;

    /**
     * ValidatorExceptionListener constructor.
     *
     * @param TranslatorInterface    $translator
     * @param NameConverterInterface $nameConverter
     */
    public function __construct(TranslatorInterface $translator, NameConverterInterface $nameConverter)
    {
        $this->translator = $translator;
        $this->nameConverter = $nameConverter;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onValidatorException',
        ];
    }

    /**
     * Validator Exception event handler.
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onValidatorException(GetResponseForExceptionEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $exception = $event->getException();
        if (!$exception instanceof InvalidParamsException) {
            return;
        }

        $data = $this->convertConstraintViolationListToArray($exception->getList());
        $response = new JsonResponse($data, Response::HTTP_BAD_REQUEST);
        $event->setResponse($response);
    }

    /**
     * Convert ConstraintViolationList to array
     *
     * @param ConstraintViolationListInterface $violationList
     *
     * @return array
     */
    private function convertConstraintViolationListToArray(ConstraintViolationListInterface $violationList): array
    {
        $errors = [];
        foreach ($violationList as $violation) {
            $errors[] = $this->formatViolation($violation);
        }

        return [
            'code' => (string) Response::HTTP_BAD_REQUEST,
            'message' => 'Validation Failed',
            'errors' => $errors,
        ];
    }

    /**
     * Format violation
     *
     * @param ConstraintViolationInterface $violation
     *
     * @return array
     */
    private function formatViolation(ConstraintViolationInterface $violation): array
    {
        $propertyPath = $this->normalizePropertyPath($violation->getPropertyPath());

        return [
            'code' => $violation->getMessage(),
            'message' => $this->translator->trans($violation->getMessage(), $violation->getParameters(), 'validator'),
            'path' => $propertyPath,
        ];
    }

    /**
     * Normalize property path
     *
     * @param string $propertyPath
     *
     * @return string
     */
    private function normalizePropertyPath(string $propertyPath): string
    {
        $propertyPath = $this->nameConverter->normalize($propertyPath);

        return str_replace(['][', '[', ']'], ['.', ''], $propertyPath);
    }
}
