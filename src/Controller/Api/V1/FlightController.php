<?php

namespace App\Controller\Api\V1;

use App\DTO\Request\Flight\FlightSearchRequest;
use App\DTO\Response\Flight\FlightSearchResponse;
use App\Handler\Flight\FlightSearchHandler;
use App\Repository\FlightRepository;
use App\Validator\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation as ApiDoc;
use Swagger\Annotations as SWG;
use App\Annotation\Controller\Rest;

/**
 * Class FlightController
 */
class FlightController
{
    /**
     * @var FlightRepository
     */
    private $flightRepository;

    /**
     * FlightController constructor.
     *
     * @param FlightRepository $flightRepository
     */
    public function __construct(FlightRepository $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    /**
     * @Route(
     *     "/api/v1/flights/search.{_format}",
     *     name="search_flights",
     *     methods={"POST"},
     *     defaults={"_format": "json", "anonymous": true}
     * )
     *
     * @Rest\View(statusCode=200)
     *
     * @SWG\Parameter(
     *     name="Flight search",
     *     in="body",
     *     @ApiDoc\Model(type=App\DTO\Request\Flight\FlightSearchRequest::class)
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     @ApiDoc\Model(type=App\DTO\Response\Flight\FlightSearchResponse::class),
     *     description="Successful response"
     * )
     *
     * @SWG\Response(response=400, description="Validation Failed", @SWG\Schema(ref="#/definitions/error.400"))
     *
     * @SWG\Tag(name="Flight")
     *
     * @param Request             $request
     * @param Validator           $validator
     * @param FlightSearchHandler $flightSearchHandler
     *
     * @return FlightSearchResponse
     */
    public function searchFlightAction(Request $request, Validator $validator, FlightSearchHandler $flightSearchHandler): FlightSearchResponse
    {
        $flightSearchRequest = FlightSearchRequest::createFromRequest($request, $validator);

        return $flightSearchHandler->handle($flightSearchRequest);
    }
}
