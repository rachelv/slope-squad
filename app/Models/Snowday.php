<?php
namespace App\Models;

use Carbon\Carbon;

class Snowday extends SlopeSquadBaseModel
{
    use Traits\hasMountain;
    use Traits\hasRank;
    use Traits\hasSeason;
    use Traits\hasUser;

    protected $table = 'snowdays';

    public function getDisplayTitle(): string
    {
        if ($this->getMountainId() > 0) {
            return $this->getMountain()->getNickname();
        } elseif (!empty($this->getTitle())) {
            return $this->getTitle();
        }

        return '';
    }

    public function getDayNum(): int
    {
        return $this->day_num;
    }

    public function setDayNum(int $dayNum): void
    {
        $this->day_num = $dayNum;
    }

    public function getDate(): Carbon
    {
        return Carbon::createFromFormat('Y-m-d', $this->date);
    }

    public function setDate(Carbon $date): void
    {
        $this->date = $date;
    }

    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getVertical(): int
    {
        return $this->vertical ?? 0;
    }

    public function setVertical(int $vertical): void
    {
        $this->vertical = $vertical;
    }

    public function getNotes(): string
    {
        return $this->notes ?? '';
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}