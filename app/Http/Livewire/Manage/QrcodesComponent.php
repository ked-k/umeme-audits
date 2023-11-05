<?php

namespace App\Http\Livewire\Manage;

use App\Models\chinavisa;
use Livewire\Component;
use Livewire\WithPagination;

class QrcodesComponent extends Component
{

    use WithPagination;

    public $perPage = 15;

    public $search = '';

    public $orderBy = 'name';

    public $orderAsc = true;
    public $createNew = false;
    public $name;

    public $mode = 'add';

    public $delete_id;

    public $edit_id;

    public $iteration = 1;

    public $template;

    public $page_title;

    public $date_from;
    public $date_to;
    public $contact;
    public $top_code = 350500522023000023;
    public $code;
    public $actors = 12;
    public $no_days = 90;
    public $is_active = 1;

    protected $paginationTheme = 'bootstrap';

    public function export()
    {
        // return (new chinavisasExport())->download('chinavisas.xlsx');
    }
    public function updatedCreateNew()
    {
        $this->resetInputs();
        $this->mode = 'add';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->page_title = 'Sample Types';
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code' => 'required|unique:chinavisas',
            'is_active' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'contact' => 'required',
            'top_code' => 'required',
            'actors' => 'required',
            'is_active' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'code' => 'required|unique:chinavisas',
            'is_active' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'no_days' => 'required',
            'contact' => 'required',
            'top_code' => 'required',
            'actors' => 'required',
            'is_active' => 'required',
        ]);

         // Generate a random string of your desired length
         $length = 24; // You can adjust the length as needed
         $randomString = bin2hex(random_bytes($length));
 
         // Encode the random string to Base64
         $this->code = base64_encode($randomString);
        $chinavisa = new chinavisa();
        $chinavisa->date_from = $this->date_from;
        $chinavisa->date_to = $this->date_to;
        $chinavisa->contact = $this->contact;
        $chinavisa->top_code = $this->top_code;
        $chinavisa->code = $this->code;
        $chinavisa->actors = $this->actors;
        $chinavisa->is_active = $this->is_active;
        $chinavisa->save();

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'chinavisa created successfully!']);
    }
    public function editData(chinavisa $chinavisa)
    {
        $this->edit_id = $chinavisa->id;
        $this->no_days = $chinavisa->no_days;
        $this->date_from = $chinavisa->date_from;
        $this->date_to = $chinavisa->date_to;
        $this->no_days = $chinavisa->no_days;
        $this->contact = $chinavisa->contact;
        $this->top_code = $chinavisa->top_code;
        $this->code = $chinavisa->code;
        $this->actors = $chinavisa->actors;
        $this->is_active = $chinavisa->is_active;
        $this->mode = 'edit';
        //$this->dispatchBrowserEvent('edit-modal');
    }

    public function resetInputs()
    {
        $this->reset([
            'code',
            'is_active',
            'date_from',
            'date_to',
            'contact',
            'top_code',
            'actors',
            'is_active',
            'no_days'
            
        ]);
        $this->mode = 'add';
    }

    public function updateData()
    {
        $this->validate([
            'code' => 'required|unique:chinavisas,code,' . $this->edit_id . '',
            'is_active' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'contact' => 'required',
            'top_code' => 'required',
            'actors' => 'required',
            'is_active' => 'required',
            'no_days' => 'required',
        ]);

        $chinavisa = chinavisa::find($this->edit_id);
        $chinavisa->date_from = $this->date_from;
        $chinavisa->date_to = $this->date_to;
        $chinavisa->no_days = $this->no_days;
        $chinavisa->contact = $this->contact;
        $chinavisa->top_code = $this->top_code;
        $chinavisa->code = $this->code;
        $chinavisa->actors = $this->actors;
        $chinavisa->is_active = $this->is_active;
        $chinavisa->update();

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'chinavisa updated successfully!']);
    }

    public function refresh()
    {
        return redirect(request()->header('Referer'));
    }

    public function cancel()
    {
        $this->delete_id = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function render()
    {
        $data['chinavisas'] = chinavisa::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.manage.qrcodes-component', $data);
    }
}
