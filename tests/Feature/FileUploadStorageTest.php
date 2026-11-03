<?php

namespace Tests\Feature;

use App\Filament\Resources\GalleryResource\Pages\CreateGallery;
use App\Filament\Resources\ServiceResource\Pages\CreateService;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class FileUploadStorageTest extends TestCase
{
    use RefreshDatabase;

    public function test_livewire_temporary_uploads_use_the_public_disk(): void
    {
        $this->assertSame('public', config('livewire.temporary_file_upload.disk'));
    }

    public function test_service_image_upload_is_saved_as_a_string_without_resizing(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $sourceImagePath = public_path('images/ganti-oli.png');
        $sourceImageDimensions = getimagesize($sourceImagePath);

        Livewire::actingAs($user)
            ->test(CreateService::class)
            ->fillForm([
                'name' => 'Ganti Oli',
                'description' => 'Penggantian oli mesin.',
                'estimated_price' => 50000,
                'image' => UploadedFile::fake()->createWithContent(
                    'service.png',
                    file_get_contents($sourceImagePath),
                ),
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $imagePath = Service::query()->sole()->image;

        $this->assertIsString($imagePath);
        $this->assertStringStartsWith('images/', $imagePath);
        Storage::disk('public')->assertExists($imagePath);
        $this->assertSame($sourceImageDimensions[0], getimagesize(Storage::disk('public')->path($imagePath))[0]);
    }

    public function test_gallery_image_upload_is_saved_as_a_string_path(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CreateGallery::class)
            ->fillForm([
                'image' => UploadedFile::fake()->createWithContent(
                    'gallery.png',
                    file_get_contents(public_path('images/galeri1.png')),
                ),
                'caption' => 'Foto bengkel',
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $imagePath = Gallery::query()->sole()->image;

        $this->assertIsString($imagePath);
        $this->assertStringStartsWith('images/', $imagePath);
        Storage::disk('public')->assertExists($imagePath);
    }

    public function test_service_price_rejects_fractional_amounts(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CreateService::class)
            ->fillForm([
                'name' => 'Ganti Oli',
                'description' => 'Penggantian oli mesin.',
                'estimated_price' => 50000.5,
            ])
            ->call('create')
            ->assertHasFormErrors(['estimated_price' => 'integer']);

        $this->assertDatabaseCount('services', 0);
    }
}
