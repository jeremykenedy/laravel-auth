<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    /**
     * Test the public pages
     *
     * @return void
     */
    public function testPublicPagesAllowed()
    {
        $this->get('/')->assertStatus(200);
        $this->get('/login')->assertStatus(200);
        $this->get('/password/reset')->assertStatus(200);
    }
}
