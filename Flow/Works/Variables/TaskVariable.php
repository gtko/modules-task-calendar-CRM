<?php

namespace Modules\TaskCalendarCRM\Flow\Works\Variables;

use Modules\CoreCRM\Flow\Works\Variables\WorkFlowVariable;

class TaskVariable extends WorkFlowVariable
{

    public function namespace(): string
    {
        return 'tache';
    }

    public function data(array $params = []): array
    {
        /** @var \Modules\TaskCalendarCRM\Models\Task $task */
        $task = $this->event->getData()['tache'];

       return [
         'title' => $task->title,
         'content' => $task->content,
         'url' => $task->url,
         'debut' => $task->start,
         'fin' => $task->end,
         'couleur' => $task->color,
         'check' => $task->checked ? "terminé" : "a faire",
         'important' => ($task->data['important'] ?? false) ? "important" : "",
       ];
    }

    public function labels(): array
    {
        return [
            'title' => 'Titre de la tache',
            'content' => 'Contenu de la tache',
            'url' => 'Url de la tache',
            'debut' => 'Début de la tache',
            'fin' => 'Fin de la tache',
            'couleur' => 'Couleur de la tache',
            'check' => 'Etat de la tache',
            'important' => 'Tache importante',
        ];
    }
}
