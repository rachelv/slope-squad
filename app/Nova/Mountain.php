<?php
namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
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

            Select::make('Region 1', 'region_1')->options($this->getRegion1Options())->hideFromIndex(),
            Select::make('Region 2', 'region_2')->options($this->getRegion2Options()),
            Select::make('Region 3', 'region_3')->options($this->getRegion3Options()),
            Select::make('Abbrev', 'region_3_abbrev')->searchable()->options(
                $this->getRegionAbbrevOptions()
            )->displayUsingLabels()->hideFromIndex(),

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

    private function getRegion1Options(): array
    {
        return [
            'United States' => 'United States',
            'Canada' => 'Canada',
            'Europe' => 'Europe',
            'South America' => 'South America',
        ];
    }

    private function getRegion2Options(): array
    {
        return [
            'East' => ['label' => 'East', 'group' => 'Canada / United States'],
            'West' => ['label' => 'West', 'group' => 'Canada / United States'],

            'Mid-atlantic' => ['label' => 'Mid-atlantic', 'group' => 'United States'],
            'Midwest' => ['label' => 'Midwest', 'group' => 'United States'],
            'Rockies' => ['label' => 'Rockies', 'group' => 'United States'],
            'Southeast' => ['label' => 'Southeast', 'group' => 'United States'],

            'Switzerland' => ['label' => 'Switzerland', 'group' => 'Europe'],

            'Chile' => ['label' => 'Chile', 'group' => 'South America'],
        ];
    }

    private function getRegion3Options(): array
    {
        return [
            'Connecticut' => ['label' => 'Connecticut', 'group' => 'United States > East'],
            'Maine' => ['label' => 'Maine', 'group' => 'United States > East'],
            'Massachusetts' => ['label' => 'Massachusetts', 'group' => 'United States > East'],
            'New Hampshire' => ['label' => 'New Hampshire', 'group' => 'United States > East'],
            'New York' => ['label' => 'New York', 'group' => 'United States > East'],
            'Rhode Island' => ['label' => 'Rhode Island', 'group' => 'United States > East'],
            'Vermont' => ['label' => 'Vermont', 'group' => 'United States > East'],

            'Maryland' => ['label' => 'Maryland', 'group' => 'United States > Mid-atlantic'],
            'New Jersey' => ['label' => 'New Jersey', 'group' => 'United States > Mid-atlantic'],
            'Pennsylvania' => ['label' => 'Pennsylvania', 'group' => 'United States > Mid-atlantic'],
            'Virginia' => ['label' => 'Virginia', 'group' => 'United States > Mid-atlantic'],
            'West Virginia' => ['label' => 'West Virginia', 'group' => 'United States > Mid-atlantic'],

            'Illinois' => ['label' => 'Illinois', 'group' => 'United States > Midwest'],
            'Indiana' => ['label' => 'Indiana', 'group' => 'United States > Midwest'],
            'Iowa' => ['label' => 'Iowa', 'group' => 'United States > Midwest'],
            'Michigan' => ['label' => 'Michigan', 'group' => 'United States > Midwest'],
            'Minnesota' => ['label' => 'Minnesota', 'group' => 'United States > Midwest'],
            'Wisconsin' => ['label' => 'Wisconsin', 'group' => 'United States > Midwest'],

            'Arizona' => ['label' => 'Arizona', 'group' => 'United States > Rockies'],
            'Colorado' => ['label' => 'Colorado', 'group' => 'United States > Rockies'],
            'Montana' => ['label' => 'Montana', 'group' => 'United States > Rockies'],
            'New Mexico' => ['label' => 'New Mexico', 'group' => 'United States > Rockies'],
            'Utah' => ['label' => 'Utah', 'group' => 'United States > Rockies'],
            'Wyoming' => ['label' => 'Wyoming', 'group' => 'United States > Rockies'],

            'Alabama' => ['label' => 'Alabama', 'group' => 'United States > Southeast'],

            'Alaska' => ['label' => 'Alaska', 'group' => 'United States > West'],
            'California' => ['label' => 'California', 'group' => 'United States > West'],
            'Idaho' => ['label' => 'Idaho', 'group' => 'United States > West'],
            'Nevada' => ['label' => 'Nevada', 'group' => 'United States > West'],
            'Oregon' => ['label' => 'Oregon', 'group' => 'United States > West'],
            'Washington' => ['label' => 'Washington', 'group' => 'United States > West'],

            'Ontario' => ['label' => 'Ontario', 'group' => 'Canada > East'],
            'Quebec' => ['label' => 'Quebec', 'group' => 'Canada > East'],

            'Alberta' => ['label' => 'Alberta', 'group' => 'Canada > West'],
            'British Columbia' => ['label' => 'British Columbia', 'group' => 'Canada > West'],

            'Bern' => ['label' => 'Bern', 'group' => 'Europe > Switzerland'],
            'Valais' => ['label' => 'Valais', 'group' => 'Europe > Switzerland'],

            'Bio Bio' => ['label' => 'Bio Bio', 'group' => 'South America > Chile'],
        ];
    }

    private function getRegionAbbrevOptions(): array
    {
        return [
            'AB' => 'Alberta (AB)',
            'AK' => 'Alaska (AK)',
            'AL' => 'Alabama (AL)',
            'AZ' => 'Arizona (AZ)',
            'BC' => 'British Columbia (BC)',
            'CA' => 'California (CA)',
            'CH' => 'Switzerland (CH)',
            'CL' => 'Chile CL)',
            'CO' => 'Colorado (XX)',
            'CT' => 'Connecticut (CT)',
            'IA' => 'Iowa (IA)',
            'ID' => 'Idaho (ID)',
            'IL' => 'Illinois (IL)',
            'IN' => 'Indiana (IN)',
            'MA' => 'Massachusetts (MA)',
            'MD' => 'Maryland (MD)',
            'ME' => 'Maine (ME)',
            'MI' => 'Michigan (MI)',
            'MN' => 'Minnesota (MN)',
            'MT' => 'Montana (MT)',
            'NH' => 'New Hampshire (NH)',
            'NJ' => 'New Jersey (NJ)',
            'NM' => 'New Mexico (NM)',
            'NV' => 'Nevada (NV)',
            'NY' => 'New York (NY)',
            'ON' => 'Ontario (ON)',
            'OR' => 'Oregon (OR)',
            'PA' => 'Pennsylvania (PA)',
            'QC' => 'Quebec (QC)',
            'RI' => 'RHode Island (RI)',
            'UT' => 'Utah (UT)',
            'VA' => 'Virginia (VA)',
            'VT' => 'Vermont (VT)',
            'WA' => 'Washington (WA)',
            'WI' => 'Wisconsin (WI)',
            'WV' => 'West Virginia (WV)',
            'WY' => 'Wyoming (WY)',
        ];
    }
}