<?php

namespace App\Http\Livewire;

use DB;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $name, $email, $password, $password_confirmation, $user_id;
    public $addUser = false, $updateUser = false, $deleteUser = false;

    protected $listeners = ['render'];

    public function rules()
    {
        return UserRequest::rules($this->user_id);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function resetValidationAndFields()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->addUser = false;
        $this->updateUser = false;
        $this->deleteUser = false;
    }

    public function mount()
    {
        if (Gate::denies('user_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
    }

    public function render()
    {
        $users = User::orderBy('name', 'asc')->paginate(10);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        if (Gate::denies('user_add')) {
            return redirect()->route('users')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->resetValidationAndFields();
        $this->addUser = true;
        return view('user.create');
    }

    public function store()
    {
        if (Gate::denies('user_add')) {
            return redirect()->route('users')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->validate();

        DB::beginTransaction();
        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $user->save();
        DB::commit();

        $this->resetValidationAndFields();
        $this->emit('render');

        session()->flash('message', trans('message.Created Successfully.', ['name' => __('User')]));
        session()->flash('alert_class', 'success');
    }


    public function edit($id)
    {
        if (Gate::denies('user_edit')) {
            return redirect()->route('users')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $user = User::find($id);

        if (!$user) {
            session()->flash('error','User not found');
            $this->emit('render');
        } else {
            $this->resetValidationAndFields();
            $this->user_id    = $user->id;
            $this->name       = $user->name;
            $this->email      = $user->email;
            $this->updateUser = true;
            return view('user.edit');
        }
    }

    public function update()
    {
        if (Gate::denies('user_edit')) {
            return redirect()->route('users')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->validate();

        DB::beginTransaction();
        $user = User::find($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        if (isset($this->password) || $this->password != '') {
            $user->password = Hash::make($this->password);
        }
        $user->save();
        DB::commit();

        $this->resetValidationAndFields();
        $this->emit('render');

        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('User')]));
        session()->flash('alert_class', 'success');
    }

    public function cancel()
    {
        $this->resetValidationAndFields();
    }

    public function setDeleteId($id)
    {
        if (Gate::denies('user_delete')) {
            return redirect()->route('users')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $user = User::find($id);
        if (!$user) {
            session()->flash('error','User not found');
            $this->emit('render');
        } else {
            $this->user_id = $user->id;
            $this->resetValidationAndFields();
            $this->deleteUser = true;
        }
    }

    public function delete()
    {
        if (Gate::denies('user_delete')) {
            return redirect()->route('users')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        DB::beginTransaction();
        User::findOrFail($this->user_id)->delete();
        DB::commit();
        $this->resetValidationAndFields();
        $this->emit('render');

        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('User')]));
        session()->flash('alert_class', 'success');
    }
}
