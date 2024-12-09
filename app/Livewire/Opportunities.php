<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Opportunities extends Component
{
    use WithPagination;

    #[Url(as: 'per_page', except: '')]
    public ?int $perPage = 20;

    public ?array $options = [20, 50, 100, 250, 500];

    public ?string $search = '';
    
    public ?string $sortDirection = 'asc';

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $items = Item::query()
            ->when($this->search, fn ($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->when($this->sortDirection, fn ($query) => $query->orderBy('id', $this->sortDirection))
            ->when($this->perPage, fn ($query) => $query->paginate($this->perPage));

        return view('livewire.opportunities', [
            'items' => $items,
        ]);
    }
}
