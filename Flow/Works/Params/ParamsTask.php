<?php

namespace Modules\TaskCalendarCRM\Flow\Works\Params;

use Modules\CoreCRM\Flow\Works\Params\WorkFlowParams;

class ParamsTask extends WorkFlowParams
{

    public function name(): string
    {
        return "Tâche";
    }

    public function describe(): string
    {
       return 'configurer la tache';
    }

    function nameView(): string
    {
        return "taskcalendarcrm::workflows.task";
    }
}
