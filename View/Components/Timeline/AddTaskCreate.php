<?php

namespace Modules\TaskCalendarCRM\View\Components\Timeline;

use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\CoreCRM\View\Components\Timeline\TimelineComponent;

class AddTaskCreate extends TimelineComponent
{
    public function render(): View
    {
        return view('taskcalendarcrm::components.timeline.add-task-create');
    }
}
