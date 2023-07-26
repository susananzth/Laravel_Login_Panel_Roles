<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Roles\StoreRequest;
use App\Http\Requests\Roles\UpdateRequest;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Roles extends Component
{
    public $roles, $permissions, $title, $role_id;
    public $updateRol = false, $addRol = false, $deleteRol = false, $selectedPermissions = [];

    protected $listeners = ['render'];

    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
    ];

    public function resetFields(){
        $this->title = '';
        $this->permissions = '';
    }

    public function render()
    {
        if (Gate::denies('role_index')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->roles = Role::latest()->get();
        return view('role.index');
    }

    public function create()
    {
        if (Gate::denies('role_add')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->resetFields();
        $this->addRol = true;
        $this->updateRol = false;
        $this->deleteRol = false;
        $list_permissions = Permission::latest()->get();

        $title_menu = '';
        $permisions = [];
        foreach ($list_permissions as $permission) {
            if ($title_menu != $permission->menu) {
                $title_menu = $permission->menu;

                $checkbox       = New \stdClass();
                $checkbox->menu = $title_menu;
                $checkbox->permissions = [];

                foreach ($list_permissions as $item) {
                    if ($title_menu == $item->menu) {
                        $children = (object)[];
                        $children->id = $item->id;
                        $children->permission = $item->permission;
                        $checkbox->permissions[] = $children;
                    }
                }

                $permisions[] = $checkbox;
            }
        };

        $this->permissions = $permisions;
        return view('role.create');
    }

    public function store()
    {
        if (Gate::denies('role_add')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->validate();

        $role = Role::create([
            'title' => $this->title
        ]);
        $role->permissions()->attach(array_keys($this->selectedPermissions));
        $role->save();

        $this->emit('render');
        $this->resetFields();
        $this->addRol = false;

        session()->flash('message', trans('message.Created Successfully.', ['name' => __('Role')]));
        session()->flash('alert_class', 'success');
    }

    public function edit($id)
    {
        if (Gate::denies('role_edit')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $role = Role::find($id)->load('permissions');

        if (!$role) {
            session()->flash('error','Role not found');
            $this->emit('render');
        } else {
            $this->title = $role->title;
            $this->permissions = $role->permissions;
            $this->role_id = $role->id;
            $this->addRol = false;
            $this->updateRol = true;
            $this->deleteRol = false;
        }
    }

    public function update()
    {
        if (Gate::denies('role_edit')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->validate();

        $role = Role::findOrFail($this->role_id);
        $role->title = $this->title;
        $role->permissions()->detach();
        $role->permissions()->attach(array_keys($this->selectedPermissions));
        $role->save();

        $this->emit('render');
        $this->resetFields();
        $this->updateRol = false;

        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('Role')]));
        session()->flash('alert_class', 'success');
    }

    public function cancel()
    {
        $this->addRol = false;
        $this->updateRol = false;
        $this->deleteRol = false;
        $this->resetFields();
    }

    public function setDeleteId($id)
    {
        if (!Gate::denies('role_delete')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $role = Role::find($id);
        if (!$role) {
            session()->flash('error','Role not found');
            $this->emit('render');
        } else {
            $this->role_id = $role->id;
            $this->addRol = false;
            $this->updateRol = false;
            $this->deleteRol = true;
        }

    }

    public function delete()
    {
        if (!Gate::denies('role_delete')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        Role::findOrFail($this->role_id)->delete();
        $this->emit('render');

        $this->deleteRol = false;

        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('Role')]));
        session()->flash('alert_class', 'success');
    }
}
