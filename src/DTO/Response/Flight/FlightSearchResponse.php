<?php

namespace App\DTO\Response\Flight;

use App\DTO\Request\Flight\FlightSearchRequest;
use App\DTO\Response\ResponseInterface;
use App\Entity\Flight;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class FlightSearchResponse
 *
 * @SWG\Definition(
 *     definition="FlightSearchResponse",
 *     type="object",
 *     required={
 *         "searchQuery",
 *         "searchResults"
 *     }
 * )
 */
class FlightSearchResponse implements ResponseInterface
{
    private const DATETIME_FORMAT = 'Y-m-d H:m:s';

    /**
     * @var array
     *
     * @Groups({"read"})
     *
     * @SWG\Property(type="string", description="Search query.")
     */
    private $searchQuery;

    /**
     * @var array
     *
     * @Groups({"read"})
     *
     * @SWG\Property(type="string", description="Search results.")
     */
    private $searchResults;

    /**
     * FlightSearchResponse constructor.
     */
    private function __construct()
    {
    }

    /**
     * Get SearchQuery
     *
     * @return array
     */
    public function getSearchQuery()
    {
        return $this->searchQuery;
    }

    /**
     * Get SearchResults
     *
     * @return array
     */
    public function getSearchResults()
    {
        return $this->searchResults;
    }

    /**
     * Create from Folder
     *
     * @param array|Flight[]      $flights
     * @param FlightSearchRequest $flightSearchRequest
     *
     * @return FlightSearchResponse
     */
    public static function createFromFlights(array $flights, FlightSearchRequest $flightSearchRequest): self
    {
        $instance = new self();

        $instance->searchQuery = [
            'departureAirport' => $flightSearchRequest->getDepartureAirport(),
            'arrivalAirport' => $flightSearchRequest->getArrivalAirport(),
            'departureDateTime' => $flightSearchRequest->getDepartureDate()->format('Y-m-d'),
        ];
        $instance->searchResults = [];

        /** @var Flight $flight */
        foreach ($flights as $flight) {
            $instance->searchResults[] = [
                'transporter' => [
                    'code' => $flight->getTransporter()->getCode(),
                    'name' => $flight->getTransporter()->getName(),
                ],
                'flightNumber' => $flight->getNumber(),
                'departureAirport' => $flight->getDepartureAirport()->getCode(),
                'arrivalAirport' => $flight->getArrivalAirport()->getCode(),
                'departureDateTime' => $flight->getDepartureDateTime()->format(self::DATETIME_FORMAT),
                'arrivalDateTime' => $flight->getArrivalDatetime()->format(self::DATETIME_FORMAT),
                'duration' => $flight->getDuration(),
            ];
        }

        return $instance;
    }
}
