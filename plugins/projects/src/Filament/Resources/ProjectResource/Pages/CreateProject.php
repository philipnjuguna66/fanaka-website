<?php

namespace Appsorigin\Plots\Filament\Resources\ProjectResource\Pages;

use App\Events\BlogCreatedEvent;
use Appsorigin\Plots\Filament\Resources\ProjectResource;
use Appsorigin\Plots\Models\Project;
use Appsorigin\Plots\Models\ProjectLocation;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    public function handleRecordCreation(array $data): Model
    {
        try {

            DB::beginTransaction();

            $data = $this->form->getState();

            $project = Project::create([
                'name' => $data['name'],
                'status' => $data['status'],
                'price' => $data['price'],
                'body' => $data['body'],
                'amenities' => $data['amenities'],
                'featured_image' => $data['featured_image'],
                'video_path' => $data['video_path'],
                'gallery' => $data['gallery'],
                'map' => $data['map'],
                'mutation' => $data['mutation'],
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
            ]);

            $project->link()->create([
                'slug' => $data['slug'],
                'type' => 'project',
            ]);


            foreach ($data['location_id'] as $locationId) {

                ProjectLocation::create([
                    'location_id' => $locationId,
                    'project_id' => $project->id
                ]);
            }

            DB::commit();

            event(new BlogCreatedEvent($project));
            return $project;


        } catch (\Exception $e) {

            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
    }
}
