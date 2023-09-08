<?php

namespace App\Http\Livewire;

use DB;
use App\Http\Requests\DocumentTypeRequest;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentTypes extends Component
{
    use WithPagination;

    public $name, $document_type_id;
    public $addDocumentType = false, $updateDocumentType = false, $deleteDocumentType = false;

    protected $listeners = ['render'];

    public function rules()
    {
        return DocumentTypeRequest::rules($this->document_type_id);
    }

    public function resetFields()
    {
        $this->name = '';
    }

    public function resetValidationAndFields()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->addDocumentType = false;
        $this->updateDocumentType = false;
        $this->deleteDocumentType = false;
    }

    public function mount()
    {
        if (Gate::denies('document_type_index')) {
            return redirect()->route('dashboard')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
    }

    public function render()
    {
        $document_types = DocumentType::orderBy('name', 'asc')->paginate(10);
        return view('document_type.index', compact('document_types'));
    }

    public function create()
    {
        if (Gate::denies('document_type_add')) {
            return redirect()->route('document_types')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->resetValidationAndFields();
        $this->addDocumentType = true;
        return view('document_type.create');
    }

    public function store()
    {
        if (Gate::denies('document_type_add')) {
            return redirect()->route('document_types')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        $this->validate();

        DB::beginTransaction();
        $document_type = DocumentType::create([
            'name' => $this->name,
        ]);
        $document_type->save();
        DB::commit();

        $this->resetValidationAndFields();
        $this->emit('render');

        session()->flash('message', trans('message.Created Successfully.', ['name' => __('Document Type')]));
        session()->flash('alert_class', 'success');
    }


    public function edit($id)
    {
        if (Gate::denies('document_type_edit')) {
            return redirect()->route('document_types')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $document_type = DocumentType::find($id);

        if (!$document_type) {
            session()->flash('error','Document Type not found');
            $this->emit('render');
        } else {
            $this->resetValidationAndFields();
            $this->document_type_id   = $document_type->id;
            $this->name               = $document_type->name;
            $this->updateDocumentType = true;
            return view('document_type.edit');
        }
    }

    public function update()
    {
        if (Gate::denies('document_type_edit')) {
            return redirect()->route('document_types')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $this->validate();

        DB::beginTransaction();
        $document_type       = DocumentType::find($this->document_type_id);
        $document_type->name = $this->name;
        $document_type->save();
        DB::commit();

        $this->resetValidationAndFields();
        $this->emit('render');

        session()->flash('message', trans('message.Updated Successfully.', ['name' => __('Document Type')]));
        session()->flash('alert_class', 'success');
    }

    public function cancel()
    {
        $this->resetValidationAndFields();
    }

    public function setDeleteId($id)
    {
        if (Gate::denies('document_type_delete')) {
            return redirect()->route('document_types')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }

        $document_type = DocumentType::find($id);
        if (!$document_type) {
            session()->flash('error','Document Type not found');
            $this->emit('render');
        } else {
            $this->document_type_id = $document_type->id;
            $this->resetValidationAndFields();
            $this->deleteDocumentType = true;
        }
    }

    public function delete()
    {
        if (Gate::denies('document_type_delete')) {
            return redirect()->route('document_types')
                ->with('message', trans('message.You do not have the necessary permissions to execute the action.'))
                ->with('alert_class', 'danger');
        }
        DB::beginTransaction();
        DocumentType::findOrFail($this->document_type_id)->delete();
        DB::commit();
        $this->resetValidationAndFields();
        $this->emit('render');

        session()->flash('message', trans('message.Deleted Successfully.', ['name' => __('Document Type')]));
        session()->flash('alert_class', 'success');
    }
}
