<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\Http\Requests\ExpenseRequest;
use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{

    public function store(ExpenseRequest $request, Budget $budget)
    {

        Gate::authorize('create', [Expense::class, $budget]);

        $data = $request->validated();
        $data['category'] ??= ExpenseCategory::Other->value;

        $budget->expenses()->create([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'category' => $data['category'],
        ]);

        return redirect()->route('budgets.show', $budget)->with('success', 'Gasto Registrado Correctamente.');
    }


    #[Authorize('update', 'expense')]
    public function update(ExpenseRequest $request, Budget $budget, Expense $expense)
    {
        $expense->update($request->validated());

        return redirect()->route('budgets.show', $budget)->with('success', 'Gasto Actualizado Correctamente.');
    }

    #[Authorize('delete', 'expense')]
    public function destroy(Budget $budget, Expense $expense)
    {
        $expense->delete();

        return redirect()->route('budgets.show', $budget)->with('success', 'Gasto Eliminado Correctamente.');
    }
}
