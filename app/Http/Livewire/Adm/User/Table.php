<?php
namespace App\Http\Livewire\Adm\User;

use App\Http\Repositories\UserRepository;
use App\Traits\WithModal;
use App\Traits\WithToast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

use Livewire\WithPagination;
use Illuminate\Support\Str;

class Table extends Component
{
    use WithModal, WithToast, WithPagination;

    protected $listeners = [
        'updatedSearch',
        'updatedLimit',
        'updatedTableUser' => '$refresh'
    ];

    public string $search = '';
    public int $limit = 10;

    private UserRepository $userRepository;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->userRepository = new UserRepository();
    }

    /**
     * @return array|mixed
     */
    public function getUsers(): mixed
    {
        $userRepositoryReturn = $this->userRepository->index([], $this->limit);

        if ($userRepositoryReturn['code'] === 200) {
            return $userRepositoryReturn['data'];
        } else {
            $this->openToast($userRepositoryReturn['message'], $userRepositoryReturn['code']);
            return [];
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id): void
    {
        $userRepositoryReturn = $this->userRepository->delete($id);

        if ($userRepositoryReturn['code'] === 200) {
            $this->emit('updatedTableUser');
            $this->openToast($userRepositoryReturn['message']);
        } else {
            $this->openToast($userRepositoryReturn['message'], $userRepositoryReturn['code']);
        }
        $this->closeModal();
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        $response = new Str();
        $response->itens = $this->getUsers();

        return view('livewire.adm.user.table', ['response' => $response]);
    }
}
