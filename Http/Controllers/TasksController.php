<?php

namespace Modules\TaskCalendarCRM\Http\Controllers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\BaseCore\Actions\Dates\ComputedDiffDateInSeconds;
use Modules\BaseCore\Http\Controllers\Controller;
use Modules\TaskCalendarCRM\Contracts\Repositories\TaskRepositoryContract;
use Modules\TaskCalendarCRM\Http\Requests\TaskStoreRequest;
use Modules\TaskCalendarCRM\Http\Requests\TaskUpdateRequest;
use Modules\TaskCalendarCRM\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param TaskRepositoryContract $taskRep
     * @return Application|Factory|View
     */

    public function index(TaskRepositoryContract $taskRep): View|Factory|Application
    {
        return view('taskcalendarcrm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|View|Response
     */

    public function create(): View|Factory|Response|Application
    {
        return view('taskcalendarcrm::create');
    }

    /**
     * @param TaskStoreRequest $request
     * @param TaskRepositoryContract $taskRep
     * @return mixed
     */

    public function store(TaskStoreRequest $request, TaskRepositoryContract $taskRep): mixed
    {
        $dates = (new ComputedDiffDateInSeconds())->getDates($request->start ?? '', $request->end ?? '');

        $taskRep->createTask(
            Auth::user(),
            $dates['start'],
            $request->title,
            $request->description ?? '',
            $request->url ?? '',
            $dates['duration']
        );

        return redirect()
            ->route('tasks.index')
            ->withSuccess('Tâche crée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Task $task
     * @return Application|Factory|View
     */

    public function edit(Task $task): View|Factory|Application
    {
        return view('taskcalendarcrm::edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     * @param TaskUpdateRequest $request
     * @param Task $task
     * @param TaskRepositoryContract $taskRep
     * @return Response
     */

    public function update(TaskUpdateRequest $request, Task $task, TaskRepositoryContract $taskRep): Response
    {
        $dates = (new ComputedDiffDateInSeconds())->getDates($request->start ?? '', $request->end ?? '');

        $taskRep->updateTask(
            $task,
            $dates['start'],
            $request->title,
            $request->description ?? '',
            $request->url ?? '',
            $dates['duration']
        );

        return redirect()
            ->route('tasks.index')
            ->withSuccess('Tâche modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     * @param Task $task
     * @param TaskRepositoryContract $taskRep
     * @return Response
     */
    public function destroy(Task $task, TaskRepositoryContract $taskRep): Response
    {
        $taskRep->removeTask($task);
        return redirect()
            ->route('tasks.index')
            ->withSuccess('Tâche supprimé avec succès');
    }
}
