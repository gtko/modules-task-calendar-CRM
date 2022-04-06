<?php

namespace Modules\TaskCalendarCRM\Interfaces;

interface TaskableModel
{
    public function checkHandle($optionsChecked = null);

    public function canCheck(): bool;

    public function actions(): array;
}
