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
    public $roles, $permissions, $title, $role_id, $update_rol = false, $addRol = false, $selectedPermissions = [];

    protected $listeners = ['render'];

    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
    ];

    public function resetFields(){
        $this->title = '';
    }

    public function render()
    {
        if (Gate::denies('role_index')) {
            return redirect()->route('home')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $this->roles = Role::latest()->get();
            return view('role.index');
        }
    }

    public function create()
    {
        if (!Gate::denies('role_add')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $this->resetFields();
            $this->addRol = true;
            $this->update_rol = false;
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
    }

    public function store()
    {
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
        $role = Role::findOrFail($id);
        if( !$role) {
            session()->flash('error','Role not found');
        } else {
        }

        $this->title = $role->title;
        $this->role_id = $role->id;
        $this->update_rol = true;
        $this->addRol = false;
    }

    public function update()
    {
        if (!Gate::denies('role_edit')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        } else {
            $this->resetFields();
            $this->addRol = true;
            $this->update_rol = false;
            $this->permissions = Permission::latest()->get();
            return view('role.create');
        }

        $this->validate();

        Role::whereId($this->role_id)->update([
            'title' => $this->title,
        ]);
        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('Role')]));
        $this->resetFields();
        $this->update_rol = false;
    }

    public function cancel()
    {
        $this->addRol = false;
        $this->update_rol = false;
        $this->resetFields();
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('Role')]));
    }
}
