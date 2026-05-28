<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request, Budget $budget)
    {
        Gate::authorize('create', [Expense::class, $budget]);
        // $data = $request->validated();

        // Expense::create([
        //     'name' => $data['name'],
        //     'amount' => $data['amount'],
        //     'category' => $data['category'],
        //     'budget_id' => $budget->id
        // ]);

        $budget->expenses()->create($request->validated());

        return redirect()->route('budget.show', $budget)->with('success', 'Gasto Registrado Correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    #[Authorize('udpate', 'expense')]
    public function update(ExpenseRequest $request, Budget $budget, Expense $expense)
    {
        $expense->update($request->validated());
        return redirect()->route('budget.show', $budget)->with('success', 'Gasto Actualizado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    #[Authorize('delete', 'expense')]
    public function destroy(Budget $budget, Expense $expense)
    {
        $expense->delete();
        return redirect()->route('budget.show', $budget)->with('success', 'Gasto Eliminado Correctamente.');
    }
}
