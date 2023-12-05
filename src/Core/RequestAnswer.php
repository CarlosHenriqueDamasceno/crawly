<?php

declare(strict_types=1);

namespace Crawly;

use DOMDocument;
use GuzzleHttp\Client;

final readonly class RequestAnswer
{
    public function __construct(private Client $client)
    {
    }

    public function execute(string $token): int
    {
        $response = $this->client->post(
            "/",
            [
                "form_params" => ["token" => $token],
                "headers" => ['Referer' => 'http://serei.crawly.com.br/']
            ]
        );
        $bodyString = (string) $response->getBody();
        return $this->getAnswerFromHtml($bodyString);
    }

    private function getAnswerFromHtml(string $html): int
    {
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $tokenElement = $dom->getElementById("answer");
        return (int) $tokenElement->textContent;
    }
}
