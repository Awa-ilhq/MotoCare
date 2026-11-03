<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageUploadEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_and_gallery_edit_pages_render_with_existing_image_paths(): void
    {
        $user = User::factory()->create();

        $service = Service::create([
            'name' => 'Servis',
            'description' => 'Deskripsi servis.',
            'image' => 'images/service.jpg',
            'estimated_price' => 100000,
        ]);

        $gallery = Gallery::create([
            'image' => 'images/gallery.jpg',
            'caption' => 'Galeri',
            'is_active' => true,
        ]);

        $this->actingAs($user)
            ->get("/admin/services/{$service->id}/edit")
            ->assertOk();

        $this->actingAs($user)
            ->get("/admin/galleries/{$gallery->id}/edit")
            ->assertOk();
    }
}
