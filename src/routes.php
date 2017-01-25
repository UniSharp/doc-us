<?php

Route::get('schema', function (Illuminate\Http\Request $request) {
    $schema = UniSharp\SchemaDocumentation\Parser::getSchema();

    switch ($request->format) {
        case 'markdown':
            $format = 'markdown';
            break;

        default:
            $format = 'html';
            break;
    }

    return response()->view("schema::{$format}", compact('schema'))
                     ->header('Content-Type', "text/{$format}");
});
