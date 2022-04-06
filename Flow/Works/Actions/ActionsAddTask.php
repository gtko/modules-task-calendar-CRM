<?php

namespace Modules\TaskCalendarCRM\Flow\Works\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\CallCRM\Contracts\Repositories\AppelRepositoryContract;
use Modules\CoreCRM\Flow\Attributes\ClientDossierNoteCreate;
use Modules\CoreCRM\Flow\Works\Actions\WorkFlowAction;
use Modules\CoreCRM\Flow\Works\Params\ParamsString;
use Modules\CoreCRM\Flow\Works\Variables\WorkFlowParseVariable;
use Modules\CoreCRM\Services\FlowCRM;
use Modules\CrmAutoCar\Flow\Works\Params\ParamsCall;
use Modules\TaskCalendarCRM\Contracts\Repositories\TaskRepositoryContract;
use Modules\TaskCalendarCRM\Flow\Works\Params\ParamsTask;

class ActionsAddTask extends WorkFlowAction
{

    public function handle()
    {
        $data = $this->event->getData();
        $commercial = $data['user'];

        $parseVariable = new WorkFlowParseVariable($this->event, $this->params[0]->getValue());
        $config = $parseVariable->resolve();

        $url  = route('dossiers.show', [$data['dossier']->client, $data['dossier']]);
        $rep = app(TaskRepositoryContract::class);
        $task = $rep->createTask($commercial,now()->addHours($config['hours']), $config['title'],$url);
    }

    public function isVariabled(): bool
    {
        return true;
    }

    public function prepareParams(): array
    {
        return [
            ParamsTask::class
        ];
    }

    public function name(): string
    {
        return "Ajouter une tâche";
    }

    public function describe(): string
    {
        return "Permet d'ajouter une tâche";
    }
}
