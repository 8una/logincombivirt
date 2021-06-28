<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <form action="{{route('buscarCuentaConDNi')}}">
    <label for=""> DNI: </label>
    <input type="number" name="dni" id="dni" placeholder="#DNI">
    <Button> Buscar </Button>
    </form>
    <hr>

    @if(!$user->isEmpty())
        <h1 class="m-2 p-2">Formulario de Declaracion Jurada</h1>
        <form method="POST" action="{{route('cargoDeclaracionJuradaExistente')}}  "class="m-2 p-2">
        @csrf @method('POST')
        @foreach ($user as $user) 
        <div class="d-flex justify-content-center">
        <label for="" class="p-2 m-2">Nombre:</label>
        <input class="form-control w-25" type="text" value="{{$user->name}}" aria-label="readonly input example" readonly>
        <label for="" class="p-2 m-2">Apellido:</label>
        <input class="form-control w-25" type="text" value="{{$user->lastname}}" aria-label="readonly input example" readonly>
        </div>
        <div class="d-flex justify-content-center">
        <label for="" class="p-2 m-2">DNI:</label>
        <input class="form-control w-25" type="text" name="DNI" value="{{$user->dni}}" aria-label="readonly input example" readonly>
        <label for="" class="p-2 m-2">Email:</label>
        <input class="form-control w-25" type="text" value="{{$user->email}}" aria-label="readonly input example" readonly>
        @endforeach
        </div>
        <hr>
        <h3 class="m-2 p-2 bg-dark text-light">Declaro que tengo los siguientes síntomas </h3>
                <div class="form-check">
                    <div>
                        Fiebre:
                    <input type="number" name="Fiebre" id="Fiebre" placeholder="º" required>
                    </div>
                    <div>
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
                    <label class="form-check-label" for="flexCheckDefault">
                        Tuvo fiebre en la última semana?
                    </label></div>
                    <div>
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
                    <label class="form-check-label" for="flexCheckDefault">
                        Tuvo pérdida de gusto / olfato en la última semana?
                    </label>
                    </div>  

                    <div>
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            Tiene dolor de garganta?
                        </label>
                        </div> 
                    <div>
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="sintomas[]">
                            <label class="form-check-label" for="flexCheckDefault">
                                Tiene dificultad para respirar?
                            </label>
                    </div>
                </div>
            
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label p-2 m-2">Terminos y condiciones</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5">Declaro que los datos consignados en este formulario son correctos y completos y que he confeccionado esta declaración, sin falsear ni omitir dato alguno, siendo fiel expresión de la verdad.

    Declaro conocer las penalidades establecidas en la legislación vigente para el caso de falsedad de la presente.

    Declaro conocer que en la República Argentina se ha decretado la emergencia pública en materia sanitaria establecida por Ley N° 27.541, en virtud de la Pandemia declarada por la ORGANIZACIÓN MUNDIAL DE LA SALUD (OMS) en relación con el coronavirus COVID-19, por el plazo de UN (1) año a partir del 12 de marzo de 2020 por el Decreto N° 260 y modificado por similar N° 167/21, se amplió por el plazo de UN (1) año hasta el 31 de diciembre de 2021.</textarea>
        
        </div>
        <div style="color:gray"><input type="checkbox" name="acepto" id=""  name="terminos" onclick="sumbit.disabled = false;">Acepto los terminos y condiciones</div>
        <button type="submit" name="sumbit" class="btn btn-outline-primary mt-2" disabled> Aceptar</button>
        </form>        
    @endif
    @endsection
</body>
</html>