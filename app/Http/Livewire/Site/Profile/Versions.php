<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Version;
use Livewire\Component;
use Livewire\WithPagination;

class Versions extends Component
{
    use WithPagination;

    public $status = 'all';
    public $ids;

    public function mount()
    {
        $this->ids = auth()->user()->products()->pluck('id');
    }

    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }

    public function render()
    {
        $versions = Version::whereIn('product_id', $this->ids)->filter($this->status)->with('product')->latest()->paginate(10);
        return view('livewire.site.profile.versions', ['versions' => $versions])->layout('layouts.profile');
    }
}
