<?php

namespace App\Http\Livewire\Contact;

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


class BookSiteVisit extends Component implements HasForms
{
    use InteractsWithForms;

    public $date;

    public $name;

    public $project;

    public $phone_number;

    public ?string $page = null;

    protected function getFormSchema(): array
    {

        return [
            Grid::make(1)
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('phone_number')->required(),
                DatePicker::make('date')
                    ->minDate(Carbon::today())
                    ->reactive()
                    ->default(now()->addDays(1))
                    ->required()->columnSpanFull(),
                Select::make('project')
                    ->placeholder("Select a Project")
                ->options(Project::query()
                    ->where('status', ProjectStatusEnum::FOR_SALE)
                    ->when(filled($this->page), fn($query) => $query->where('name', 'like', "%{$this->page}%"))
                    ->pluck('name','name'))
                ->searchable()
                ->preload()
                ->maxItems(5)
                ->required(fn() : bool =>  ! filled($this->page))
                ->hidden(fn() : bool =>   filled($this->page))
            ])->inlineLabel(),
        ];
    }

    public function bookVisit()
    {
        $data = $this->form->getState();

        $phone = $data['phone_number'];

       $message = $data['name'] . " Booked a visit on : [" .  Carbon::parse($data['date'])->format('Y-m-d') ."] Phone Number:  {$phone}";

       if (! is_null($this->page))
       {
           $message .= " to view {$this->page}";
       }
       if( isset($data['project'])){

           $message .= " to view {$data['project']}";
       }


        try {
          /* (new SendSms())
                ->send(
                    to: 254790185555,
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

            Lead::create([
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'date' => Carbon::parse($data['date']),
                'page' => $this->page,
            ]);

            $this->form->fill([
                'name' => '',
                'phone_number' => '',
                'date' => '',
            ]);



            return Notification::make()
                ->success()
                ->body("We have received your request")
                ->send();

        }
       catch (\Exception $e)
       {
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
