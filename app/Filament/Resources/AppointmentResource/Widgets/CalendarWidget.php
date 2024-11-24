<?php

namespace App\Filament\Resources\AppointmentResource\Widgets;

use App\Models\Appointment;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Actions\CreateAction;
use Saade\FilamentFullCalendar\Actions\DeleteAction;
use Saade\FilamentFullCalendar\Actions\EditAction;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Appointment::class;

    public function fetchEvents(array $fetchInfo): array
    {
        return Appointment::where('start_time', '>=', $fetchInfo['start'])
            ->where('end_time', '<=', $fetchInfo['end'])
            ->get()
            ->map(function (Appointment $appointment) {
                return [
                    'id'    => $appointment->id,
                    'title' => $appointment->title,
                    'start' => $appointment->start_time,
                    'end'   => $appointment->end_time,
                ];
            })
            ->toArray();
    }

    public function getFormSchema(): array
    {
        return [
            Grid::make()
                ->schema(Appointment::getForm()),
        ];
    }

    protected function headerActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function modalActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }

    public function eventDidMount(): string
    {
        return <<<JS
            function({ event, timeText, isStart, isEnd, isMirror, isPast, isFuture, isToday, el, view }){
                el.setAttribute("x-tooltip", "tooltip");
                el.setAttribute("x-data", "{ tooltip: '"+event.title+"' }");
            }
        JS;
    }

    public function getViewData(): array
    {
        return Appointment::all()->toArray();
    }

    public function createAppointment(array $data): void
    {
        Appointment::create($data);
        $this->refreshEvents();
    }

    public function editAppointmenz(array $data): void
    {
        $this->appointment->update($data);
        $this->refreshEvents();
    }
    public function resolveAppointmentRecord(array $data): Model
    {
        return Appointment::find($data['id']);
    }

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'dayGridMonth,dayGridWeek,dayGridDay',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
        ];
    }
}
