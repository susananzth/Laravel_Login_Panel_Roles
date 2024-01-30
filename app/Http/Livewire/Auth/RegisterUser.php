<?php

namespace App\Http\Livewire\Auth;

use DB;

use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\State;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\UserRequest;
use Illuminate\Auth\Events\Registered;
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

class RegisterUser extends Component
{
    use WithFileUploads;

    public $user, $first_name, $last_name, $image, $imageEdit, $documents, $document_type_id, $document_number;
    public $countries, $country_id, $states, $state_id, $cities, $city_id, $address, $status;
    public $phone_codes, $phone_code_id, $phone, $email, $user_id, $password, $password_confirmation;

    protected $listeners = ['render'];

    #[Layout('layouts.guest')] 
    #[Title('Profile')]
    public function rules()
    {
        return UserRequest::rules();
    }

    public function resetFields()
    {
        $this->first_name       = '';
        $this->last_name        = '';
        $this->imageEdit        = '';
        $this->documents        = DocumentType::orderBy('name', 'asc')->get();
        $this->document_type_id = '';
        $this->document_number  = '';
        $this->countries        = Country::orderBy('name', 'asc')->get();
        $this->country_id       = '';
        $this->states           = [];
        $this->state_id         = '';
        $this->cities           = [];
        $this->city_id          = '';
        $this->address          = '';
        $this->phone_codes      = $this->countries;
        $this->phone_code_id    = '';
        $this->phone            = '';
        $this->email            = '';
        $this->status           = true;
    }

    public function mount()
    {
        $this->resetFields();
        $this->documents   = DocumentType::orderBy('name', 'asc')->get();
        $this->countries   = Country::orderBy('name', 'asc')->get();
        $this->phone_codes = $this->countries;
    }

    public function render()
    {
        return view('auth.register');
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        $user = User::create([
            'first_name'       => Str::title($this->first_name),
            'last_name'        => Str::title($this->last_name),
            'document_type_id' => $this->document_type_id,
            'document_number'  => $this->document_number,
            'city_id'          => $this->city_id,
            'address'          => $this->address,
            'phone_code_id'    => $this->phone_code_id,
            'phone'            => $this->phone,
            'email'            => Str::lower($this->email),
            'password'         => Hash::make($this->password),
        ]);

        $user->save();
        DB::commit();

        event(new Registered($user));

        Auth::login($user);

        DB::beginTransaction();
        if ($this->image != '') {
            if ($user->image) {
                if (Storage::exists('public/images/'.$user->image->url)) {
                    Storage::delete('public/images/'.$user->image->url);
                }
                $user->image->delete();
            }
            $file = $this->image->storePublicly('public/images');
            $user->image()->create([
                'url' => substr($file, strlen('public/images/')),
            ]);
        }
        DB::commit();

        return redirect(RouteServiceProvider::HOME);
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
}