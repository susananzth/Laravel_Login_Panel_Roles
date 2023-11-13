<?php

namespace App\Http\Livewire;

use DB;
use App\Http\Requests\CurrencyRequest;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Currencies extends Component
{
    use WithPagination;

    public $countries, $name, $iso_4, $symbol, $currency_id;
    public $addCurrency = false, $updateCurrency = false, $deleteCurrency = false;

    protected $listeners = ['render'];

    public function rules()
    {
        return CurrencyRequest::rules($this->currency_id);
    }

    public function resetFields()
    {
        $this->name = '';
        $this->iso_4 = '';
        $this->symbol = '';
        $this->countries = '';
    }

    public function resetValidationAndFields()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->addCurrency = false;
        $this->updateCurrency = false;
        $this->deleteCurrency = false;
    }

    public function mount()
    {
        if (Gate::denies('currency_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
    }

    public function render()
    {
        $currencies = Currency::orderBy('name', 'asc')->paginate(10);
        return view('currency.index', compact('currencies'));
    }

    public function create()
    {
        if (Gate::denies('currency_add')) {
            return redirect()->route('currencies')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->resetValidationAndFields();
        $this->countries  = Country::orderBy('name', 'asc')->get();
        $this->addCurrency = true;
        return view('currency.create');
    }

    public function store()
    {
        if (Gate::denies('currency_add')) {
            return redirect()->route('currencies')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->validate();

        DB::beginTransaction();
        $currency = Currency::create([
            'name'   => $this->name,
            'iso_4'  => $this->iso_4,
            'symbol' => $this->symbol,
        ]);
        $currency->countries()->attach($this->countries);
        $currency->save();
        DB::commit();
        session()->flash('message', trans('message.Created Successfully.', ['name' => __('Currency')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/currency');
    }


    public function edit($id)
    {
        if (Gate::denies('currency_edit')) {
            return redirect()->route('currencies')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $currency = Currency::find($id);

        if (!$currency) {
            session()->flash('error', 'Currency not found');
            return redirect()->to('/currency');
        } else {
            $this->resetValidationAndFields();
            $this->currency_id    = $currency->id;
            $this->name           = $currency->name;
            $this->iso_4          = $currency->iso_4;
            $this->symbol         = $currency->symbol;
            $this->countries      = Country::orderBy('name', 'asc')->get();
            $this->updateCurrency = true;
            return view('currency.edit');
        }
    }

    public function update()
    {
        if (Gate::denies('currency_edit')) {
            return redirect()->route('currencies')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->validate();

        DB::beginTransaction();
        $currency         = Currency::find($this->currency_id);
        $currency->name   = $this->name;
        $currency->iso_4  = $this->iso_4;
        $currency->symbol = $this->symbol;
        $currency->countries()->attach($this->countries);
        $currency->save();
        DB::commit();
        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('Currency')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/currency');
    }

    public function cancel()
    {
        $this->resetValidationAndFields();
    }

    public function setDeleteId($id)
    {
        if (Gate::denies('currency_delete')) {
            return redirect()->route('currencies')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $currency = Currency::find($id);
        if (!$currency) {
            session()->flash('error', 'Currency not found');
            return redirect()->to('/currency');
        } else {
            $this->currency_id = $currency->id;
            $this->resetValidationAndFields();
            $this->deleteCurrency = true;
        }
    }

    public function delete()
    {
        if (Gate::denies('currency_delete')) {
            return redirect()->route('currencies')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        DB::beginTransaction();
        Currency::findOrFail($this->currency_id)->delete();
        DB::commit();
        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('Currency')]));
        session()->flash('alert_class', 'success');

        return redirect()->to('/currency');
    }
}