<?php

namespace Mikhadev\EloquentTodayable;

use DateTimeInterface;
use Illuminate\Support\Carbon;

trait Todayable
{
    public static function bootExpirable(): void
    {
        static::addGlobalScope(new TodayScope);
    }

    public function updatedToday(): bool
    {
        $updatedAt = $this->{$this->getUpdatedAtColumn()};

        return $updatedAt && $updatedAt->isToday();
    }

    public function createdToday(): bool
    {
        $createdAt = $this->{$this->getCreatedAtColumn()};

        return $createdAt && $createdAt->isToday();
    }

}
