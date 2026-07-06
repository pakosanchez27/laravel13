<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;


class TicketScanController extends Controller
{
    public function store(Request $request, Budget $budget)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:1240']
        ]);

    }
}
