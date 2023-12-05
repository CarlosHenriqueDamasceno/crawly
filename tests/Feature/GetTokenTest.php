<?php

declare(strict_types=1);

namespace Tests\Feature;

use Crawly\GetToken;
use Crawly\Token;
use DOMDocument;
use GuzzleHttp\Client;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GetTokenTest extends TestCase
{
    const BASE_URL = "http://serei.crawly.com.br/";

    #[Test]
    public function shouldGetTokenFromPage(): void
    {
        $client = new Client([
            "base_uri" => self::BASE_URL
        ]);
        $getToken = new GetToken($client);
        $token = $getToken->execute();
        $this->assertNotEmpty($token);
    }
}
