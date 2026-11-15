<?php

namespace App\Filament\Resources\SiteStatisticResource\Pages;

use App\Filament\Resources\SiteStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteStatistics extends ListRecords
{
    protected static string $resource = SiteStatisticResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
