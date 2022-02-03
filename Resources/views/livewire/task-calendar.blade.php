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
                            id: "{{$task->id}}",
                            title: "{!! $task->title !!}",
                            start: "{{$task->start->format('Y-m-d H:i') ?? ''}}",
                            end: "{{$task->end?->format('Y-m-d H:i') ?? ''}}",
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
                        if (info.view.type !== 'listWeek') {
                            @this.redirectTask(info.event.id)
                        }
                    },
                    eventContent: function (info) {
                        if (info.view.type === 'listWeek') {
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

                            let text = document.createElement("SPAN");
                            text.innerText = info.event.title;
                            text.className = 'cursor-pointer';
                            text.addEventListener('click', function (e) {
                                @this.
                                redirectTask(info.event.id)
                            });

                            let arrayOfDomNodes = [checkbox, text]
                            return {domNodes: arrayOfDomNodes}
                        }
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
