<?php

namespace Modules\TaskCalendarCRM\Http\Livewire;


use Illuminate\View\View;
use Livewire\Component;
use Modules\TaskCalendarCRM\Contracts\Repositories\TaskRepositoryContract;
use Modules\TaskCalendarCRM\Models\Task;

class TaskCheckAction extends Component
{

    public bool $checked;
    public int $task_id;

    protected array $rules = [
        'checked' => 'bool'
    ];

    public function mount(Task $task){
        $this->checked = $task->checked;
        $this->task_id = $task->id;
    }

    public function updatedChecked()
    {
        $taskRep = app(TaskRepositoryContract::class);
        $task = $taskRep->getTaskById($this->task_id);
        if($this->checked) {
            $taskRep->checkedTask($task);
            $this->emit("TaskRemove",$task->id);
        }else{
            $taskRep->uncheckedTask($task);
        }

        $this->emit("TaskChecked");
    }

    /**
     * Get the views / contents that represent the component.
     *
     * @return View|string
     */
    public function render(): string|View
    {
        return view('taskcalendarcrm::livewire.task-check-action');
    }
}
