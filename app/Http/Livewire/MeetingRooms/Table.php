<?php

namespace App\Http\Livewire\MeetingRooms;

use App\Http\Repositories\MeetingRoomsRepository;
use App\Http\Repositories\UserRepository;
use App\Traits\WithModal;
use App\Traits\WithToast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{   use WithModal, WithToast, WithPagination;

    protected $listeners = [
        'updatedSearch',
        'updatedLimit',
        'updatedTableUser' => '$refresh'
    ];

    public string $search = '';
    public int $limit = 10;

    private MeetingRoomsRepository $meetingRoomsRepository;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->meetingRoomsRepository = new MeetingRoomsRepository();
    }

    /**
     * @return array|mixed
     */
    public function getData(): mixed
    {
        $dataReturn = $this->meetingRoomsRepository->index([], $this->limit);

        if ($dataReturn['code'] === 200) {
            return $dataReturn['data'];
        } else {
            $this->openToast($dataReturn['message'], $dataReturn['code']);
            return [];
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id): void
    {
        $dataReturn = $this->meetingRoomsRepository->delete($id);

        if ($dataReturn['code'] === 200) {
            $this->emit('updatedTableUser');
            $this->openToast($dataReturn['message']);
        } else {
            $this->openToast($dataReturn['message'], $dataReturn['code']);
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



        return view('livewire.meeting-rooms.table', ['response' => $response]);
    }
}
