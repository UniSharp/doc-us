<?php

namespace UniSharp\DocUs;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Parser
{
    public static function getSchema()
    {
        return collect(DB::select('show tables'))->map(function ($row) {
            $table = head($row);

            return [
                'name' => $table,
                'columns' => static::getColumns($table),
                'indices' => static::getIndices($table),
            ];
        });
    }

    protected static function getColumns($table)
    {
        $sql = ((array) head(DB::select("show create table `{$table}`")))['Create Table'];

        return collect(DB::select("show columns from `{$table}`"))->map(function ($column) use ($sql) {
            $attributes = collect();

            if ('PRI' === $column->Key) {
                $attributes->push('Primary');
            }

            if (Str::contains($column->Extra, 'auto_increment')) {
                $attributes->push('Auto increment');
            }

            if ('NO' === $column->Null) {
                $attributes->push('Not null');
            }

            preg_match("/`{$column->Field}`.+?COMMENT '(.+)'/", $sql, $matches);

            return (object) [
                'name' => $column->Field,
                'type' => strtoupper($column->Type),
                'attributes' => $attributes,
                'default' => $column->Default ?: ('YES' === $column->Null ? 'NULL' : ''),
                'description' => count($matches) ? $matches[1] : '',
            ];
        });
    }

    protected static function getIndices($table)
    {
        return collect(DB::select("show index from `{$table}`"))
            ->groupBy('Key_name')
            ->map(function ($indices) {
                switch (true) {
                    case 'PRIMARY' === $indices->first()->Key_name:
                        $type = 'PRIMARY';
                        break;

                    case 0 === $indices->first()->Non_unique:
                        $type = 'UNIQUE';
                        break;

                    default:
                        $type = 'INDEX';
                        break;
                }

                return (object) [
                    'name' => $indices->first()->Key_name,
                    'columns' => $indices->pluck('Column_name'),
                    'type' => $type,
                    'description' => '',
                ];
            })
            ->values();
    }
}
