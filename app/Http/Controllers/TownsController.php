<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TownsController
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

        $request->user()->town->update($validatedData);

        return redirect()->route('home');
    }
}
