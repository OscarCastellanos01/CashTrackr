<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Inertia\Inertia;

class UpdatePasswordController extends Controller
{
    public function edit()
    {
        return Inertia::render('Settings/UpdatePassword');
    }

    public function update(UpdatePasswordRequest $request)
    {

    }
}
