<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>resporte PDF</title>
</head>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    thead {
        background-color: green;
        color: white;
    }
    th, td {
        padding: 10px;
    }
    h3{
        text-align: center;
    }
    tr:nth-child(even) {
    background-color: rgba(150, 212, 212, 0.4);
    }
    table{
        font-size: 0.9em;
    }


</style>
<body>
    <div>
        <div>
            {{-- <img src="{{public_path().'/assets/img/logo.png'}}"> --}}
        </div>
        <div><h3>REPORTE DATOS DE SENSORES</h3></div>
    </div>


        <table border="1" cellspacing="0" cellpadding="4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Temperatura</th>
                    <th>Humedad</th>
                    <th>Unicación</th>
                    <th>Posición</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->fechatreg}}</td>
                    <td>{{$item->temperatura}}</td>
                    <td>{{$item->humedad}}</td>
                    <td>{{$item->location->nombrelugar}}</td>
                    <td>{{$item->place->name}}</td>
                    <td>{{$item->place->type}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

</body>a
</html>
