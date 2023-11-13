<?php

namespace App\Http\Livewire;

use DB;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Countries extends Component
{
    use WithPagination;

    public $name, $iso_2, $iso_3, $iso_number, $phone_code, $country_id;
    public $addCountry = false, $updateCountry = false, $deleteCountry = false;

    protected $listeners = ['render'];

    public function rules()
    {
        return CountryRequest::rules($this->country_id);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->iso_2 = '';
        $this->iso_3 = '';
        $this->iso_number = '';
        $this->phone_code = '';
    }

    public function resetValidationAndFields()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->addCountry = false;
        $this->updateCountry = false;
        $this->deleteCountry = false;
    }

    public function mount()
    {
        if (Gate::denies('country_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
    }

    public function render()
    {
        $countries = Country::orderBy('name', 'asc')->paginate(10);
        return view('country.index', compact('countries'));
    }

    public function create()
    {
        if (Gate::denies('country_add')) {
            return redirect()->route('countries')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->resetValidationAndFields();
        $this->addCountry = true;
        return view('country.create');
    }

    public function store()
    {
        if (Gate::denies('country_add')) {
            return redirect()->route('countries')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->validate();

        DB::beginTransaction();
        $country = Country::create([
            'name'       => $this->name,
            'iso_2'      => $this->iso_2 ? $this->iso_2 : null,
            'iso_3'      => $this->iso_3 ? $this->iso_3 : null,
            'iso_number' => $this->iso_number ? $this->iso_number : null,
            'phone_code' => $this->phone_code,
        ]);
        $country->save();
        DB::commit();
        session()->flash('message', trans('message.Created Successfully.', ['name' => __('Country')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/country');
    }


    public function edit($id)
    {
        if (Gate::denies('country_edit')) {
            return redirect()->route('countries')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $country = Country::find($id);

        if (!$country) {
            session()->flash('error','Country not found');
            return redirect()->to('/country');
        } else {
            $this->resetValidationAndFields();
            $this->country_id    = $country->id;
            $this->name          = $country->name;
            $this->iso_2         = $country->iso_2;
            $this->iso_3         = $country->iso_3;
            $this->iso_number    = $country->iso_number;
            $this->phone_code    = $country->phone_code;
            $this->updateCountry = true;
            return view('country.edit');
        }
    }

    public function update()
    {
        if (Gate::denies('country_edit')) {
            return redirect()->route('countries')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->validate();

        DB::beginTransaction();
        $country             = Country::find($this->country_id);
        $country->name       = $this->name;
        $country->iso_2      = $this->iso_2;
        $country->iso_3      = $this->iso_3;
        $country->iso_number = $this->iso_number;
        $country->phone_code = $this->phone_code;
        $country->save();
        DB::commit();
        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('Country')]));
        session()->flash('alert_class', 'success');
        
        return redirect()->to('/country');
    }

    public function cancel()
    {
        $this->resetValidationAndFields();
    }

    public function setDeleteId($id)
    {
        if (Gate::denies('country_delete')) {
            return redirect()->route('countries')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $country = Country::find($id);
        if (!$country) {
            session()->flash('error','Country not found');
            return redirect()->to('/country');
        } else {
            $this->country_id = $country->id;
            $this->resetValidationAndFields();
            $this->deleteCountry = true;
        }
    }

    public function delete()
    {
        if (Gate::denies('country_delete')) {
            return redirect()->route('countries')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        DB::beginTransaction();
        Country::findOrFail($this->country_id)->delete();
        DB::commit();
        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('Country')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/country');
    }
}