<?php
namespace App\Console\Commands;

use App\Models\Mountain;
use App\Models\Season;
use App\Models\Snowday;
use App\Models\User;
use App\Models\UserFollowing;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportDataFromHeroku extends Command
{
    protected $signature = 'ssq:import-data-from-heroku {table}';
    protected $description = 'Import data we want from the old Heroku database';

    private $allowedTables = [
        'mountains',
        'seasons',
        'snowdays',
        'users',
        'users_following',
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
        } elseif ($table === 'users') {
            $this->importUsers();
        } elseif ($table === 'snowdays') {
            $this->importSnowdays();
        } elseif ($table === 'users_following') {
            $this->importFollowers();
        }

        return Command::SUCCESS;
    }

    private function importSnowdays(): void
    {
        $fields = [
            'id',
            'user_id',
            'mountain_id',
            'season_id',
            'rank',
            'day_num',
            'date',
            'title',
            'vertical',
            'notes',
            'created_at',
            'updated_at',
        ];

        Snowday::truncate();

        foreach ($this->getFromHeroku('snowdays', $fields) as $idx => $sourceSnowday) {
            // temporary: only import 10% of snowdays
            if ($idx % 10 !== 0) {
                continue;
            }

            $this->line("- [{$idx}] importing snowday {$sourceSnowday->id}");

            $snowday = new Snowday();

            foreach ($fields as $field) {
                $sourceValue = $sourceSnowday->{$field};
                if (in_array($field, ['notes', 'title'])) {
                    $snowday->{$field} = utf8_encode($sourceValue);
                } elseif ($field === 'mountain_id') {
                    $snowday->{$field} = $sourceValue < 0 ? 0 : $sourceValue;
                } else {
                    $snowday->{$field} = $sourceValue;
                }
            }

            $snowday->save();
        }
    }

    private function importUsers(): void
    {
        $fields = [
            'id',
            'name',
            'email',
            'confirmed_at',
            'encrypted_password',
            'total_mountains',
            'total_snowdays',
            'total_seasons',
            'total_friends',
            'current_sign_in_at',
            'created_at',
            'updated_at',
        ];

        User::truncate();

        foreach ($this->getFromHeroku('users', $fields) as $sourceUser) {
            if ($sourceUser->email === null) {
                $sourceUser->email = Str::slug($sourceUser->name) . '@fake-email.com';
            }

            $this->line("- importing {$sourceUser->email}");

            $user = new User();

            foreach ($fields as $field) {
                if ($field === 'confirmed_at') {
                    $user->email_verified_at = Carbon::parse($sourceUser->confirmed_at)->timestamp;
                } elseif ($field === 'encrypted_password') {
                    $user->password = $sourceUser->encrypted_password;
                } elseif ($field === 'current_sign_in_at') {
                    $user->last_logged_in_at = Carbon::parse($sourceUser->current_sign_in_at)->timestamp;
                } else {
                    $user->{$field} = $sourceUser->{$field};
                }
            }

            $user->save();
        }
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

    private function importFollowers(): void
    {
        $fields = [
            'user_id',
            'friend_user_id',
            'created_at',
            'updated_at',
        ];

        Season::truncate();

        foreach ($this->getFromHeroku('friends', $fields) as $sourceFollowing) {
            $this->line("- importing {$sourceFollowing->user_id} : {$sourceFollowing->friend_user_id}");

            $userFollowing = new UserFollowing();

            foreach ($fields as $field) {
                if ($field === 'friend_user_id') {
                    $userFollowing->following_user_id = $sourceFollowing->friend_user_id;
                } else {
                    $userFollowing->{$field} = $sourceFollowing->{$field};
                }
            }

            $userFollowing->save();
        }
    }

    private function getFromHeroku(string $table, array $fields): array
    {
        $stringFields = implode(', ', $fields);
        return DB::connection('heroku')->select("select {$stringFields} from {$table}");
    }
}