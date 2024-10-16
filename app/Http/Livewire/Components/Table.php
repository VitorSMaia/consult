<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use App\Traits\WithToast;
use App\Traits\WithModal;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, WithModal, WithToast;
    public string $resource;
    public array $columns;
    public array $action;
    public string $title;
    public string $delete;
    public array $eagerLoading;

    protected $listeners = ['updateTable' => '$refresh'];

    public function render()
    {

        if($this->resource == 'Role') {
            $resource = app("Spatie\Permission\Models\\" . $this->resource);
        }else {
            $resource = app("App\Models\\" . $this->resource);
        }

        if (!empty($this->eagerLoading))
        {
            $resource = $resource->with($this->eagerLoading);
        }

        return view('livewire.components.table', [
            'items' => $resource->paginate(10)
        ]);
    }

    public function destroy($item)
    {
        if(Auth::check()) {
            $this->delete($item['id']);
        }
    }

    private function delete($id)
    {
        if($this->resource == 'Role') {
            $resource = app("Spatie\Permission\Models\\" . $this->resource);
        }else {
            $resource = app("App\Models\\" . $this->resource);
        }

        $resource->findOrFail($id)->delete();
    }
}
