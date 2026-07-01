<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\Http\Requests\ExpenseRequest;
use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function store(ExpenseRequest $request, Budget $budget)
    {
        $data = $request->validated();
        $data['category'] ??= ExpenseCategory::Other->value;

        $budget->expenses()->create([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'category' => $data['category'],
        ]);

        return redirect()->route('budgets.show', $budget)->with('success', 'Gasto Registrado Correctamente.');
    }

    public function update(Request $request, Expense $expense)
    {
        //
    }

    public function destroy(Expense $expense)
    {
        //
    }
}
