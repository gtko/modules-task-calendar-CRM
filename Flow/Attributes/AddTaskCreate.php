<?php

namespace Modules\TaskCalendarCRM\Flow\Attributes;

use Modules\CoreCRM\Contracts\Entities\DevisEntities;
use Modules\CoreCRM\Flow\Attributes\Attributes;
use Modules\CoreCRM\Flow\Interfaces\FlowAttributes;
use Modules\TaskCalendarCRM\Models\Task;

class AddTaskCreate extends Attributes
{
    public function __construct(
        public Task $task
    ){
        parent::__construct();
    }

    public static function instance(array $value): FlowAttributes
    {
        return new AddTaskCreate(Task::where('id', $value['task'])->first());
    }

    public function toArray(): array
    {
        return [
            'task' => $this->task->id
        ];
    }


    /**
     * @return \Modules\TaskCalendarCRM\Models\Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

}
