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
        <h3>Ingrese DNI y correo electronico</h3>
        <hr>
        {{$msg}}
        <hr>
        @if($msg != "Usted no puede viajar, se ha creado su cuenta pero por 14 dias no podra viajar")
        <form method="POST" action="{{route('cargoDeclaracionJuradaInexistente')}}  "class="m-2 p-2">
            @csrf @method('POST')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label w-50">Correo Electronico</label>
                <input type="email" class="form-control m-2 p-2 w-25" name="correo" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label   w-50">DNI:</label>
                <input type="text" class="form-control m-2 p-2 w-25" name="dni" id="exampleInputPassword1" required>
              </div>
                <h3 class="m-2 p-2 bg-dark text-light">Declaro que tengo los siguientes síntomas </h3>
                <div class="form-check">
                    <div>
                        Temperatura:
                    <input type="number" name="fiebre" id="Fiebre" placeholder="º" required>
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