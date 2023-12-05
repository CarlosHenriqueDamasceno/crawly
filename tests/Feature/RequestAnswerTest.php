<?php

declare(strict_types=1);

use Crawly\GetToken;
use Crawly\RequestAnswer;
use Crawly\Token;
use GuzzleHttp\Client;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RequestAnswerTest extends TestCase
{
    const BASE_URL = "http://serei.crawly.com.br";
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            "base_uri" => self::BASE_URL,
            "cookies" => true
        ]);
    }

    #[Test]
    public function shouldGetAnswer(): void
    {
        $token = (new GetToken($this->client))->execute();
        $preparedToken = $token->prepareToRequest();
        $requestAnswer = new RequestAnswer($this->client);
        $answer = $requestAnswer->execute($preparedToken);
        $this->assertNotEmpty($answer);
    }

    #[Test]
    public function fullRequestCycleTest(): void
    {
        $response = $this->client->get("/");
        $bodyString = (string) $response->getBody();
        $dom = new DOMDocument();
        $dom->loadHTML($bodyString);
        $tokenElement = $dom->getElementById("token");
        $token = new Token($tokenElement->getAttribute("value"));
        $newToken = $token->prepareToRequest();
        $response = $this->client->post(
            "/",
            [
                "form_params" => ["token" => $newToken],
                "headers" => ['Referer' => self::BASE_URL]
            ]
        );
        $this->assertStringNotContainsString("Forbidden", (string)$response->getBody());
        $this->assertStringContainsString('id="answer"', (string)$response->getBody());
    }
}
