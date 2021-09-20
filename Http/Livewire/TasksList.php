<?php

namespace Modules\TaskCalendarCRM\Http\Livewire;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Modules\TaskCalendarCRM\Contracts\Repositories\TaskRepositoryContract;

class TasksList extends Component
{

    protected $listeners = [
        'TaskChecked' => '$refresh'
    ];

    /**
     * Get the views / contents that represent the component.
     *
     * @return View|string
     */
    public function render(TaskRepositoryContract $taskRep): string|View
    {
        return view('taskcalendarcrm::livewire.tasks-list', [
            'tasks' =>  $taskRep->getTaskToday(Auth::user())
        ]);
    }
}
