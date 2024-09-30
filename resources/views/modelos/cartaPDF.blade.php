<!-- resources/views/carta.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Carta</title>
    <style>
        /* Agrega estilos CSS si es necesario */
        .carta {
            font-family: Arial, sans-serif, blue;
            margin: 1.5cm;
            margin-top: 0.5cm;
        }

        .content {
            margin: 20px 0;
            color: blue;
        }
    </style>
    
</head>

<body>
    <div style="background:  #154733">
        <img class="imgheaderIzq" src="{{ public_path('img/logoU.png') }}" alt="Logo">
    </div>
    <div class="carta">
        <!-- <br><strong><pre style="carta">{{$req->destinatario}}</pre></strong> -->
        <div class="header">
            <p  style="text-align: left;">{{$req->departamento}},  {{$fecha->isoFormat('dddd, D [de] MMMM [de] YYYY')}}</p>
            <br>
            {{ $req->sr? $req->sr.': ':""  }}<br><strong>{!! nl2br(e($req->destinatario)) !!}</strong>
            <br><br>

            Ref: <b><u>{!! $req->referencia !!}</u></b>
            
        </div>
        <br>

        <div>
            {!! $req->contenido !!}
        </div>
        <br>

        <div class="footer">
            <p>Atentamente,</p>
            <p style="text-align: center;"><b>UNIVERSAL BROKERS S.A.</b></p>
        </div>
        
        <br><br>
        <hr>
        
        {{Auth::user()->idOficina}}
        <br>
        {{Auth::user()->mosca}}
        
    </div>
    
</body>
</html>