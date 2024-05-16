<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::all();
        return view('permission.management', ['permissions' => $permissions]);
    }

    public function create(): View
    {
        return view('permission.form');
    }

    public function edit(Request $request): View
    {
        $permissionUuid = $request->route('permissionUuid');

        $permission = Permission::where("uuid", $permissionUuid)
            ->firstOrFail();

        return view('permission.form', ['permission' => $permission]);
    }

    public function update(Request $request): RedirectResponse
    {
        $permissionUuid = $request->route('permissionUuid');

        $permission = Permission::where("uuid", $permissionUuid)
            ->firstOrFail();

        $data = $request->all();
        $data['slug_name'] = Str::slug($request->input('name'));

        $permission->update(
            Arr::except(
                $data,
                ['uuid']
            )
        );

        return redirect()->route('permission.management.index');
    }


    public function store(Request $request): RedirectResponse
    {
        $permissionName = $request->input('name');

        $permission = Permission::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => $permissionName,
            'slug_name' => Str::slug($permissionName)
        ]);

        return redirect()->route('permission.management.index');
    }

    public function delete(Request $request): RedirectResponse
    {
        $permissionUuid = $request->route('permissionUuid');

        $permission = Permission::where("uuid", $permissionUuid)
            ->firstOrFail();

        $permission->delete();

        return redirect()->route('permission.management.index');
    }
}
