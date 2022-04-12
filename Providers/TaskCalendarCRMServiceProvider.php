<?php

namespace Modules\TaskCalendarCRM\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\CoreCRM\Flow\Works\WorkflowKernel;
use Modules\SignatureCRM\Contracts\Repositories\SignatureRepositoryContract;
use Modules\SignatureCRM\Repositories\SignatureRepository;
use Modules\TaskCalendarCRM\Contracts\Repositories\TaskRepositoryContract;
use Modules\TaskCalendarCRM\Flow\Works\Events\EventAddTaskCreate;
use Modules\TaskCalendarCRM\Repositories\TaskRepository;

class TaskCalendarCRMServiceProvider extends ServiceProvider
{

    /**
     * @var string $moduleName
     */
    protected string $moduleName = 'TaskCalendarCRM';

    /**
     * @var string $moduleNameLower
     */
    protected string $moduleNameLower = 'taskcalendarcrm';

    /**
     * Register services.
     */
    public function register() :void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(TaskRepositoryContract::class, TaskRepository::class);

        app(WorkflowKernel::class)->addEvents([
           EventAddTaskCreate::class
        ]);
    }

    public function boot() :void
    {
        Blade::componentNamespace('Modules\TaskCalendarCRM\View\Components', $this->moduleNameLower);
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
