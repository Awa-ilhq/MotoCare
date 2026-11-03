<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestBookings extends TableWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Booking terbaru')
            ->query(fn (): Builder => Booking::query()->with('service')->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan'),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Layanan'),
                Tables\Columns\TextColumn::make('service_date')
                    ->label('Tanggal servis')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'confirmed' => 'Dikonfirmasi',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->paginated(false)
            ->recordUrl(fn (Booking $record): string => route('filament.admin.resources.bookings.edit', $record));
    }
}
