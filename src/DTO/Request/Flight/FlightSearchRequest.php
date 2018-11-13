<?php

namespace App\DTO\Request\Flight;

use App\DTO\Request\RequestInterface;
use App\Validator\Constraints;
use App\Validator\Validator;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FlightSearchRequest
 *
 * @SWG\Definition(
 *     definition="FlightSearchRequest",
 *     type="object",
 *     required={
 *         "departureAirport",
 *         "arrivalAirport",
 *         "departureDate"
 *      }
 * )
 */
class FlightSearchRequest implements RequestInterface
{
    /**
     * @var string
     *
     * @SWG\Property(property="departureAirport", type="string", description="Departure Airport.")
     *
     * @Assert\NotNull(message="flight_search.departure_airport.not_null")
     * @Assert\NotBlank(message="flight_search.departure_date.not_null")
     *
     * @Constraints\EntityReference(
     *     entityClass="App\Entity\Airport",
     *     property="code",
     *     message="flight_search.departure_airport.not_found",
     * )
     */
    private $departureAirport;

    /**
     * @var string
     *
     * @SWG\Property(property="arrivalAirport", type="string", description="Arrival Airport.")
     *
     * @Assert\NotNull(message="flight_search.arrival_airport.not_null")
     * @Assert\NotBlank(message="flight_search.departure_date.not_null")
     *
     * @Constraints\EntityReference(
     *     entityClass="App\Entity\Airport",
     *     property="code",
     *     message="flight_search.arrival_airport.not_found",
     * )
     */
    private $arrivalAirport;

    /**
     * @var \DateTime
     *
     * @SWG\Property(property="departureDate", type="string", description="Departure date.")
     *
     * @Assert\NotNull(message="flight_search.departure_date.not_null")
     * @Assert\NotBlank(message="flight_search.departure_date.not_null")
     */
    private $departureDate;

    /**
     * FlightSearchRequest constructor.
     */
    private function __construct()
    {
    }

    /**
     * Get DepartureAirport
     *
     * @return string
     */
    public function getDepartureAirport(): string
    {
        return $this->departureAirport;
    }

    /**
     * Get ArrivalAirport
     *
     * @return string
     */
    public function getArrivalAirport(): string
    {
        return $this->arrivalAirport;
    }

    /**
     * Get DepartureDate
     *
     * @return \DateTime
     */
    public function getDepartureDate(): \DateTime
    {
        return $this->departureDate;
    }

    /**
     * Create FlightSearchRequest from request
     *
     * @param Request   $request
     * @param Validator $validator
     *
     * @return FlightSearchRequest
     */
    public static function createFromRequest(Request $request, Validator $validator): self
    {
        $content = json_decode($request->getContent(), true);
        $searchQuery = $content['searchQuery'] ?? [];

        $instance = new self();
        $instance->departureAirport = $searchQuery['departureAirport'] ?? null;
        $instance->arrivalAirport = $searchQuery['arrivalAirport'] ?? null;
        $instance->departureDate = $searchQuery['departureDate'] ?? null;
        $instance->departureDate = new \DateTime($instance->departureDate);

        $validator->validate($instance);

        return $instance;
    }
}
