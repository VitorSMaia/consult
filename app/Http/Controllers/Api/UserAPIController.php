<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserAPIController extends Controller
{
    private UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index(): JsonResponse
    {
        try {
            $filters = [];
            $returnUserRepository = $this->userRepository->index($filters);

            return response()->json($returnUserRepository);

        }catch (Exception $exception){
            Log::error('[UserAPIController][index] => ' . $exception->getMessage());
            return response()->json([]);
        }
    }

    public function find()
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}