<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Users extends Component
{
    public $addUser = false, $updateUser = false, $deleteUser = false;
    public function render()
    {
        if (Gate::denies('user_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $users = User::orderBy('name', 'asc')->paginate(10);
        return view('user.index', compact('users'));
    }
}
