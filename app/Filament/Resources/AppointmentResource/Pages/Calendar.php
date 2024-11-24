<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use App\Filament\Resources\AppointmentResource\Widgets\CalendarWidget;
use Filament\Resources\Pages\Page;

class Calendar extends Page
{
    protected static string $resource = AppointmentResource::class;

    protected static string $view = 'filament.resources.appointment-resource.pages.calendar';

}
