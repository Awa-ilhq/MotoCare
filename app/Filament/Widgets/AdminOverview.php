<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Booking menunggu', Booking::query()->where('status', 'pending')->count())
                ->description('Perlu ditindaklanjuti')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->url(route('filament.admin.resources.bookings.index')),
            Stat::make('Total layanan', Service::query()->count())
                ->description('Layanan terdaftar')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('primary')
                ->url(route('filament.admin.resources.services.index')),
            Stat::make('Foto galeri aktif', Gallery::query()->where('is_active', true)->count())
                ->description('Ditampilkan di halaman depan')
                ->descriptionIcon('heroicon-m-photo')
                ->color('success')
                ->url(route('filament.admin.resources.galleries.index')),
            Stat::make('Pesan masuk', Contact::query()->count())
                ->description('Pesan dari pelanggan')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info')
                ->url(route('filament.admin.resources.contacts.index')),
        ];
    }
}
