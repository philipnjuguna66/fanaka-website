<?php

namespace App\Filament\AdminPanel\Resources\WhatsappResource\Pages;

use App\Filament\AdminPanel\Resources\WhatsappResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateWhatsapp extends CreateRecord
{
    protected static string $resource = WhatsappResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        return parent::handleRecordCreation($data);
    }
}
