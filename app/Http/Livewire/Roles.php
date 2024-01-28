<?php

namespace App\Http\Livewire;

use DB;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;

    public $permissions, $title, $status, $role_id;
    public $updateRol = false, $addRol = false, $deleteRol = false, $selectedPermissions = [];

    protected $listeners = ['render'];

    #[Title('Roles')]
    public function rules()
    {
        return RoleRequest::rules($this->role_id);
    }

    public function resetFields()
    {
        $this->title = '';
        $this->permissions = '';
        $this->status = '';
        $this->selectedPermissions = [];
    }

    public function resetValidationAndFields()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->addRol = false;
        $this->updateRol = false;
        $this->deleteRol = false;
    }

    public function mount()
    {
        if (Gate::denies('role_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
    }

    public function render()
    {
        $roles = Role::orderBy('title', 'asc')->paginate(10);
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        if (Gate::denies('role_add')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->resetValidationAndFields();
        $this->role_id = '';
        $this->addRol = true;
        $list_permissions = Permission::orderBy('menu', 'asc')->get();

        $title_menu = '';
        $permisions = [];
        foreach ($list_permissions as $permission) {
            if ($title_menu != $permission->menu) {
                $title_menu = $permission->menu;

                $checkbox       = New \stdClass();
                $checkbox->menu = $title_menu;
                $checkbox->permissions = [];

                $get_permissions = Permission::orderBy('permission', 'asc')->where('menu', $title_menu)->get();
                foreach ($get_permissions as $item) {
                    $children = (object)[];
                    $children->id = $item->id;
                    $children->permission = $item->permission;
                    $checkbox->permissions[] = $children;
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

        DB::beginTransaction();
        $role = Role::create([
            'title' => $this->title
        ]);
        $role->permissions()->attach($this->selectedPermissions);
        $role->save();
        DB::commit();

        return redirect()->route('roles')
            ->with('message', trans('message.Created Successfully.', ['name' => __('Role')]))
            ->with('alert_class', 'success');
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
            return redirect()->route('roles')
                ->with('message', __('Role not found'))
                ->with('alert_class', 'danger');
        }
        $this->resetValidationAndFields();
        $this->role_id = $role->id;
        $this->title   = $role->title;
        $this->status  = $role->status;
        $this->selectedPermissions = $role->permissions()->pluck('permissions.id')->toArray();
        $this->updateRol  = true;
        $list_permissions = Permission::orderBy('menu', 'asc')->get();

        $title_menu = '';
        $permisions = [];
        foreach ($list_permissions as $permission) {
            if ($title_menu != $permission->menu) {
                $title_menu = $permission->menu;

                $checkbox       = New \stdClass();
                $checkbox->menu = $title_menu;
                $checkbox->permissions = [];

                $get_permissions = Permission::orderBy('permission', 'asc')->where('menu', $title_menu)->get();
                foreach ($get_permissions as $item) {
                    $children = (object)[];
                    $children->id = $item->id;
                    $children->permission = $item->permission;
                    $checkbox->permissions[] = $children;
                }

                $permisions[] = $checkbox;
            }
        };

        $this->permissions = $permisions;
        return view('role.edit');
    }

    public function update()
    {
        if (Gate::denies('role_edit')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->validate();

        $role = Role::find($this->role_id);
        if (!$role) {
            return redirect()->route('roles')
                ->with('message', __('Role not found'))
                ->with('alert_class', 'danger');
        }

        DB::beginTransaction();
        $role->title  = $this->title;
        $role->status = $this->status;
        $role->permissions()->detach();
        $role->permissions()->attach($this->selectedPermissions);
        $role->save();
        DB::commit();

        return redirect()->route('roles')
            ->with('message', trans('message.Updated Successfully.', ['name' => __('Role')]))
            ->with('alert_class', 'success');
    }

    public function cancel()
    {
        $this->resetValidationAndFields();
    }

    public function setDeleteId($id)
    {
        if (Gate::denies('role_delete')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('roles')
                ->with('message', __('Role not found'))
                ->with('alert_class', 'danger');
        }
        $this->role_id = $role->id;
        $this->resetValidationAndFields();
        $this->deleteRol = true;
    }

    public function delete()
    {
        if (Gate::denies('role_delete')) {
            return redirect()->route('roles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $role = Role::find($this->role_id);
        if (!$role) {
            return redirect()->route('roles')
                ->with('message', __('Role not found'))
                ->with('alert_class', 'danger');
        }
        DB::beginTransaction();
        $role->delete();
        DB::commit();

        return redirect()->route('roles')
            ->with('message', trans('message.Deleted Successfully.', ['name' => __('Role')]))
            ->with('alert_class', 'success');
    }
}