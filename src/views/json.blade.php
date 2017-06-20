@if(request()->has('pretty') && request('pretty'))
    {!! json_encode($schema, JSON_PRETTY_PRINT) !!}
@else
    {!! $schema->toJson() !!}
@endif
