<x-basecore::app-layout>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Tâches</h2>
</div>
<div class="grid grid-cols-12 gap-5 mt-5">
    <!-- BEGIN: Calendar Side Menu -->
    <div class="col-span-12 xl:col-span-4 xxl:col-span-3">
        <div class="box p-5 intro-y">
            <a href="{{ route('tasks.create') }}" type="button" class="btn btn-primary w-full mt-2">
                <i class="w-4 h-4 mr-2" data-feather="edit-3"></i> Ajouter une tâche
            </a>
            <div class="border-t border-b border-gray-200 dark:border-dark-5 mt-6 mb-5 py-3" id="calendar-events">
                <livewire:taskcalendarcrm::tasks-list/>
            </div>
        </div>

    </div>
    <!-- END: Calendar Side Menu -->
    <!-- BEGIN: Calendar Content -->
    <div class="col-span-12 xl:col-span-8 xxl:col-span-9">
        <div class="box p-5">
            <livewire:taskcalendarcrm::task-calendar/>
        </div>
    </div>
    <!-- END: Calendar Content -->
</div>
</x-basecore::app-layout>
