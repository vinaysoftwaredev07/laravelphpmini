<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testLoginFalse()
    {
        $credential = [
            'email' => 'user@ad.com',
            'password' => 'incorrectpass'
        ];

        $response = $this->post('login',$credential);

        $response->assertSessionHasErrors();
    }

    public function testLoginTrue()
    {
        $credential = [
            'email' => 'admin@admin.com',
            'password' => 'password'
        ];
        $response = $this->post('login',$credential);
        $response->assertSessionMissing('errors');
    }

    public function testJwtApiLoginFalse()
    {
        $credential = [
            'email' => 'sdfsfdf@admin',
            'password' => '435345'
        ];
        $response = $this->post('api/jwt/login',$credential);
        $response->assertSessionHasErrors();
    }

    public function testJwtApiLoginTrue()
    {
        $credential = [
            'email' => 'admin@admin',
            'password' => 'password'
        ];
        $response = $this->post('api/jwt/login',$credential);
        $response->assertSessionMissing('errors');
    }
}


