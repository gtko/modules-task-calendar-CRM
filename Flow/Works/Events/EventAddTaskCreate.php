<?php

namespace Modules\TaskCalendarCRM\Flow\Works\Events;

use Modules\CoreCRM\Flow\Attributes\Attributes;
use Modules\CoreCRM\Flow\Works\Actions\ActionsAddCall;
use Modules\CoreCRM\Flow\Works\Actions\ActionsAddNote;
use Modules\CoreCRM\Flow\Works\Actions\ActionsAjouterTag;
use Modules\CoreCRM\Flow\Works\Actions\ActionsChangeStatus;
use Modules\CoreCRM\Flow\Works\Actions\ActionsSendNotification;
use Modules\CoreCRM\Flow\Works\Actions\ActionsSupprimerTag;
use Modules\CoreCRM\Flow\Works\CategoriesEventEnum;
use Modules\CoreCRM\Flow\Works\Conditions\ConditionCountDevis;
use Modules\CoreCRM\Flow\Works\Conditions\ConditionCountDossier;
use Modules\CoreCRM\Flow\Works\Conditions\ConditionStatus;
use Modules\CoreCRM\Flow\Works\Conditions\ConditionTag;
use Modules\CoreCRM\Flow\Works\Events\WorkFlowEvent;
use Modules\CoreCRM\Flow\Works\Variables\ClientVariable;
use Modules\CoreCRM\Flow\Works\Variables\CommercialVariable;
use Modules\CoreCRM\Flow\Works\Variables\DeviVariable;
use Modules\CoreCRM\Flow\Works\Variables\DossierVariable;
use Modules\CoreCRM\Flow\Works\Variables\UserVariable;
use Modules\CrmAutoCar\Flow\Attributes\ClientDossierAddTag;
use Modules\CrmAutoCar\Flow\Attributes\DevisSendClient;
use Modules\CrmAutoCar\Flow\Works\Conditions\ConditionDateDepartDevis;
use Modules\CrmAutoCar\Flow\Works\Files\CguPdfFiles;
use Modules\CrmAutoCar\Flow\Works\Files\DevisBrand1PdfFiles;
use Modules\CrmAutoCar\Flow\Works\Files\DevisBrand2PdfFiles;
use Modules\CrmAutoCar\Flow\Works\Files\DevisPdfFiles;
use Modules\CrmAutoCar\Flow\Works\Files\InformationVoyagePdfFiles;
use Modules\CrmAutoCar\Flow\Works\Files\ProformatPdfFiles;
use Modules\CrmAutoCar\Flow\Works\Files\RIBPdfFiles;
use Modules\CrmAutoCar\Flow\Works\Variables\GestionnaireVariable;
use Modules\CrmAutoCar\Flow\Works\Variables\InformationVoyageVariable;
use Modules\CrmAutoCar\Flow\Works\Variables\ProformatVariable;
use Modules\CrmAutoCar\Flow\Works\Variables\TagVariable;
use Modules\TaskCalendarCRM\Flow\Attributes\AddTaskCreate;
use Modules\TaskCalendarCRM\Flow\Works\Variables\TaskVariable;

class EventAddTaskCreate extends WorkFlowEvent
{

    public function name(): string
    {
        return "Ajout d'une tâche";
    }

    public function category():string
    {
        return CategoriesEventEnum::DOSSIER;
    }

    public function describe(): string
    {
        return "Se déclenche quand on ajoute une tache";
    }

    public function conditions():array
    {
        return [
            ConditionCountDevis::class,
            ConditionCountDossier::class,
            ConditionStatus::class,
            ConditionTag::class,
            ConditionDateDepartDevis::class
        ];
    }

    protected function prepareData(Attributes $flowAttribute): array
    {
        $dossier = $flowAttribute->getDossier();
        return [
            'dossier' => $dossier,
            'commercial' => $dossier->commercial,
            'client' => $dossier->client,
            'user' => $flowAttribute->getTask()->user,
            'tache' => $flowAttribute->getTask(),
        ];
    }

    public function files():array
    {
        return [
            (new CguPdfFiles($this)),
            (new RIBPdfFiles($this)),
        ];
    }

    public function variables():array
    {
        return [
            (new DossierVariable($this)),
            (new CommercialVariable($this)),
            (new GestionnaireVariable($this)),
            (new ClientVariable($this)),
            (new UserVariable($this)),
            (new TaskVariable($this)),
        ];
    }

    public function listen(): array
    {
        return [
            AddTaskCreate::class
        ];
    }
}
