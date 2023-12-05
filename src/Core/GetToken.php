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

    public function execute(): Token
    {
        $response = $this->client->get("/");
        $bodyString = (string) $response->getBody();
        $tokenText = $this->getTokenTextFromHtml($bodyString);
        return new Token($tokenText);
    }

    private function getTokenTextFromHtml(string $html): string
    {
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $tokenElement = $dom->getElementById("token");
        return $tokenElement->getAttribute("value");
    }
}
