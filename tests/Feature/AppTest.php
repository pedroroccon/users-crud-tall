<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_access_the_application_home()
    {
        $this->get(route('home'))->assertSuccessful();
    }

    /** @test */
    public function it_can_access_the_users_page()
    {
        $this->get(route('users.index'))
            ->assertSee('Usuários')
            ->assertSuccessful();
    }

    /** @test */
    public function it_can_access_a_specific_user_page()
    {
        $user = User::factory()->create();

        $this->get(route('users.show', ['user' => $user->id]))
            ->assertSee($user->name)
            ->assertSuccessful();
    }
}
