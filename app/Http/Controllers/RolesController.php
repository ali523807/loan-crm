<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::query()
                ->withCount(['permissions', 'users']);

            $totalCount = Role::count();
            $filterCount = $roles->clone()->count();

            $roles = $roles
                ->latest('id')
                ->skip($request->start ?? 0)
                ->take($request->length ?? 10)
                ->get();

            return DataTables::of($roles)
                ->with([
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $filterCount,
                ])
                ->skipPaging()
                ->addIndexColumn()
                ->addColumn('permissions', fn (Role $role): string => (string) $role->permissions_count)
                ->addColumn('users', fn (Role $role): string => (string) $role->users_count)
                ->addColumn('action', fn (Role $role): string => view('roles.columns._actions', ['role' => $role])->render())
                ->rawColumns(['action'])
                ->make(true);
        }

        $permissions = Permission::query()
            ->orderBy('group')
            ->orderBy('display_name')
            ->get()
            ->groupBy('group');

        return view('roles.index', compact('permissions'));
    }

    public function storeOrUpdate(StoreRoleRequest $request)
    {
        $data = $request->validated();

        $role = isset($data['id'])
            ? Role::query()->findOrFail($data['id'])
            : new Role(['name' => Str::slug($data['display_name'])]);

        $role->fill([
            'display_name' => $data['display_name'],
            'description' => $data['description'] ?? null,
            'is_system' => $role->exists ? $role->is_system : false,
        ])->save();

        $role->permissions()->sync($data['permissions'] ?? []);

        return response()->json(['message' => 'Role saved successfully!']);
    }

    public function edit(Role $role)
    {
        return response()->json([
            ...$role->toArray(),
            'permissions' => $role->permissions()->pluck('permissions.id')->all(),
        ]);
    }

    public function destroy(Role $role)
    {
        abort_if($role->is_system, 403, 'System roles cannot be deleted.');

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully!']);
    }
}
