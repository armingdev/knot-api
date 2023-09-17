<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatusEnum;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\CreditCard;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $validatedRequest = $request->validated();
        $creditCard = CreditCard::findOrFail($validatedRequest['credit_card_id']);
        Gate::authorize('create-task', $creditCard);

        $lastFinishedTask = Task::where('user_id', $validatedRequest['user_id'])
            ->where('merchant_id', $validatedRequest['merchant_id'])
            ->where('status', TaskStatusEnum::Finished)
            ->latest('created_at')
            ->first();

        if ($lastFinishedTask) {
            $validatedRequest['previous_credit_card_id'] = $lastFinishedTask->credit_card_id;
        }

        $task = Task::create($validatedRequest);

        return response()->json($task);
    }

    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json($task);
    }

    public function latestFinishedTasks(int $user_id): JsonResponse
    {
        $tasks = Task::where('user_id', $user_id)
            ->where('status', TaskStatusEnum::Finished)
            ->with([
                'merchant' => function ($query) {
                    $query->select(['merchants.id', 'merchants.name']);
                },
                'creditCard'
            ])
            ->latest('created_at')
            ->get();

        $latestTasks = $tasks->groupBy('merchant_id')->map(function ($merchantTasks) {
            return $merchantTasks->first();
        });

        return response()->json($latestTasks->values());
    }

}
