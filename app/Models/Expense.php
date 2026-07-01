<?php

namespace App\Models;

use App\ExpenseCategory;
use App\Models\Budget;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'amount', 'category', 'budget_id'])]
class Expense extends Model
{


    use SoftDeletes;

    protected $casts = [
        'category' => ExpenseCategory::class,
    ];

    protected $appends = ['category_label', 'category_color'];

    public function getCategoryLabelAttribute(): string
    {
        return $this->category->label();
    }

     public function getCategoryColorAttribute(): string
    {
        return $this->category->color();
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
