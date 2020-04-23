<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TownsController extends Controller
{
    public function edit()
    {
        return view('town_name');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:30',
        ]);
        $user = $request->user();
        $town = $user->town;
        $town->name = $validatedData['name'];
        $town->save();
        return redirect()->route('home');
    }
}
