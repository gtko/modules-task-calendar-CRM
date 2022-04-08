<?php
namespace Modules\TaskCalendarCRM\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\BaseCore\Contracts\Entities\UserEntity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BaseCore\Icons\Icons;
use Modules\SearchCRM\Entities\SearchResult;
use Modules\SearchCRM\Interfaces\SearchableModel;
use Modules\BaseCore\Models\User;

/**
 * Class Dates
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property Carbon $start
 * @property Carbon $end
 * @property string $color
 * @property int $duration
 * @property UserEntity $user
 * @property int $user_id
 * @property bool $checked
 * @package App\Models
 */
class Task extends Model implements SearchableModel
{

    protected $dates = [
        'start'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get the user that owns the Dates
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(app(UserEntity::class)::class);
    }

    public function taskable() : MorphTo
    {
        return $this->morphTo('taskable', 'taskable_type', 'taskable_id');
    }

    public function getEndAttribute():Carbon|null
    {
        if($this->duration < 1) return null;
        return $this->start->addSeconds($this->duration ?? 0);
    }

    public function getSearchResult(): SearchResult
    {
        $result = new SearchResult(
            $this,
            $this->title,
            route('tasks.edit', $this),
            'Tâches'
        );

        $result->setSvg(Icons::task());

        return $result;
    }
}
