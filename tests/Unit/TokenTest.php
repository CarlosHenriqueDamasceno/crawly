<?php

declare(strict_types=1);

namespace Tests\Unit;

use Crawly\Token;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    #[Test]
    public function shouldPrepareTokenToRequestAnswer(): void
    {
        $expectedToken = "zyxwvutsrqponmlkjihgfedcba9876543210";
        $token = new Token("abcdefghijklmnopqrstuvwxyz0123456789");
        $newToken = $token->prepareToRequest();
        $this->assertEquals($expectedToken, $newToken);
    }
}
