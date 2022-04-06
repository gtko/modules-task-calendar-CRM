<x-basecore::app-layout>
<div class="intro-y flex flex-col sm:flex-row items-center justify-between mt-8">
    <h2 class="text-lg font-medium mr-auto">Tâches</h2>
    <div>
        <a href="{{ route('tasks.create') }}" type="button" class="btn btn-primary w-full mt-2">
            @icon('addCircle', null, 'w-4 h-4 mr-2') Ajouter une tâche
        </a>
    </div>
</div>
        <div class="box p-5 mt-5">
            <livewire:taskcalendarcrm::task-calendar/>
        </div>
</x-basecore::app-layout>
