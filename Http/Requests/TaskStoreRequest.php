<?php

namespace Modules\TaskCalendarCRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $title
 * @property-read string $start
 * @property-read string $end
 * @property-read string $url
 * @property-read string $description
 */
class TaskStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string',
            'start' => 'nullable|date',
            'end' => 'nullable|date',
            'url' => 'nullable|url',
            'description' => 'nullable|string'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
