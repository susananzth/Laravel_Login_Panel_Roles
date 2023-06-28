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
    public $roles, $permissions, $title, $role_id, $update_rol = false, $addRol = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteRoleListner'=>'delete'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title' => 'required',
        'description' => 'required'
    ];

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->title = '';
    }

    /**
     * render the role data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

    /**
     * Open Add Role form
     * @return void
     */
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
            $this->permissions = Permission::latest()->get();
            return view('role.create');
        }
    }

    /**
     * store the user inputted role data in the roles table
     * @return void
     */
    public function store()
    {
        $this->validate();

        Role::create([
            'title' => $this->title,
            'description' => $this->description
        ]);
        session()->flash('message', trans('messages.Created Successfully.', ['name' => __('Role')]));
        $this->resetFields();
        $this->addRol = false;
    }

    /**
     * show existing role data in edit role form
     * @param mixed $id
     * @return void
     */
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

    /**
     * update the role data
     * @return void
     */
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
        session()->flash('message', trans('messages.Updated Successfully.', ['name' => __('Role')]));
        $this->resetFields();
        $this->update_rol = false;
    }

    /**
     * Cancel Add/Edit form and redirect to role listing page
     * @return void
     */
    public function cancel()
    {
        $this->addRol = false;
        $this->update_rol = false;
        $this->resetFields();
    }

    /**
     * delete specific role data from the roles table
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('message', trans('messages.Deleted Successfully.', ['name' => __('Role')]));
    }
}
