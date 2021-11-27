<?php
namespace App\Console\Commands;

use App\Models\Mountain;
use App\Models\Season;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportDataFromHeroku extends Command
{
    protected $signature = 'ssq:import-data-from-heroku {table}';
    protected $description = 'Import data we want from the old Heroku database';

    private $allowedTables = [
        'mountains',
        'seasons',
        'snowdays',
        'users',
    ];

    public function handle()
    {
        $table = $this->argument('table');
        if (!in_array($table, $this->allowedTables)) {
            $this->error('Table must be one of: ' . implode(', ', $this->allowedTables));
            return Command::INVALID;
        }

        if ($table === 'mountains') {
            $this->importMountains();
        } elseif ($table === 'seasons') {
            $this->importSeasons();
        }

        return Command::SUCCESS;
    }

    private function importMountains(): void
    {
        $fields = [
            'id',
            'name',
            'short_name',
            'url',
            'lat',
            'lon',
            'region_1',
            'region_2',
            'region_3',
            'region_3_abbrev',
            'city',
            'active',
            'international',
            'created_at',
            'updated_at',
        ];

        Mountain::truncate();

        foreach ($this->getFromHeroku('mountains', $fields) as $sourceMountain) {
            $this->line("- importing {$sourceMountain->name}");

            $mountain = new Mountain();

            foreach ($fields as $field) {
                if (in_array($field, ['active', 'international'])) {
                    $targetField = "is_{$field}";
                    $mountain->{$targetField} = $sourceMountain->{$field};
                } else {
                    $mountain->{$field} = $sourceMountain->{$field};
                }
            }

            $mountain->save();
        }
    }

    private function importSeasons(): void
    {
        $fields = [
            'id',
            'rank',
            'is_current',
            'name',
            'created_at',
            'updated_at',
        ];

        Season::truncate();

        foreach ($this->getFromHeroku('seasons', $fields) as $sourceSeason) {
            $this->line("- importing {$sourceSeason->name}");

            $season = new Season();

            foreach ($fields as $field) {
                $season->{$field} = $sourceSeason->{$field};
            }

            $season->save();
        }
    }

    private function getFromHeroku(string $table, array $fields): array
    {
        $stringFields = implode(', ', $fields);
        return DB::connection('heroku')->select("select {$stringFields} from {$table}");
    }
}