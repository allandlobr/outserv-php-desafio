<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Ramsey\Uuid\Nonstandard\Uuid;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('user.management', ['users' => $users]);
    }

    public function create(): View
    {
        $profiles = Profile::all();
        return view('user.form', ['profiles' => $profiles]);
    }

    public function edit(Request $request): View
    {
        $profiles = Profile::all();

        $userUuid = $request->route('userUuid');

        $user = User::with('profile')
            ->where("uuid", $userUuid)
            ->firstOrFail();

        return view(
            'user.form',
            [
                'user' => $user,
                'profiles' => $profiles
            ]
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $user = User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => $request->input('username'),
            'password' => '12345678',
            'profile_id' => $request->input('profile_id')
        ]);

        return redirect()->route('user.management.index');
    }

    public function update(Request $request): RedirectResponse
    {
        $userUuid = $request->route('userUuid');
        $requestData = $request->all();

        $user = User::with('profile')
            ->where("uuid", $userUuid)
            ->firstOrFail();

        $user->update(
            Arr::except(
                $requestData,
                ['uuid']
            )
        );

        return redirect()->route('user.management.index');
    }

    public function delete(Request $request): JsonResponse
    {
        $userUuid = $request->route('userUuid');

        $user = User::with('profile')
            ->where('uuid', $userUuid)
            ->firstOrFail();

        $user->delete();

        return response()->json();
    }
}
