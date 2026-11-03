<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_panel_pages_are_accessible(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin')->assertOk();
        $this->actingAs($user)->get('/admin/services')->assertOk();
        $this->actingAs($user)->get('/admin/services/create')->assertOk();
        $this->actingAs($user)->get('/admin/bookings')->assertOk();
        $this->actingAs($user)->get('/admin/bookings/create')->assertOk();
        $this->actingAs($user)->get('/admin/contacts')->assertOk();
        $this->actingAs($user)->get('/admin/contacts/create')->assertOk();
    }
}
