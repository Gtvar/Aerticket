<?php

namespace App\DTO\Response\V1;

use App\DTO\Response\ResponseInterface;
use Swagger\Annotations as SWG;

/**
 * Class VersionResponse
 *
 * @SWG\Definition(
 *     definition="VersionResponse",
 *     type="object",
 *     required={
 *         "api_version"
 *     }
 * )
 */
class VersionResponse implements ResponseInterface
{
    /**
     * @var string
     *
     * @SWG\Property(type="string", description="Common api version.")
     */
    private $apiVersion;

    /**
     * VersionResponse constructor.
     */
    private function __construct()
    {
        $this->apiVersion = '1.0';
    }

    /**
     * Get ApiVersion
     *
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * Create new instance
     *
     * @return VersionResponse
     */
    public static function create(): self
    {
        return new self();
    }
}
