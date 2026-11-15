<?php

namespace App\Filament\Resources\SiteStatisticResource\Pages;

use App\Filament\Resources\SiteStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteStatistic extends EditRecord
{
    protected static string $resource = SiteStatisticResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
