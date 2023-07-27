<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gender;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index($id): View
    {
        $user = User::find($id);
        $genders = Gender::all();
        return view('profile.index', [
            'user' => $user,
            'genders' => $genders
        ]);
    }
    
    public function edit(Request $request): View
    {
        $genders = Gender::all();
        return view('profile.edit', [
            'user' => $request->user(),
            'genders' => $genders
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            // Récupération du fichier
            $avatar = $request->file('avatar');

            // Assignez un nom unique au fichier
            $new_name = $request->email . '.' . $avatar->getClientOriginalExtension();

            // Suppression de l'ancien fichier s'il existe
            Storage::delete('users-avatar/' . $new_name);

            // Déplacez l'image dans le dossier de destination
            $path = $avatar->storeAs('users-avatar', $new_name);

            // Ajout du nouveau nom de fichier à l'utilisateur
            $request->user()->avatar = $new_name;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function role(User $user): RedirectResponse
    {
        if(!$user->is_admin){
            $user->is_admin = true;
        }else{
            $user->is_admin = false;
        }
        $user->save();

        #redirect back
        return Redirect::back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
