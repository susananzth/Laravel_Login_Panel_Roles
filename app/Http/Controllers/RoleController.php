<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Roles\StoreRequest;
use App\Http\Requests\Roles\UpdateRequest;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('role_index')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $roles = Role::all();
            return view('role.index', compact('roles'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if (Gate::denies('role_edit')) {
            return redirect()->route('role.index')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            if ($role->id == 1) {
                return redirect()->route('role.index')
                ->with('message', trans('message.Editing or deleting parent roles is not allowed. Contact the administrator.'))
                ->with('alert_class', 'danger');
            } else {
                $data['permissions'] = Permission::all();
                $data['role'] = $role->load('permissions');
                return view('roles.edit', $data);
            }
        }
    }

    /**
     * Update the user's profile information.
        public function update(ProfileUpdateRequest $request): RedirectResponse
        {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            return Redirect::route('role.edit')->with('status', 'role-updated');
        }*/
}
