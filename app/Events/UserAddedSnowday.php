<?php
namespace App\Events;

use App\Models\Snowday;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserAddedSnowday
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Snowday $snowday;

    public function __construct(Snowday $snowday)
    {
        $this->snowday = $snowday;
    }

    public function getSnowday(): Snowday
    {
        return $this->snowday;
    }
}