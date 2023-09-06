<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('options.name', 'Fanaka Real estate');
        $this->migrator->add('options.meta_title', 'Affordable Value added Plots for In Nairobi');
        $this->migrator->add('options.meta_description', "Over 160 listings of Affordable Value added Plots for In Nairobi");
        $this->migrator->add('options.logo', "");
        $this->migrator->add('options.favicon', "");
        $this->migrator->add('options.socials', []);
    }
};
