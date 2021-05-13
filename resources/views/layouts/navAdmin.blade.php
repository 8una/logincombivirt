<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Combis-19</title>
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
</head>
<body>
    <div class="d-flex bg-dark">
      <img  src="{{ asset('images/logo_is.png') }}" alt="" width="100" height="100">
       <div class=""">
          <ul class="d-flex text-light h2 align-middle "  >
            <li>Inicio</li>
        
          </ul>        
       </div>
    </div>
    @yield('contentAdmin')
</body>
</html>