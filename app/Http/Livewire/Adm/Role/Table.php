<?php
namespace App\Http\Livewire\Adm\Role;

use App\Http\Repositories\RoleRepository;
use App\Traits\WithToast;
use App\Traits\WithModal;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Table extends Component
{
    use WithToast, WithModal, WithPagination;

    protected $listeners = [
        'updatedSearch' => 'refreshData',
        'updatedLimit' => 'refreshData',
        'updatedTableRole' => '$refresh',
        'deletedRole' => '$refresh'
    ];

    public $search = null;

    protected $paginationTheme = 'bootstrap'; // Defina o tema de paginação conforme necessário

    /**
     * @return void
     */
    public function refreshData(): void
    {
        $this->resetPage(); // Resetar a página para refletir a nova busca ou limite
    }

    /**
     * @return array|mixed
     */
    protected function getPermission()
    {
        $permissionRepository = new RoleRepository();
        $response = $permissionRepository->index($this->search);

        if ($response['code'] === 200) {
            return $response['data'];
        } else {
            return []; // Retorna um array vazio em caso de erro
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id) : void
    {
        $permissionRepository = new RoleRepository();
        $response = $permissionRepository->delete($id);

        $this->openToast($response['message'], $response['code']);
        $this->emit('updatedTableRole');
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        $permissions = $this->getPermission();

        return view('livewire.adm.role.table', ['permissions' => $permissions]);
    }
}

