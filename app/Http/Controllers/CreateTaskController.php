<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateNewTask;
use App\DTO\TaskDTO;
use App\Http\Resources\TaskResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

final class CreateTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CreateNewTask $taskCreator)
    {
        try {
            $task = $taskCreator->create(
                TaskDTO::fromArray($request->all())
            );

        } catch (ValidationException $th) {
            return response()->json([
                'errors' => [
                    'message' => $th->getMessage(),
                ],
            ], $th->status);
        } catch (Exception $th) {
            return response()->json([
                'errors' => [
                    'message' => 'An unexpected error occurred.',
                ],
            ], 500);
        }
        
        return new TaskResource($task);
    }
}
