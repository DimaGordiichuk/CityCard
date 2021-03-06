<?php

namespace App\Models\Traits;

trait HasStaticLists
{
    /**
     * @param string|null $columnKey
     * @param string|null $indexKey
     * @param array|null $records
     * @return array
     */
    protected static function staticListBuild(
        array $records = [],
        string $columnKey = null,
        string $indexKey = null
    ): array {
        if ($indexKey && $columnKey) {
            return array_column($records, $columnKey, $indexKey);
        } elseif ($columnKey) {
            return array_column($records, $columnKey);
        }

        return $records;
    }
}
