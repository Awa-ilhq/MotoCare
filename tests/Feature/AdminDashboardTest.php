<?php

namespace Tests\Feature;

use App\Filament\Widgets\AdminOverview;
use App\Filament\Widgets\LatestBookings;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_project_metrics_and_latest_bookings(): void
    {
        $user = User::factory()->create();
        $service = Service::create([
            'name' => 'Ganti Oli',
            'description' => 'Ganti oli motor.',
            'image' => null,
            'estimated_price' => 50000,
        ]);
        Booking::create([
            'customer_name' => 'Pelanggan MotoCare',
            'whatsapp_number' => '081234567890',
            'plate_number' => 'M 1234 AB',
            'service_date' => today()->toDateString(),
            'service_id' => $service->id,
            'status' => 'pending',
        ]);
        Gallery::create([
            'image' => 'images/gallery.jpg',
            'caption' => 'Foto bengkel',
            'is_active' => true,
        ]);
        Contact::create([
            'name' => 'Pelanggan',
            'email' => 'pelanggan@example.com',
            'phone' => '081234567890',
            'message' => 'Mohon informasi layanan.',
        ]);

        $this->actingAs($user)->get('/admin')->assertOk();

        Livewire::actingAs($user)
            ->test(AdminOverview::class)
            ->assertSee('Booking menunggu')
            ->assertSee('Total layanan')
            ->assertSee('Foto galeri aktif')
            ->assertSee('Pesan masuk');

        Livewire::actingAs($user)
            ->test(LatestBookings::class)
            ->assertSee('Pelanggan MotoCare')
            ->assertSee('Ganti Oli');
    }
}
