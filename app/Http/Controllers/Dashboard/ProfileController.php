<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Symfony\Component\Intl\Countries;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),
            'locales' => Locales::getNames()
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        $user->profile->fill($request->all())->save();

        return Redirect::route('dashboard.profile.edit')->with([
            'success' => 'Profile has been Updated!',
        ]);
    }
}