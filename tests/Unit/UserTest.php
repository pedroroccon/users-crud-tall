<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_returns_a_path_with_resource_url()
    {
        $this->assertEquals(route('users.show', ['user' => $this->user->id]), $this->user->path());
    }

    /** @test */
    public function it_returns_a_complete_address_string()
    {
        $this->assertEquals($this->user->address . ', N ' . $this->user->numer . ' - ' . $this->user->district, $this->user->address_complete);
    }
}
