<?php

namespace App\Http\Livewire;

use DB;
use App\Http\Requests\UserRequest;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $first_name, $last_name, $documents, $document_type_id, $document_number, $phone_codes, $phone_code_id, $phone, $status, $email, $password, $password_confirmation, $user_id;
    public $addUser = false, $updateUser = false, $deleteUser = false;

    protected $listeners = ['render'];

    public function rules()
    {
        return UserRequest::rules($this->user_id);
    }

    public function resetFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->documents = '';
        $this->document_type_id = '';
        $this->document_number = '';
        $this->phone_codes = '';
        $this->phone_code_id = '';
        $this->phone = '';
        $this->status = '';
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
        $users = User::orderBy('first_name', 'asc')->paginate(10);
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
        $this->phone_codes  = Country::orderBy('name', 'asc')->get();
        $this->documents  = DocumentType::orderBy('name', 'asc')->get();
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
            'first_name'       => Str::title($this->first_name),
            'last_name'        => Str::title($this->last_name),
            'document_type_id' => $this->document_type_id,
            'document_number'  => $this->document_number,
            'phone_code_id'    => $this->phone_code_id,
            'phone'            => $this->phone,
            'email'            => Str::lower($this->email),
            'password'         => Hash::make($this->password),
        ]);
        $user->save();
        DB::commit();
        session()->flash('message', trans('message.Created Successfully.', ['name' => __('User')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/user');
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
            return redirect()->to('/user');
        } else {
            $this->resetValidationAndFields();
            $this->user_id          = $user->id;
            $this->first_name       = $user->first_name;
            $this->last_name        = $user->last_name;
            $this->documents        = DocumentType::orderBy('name', 'asc')->get();
            $this->document_type_id = $user->document_type_id;
            $this->document_number  = $user->document_number;
            $this->phone_codes      = Country::orderBy('name', 'asc')->get();
            $this->phone_code_id    = $user->phone_code_id;
            $this->phone            = $user->phone;
            $this->status           = $user->status;
            $this->email            = $user->email;
            $this->updateUser       = true;
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
        $user->first_name       = Str::title($this->first_name);
        $user->last_name        = Str::title($this->last_name);
        $user->document_type_id = $this->document_type_id;
        $user->document_number  = $this->document_number;
        $user->phone_code_id    = $this->phone_code_id;
        $user->phone            = $this->phone;
        $user->status           = $this->status;
        $user->email            = Str::lower($this->email);
        if (isset($this->password) || $this->password != '') {
            $user->password = Hash::make($this->password);
        }
        $user->save();
        DB::commit();
        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('User')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/user');
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
            return redirect()->to('/user');
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
        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('User')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/user');
    }
}