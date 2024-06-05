<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
        <title>UEX</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="{{asset('https://fonts.bunny.net/css?family=figtree:400,600&display=swap')}}" rel="stylesheet" />
        <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{URL::asset('css/toastr.css')}}">
        <link href="{{URL::asset('css/geral.css')}}" rel="stylesheet" type="text/css">

    </head>

    <body class="antialiased">

        @yield('content')

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
        <script src="{{URL::asset('js/toastr.js')}}"></script>
        <script src="{{URL::asset('js/Alerta.js')}}"></script>
        
    </body>
    @if ($errors->any())
    @foreach ($errors->all() as $erro)
        <script>
            Alerta.alert('{{$erro}}', 'error');
        </script>
    @endforeach
@endif
@if (isset($error))
<script>
    Alerta.alert('{{$erro}}', 'error');
</script>
@endif
@if (isset($success))
<script>
    Alerta.alert('{{$success}}', 'success');
</script>
@endif
@if (session('success'))
<script>

    Alerta.alert('{{session('success')}}', 'success');
</script>
@endif
</html>