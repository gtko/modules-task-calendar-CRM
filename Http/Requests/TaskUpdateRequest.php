<?php

namespace Modules\TaskCalendarCRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends TaskStoreRequest
{
    public function rules()
    {
        return parent::rules();
    }

}
