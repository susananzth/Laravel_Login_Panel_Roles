<?php

namespace App\Http\Livewire;

use DB;
use App\Http\Requests\StateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class States extends Component
{
    use WithPagination;

    public $countries, $name, $iso_2, $state_id, $country_id;
    public $addState = false, $updateState = false, $deleteState = false;

    protected $listeners = ['render'];

    public function rules()
    {
        return StateRequest::rules($this->state_id);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->countries = '';
        $this->iso_2 = '';
        $this->country_id = '';
    }

    public function resetValidationAndFields()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->addState = false;
        $this->updateState = false;
        $this->deleteState = false;
    }

    public function mount()
    {
        if (Gate::denies('state_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
    }

    public function render()
    {
        $states = State::orderBy('name', 'asc')->paginate(10);
        return view('state.index', compact('states'));
    }

    public function create()
    {
        if (Gate::denies('state_add')) {
            return redirect()->route('states')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->resetValidationAndFields();
        $this->countries = Country::orderBy('name', 'asc')->get();
        $this->addState = true;
        return view('state.create');
    }

    public function store()
    {
        if (Gate::denies('state_add')) {
            return redirect()->route('states')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->validate();

        DB::beginTransaction();
        $state = State::create([
            'name'       => $this->name,
            'iso_2'      => $this->iso_2 ? $this->iso_2 : null,
            'country_id' => $this->country_id,
        ]);
        $state->save();
        DB::commit();
        session()->flash('message', trans('message.Created Successfully.', ['name' => __('State')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/state');
    }


    public function edit($id)
    {
        if (Gate::denies('state_edit')) {
            return redirect()->route('states')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $state = State::find($id);

        if (!$state) {
            session()->flash('error', 'State not found');
            return redirect()->to('/state');
        } else {
            $this->resetValidationAndFields();
            $this->state_id    = $state->id;
            $this->name        = $state->name;
            $this->iso_2       = $state->iso_2;
            $this->country_id  = $state->country_id;
            $this->countries   = Country::orderBy('name', 'asc')->get();
            $this->updateState = true;
            return view('state.edit');
        }
    }

    public function update()
    {
        if (Gate::denies('state_edit')) {
            return redirect()->route('states')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->validate();

        DB::beginTransaction();
        $state             = State::find($this->state_id);
        $state->name       = $this->name;
        $state->iso_2      = $this->iso_2;
        $state->country_id = $this->country_id;
        $state->save();
        DB::commit();
        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('State')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/state');
    }

    public function cancel()
    {
        $this->resetValidationAndFields();
    }

    public function setDeleteId($id)
    {
        if (Gate::denies('state_delete')) {
            return redirect()->route('states')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $state = State::find($id);
        if (!$state) {
            session()->flash('error', 'State not found');
            return redirect()->to('/state');
        } else {
            $this->state_id = $state->id;
            $this->resetValidationAndFields();
            $this->deleteState = true;
        }
    }

    public function delete()
    {
        if (Gate::denies('state_delete')) {
            return redirect()->route('states')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        DB::beginTransaction();
        State::findOrFail($this->state_id)->delete();
        DB::commit();
        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('State')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/state');
    }
}