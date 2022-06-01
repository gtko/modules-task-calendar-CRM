<?php

namespace Modules\TaskCalendarCRM\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\BaseCore\Actions\Dates\ComputedDiffDateInSeconds;
use Modules\TaskCalendarCRM\Contracts\Repositories\TaskRepositoryContract;

class TaskCalendar extends Component
{

    /**
     * @param int $task_id
     * @param string $startDate
     * @param string $endDate
     */
    public function moveResize(int $task_id, string $startDate, string $endDate)
    {
        $taskRep = app(TaskRepositoryContract::class);
        $task = $taskRep->getTaskById($task_id);
        $dates = (new ComputedDiffDateInSeconds())->getDates($startDate, $endDate);

        $taskRep->updateTask(
            $task,
            $dates['start'],
            $task->title,
            $task->content,
            $task->url,
            $dates['duration']
        );

        $this->emit('TaskChecked');
    }

    public function redirectLink(int $task_id){
        $taskRep = app(TaskRepositoryContract::class);
        $task = $taskRep->getTaskById($task_id);
        if($task->url){
            return $task->url;
        }

    }

    public function redirectTask(int $task_id)
    {
        $taskRep = app(TaskRepositoryContract::class);
        $task = $taskRep->getTaskById($task_id);

        return redirect()->route('tasks.edit', $task);
    }

    public function checkTask(int $task_id)
    {
        $taskRep = app(TaskRepositoryContract::class);
        $task = $taskRep->getTaskById($task_id);
        $taskRep->checkedTask($task);
        $this->emit('TaskChecked');
    }

    /**
     * Get the views / contents that represent the component.
     *
     * @param TaskRepositoryContract $taskRep
     * @return Application|Factory|View
     */

    public function render(TaskRepositoryContract $taskRep): View|Factory|Application
    {
        return view('taskcalendarcrm::livewire.task-calendar', [
            'tasks' =>  $taskRep->getTaskUnChecked(Auth::user())
        ]);
    }
}
