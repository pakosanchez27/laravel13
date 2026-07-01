<?php

use App\Budgetype;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it stores an expense with a default category when none is provided', function () {
    $user = User::factory()->create();
    $budget = Budget::create([
        'name' => 'Monthly budget',
        'amount' => 1000,
        'type' => Budgetype::Goal->value,
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->post("/dashboard/budgets/{$budget->id}/expenses", [
        'name' => 'PS5',
        'amount' => '5.00',
    ]);

    $response->assertRedirect();
    expect(Expense::count())->toBe(1)
        ->and(Expense::first()->category)->toBe('other');
});
