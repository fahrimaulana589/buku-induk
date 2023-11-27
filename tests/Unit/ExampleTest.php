<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $contents = Storage::read('public/01HFK05XKDE27BV6B6JMB5KJZ5.jpg');
        dump($contents);
        $this->assertTrue(true);
    }
}
