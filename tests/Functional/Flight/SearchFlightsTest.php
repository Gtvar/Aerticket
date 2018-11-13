<?php

namespace App\Tests\Controller;

use App\Tests\Functional\Util\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SearchFlightsTest
 */
class SearchFlightsTest extends WebTestCase
{
    /**
     * {@inheritDoc}
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->loadFixtureFiles([
            'tests/DataFixtures/ORM/Airport.yml',
            'tests/DataFixtures/ORM/Transporter.yml',
            'tests/DataFixtures/ORM/Flight.yml',
        ]);
    }

    /**
     * Test Success
     */
    public function testSuccess()
    {
        $path = $this->getUrl('search_flights');

        $payload = [
            'searchQuery' => [
                'departureAirport' => 'IEV',
                'arrivalAirport' => 'BUD',
                'departureDate' => (new \DateTime())->format('Y-m-d'),
            ],
        ];

        $client = $this->makeClient();
        $client->request('POST', $path, [], [], [], json_encode($payload));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJsonResponse($client);

        $data = $this->getData($client);

        $this->assertArrayHasKey('searchQuery', $data);
        $this->assertArrayHasKey('searchResults', $data);
        $this->assertCount(3, $data['searchResults']);
    }

    /**
     * Test Not Found
     */
    public function testNotFound()
    {
        $path = $this->getUrl('search_flights');

        $payload = [
            'searchQuery' => [
                'departureAirport' => 'FOO',
                'arrivalAirport' => 'BUD',
                'departureDate' => (new \DateTime())->format('Y-m-d'),
            ],
        ];

        $client = $this->makeClient();
        $client->request('POST', $path, [], [], [], json_encode($payload));

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this->assertJsonResponse($client);
        $this->assertValidationErrorResponse($client);
    }
}
