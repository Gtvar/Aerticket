<?php

namespace App\Tests\Functional\Util;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Liip\FunctionalTestBundle\Test\WebTestCase as BaseClass;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class WebTestCase
 */
class WebTestCase extends BaseClass
{
    /** @var ObjectManager */
    protected $objectManager;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->objectManager = $this->getContainer()->get('doctrine');
    }

    /**
     * @param Client $client
     *
     * @throws \Exception
     */
    public function assertJsonResponse(Client $client): void
    {
        $this->assertEquals('application/json', $client->getResponse()->headers->get('content-type'));
    }

    /**
     * Assert error response
     *
     * @param Client $client
     * @param int    $code
     */
    public function assertErrorResponse(Client $client, int $code = 400): void
    {
        $this->assertStatusCode($code, $client);
        $this->assertJsonResponse($client);
        $response = $this->getData($client);
        $this->assertArrayHasKey('code', $response);
        $this->assertArrayHasKey('message', $response);
    }

    /**
     * Assert validation error response
     *
     * @param Client $client
     * @param int    $code
     */
    public function assertValidationErrorResponse(Client $client, int $code = 400): void
    {
        $this->assertErrorResponse($client, $code);
        $response = $this->getData($client);
        $this->assertArrayHasKey('errors', $response);

        $this->assertTrue(is_array($response['errors']));
    }

    /**
     * Get data
     *
     * @param Client $client
     *
     * @return array
     */
    public function getData(Client $client): array
    {
//        echo $client->getResponse()->getContent();

        return json_decode($client->getResponse()->getContent(), true);
    }

    /**
     * Get Repository
     *
     * @param string $class
     *
     * @return ObjectRepository
     */
    public function getRepository(string $class): ObjectRepository
    {
        return $this->objectManager->getRepository($class);
    }
}
