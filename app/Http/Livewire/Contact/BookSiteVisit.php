<?php

namespace App\Http\Livewire\Contact;

use App\Events\LeadCreatedEvent;
use App\Utils\Enums\ProjectStatusEnum;
use App\Utils\SendSms;
use Appsorigin\Leads\Models\Lead;
use Appsorigin\Plots\Models\Project;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use function PHPUnit\Framework\isFalse;


class BookSiteVisit extends Component implements HasForms
{
    use InteractsWithForms;

    public $date;

    public $name;

    public $project;

    public $branch;
    public $phone_number;

    public $page = null;

    protected function getFormSchema(): array
    {

        return [
            Grid::make(1)
                ->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('phone_number')->required(),
                    Select::make('Branch')
                        ->label('Location')
                        ->placeholder("Select a location Interested")
                        ->options([
                            'kangundo_road' => "Along Kangundo Road",
                            'mombasa_road' => "Along Kangundo Road",
                            'thika_road' => "Along Kangundo Road",
                        ])
                        ->searchable()
                        ->preload()
                        ->required(fn(): bool => !filled($this->page))
                        ->hidden(fn(): bool => filled($this->page))
                ])->inlineLabel(),
        ];
    }

    public function bookVisit()
    {
        $data = $this->form->getState();

        $phone = $data['phone_number'];

        $message = $data['name'] . " Booked a visit on : [" . Carbon::parse($data['date'])->format('Y-m-d') . "] Phone Number:  {$phone}";


        $branch = "";
        if (!is_null($this->page)) {
            $message .= " to view {$this->page}";


        }
        if (isset($data['project'])) {

            $message .= " to view {$data['project']}";
        }

        try {


            Http::baseUrl('https://mis.fanaka.co.ke/api')
                ->get('/notification', [
                    'tel' => $phone,
                    'branch' => $this->branch
                ]);
/*
            (new SendSms())
                ->send(
                    to: 254714686511,
                    text: $message
                );
            (new SendSms())
                ->send(
                    to: 254714686511,
                    text: $message
                );
            (new SendSms())
                ->send(
                    to: $phone,
                    text: "We have received your request and one of our agents will call you shortly"
                );*/

            $lead = Lead::create([
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'date' => Carbon::parse($data['date']),
                'page' => $this->page,
            ]);

            event(new LeadCreatedEvent(lead: $lead, message: $message));


            $this->form->fill([
                'name' => '',
                'phone_number' => '',
                'date' => '',
            ]);


            return Notification::make()
                ->success()
                ->body("We have received your request")
                ->send();

        } catch (\Exception $e) {
            return Notification::make()
                ->danger()
                ->title('Something went wrong')
                ->body($e->getMessage())
                ->send();
        }
        //  dd($response->json());

    }

    public function render()
    {
        return view('livewire.contact.book-site-visit');
    }
}
