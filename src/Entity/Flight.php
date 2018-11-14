<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 */
class Flight
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32)
     */
    private $number;

    /**
     * @var Airport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departureAirport;

    /**
     * @var Airport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arrivalAirport;

    /**
     * @var Transporter
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Transporter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $transporter;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint")
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $departureDateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $arrivalDateTime;

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set Number
     *
     * @param string $number
     *
     * @return Flight
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get DepartureAirport
     *
     * @return Airport
     */
    public function getDepartureAirport()
    {
        return $this->departureAirport;
    }

    /**
     * Set DepartureAirport
     *
     * @param Airport $departureAirport
     *
     * @return Flight
     */
    public function setDepartureAirport($departureAirport)
    {
        $this->departureAirport = $departureAirport;

        return $this;
    }

    /**
     * Get ArrivalAirport
     *
     * @return Airport
     */
    public function getArrivalAirport()
    {
        return $this->arrivalAirport;
    }

    /**
     * Set ArrivalAirport
     *
     * @param Airport $arrivalAirport
     *
     * @return Flight
     */
    public function setArrivalAirport($arrivalAirport)
    {
        $this->arrivalAirport = $arrivalAirport;

        return $this;
    }

    /**
     * Get Transporter
     *
     * @return Transporter
     */
    public function getTransporter()
    {
        return $this->transporter;
    }

    /**
     * Set Transporter
     *
     * @param Transporter $transporter
     *
     * @return Flight
     */
    public function setTransporter($transporter)
    {
        $this->transporter = $transporter;

        return $this;
    }

    /**
     * Get Duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set Duration
     *
     * @param int $duration
     *
     * @return Flight
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get DepartureDateTime
     *
     * @return \DateTime
     */
    public function getDepartureDateTime()
    {
        return $this->departureDateTime;
    }

    /**
     * Set DepartureDateTime
     *
     * @param \DateTime $departureDateTime
     *
     * @return Flight
     */
    public function setDepartureDateTime($departureDateTime)
    {
        $this->departureDateTime = $departureDateTime;

        return $this;
    }

    /**
     * Get ArrivalDateTime
     *
     * @return \DateTime
     */
    public function getArrivalDateTime()
    {
        return $this->arrivalDateTime;
    }

    /**
     * Set ArrivalDateTime
     *
     * @param \DateTime $arrivalDateTime
     *
     * @return Flight
     */
    public function setArrivalDateTime($arrivalDateTime)
    {
        $this->arrivalDateTime = $arrivalDateTime;

        return $this;
    }
}
