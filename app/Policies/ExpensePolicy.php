<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExpensePolicy
{


    public function create(User $user, Budget $budget): Response
    {
        // Solo el propietario del presupuesto puede crear gastos
        return $user->id === $budget->user_id ? Response::allow() : Response::deny('No tienes permiso para crear gastos en este presupuesto.');
    }


    public function update(User $user, Expense $expense): Response
    {
        // Solo el propietario del presupuesto puede actualizar gastos
        return $user->id === $expense->budget->user_id ? Response::allow() : Response::deny('No tienes permiso para actualizar este gasto.');
    }


    public function delete(User $user, Expense $expense): Response
    {
        // Solo el propietario del presupuesto puede eliminar gastos
        return $user->id === $expense->budget->user_id ? Response::allow() : Response::deny('No tienes permiso para eliminar este gasto.');
    }

}
