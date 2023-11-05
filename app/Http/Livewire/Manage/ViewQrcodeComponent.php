<?php

namespace App\Http\Livewire\Manage;

use Livewire\Component;
use App\Models\chinavisa;

class ViewQrcodeComponent extends Component
{
    public $code;

    public function mount()
    {
        $this->code = request()->get('id');
    }
    public function render()
    {
        $data['chinavisa'] = chinavisa::where('code', $this->code)->where('is_active', 1)->first();
        return view('livewire.manage.view-qrcode-component', $data);
    }
}
