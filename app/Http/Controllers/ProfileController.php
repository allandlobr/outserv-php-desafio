<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Ramsey\Uuid\Nonstandard\Uuid;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profiles = Profile::all();
        return view('profile.management', ['profiles' => $profiles]);
    }

    public function create(): View
    {
        $permissions = Permission::all();
        return view('profile.form', ['permissions' => $permissions]);
    }

    public function edit(Request $request): View
    {
        $profileUuid = $request->route('profileUuid');

        $permissions = Permission::all();

        $profile = Profile::with('permissions')
            ->where("uuid", $profileUuid)
            ->firstOrFail();

        return view('profile.form', ['profile' => $profile, 'permissions' => $permissions]);
    }

    public function update(Request $request): RedirectResponse
    {
        $profileUuid = $request->route('profileUuid');

        $profile = Profile::with('permissions')
            ->where("uuid", $profileUuid)
            ->firstOrFail();

        $profile->update(
            Arr::only(
                $request->all(),
                ['name']
            )
        );

        $profile->permissions()->sync($request->input('permissions'));

        return redirect()->route('profile.management.index');
    }


    public function store(Request $request): RedirectResponse
    {
        $permission = $request->input('permissions');

        $profile = Profile::create([
            'uuid'=>Uuid::uuid4()->toString(),
            'name' => $request->input('name')
        ]);

        $profile->permissions()->sync($permission);

        return redirect()->route('profile.management.index');
    }

    public function delete(Request $request): JsonResponse
    {
        $profileUuid = $request->route('profileUuid');
        $profile = Profile::with('permissions')
            ->where('uuid', $profileUuid)
            ->firstOrFail();

        $profile->permissions()
            ->detach();

        $profile->delete();
        return response()->json();
    }
}
