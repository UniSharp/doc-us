# Schema Documentation
@foreach ($schema as $table)

## Table: `{{ $table['name'] }}`

### Description:



### Columns:

| Column | Data Type | Attributes | Default | Description |
| --- | --- | --- | --- | --- |
@foreach ($table['columns'] as $column)
| `{{ $column->name }}` | {{ $column->type }} | {{ $column->attributes->implode(', ') }} | {{ $column->default }} | {{ $column->description }} |
@endforeach
@if (count($table['indices']))

### Indices:

| Name | Columns | Type | Description |
| --- | --- | --- | --- |
@foreach($table['indices'] as $indices)
| `{{ $indices->name }}` | {{ $indices->columns->map(function ($column) { return "`{$column}`"; })->implode(', ') }} | {{ $indices->type }} | {{ $indices->description }} |
@endforeach
@endif
@endforeach
