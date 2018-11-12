<?php

namespace App\Tests\Controller;

use App\Tests\Functional\Util\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetByPathActionTest
 */
class GetByPathActionTest extends WebTestCase
{
    /**
     * {@inheritDoc}
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->loadFixtureFiles([
            'tests/DataFixtures/ORM/Folder.yml',
        ]);
    }

    /**
     * Test Success
     */
    public function testSuccess()
    {
        $folder = 'folder1';
        $path = $this->getUrl(
            'folder_get_by_path',
            [
                'path' => $folder,
            ]
        );

        $client = $this->makeClient();
        $client->request('GET', $path);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJsonResponse($client);

        $data = $this->getData($client);
        $this->assertEquals($folder, $data['path']);
    }

    /**
     * Test Not Found
     */
    public function testNotFound()
    {
        $folder = 'unknown';
        $path = $this->getUrl(
            'folder_get_by_path',
            [
                'path' => $folder,
            ]
        );

        $client = $this->makeClient();
        $client->request('GET', $path);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this->assertJsonResponse($client);
        $this->assertValidationErrorResponse($client);
    }
}
