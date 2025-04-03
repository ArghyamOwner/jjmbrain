<?php

namespace App\Providers;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Macros\StringMacros;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class LaravelFreshServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::addNamespace('datatable', resource_path('views/partials/datatable'));
        
        Model::preventLazyLoading(! $this->app->isProduction());
        
        Component::macro('bannerMessage', function ($message, $style = 'success') {
            $this->dispatchBrowserEvent('banner-message', [
                'style' => $style, // success|danger
                'message' => $message
            ]);
        });

        Component::macro('notify', function ($message, $messageType = 'success') {
            $this->dispatchBrowserEvent('notify', [
                'type' => $messageType, // notice|success|error
                'text' => $message
            ]);
        });

        Blade::directive('inr', function ($amount, $decimal = 2) {
            return "<?php echo '&#8377;' . number_format(floatval(str_replace(',', '', $amount)), $decimal); ?>";
        });

        Blade::directive('date', function ($value) {
            if (empty($value)) {
                return null;
            }
            return "<?php echo ($value)->toFormattedDateString(); ?>";
        });

        Blade::directive('dateWithTime', function ($value) {
            return "<?php echo ($value)->format('d M, Y h:i a'); ?>";
        });

        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            if (count(explode('.', $attribute)) > 2):
                                [$relationName, $relationNameTwo, $relationAttribute] = explode('.', $attribute);
     
                            $query->orWhereHas($relationName.'.'.$relationNameTwo, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            }); else:
                                [$relationName, $relationAttribute] = explode('.', $attribute);
     
                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                            endif;
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

        Str::mixin(new StringMacros);
    }
}
