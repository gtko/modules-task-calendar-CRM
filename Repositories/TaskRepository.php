<?php


namespace Modules\TaskCalendarCRM\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\BaseCore\Contracts\Entities\UserEntity;
use Modules\BaseCore\Repositories\AbstractRepository;
use Modules\TaskCalendarCRM\Contracts\Repositories\TaskRepositoryContract;
use Modules\TaskCalendarCRM\Models\Task;

class TaskRepository extends AbstractRepository implements TaskRepositoryContract
{
    public function createTask(UserEntity $user, Carbon $start, string $title, string $content = "", string $url = "", int $duration = 0, string $color = null, $taskable = null, array $data = []): Task
    {
        $task = new Task();
        $task->user()->associate($user);
        $task->start = $start;
        $task->title = $title;
        $task->content = $content;
        $task->url = $url;
        $task->duration = $duration;
        $task->color = $color;
        $task->checked = false;
        $task->data = $data;
        if($taskable) {
            $task->taskable()->associate($taskable);
        }
        $task->save();

        return $task;
    }

    public function checkedTask(Task $task): Task
    {
        $task->checked = true;
        $task->save();

        return $task;
    }

    public function uncheckedTask(Task $task): Task
    {
        $task->checked = false;
        $task->save();

        return $task;
    }

    public function updateTask(Task $task, Carbon $start, string $title, string $content = "", string $url = "", int $duration = 0, string $color = null, array $data = []): Task
    {
        $task->start = $start;
        $task->title = $title;
        $task->content = $content;
        $task->url = $url;
        $task->duration = $duration;
        $task->color = $color;
        $task->data = $data;
        $task->save();

        return $task;
    }

    public function removeTask(Task $task): bool
    {
       return $task->delete();
    }

    public function getTaskToday(UserEntity $user): Collection
    {
        return Task::whereHas('user', function($query) use ($user){
                $query->where('user_id', $user->id);
            })
            ->where('checked', false)
            ->where('start', '>=', Carbon::now()->startOfDay())
            ->where('start', '<=', Carbon::now()->endOfDay())
            ->get();
    }

    public function getTaskChecked(UserEntity $user): Collection
    {
        return Task::whereHas('user', function($query) use ($user){
            $query->where('user_id', $user->id);
        })->where('checked', true)->get();
    }

    public function getTaskUnChecked(UserEntity $user): Collection
    {
        return Task::whereHas('user', function($query) use ($user){
            $query->where('user_id', $user->id);
        })->where('checked', false)->get();
    }

    public function getTaskById(int $id): Task
    {
        return $this->getModel()::find($id);
    }

    public function searchQuery(Builder $query, string $value, mixed $parent = null): Builder
    {
        $query->where(function($query) use ($value){
                $query->where("title", 'LIKE', "%$value%")
                    ->orWhere("content", 'LIKE', "%$value%");
            })
            ->where("user_id", Auth::id());


        $query = $this->searchDates($query, $value);
        $query = $this->searchDates($query, $value, 'start');

        return $query;
    }

    public function getModel(): Model
    {
       return new Task();
    }

    public function checkTaskByTaskable(UserEntity $user, $taskable)
    {
        $tasks = $this->newQuery()
            ->whereHasMorph(
            'taskable',
            [$taskable::class],
            function (Builder $query) use ($taskable) {
                $query->where('taskable_id', $taskable->id);
            }
            )
            ->where('user_id', $user->id)
            ->get();


        foreach($tasks as $task) {
            $task->checked = true;
            $task->save();
        }

    }
}
