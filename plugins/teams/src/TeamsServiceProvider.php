<?php

namespace Appsorigin\Teams;

use Appsorigin\Teams\Filament\Resources\TeamResource;
use Spatie\LaravelPackageTools\PackageServiceProvider;

use Spatie\LaravelPackageTools\Package;

class TeamsServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package->name('apps-teams');
    }



    protected array $resources = [

        TeamResource::class,
    ];

    protected array $pages  = [];


    protected array $widgets = [];


    public function packageBooted(): void
    {

        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations',
        ]);

        parent::packageBooted();
    }

}
