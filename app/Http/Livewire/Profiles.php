<?php

namespace App\Http\Livewire;

use DB;

use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\State;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profiles extends Component
{
    use WithFileUploads;

    public $user, $first_name, $last_name, $image, $imageEdit, $documents, $document_type_id, $document_number;
    public $countries, $country_id, $states, $state_id, $cities, $city_id, $address;
    public $phone_codes, $phone_code_id, $phone, $email, $user_id;
    public $current_password, $password, $password_confirmation, $password_delete;
    public $deleteProfile = false, $update_passowrd = false, $delete_profile = false;

    protected $listeners = ['render'];

    //#[Layout('layouts.app-profile')] 
    #[Title('Profile')]
    public function rules()
    {
        return ProfileRequest::rules($this->user_id, $this->update_passowrd);
    }

    public function mount()
    {
        if (Gate::denies('profile_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
    }

    public function render()
    {
        $user = Auth::user();

        $this->user             = $user;
        $this->user_id          = $user->id;
        $this->first_name       = $user->first_name;
        $this->last_name        = $user->last_name;
        $this->imageEdit        = $user->image->url ?? '';
        $this->documents        = DocumentType::orderBy('name', 'asc')->get();
        $this->document_type_id = $user->document_type_id;
        $this->document_number  = $user->document_number;
        $this->countries        = Country::orderBy('name', 'asc')->get();
        $this->country_id       = $user->country_id;
        $this->states           = [];
        $this->state_id         = $user->state_id;
        $this->cities           = [];
        $this->city_id          = $user->city_id;
        $this->address          = $user->address;
        $this->phone_codes      = $this->countries;
        $this->phone_code_id    = $user->phone_code_id;
        $this->phone            = $user->phone;
        $this->email            = $user->email;

        return view('profile.edit', $user);
    }

    public function update()
    {
        if (Gate::denies('profile_edit')) {
            return redirect()->route('profiles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->update_passowrd = false;

        $this->validate();

        $user = Auth::user();

        DB::beginTransaction();
        $user->first_name       = Str::title($this->first_name);
        $user->last_name        = Str::title($this->last_name);
        $user->document_type_id = $this->document_type_id;
        $user->document_number  = $this->document_number;
        $user->phone_code_id    = $this->phone_code_id;
        $user->phone            = $this->phone;
        $user->email            = Str::lower($this->email);
        $user->city_id          = $this->city_id;
        $user->address          = $this->address;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if (gettype($this->image) != 'string' && $this->image != '') {
            $file = $this->image->storePublicly('public/images');
            $this->image = substr($file, strlen('public/images/'));
            if (Storage::exists('public/images/'.$user->image->url)) {
                Storage::delete('public/images/'.$user->image->url);
            }
            $user->image->url = $this->image;
            $user->image->save();
        }
        DB::commit();

        return redirect()->route('profiles')
            ->with('message', trans('message.Updated Successfully.', ['name' => __('Profile')]))
            ->with('alert_class', 'success');
    }

    public function countryChange($country_id)
    {
        if ($country_id != '') {
            $this->states = State::where('country_id', $country_id)->get();
        } else {
            $this->states = [];
            $this->state_id = '';
            $this->cities = [];
            $this->city_id = '';
        }
    }

    public function stateChange($state_id)
    {
        if ($state_id != '') {
            $this->cities = City::where('state_id', $state_id)->get();
        } else {
            $this->cities = [];
            $this->city_id = '';
        }
    }

    public function passwordUpdate()
    {
        if (Gate::denies('profile_edit')) {
            return redirect()->route('profiles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->update_passowrd = true;

        $this->validate();
        $user = Auth::user();

        DB::beginTransaction();
        $user->password = Hash::make($this->password);
        $user->save();
        DB::commit();

        return redirect()->route('profiles')
            ->with('message', trans('message.Updated Successfully.', ['name' => __('Password')]))
            ->with('alert_class', 'success');
    }

    public function setDeleteId()
    {
        if (Gate::denies('profile_delete')) {
            return redirect()->route('profiles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->deleteProfile = true;
    }

    public function delete(Request $request)
    {
        if (Gate::denies('profile_delete')) {
            return redirect()->route('profiles')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        DB::beginTransaction();
        $validated = $this->validate([ 
            'password_delete' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        if ($user->image && Storage::exists('public/images/'.$user->image->url)) {
            Storage::delete('public/images/'.$user->image->url);
        }
        $user->image()->delete();
        $user->roles()->detach();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        DB::commit();

        return redirect('/');
    }
}