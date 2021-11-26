<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SlopeSquadBaseModel extends Model
{
    // created_at / updated_at columns are epoch ints
    protected $dateFormat = 'U';

    /**
     * Every model has a PK int id.
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at ?? now();
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at ?? now();
    }
}