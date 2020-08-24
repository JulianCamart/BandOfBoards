<?php

namespace App\Tests\Func;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductTest extends AbstractEndPoint
{
    public function testProducts(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_GET,
            'api/products'
        );

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);

    }

}