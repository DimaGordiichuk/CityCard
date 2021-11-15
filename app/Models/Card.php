<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    use HasStaticLists;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /** @var string */
    public const TYPE_TYPICAL = 'typical';

    /** @var string */
    public const TYPE_CONCESSION = 'concession';

    /**
     * Get user card.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param string|null $columnKey
     * @param string|null $indexKey
     * @return array
     */
    public static function typeList(string $columnKey = null, string $indexKey = null): array
    {
        $records = [
            [
                'key' => self::TYPE_TYPICAL,
                'name' => trans('system.card.type.typical'),
            ],
            [
                'key' => self::TYPE_CONCESSION,
                'name' => trans('system.card.type.concession'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey);
    }

    /**
     * @return string
     */
    public function getTypeStr(): string
    {
        return self::typeList('name', 'key')[$this->type] ?? '';
    }
}
