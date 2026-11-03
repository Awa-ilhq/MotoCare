<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DynamicImagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploaded_service_and_gallery_images_are_displayed_on_the_landing_page(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('images/service-updated.jpg', 'service image');
        Storage::disk('public')->put('images/gallery-updated.jpg', 'gallery image');

        $service = Service::create([
            'name' => 'Servis Baru',
            'description' => 'Deskripsi layanan.',
            'image' => 'images/service-old.jpg',
            'estimated_price' => 100000,
        ]);
        $service->update(['image' => 'images/service-updated.jpg']);

        $gallery = Gallery::create([
            'image' => 'images/gallery-old.jpg',
            'caption' => 'Foto baru',
            'is_active' => true,
        ]);
        $gallery->update(['image' => 'images/gallery-updated.jpg']);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee(Storage::disk('public')->url('images/service-updated.jpg'))
            ->assertSee(Storage::disk('public')->url('images/gallery-updated.jpg'))
            ->assertDontSee('images/service-old.jpg')
            ->assertDontSee('images/gallery-old.jpg');
    }

    public function test_inactive_gallery_images_are_not_displayed_on_the_landing_page(): void
    {
        Gallery::create([
            'image' => 'images/hidden-gallery.jpg',
            'caption' => 'Foto tersembunyi',
            'is_active' => false,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('images/hidden-gallery.jpg');
    }
}
