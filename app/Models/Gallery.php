<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'image',
        'caption',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * URL gambar galeri (mendukung gambar lama di public/images dan upload baru di storage).
     */
    public function getImageUrlAttribute(): string
    {
        if (blank($this->image)) {
            return asset('images/galeri1.png');
        }

        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return Storage::disk('public')->url($this->image);
    }
}
