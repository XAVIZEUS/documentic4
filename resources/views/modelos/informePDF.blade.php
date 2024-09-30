<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            /*font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;*/
            background-color: rgba(54, 194, 212, 0.555);
            box-sizing: inherit;
        }

        body {

            font-family: Arial, sans-serif, blue;
            margin: 0;
            display: grid;
            grid-template-rows: 50px 1fr auto;
            height: 100dvh;
            padding: 20px 40px;
        }

        .date {
            text-align: left;
            margin-bottom: 20px;
        }

        .date p {
            margin: 0;
            /* Elimina el margen entre los párrafos */
            line-height: 1.2;
            /* Ajusta el interlineado */
        }

        .encabezado {
            margin: 0;
            /* Elimina el margen entre los párrafos */
            line-height: 1.2;
        }

        .encabezado p {
            margin: 0;
            /* Elimina el margen entre los párrafos */
            line-height: 1.2;
        }

        .titulo {
            text-align: center;
            line-height: 1.2;
        }

    </style>
</head>

<body>

    <div class="titulo">
        <h3><b><u>INFORME</u></b></h3>
        <p>UB/SC.COM/INF/2024-2026</p>
    </div>

    <br><br>

    <div class="date">
        <p>
            {{now()->isoFormat('dddd, D [de] MMMM [de] YYYY')}}
        </p>

    </div>
    <br>

    <div class="encabezado">

        <p><span style="padding-right: 40px;">DE:</span><b>{{$request->remitente}}</b></p>

        <P style="padding-left: 67px;"><b>{{$request->cargoRemitente}}</b></P>
    </div>
    <br><br>
    <div class="encabezado">

        <p><span style="padding-right: 52px;">A:</span><b>{{$request->destinatario}}</b></p>

        <P style="padding-left: 68px;"><b>{{$request->cargoDestinatario}}</b></P>
    </div>

    <br><br>

    <div class="referencia">
        <p><b>Ref.: <u>{{$request->referencia}}</u></b></p>
    </div>

    <br><br><br><br><br>
    <p>{!! $request->contenido !!}</p>


</body>

</html>
