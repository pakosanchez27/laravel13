<?php

namespace App\Models;

use App\Budgetype;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'amount', 'type', 'user_id'])]
class Budget extends Model
{
    protected $casts = [
        'type' => Budgetype::class,
    ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

    public function isGeneral(): bool
    {
        return $this->type === Budgetype::General;
    }

    public function isGoal(): bool
    {
        return $this->type === Budgetype::Goal;
    }
}
