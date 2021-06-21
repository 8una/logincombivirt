@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>

@section('content')
    <div >
        <form action="{{ route('showProximoViaje',Auth::user()->dni)}}">csr<button class="w-100 bg-dark text-light" style="height: 3em; font-size: 10em;">Proximo viaje</button></form>
    </div>


@endsection
</body>
</html>

