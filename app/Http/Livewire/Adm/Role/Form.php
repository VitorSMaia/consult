<?php

namespace App\Http\Livewire\Adm\Role;

use App\Http\Repositories\RoleRepository;
use App\Traits\WithModal;
use App\Traits\WithToast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    use WithModal, WithToast;

    public array $roles = [];
    public ?int $idRole = null;
    public string $title = '';
    public array $state = [
        'name' => '',
        'guard_name' => 'web'
    ];

    private RoleRepository $roleRepository;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->roleRepository = new RoleRepository();
    }

    /**
     * @param array $params
     * @return void
     */
    public function mount(array $params): void
    {
        if (isset($params['id'])) {
            $this->idRole = $params['id'];
            $this->state = $this->getRole();
        }
        $this->roles = Role::all()->toArray(); // Carrega todos os papéis disponíveis
    }

    /**
     * @return array
     */
    public function getRole(): array
    {
        $roleRepositoryReturn = $this->roleRepository->find($this->idRole);

        if ($roleRepositoryReturn['code'] === 200) {
            return $roleRepositoryReturn['data'];
        } else {
            $this->openToast($roleRepositoryReturn['message'], $roleRepositoryReturn['code']);
            return [];
        }
    }

    /**
     * @return void
     */
    public function save(): void
    {
        $request = $this->state;

        $roleRepositoryReturn = $this->roleRepository->updateOrCreate($request, $this->idRole);

        $this->emit('updatedTableRole');
        $this->openToast($roleRepositoryReturn['message'], $roleRepositoryReturn['code']);
        $this->closeModal();
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('livewire.adm.role.form');
    }
}
