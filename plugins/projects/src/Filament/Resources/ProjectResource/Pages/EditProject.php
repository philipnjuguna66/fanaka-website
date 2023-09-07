<?php

namespace Appsorigin\Plots\Filament\Resources\ProjectResource\Pages;

use App\Events\BlogCreatedEvent;
use Appsorigin\Plots\Filament\Resources\ProjectResource;
use Appsorigin\Plots\Models\Project;
use Appsorigin\Plots\Models\ProjectLocation;
use Carbon\Carbon;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {

        $data['slug'] = $this->getRecord()->link?->slug;

        foreach (ProjectLocation::query()->where('project_id', $this->record->id)->get() as $location) {


            $data['location_id'][] = $location->location_id;

        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        try {


            DB::beginTransaction();
            /**
             * @var Project $record
             */
            $project = $record;

            $project->update([
                'name' => $data['name'],
                'status' => $data['status'],
                'price' => $data['price'],
                'cta' => $data['cta'],
                'body' => $data['body'],
                'amenities' => $data['amenities'],
                'featured_image' => $data['featured_image'],
                'video_path' => $data['video_path'],
                'gallery' => $data['gallery'],
                'map' => $data['map'],
                'mutation' => $data['mutation'],
                'meta_title' => $data['meta_title'],
                'location' => $data['location'],
                'purpose' => $data['purpose'],
                'meta_description' => $data['meta_description'],
            ]);

            $record->setCreatedAt(Carbon::parse($data['created_at']));

            $record->saveQuietly();

            $record->link()->delete();

            $project->link()->create([
                'slug' => $data['slug'],
                'type' => 'project',
            ]);

            event(new BlogCreatedEvent($record));

            ProjectLocation::query()->where('project_id', $project->id)->delete();

            foreach ($data['location_id'] as $locationId) {

                ProjectLocation::create([
                    'location_id' => $locationId,
                    'project_id' => $project->id
                ]);
            }

            DB::commit();

            return $project;


        } catch (\Exception $e) {

            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
    }

}
