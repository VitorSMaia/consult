<?php

namespace App\Http\Livewire\Adm\Role\Permission;


use App\Http\Repositories\RoleRepository;
use App\Models\GroupPermission;
use App\Traits\WithModal;
use App\Traits\WithToast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class Form extends Component
{
    use WithModal, WithToast;

    public array $groupPermission = [];
    public array $state = [];
    public ?int $idRole = null;

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
        $this->idRole = $params['id'] ?? null;
        $this->loadGroupPermissions();
        $this->initializeState();
    }

    /**
     * Carrega as permissões do grupo
     *
     * @return void
     */
    private function loadGroupPermissions(): void
    {
        $this->groupPermission = GroupPermission::query()
            ->with('permission.roles')
            ->get()
            ->toArray();
    }

    /**
     * Inicializa o estado das permissões com base no papel
     *
     * @return void
     */
    private function initializeState(): void
    {
        foreach ($this->groupPermission as $group) {
            foreach ($group['permission'] as $permission) {
                foreach ($permission['roles'] as $role) {
                    if ($role['pivot']['role_id'] == $this->idRole) {
                        $this->state[$permission['name']] = true;
                    }
                }
            }
        }
    }

    /**
     * Salva as permissões associadas ao papel
     *
     * @return void
     */
    public function save(): void
    {
        $response = $this->roleRepository->sync($this->idRole, $this->state);

        $this->emit('updatedTableRole');
        $this->openToast($response['message'], $response['code'] ?? 200);
        $this->closeModal();
    }

    /**
     * Renderiza a visualização do formulário
     *
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('livewire.adm.role.permission.form');
    }
}
