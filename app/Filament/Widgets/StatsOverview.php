<?php

namespace App\Filament\Widgets;

use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Promo;
use App\Models\Reservation;
use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Active Menus', Menu::count())
                ->description('Total food & beverage items')
                ->color('primary')
                ->icon('heroicon-o-building-storefront'),
            Stat::make('Gallery Assets', Gallery::count())
                ->description('Photos & media items')
                ->color('success')
                ->icon('heroicon-o-photo'),
            Stat::make('Amenities', Facility::count())
                ->description('Active cafe facilities')
                ->color('warning')
                ->icon('heroicon-o-sparkles'),
            Stat::make('Testimonials', Testimonial::count())
                ->description('Customer reviews')
                ->color('info')
                ->icon('heroicon-o-chat-bubble-bottom-center-text'),
            Stat::make('Pending Reservations', Reservation::where('status', 'pending')->count())
                ->description(Reservation::count() . ' total requests')
                ->color('danger')
                ->icon('heroicon-o-calendar-days'),
            Stat::make('Active Promos', Promo::active()->count())
                ->description('Promo & events aktif')
                ->color('warning')
                ->icon('heroicon-o-tag'),
        ];
    }
}
