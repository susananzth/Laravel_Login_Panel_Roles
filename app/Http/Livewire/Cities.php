<?php

namespace App\Http\Livewire;

use DB;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Cities extends Component
{
    use WithPagination;

    public $states, $name, $city_id, $state_id;
    public $addCity = false, $updateCity = false, $deleteCity = false;

    protected $listeners = ['render'];

    public function rules()
    {
        return CityRequest::rules($this->state_id, $this->city_id);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->states = '';
        $this->state_id = '';
    }

    public function resetValidationAndFields()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->addCity = false;
        $this->updateCity = false;
        $this->deleteCity = false;
    }

    public function mount()
    {
        if (Gate::denies('city_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
    }

    public function render()
    {
        $cities = City::orderBy('name', 'asc')->paginate(10);
        return view('city.index', compact('cities'));
    }

    public function create()
    {
        if (Gate::denies('city_add')) {
            return redirect()->route('cities')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->resetValidationAndFields();
        $this->states  = State::orderBy('name', 'asc')->get();
        $this->addCity = true;
        return view('city.create');
    }

    public function store()
    {
        if (Gate::denies('city_add')) {
            return redirect()->route('cities')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->validate();

        DB::beginTransaction();
        $city = City::create([
            'name'     => $this->name,
            'state_id' => $this->state_id,
        ]);
        $city->save();
        DB::commit();
        session()->flash('message', trans('message.Created Successfully.', ['name' => __('City')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/city');
    }


    public function edit($id)
    {
        if (Gate::denies('city_edit')) {
            return redirect()->route('cities')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $city = City::find($id);

        if (!$city) {
            session()->flash('error', 'City not found');
            return redirect()->to('/city');
        } else {
            $this->resetValidationAndFields();
            $this->city_id    = $city->id;
            $this->name       = $city->name;
            $this->state_id   = $city->state_id;
            $this->states     = State::orderBy('name', 'asc')->get();
            $this->updateCity = true;
            return view('city.edit');
        }
    }

    public function update()
    {
        if (Gate::denies('city_edit')) {
            return redirect()->route('cities')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->validate();

        DB::beginTransaction();
        $city           = City::find($this->city_id);
        $city->name     = $this->name;
        $city->state_id = $this->state_id;
        $city->save();
        DB::commit();
        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('City')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/city');
    }

    public function cancel()
    {
        $this->resetValidationAndFields();
    }

    public function setDeleteId($id)
    {
        if (Gate::denies('city_delete')) {
            return redirect()->route('cities')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $city = City::find($id);
        if (!$city) {
            session()->flash('error', 'City not found');
            return redirect()->to('/city');
        } else {
            $this->city_id = $city->id;
            $this->resetValidationAndFields();
            $this->deleteCity = true;
        }
    }

    public function delete()
    {
        if (Gate::denies('city_delete')) {
            return redirect()->route('cities')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        DB::beginTransaction();
        City::findOrFail($this->city_id)->delete();
        DB::commit();
        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('City')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/city');
    }
}