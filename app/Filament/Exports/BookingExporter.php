<?php

namespace App\Filament\Exports;

use App\Models\Booking;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class BookingExporter extends Exporter
{
    protected static ?string $model = Booking::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('customer_name')
                ->label('Nama Pelanggan'),
            ExportColumn::make('whatsapp_number')
                ->label('Nomor WhatsApp'),
            ExportColumn::make('plate_number')
                ->label('Plat Nomor'),
            ExportColumn::make('service.name')
                ->label('Jenis Servis'),
            ExportColumn::make('service_date')
                ->label('Tanggal Servis')
                ->formatStateUsing(fn ($state): string => $state?->format('d/m/Y') ?? ''),
            ExportColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'pending' => 'Menunggu',
                    'confirmed' => 'Dikonfirmasi',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                    default => $state,
                }),
            ExportColumn::make('created_at')
                ->label('Dibuat Pada')
                ->formatStateUsing(fn ($state): string => $state?->format('d/m/Y H:i') ?? ''),
        ];
    }

    public function getJobConnection(): ?string
    {
        return 'sync';
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Export booking telah selesai. '.number_format($export->successful_rows).' baris berhasil diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' baris gagal diekspor.';
        }

        return $body;
    }
}
