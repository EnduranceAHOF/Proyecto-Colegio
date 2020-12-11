<!DOCTYPE html> 

<?php
    $period = $periods["active_period"];
?>
@extends("layouts.mcdn")
@section("title")
Administrar Periodos
@endsection

@section("headex")

@endsection

@section("context")
    <hr>
    <div class="container">
        <h1 style="text-align: center;">Administrar Periodos</h1>
        <form>
            <div class="form-row">
                <div class="col-3">
                </div>
                <div class="col">
                    <input type="number" min="2000" max="{{(int) date("Y") +1}}" value="{{(int) date("Y") +1}}" class="form-control">
                </div>
                <div class="col">
                    <button class="btn btn-primary" id="btn_periodo" >Agregar nuevo periodo</button>
                </div>
                <div class="col-3">
                </div>
            </div>
        </form>
        <hr>
        <table class="table table-sm" style="text-align: center;">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Año</th>
                    <th scope="col">Cantidad Estudiantes</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($periods["list_periods"] as $row)
                    <tr>
                        <td>{{$row["year"]}}</td>
                        <td>45658</td>
                        <td>
                            @if($row["status"] == 1)
                                <button class="btn btn-primary btn-sm">Activado</button>
                            @else
                                <button class="btn btn-secondary btn-sm">Desactivado</button>
                            @endif
                        </td>
                    </tr>                
                @endforeach             
            </tbody>
        </table>
    
    </div>
@endsection