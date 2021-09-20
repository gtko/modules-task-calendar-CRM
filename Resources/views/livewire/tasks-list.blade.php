<div>
    @forelse($tasks as $task)
        <div class="relative" key="{{$task->id}}">
            <div class="event p-3 -mx-3 cursor-pointer transition duration-300 ease-in-out hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md flex items-start">
                <livewire:task-check-action :task="$task" :key="$task->id.'_checked'"/>
                <div class="ml-2 pr-10">
                    <div class="event__title truncate">{{ $task->title }}</div>
                    <div class="text-gray-600 text-xs mt-0.5">
                        à {{$task->start->format('H:i')}} pour une durée de {{Carbon\CarbonInterval::seconds($task->duration)->cascade()->forHumans()}}
                    </div>
                </div>
            </div>
            <a class="flex items-center absolute top-0 bottom-0 my-auto right-0" href="{{route('tasks.edit', $task)}}">
                <i data-feather="edit" class="w-4 h-4 text-gray-600"></i>
            </a>
        </div>
    @empty
        <div class="text-gray-600 p-3 text-center " id="calendar-no-events">Aucune tâche en attente</div>
    @endforelse
</div>
