<?php

namespace Appsorigin\Leads;

use Appsorigin\Leads\Filament\Resources\LeadResource;
use Spatie\LaravelPackageTools\PackageServiceProvider;

use Spatie\LaravelPackageTools\Package;

class LeadsServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package->name('apps-leads');
    }



    protected array $resources = [
      LeadResource::class
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
