<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body class="py-5">
    <div class="container">
      <h1 class="display-4">Schema Documentation</h1>
      @foreach ($schema as $table)
        <h3 class="mt-5 pl-1">Table: {{ $table['name'] }}</h3>
        <h5 class="mt-4 pl-1">Columns</h5>
        <table class="table">
          <tr>
            <th>Column</th>
            <th>Data Type</th>
            <th>Attributes</th>
            <th>Default</th>
            <th>Description</th>
          </tr>
          @foreach ($table['columns'] as $column)
            <tr>
              <td>{{ $column->name }}</td>
              <td>{{ $column->type }}</td>
              <td>{{ $column->attributes->implode(', ') }}</td>
              <td>{{ $column->default }}</td>
              <td>{{ $column->description }}</td>
            </tr>
          @endforeach
        </table>
        @if (count($table['indices']))
          <h5 class="mt-4 pl-1">Indices</h5>
          <table class="table">
            <tr>
              <th>Name</th>
              <th>Columns</th>
              <th>Type</th>
              <th>Description</th>
            </tr>
            @foreach($table['indices'] as $indices)
              <tr>
                <td>{{ $indices->name }}</td>
                <td>{{ $indices->columns->implode(', ') }}</td>
                <td>{{ $indices->type }}</td>
                <td>{{ $indices->description }}</td>
              </tr>
            @endforeach
          </table>
        @endif
      @endforeach
    </div>
  </body>
</html>
