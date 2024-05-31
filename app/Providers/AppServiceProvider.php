<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Permalink;
use App\Models\Whatsapp;
use Appsorigin\Plots\Models\Location;
use Filament\Forms\Components\Select;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Model::preventLazyLoading(!app()->isProduction());

        $this->customDirectives();

        $this->readDuration();

        $this->morphsSchemas();

        FilamentNavigation::addItemType('Internal Page', [
            Select::make('url')
                ->searchable()
                ->options(function () {
                    return Permalink::query()->where('type', 'page')->pluck('title', 'slug');
                }),
        ]);



    }

    private function customDirectives(): void
    {

        if ( ! $this->app->runningInConsole()){
            Cache::forever('styles', view('layouts.partials.styles')->render());




            View::composer('layouts.guest', fn(\Illuminate\View\View $view) => $view->with([
                'styles' =>  Cache::get('styles')

            ]));
        }






        Blade::directive('meta', function ($expression): string {
            [$property, $content] = explode(',', $expression, 2);
            $metas = '';

            if ($property == 'description') {

                $metas .= "<?php echo '<meta property=\"description\" content=\"' . $content . '\">' . \"\n\"; ?>";

            }

            $metas .= "<?php echo '<meta property=\"og:' . $property . '\" content=\"' . $content . '\">' . \"\n\"; ?>";
            $metas .= "<?php echo '<meta property=\"twitter:' . $property . '\" content=\"' . $content . '\">' . \"\n\"; ?>";
            $metas .= "<?php echo '<meta property=\"article:' . $property . '\" content=\"' . $content . '\">' . \"\n\"; ?>";

            return $metas;
        });
    }

    private function readDuration(): void
    {
        Str::macro('readDuration', function (...$text): int {
            $totalWords = str_word_count(implode(' ', $text));
            $minutesToRead = round($totalWords / 200);

            return (int)max(1, $minutesToRead);
        });
    }

    private function morphsSchemas()
    {
        return Relation::morphMap([
            'page' => Page::class,
        ]);
    }
}
