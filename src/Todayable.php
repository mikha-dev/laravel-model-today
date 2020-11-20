<?php

namespace Mikhadev\EloquentTodayable;

use Mikhadev\EloquentTodayable\TodayScope;

trait Todayable
{
    public static function bootTodayable(): void
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
