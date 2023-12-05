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

    #[Test]
    public function shouldGetAnswer(): void
    {
        $client = new Client([
            "base_uri" => self::BASE_URL,
            "cookies" => true
        ]);
        $token = (new GetToken($client))->execute();
        $preparedToken = $token->prepareToRequest();
        $requestAnswer = new RequestAnswer($client);
        $answer = $requestAnswer->execute($preparedToken);
        $this->assertNotEmpty($answer);
    }

    #[Test]
    public function fullRequestCycleTest(): void
    {
        $client = new Client([
            "base_uri" => self::BASE_URL,
            'cookies' => true
        ]);
        $response = $client->get("/");
        $bodyString = (string) $response->getBody();
        $dom = new DOMDocument();
        $dom->loadHTML($bodyString);
        $tokenElement = $dom->getElementById("token");
        $token = new Token($tokenElement->getAttribute("value"));
        $newToken = $token->prepareToRequest();
        $response = $client->post(
            "/",
            [
                "form_params" => ["token" => $newToken],
                "headers" => [
                    'Referer' => 'http://serei.crawly.com.br/'
                ]
            ]
        );
        var_dump((string)$response->getBody());
    }
}
