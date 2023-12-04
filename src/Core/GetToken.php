<?php

declare(strict_types=1);

namespace Crawly;

use DOMDocument;
use GuzzleHttp\Client;

final readonly class GetToken
{
    public function __construct(private Client $client)
    {
    }

    public function execute(): string
    {
        $response = $this->client->get("/");
        $dom = new DOMDocument();
        $dom->loadHTML((string)$response->getBody());
        $tokenElement = $dom->getElementById("token");
        return $tokenElement->getAttribute("value");
    }
}
