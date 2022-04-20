<div>
    <div wire:ignore >
        <div class="full-calendar" id="calendar"></div>
        @push('scripts')
         <script>

            if(typeof calendarEl === "undefined") {

                let calendarEl = document.getElementById('calendar');
                let calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
                    initialView: 'timeGridDay',
                    locale: 'fr',
                    events: [
                        @foreach($tasks as $task)
                        {
                            @php
                                $title = $task->title  . ' - ' . $task->content;
                                if($task->taskable){
                                    if(method_exists($task->taskable, 'client'))
                                    {
                                        $title .= ' - ' . $task->taskable->client->format_name;
                                    }
                                }
                            @endphp
                            id: "{{$task->id}}",
                            title: "{!! $title !!}",
                            start: "{{$task->start->format('Y-m-d H:i') ?? ''}}",
                            end: "{{$task->end?->format('Y-m-d H:i') ?? ''}}",
                            @if($task->color)
                                color: "{{$task->color}}",
                            @endif
                            extendedProps: {
{{--                                @if($task->taskable_type)--}}
{{--                                    actions: {!! json_encode($task->taskable->actions()) !!}--}}
{{--                                @endif--}}
                            }
                        },
                        @endforeach
                    ],
                    editable: true,
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "listWeek,dayGridMonth,timeGridWeek,timeGridDay",
                    },
                    droppable: true,
                    eventColor: '#809191',
                    eventDrop: function (info) {
                        console.log(info);
                        @this.moveResize(info.event.id, info.event.startStr, info.event.endStr)
                    },
                    eventResize : function( info ) {
                        console.log(info);
                        @this.moveResize(info.event.id, info.event.startStr, info.event.endStr)
                    },
                    dateClick: function (info) {
                        console.log(info)
                    },
                    select: function (info) {
                        console.log(info)
                    },
                    unselect: function (info) {
                        console.log(info)
                    },
                    eventClick: function(info) {
                        {{--if (info.view.type !== 'listWeek') {--}}
                        {{--    @this.redirectLink(info.event.id)--}}
                        {{--}--}}
                    },
                    eventContent: function (info) {
                            let checkbox = document.createElement('input');
                            checkbox.type = "checkbox";
                            checkbox.name = "name";
                            checkbox.className = 'mr-2 cursor-pointer';
                            checkbox.value = false;
                            checkbox.addEventListener('change', function () {
                                info.event.remove();
                                @this.
                                checkTask(info.event.id);
                            });

                            let heure = null
                            if (info.view.type !== 'listWeek') {
                                let heure = document.createElement("SPAN");
                                heure.innerText = info.event.timeText;
                                heure.className = 'cursor-pointer mr-2';
                                heure.addEventListener('click', function (e) {
                                    @this.
                                    redirectLink(info.event.id)
                                });
                            }

                            let text = document.createElement("SPAN");
                            text.innerText = info.event.title;
                            text.className = 'cursor-pointer mr-2';
                            text.addEventListener('click', function (e) {
                                @this.redirectLink(info.event.id)
                            });

                            let show = document.createElement("SPAN");
                            show.innerText = 'Voir le lien';
                            show.className = 'cursor-pointer hover:text-blue-200';
                            show.addEventListener('click', function (e) {
                                @this.
                                redirectLink(info.event.id)
                            });

                            let arrayOfDomNodes = [checkbox, text, show];
                            if(heure) {
                                arrayOfDomNodes = [checkbox,heure, text, show];
                            }

                            return {domNodes: arrayOfDomNodes}
                    },
                });

                calendar.render();

                window.Livewire.on('TaskRemove', taskId => {
                    for (let key in calendar.getEvents()) {
                        let event = calendar.getEvents()[key]
                        if (event && event.id == taskId) {
                            event.remove()
                        }
                    }
                })
            }




        </script>
        @endpush
    </div>
</div>
