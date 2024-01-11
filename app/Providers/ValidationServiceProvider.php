<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\Alcohol;
use App\Models\Image;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('place_check', function ($attribute, $value, $parameters, $validator) {
            $newPlace = $validator->getData()['new_place'];
            $place = $validator->getData()['place'];

            if ($newPlace === null && $place == '0') {
                return false;
            }

            if ($newPlace !== null && $place !== '0') {
                return false;
            }

            return true;
        });

        Validator::extend('same_place_check', function ($attribute, $value, $parameters, $validator) {
            $newPlace = $validator->getData()['new_place'];
            $existingPlace = Alcohol::where('place', $newPlace)->exists();

            return !$existingPlace;
        });
    }
}
