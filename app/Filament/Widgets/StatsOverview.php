<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Projects', Project::count())
                ->description('Total projects')
                ->color('success')
                ->icon('heroicon-o-briefcase'),

            Stat::make('Services', Service::count())
                ->description('Active services')
                ->color('info')
                ->icon('heroicon-o-wrench-screwdriver'),

            Stat::make('Blog Posts', BlogPost::count())
                ->description(BlogPost::where('is_published', true)->count() . ' published')
                ->color('warning')
                ->icon('heroicon-o-document-text'),

            Stat::make('Products', Product::count())
                ->description('Total products')
                ->color('primary')
                ->icon('heroicon-o-shopping-bag'),

            Stat::make('Messages', ContactMessage::count())
                ->description(ContactMessage::where('is_read', false)->count() . ' unread')
                ->color('danger')
                ->icon('heroicon-o-envelope'),
        ];
    }
}
