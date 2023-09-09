<?php

namespace App\Filament\Pages;

use App\Imports\PropertiesImport;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Page;
use Maatwebsite\Excel\Facades\Excel;

class ImportProperty extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.import-property';


    public $property;


    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('property')
            ->required()
        ];
    }

    public function save()
    {
        $data =  $this->form->getData();

        Excel::import(new PropertiesImport(), $data['property']);

    }
}
