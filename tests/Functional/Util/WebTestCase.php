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
     * Get data
     *
     * @param Client $client
     *
     * @return array
     */
    public function getData(Client $client): array
    {
        return json_decode($client->getResponse()->getContent(), true);
    }

    /**
     * @param string $class
     *
     * @return ObjectRepository
     */
    public function getRepository(string $class): ObjectRepository
    {
        return $this->objectManager->getRepository($class);
    }
}
