<?php

declare(strict_types=1);

namespace Test\Feature;

use GuzzleHttp\Client;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TestsTest extends TestCase
{
    #[Test]
    public function shouldBeTrue(): void
    {
        $this->assertTrue(true);
    }

    #[Test]
    public function guzzleShouldWork(): void
    {
        $client = new Client();
        $response = $client->get("www.google.com");
        $this->assertEquals($response->getStatusCode(), 200);
    }
}
