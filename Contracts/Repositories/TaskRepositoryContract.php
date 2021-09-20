<?php


namespace Modules\TaskCalendarCRM\Contracts\Repositories;



use Modules\BaseCore\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Modules\TaskCalendarCRM\Models\Task;

interface TaskRepositoryContract
{
    /**
     * @param UserEntity $user
     * @param Carbon $start
     * @param string $title
     * @param string $content
     * @param string $url
     * @param int $duration
     * @return Task
     */
    public function createTask(UserEntity $user, Carbon $start, string $title, string $content = "", string $url = "", int $duration = 0 ):Task;

    /**
     * @param Task $task
     * @return Task
     */
    public function checkedTask(Task $task):Task;

    /**
     * @param Task $task
     * @return Task
     */
    public function uncheckedTask(Task $task):Task;

    /**
     * @param Task $task
     * @param Carbon $start
     * @param string $title
     * @param string $content
     * @param string $url
     * @param int $duration
     * @return Task
     */
    public function updateTask(Task $task,Carbon $start, string $title, string $content = "", string $url = "", int $duration = 0):Task;

    /**
     * @param Task $task
     * @return bool
     */
    public function removeTask(Task $task):bool;

    /**
     * @param UserEntity $user
     * @return Collection<int, Task>
     */
    public function getTaskToday(UserEntity $user):Collection;

    /**
     * @param UserEntity $user
     * @return Collection<Task>
     */
    public function getTaskChecked(UserEntity $user):Collection;

    /**
     * @param UserEntity $user
     * @return Collection<Task>
     */
    public function getTaskUnChecked(UserEntity $user):Collection;

    /**
     * @param int $id
     * @return Task
     */
    public function getTaskById(int $id):Task;
}
