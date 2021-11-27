<?php
namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Mountain extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Mountain::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'short_name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),

            Text::make('Name', function () {
                return empty($this->getNickname()) ? $this->getName() : $this->getNickname();
            })->onlyOnIndex(),

            Text::make('Name', 'name')->hideFromIndex(),
            Text::make('Nickname', 'short_name')->hideFromIndex(),
            Text::make('URL', 'url')->hideFromIndex(),

            Number::make('lat')->min(-180)->max(180)->step(0.0001)->hideFromIndex(),
            Number::make('lon')->min(-180)->max(180)->step(0.0001)->hideFromIndex(),

            Text::make('Region 1', 'region_1')->hideFromIndex(),
            Text::make('Region 2', 'region_2'),
            Text::make('Region 3', 'region_3')->hideFromIndex(),
            Text::make('Region 3', 'region_3_abbrev'),
            Text::make('City', 'city')->hideFromIndex(),

            Boolean::make('Active', 'is_active'),
            Boolean::make('International', 'is_international'),

            DateTime::make('Created At', 'created_at')->hideFromIndex(),
            DateTime::make('Updated At', 'updated_at')->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}