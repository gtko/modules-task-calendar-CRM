<?php

use Modules\TaskCalendarCRM\Http\Controllers\TasksController;

Route::resource('tasks', TasksController::class)->except('show');
