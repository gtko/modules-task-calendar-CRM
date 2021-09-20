<x-basecore::app-layout>
    <x-slot name="breadcrumb">
        <x-basecore::breadcrumb-item :href="route('tasks.index')">Tâches</x-basecore::breadcrumb-item>
        <x-basecore::breadcrumb-item>Modifier une tâche</x-basecore::breadcrumb-item>
    </x-slot>

    <x-basecore::layout.panel-left>
        <x-basecore::partials.card>
            <x-slot name="title">
                <a href="{{ route('tasks.index') }}" class="mr-4"
                ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
            </x-slot>
            <x-basecore::form
                method="PUT"
                action="{{ route('tasks.update', $task) }}"
                class="mt-4"
            >

                @include("taskcalendarcrm::form")

                <div class="mt-5 flex justify-between items-center">
                    <a href="{{ route('tasks.index') }}" class="button">
                        <i
                            class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                        ></i>
                        @lang('basecore::crud.common.back')
                    </a>

                    <x-basecore::button type="submit">
                        <i class="mr-1 icon ion-md-save"></i>
                        @lang('basecore::crud.common.save')
                    </x-basecore::button>
                </div>
            </x-basecore::form>
        </x-basecore::partials.card>
    </x-basecore::layout.panel-left>
</x-basecore::app-layout>
