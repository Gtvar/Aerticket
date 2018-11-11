<?php

namespace App\Tests\Controller;

use App\Tests\Functional\Util\WebTestCase;

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

        $this->isSuccessful($client->getResponse());

        $this->assertJsonResponse($client);

        $data = $this->getData($client);
        $this->assertEquals($folder, $data['path']);
    }
}
