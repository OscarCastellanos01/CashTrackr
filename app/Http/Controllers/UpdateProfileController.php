<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Inertia\Inertia;

class UpdateProfileController extends Controller
{
    public function edit()
    {
        return Inertia::render('Settings/UpdateProfile');
    }

    public function update(UpdateProfileRequest $request)
    {

    }
}
