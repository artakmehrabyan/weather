<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;


class UserPreferenceController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'precipitation_threshold' => 'required|numeric|min:0',
            'uv_index_threshold' => 'required|integer|min:0',
        ]);

        $user = auth()->user();
        $user->preferences()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'precipitation_threshold',
                'uv_index_threshold',
            ])
        );

        return redirect()->back()->with('success', 'Preferences updated successfully!');
    }
}
