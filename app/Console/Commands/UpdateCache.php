<?php

namespace App\Console\Commands;

use App\Events\BlogCreatedEvent;
use App\Events\PageCreatedEvent;
use App\Models\Page;
use Appsorigin\Plots\Models\Project;
use Illuminate\Console\Command;

class UpdateCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Website Cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(function (){

            $pages =  Page::query()->cursor();


            foreach ($pages as $page){

                event(new PageCreatedEvent($page));

            }

            $projects =  Project::query()->cursor();


            foreach ($projects as $project){

                event(new BlogCreatedEvent($project));

            }


        });
    }
}
