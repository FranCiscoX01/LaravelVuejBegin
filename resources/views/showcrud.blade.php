<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://use.fontawesome.com/releases/v5.11.2/js/all.js" data-auto-replace-svg="nest"></script>
</head>
<body>
<div class="container" id="app">
    <center>
        <h1>Mostrar Crud Personalizado</h1>
        <br>
        <crud-axios-show :show="{{ json_encode($show) }}"></crud-axios-show>
    </center>
</div>
</body>
</html>
