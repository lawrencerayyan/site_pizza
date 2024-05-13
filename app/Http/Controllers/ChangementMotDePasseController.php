<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ChangementMotDePasseController extends Controller
{
    public function edit()
    {
        return view('ChangerMDP');
    }
    public function store(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'mdp_actuel' => ['required'],
            'mdp' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->mdp_actuel, $user->mdp)) {
            return redirect()->back()->withErrors(['mdp_actuel' => 'Le mot de passe actuel ne correspond pas.']);
        }

        $user->update(['mdp' => Hash::make($request->mdp)]);

        return redirect()->back()->with('success', 'Le mot de passe a été changé avec succès.');
    }


    public function update(Request $request){

        $request->validate([
            'mdp' => 'required|string|confirmed'//|min:8',
        ]);
        $user = auth()->user();

        $user->mdp = Hash::make($request->mdp);
        $user->save();

        session()->flash('etat','MDP modifié');


        return redirect(RouteServiceProvider::HOME);
    }

}
