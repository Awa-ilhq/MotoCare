<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;

class ImageUploadField
{
    public static function make(string $label, bool $required = false): FileUpload
    {
        return FileUpload::make('image')
            ->label($label)
            ->image()
            ->disk('public')
            ->directory('images')
            ->multiple(false)
            ->panelLayout('integrated')
            ->imagePreviewHeight('320')
            ->placeholder('Tarik & lepas gambar ke sini atau klik untuk memilih')
            ->maxSize(2048)
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->helperText('Gambar disimpan dalam ukuran aslinya. Format JPG/PNG/WEBP, maksimal 2 MB.')
            ->required($required)
            ->columnSpanFull();
    }
}
