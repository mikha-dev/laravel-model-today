<?php

namespace Mikhadev\EloquentTodayable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TodayScope implements Scope
{
    /** @var array */
    protected $extensions = [
        'CreatedToday',
        'UpdatedToday',
    ];

    public function apply(Builder $builder, Model $model): void
    {
        //
    }

    public function extend(Builder $builder): void
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }

    protected function addCreatedToday(Builder $builder): void
    {
        $builder->macro('createdToday', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->whereDate($model->getQualifiedCreatedAtColumn(), date('Y-m-d'));
        });
    }    

    protected function addUpdatedToday(Builder $builder): void
    {
        $builder->macro('updatedToday', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->whereDate($model->getQualifiedUpdatedAtColumn(), date('Y-m-d'));
        });
    }        
}
