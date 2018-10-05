<?php

namespace App\Controller\Api\V1;

use App\DTO\Response\V1\VersionResponse;
use App\Annotation\Controller\Rest;
use Nelmio\ApiDocBundle\Annotation as ApiDoc;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 */
class ApiController extends Controller
{
    /**
     * Version.
     *
     * @return VersionResponse
     *
     * @Route(
     *     "/api/v1/version.{_format}",
     *     name="api_v1_version",
     *     defaults={"_format": "json", "anonymous": true},
     *     methods={"GET"}
     * )
     *
     * @Rest\View(statusCode=200)
     *
     * @SWG\Response(
     *     response=200,
     *     @ApiDoc\Model(type=App\DTO\Response\V1\VersionResponse::class),
     *     description="Successful response"
     * )
     */
    public function getVersionAction(): VersionResponse
    {
        return VersionResponse::create();
    }
}
