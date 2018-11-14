<?php

namespace App\Handler\Flight;

use App\DTO\Request\Flight\FlightSearchRequest;
use App\DTO\Response\Flight\FlightSearchResponse;
use App\Exception\Http\VerboseNotFoundHttpException;
use App\Repository\AirportRepository;
use App\Repository\FlightRepository;

/**
 * Class FlightSearchHandler
 */
class FlightSearchHandler
{
    /**
     * @var FlightRepository
     */
    private $flightRepository;

    /**
     * @var AirportRepository
     */
    private $airportRepository;

    /**
     * FlightSearchHandler constructor.
     *
     * @param FlightRepository  $flightRepository
     * @param AirportRepository $airportRepository
     */
    public function __construct(FlightRepository $flightRepository, AirportRepository $airportRepository)
    {
        $this->flightRepository = $flightRepository;
        $this->airportRepository = $airportRepository;
    }

    /**
     * Handle
     *
     * @param FlightSearchRequest $flightSearchRequest
     *
     * @return FlightSearchResponse
     */
    public function handle(FlightSearchRequest $flightSearchRequest): FlightSearchResponse
    {
        $departureAirport = $this->airportRepository->findOneByCode($flightSearchRequest->getDepartureAirport());
        $arrivalAirport = $this->airportRepository->findOneByCode($flightSearchRequest->getArrivalAirport());

        if (!$departureAirport || !$arrivalAirport) {
            throw new VerboseNotFoundHttpException('airport.not_found');
        }

        $flights = $this->flightRepository->findByAirportsAndDate($departureAirport, $arrivalAirport, $flightSearchRequest->getDepartureDate());

        if (!$flights) {
            throw new VerboseNotFoundHttpException('flights.not_found');
        }

        return FlightSearchResponse::createFromFlights($flights, $flightSearchRequest);
    }
}
