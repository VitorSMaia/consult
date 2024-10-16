<?php
namespace App\Http\Livewire\Adm\User;

use App\Http\Repositories\UserRepository;
use App\Traits\WithModal;
use App\Traits\WithToast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    use WithModal, WithToast;

    public array $roles = [];
    public ?int $idUser = null;
    public string $title = '';
    public array $state = [
        'name' => '',
        'password' => '',
        'password_confirmation' => '',
        'status' => 'Ativo',
        'office' => '',
        'company' => '',
        'permission' => ''
    ];

    private UserRepository $userRepository;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->userRepository = new UserRepository();
    }

    /**
     * @param $params
     * @return void
     */
    public function mount($params): void
    {
        if (isset($params['id'])) {
            $this->idUser = $params['id'];
            $this->state = $this->getUser();
            $this->state['permission'] = $this->state['roles'][0]['name'] ?? '';
        }
        $this->roles = Role::all()->toArray();
    }

    /**
     * @return mixed
     */
    public function getUser(): mixed
    {
        $userRepositoryReturn = $this->userRepository->find($this->idUser);

        if ($userRepositoryReturn['code'] === 200) {
            return $userRepositoryReturn['data'];
        } else {
            $this->openToast($userRepositoryReturn['message'], $userRepositoryReturn['code']);
            return [];
        }
    }

    /**
     * @return void
     * @throws ValidationException
     */
    public function save(): void
    {
        $request = $this->state;

        $userRepositoryReturn = $this->userRepository->updateOrCreate($request, $this->idUser);

        $this->emit('updatedTableUser');
        $this->openToast($userRepositoryReturn['message'], $userRepositoryReturn['code']);
        $this->closeModal();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.adm.user.form');
    }
}
