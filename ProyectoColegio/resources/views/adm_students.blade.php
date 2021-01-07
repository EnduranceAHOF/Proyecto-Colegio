<!DOCTYPE html> 


@extends("layouts.mcdn")
@section("title")
Admin Cursos
@endsection

@section("headex")

@endsection

@section("context")
<div class="container">
    <h2 style="text-align: center;">Administrar Estudiantes 
            @if(Session::has('period'))
                {{Session::get('period')}}
            @endif            
    </h2>
    @if(isset($message))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{$message}}',
                })
        </script>
    @endif
    <br>
    <button class="btn btn-success " type="button" data-toggle="collapse" data-target="#collapseStudents" aria-expanded="false" aria-controls="collapseStudents">Agregar Estudiante</button>
    <br>
    <div class="collapse mt-2" id="collapseStudents">
        <!--  -->
        <form class="was-validated" action="add_student" method="GET">
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rutalumno">Rut</label>
                        <input id="rutalumno" class="form-control is-invalid" autocomplete="off" name="rut" type="text" required=""  oninput="checkRut(this)" placeholder="Rut del alumno" minlength="6" maxlength="11">
                        <script>
                            function checkRut(rut) {
                                $("#btnapisearch").removeClass("btn-secondary");
                                $("#btnapisearch").removeClass("btn-success");
                                $("#btnapisearch").addClass("btn-primary");
                                $("#btnapisearch").attr("disabled",false);
                                $("#btnapisearch").html("Autocompletar");
                                var valor = rut.value.replace('.','');
                                valor = valor.replace('-','');
                                cuerpo = valor.slice(0,-1);
                                dv = valor.slice(-1).toUpperCase();
                                rut.value = cuerpo + '-'+ dv
                                if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
                                suma = 0;
                                multiplo = 2;
                                for(i=1;i<=cuerpo.length;i++) {
                                    index = multiplo * valor.charAt(cuerpo.length - i);
                                    suma = suma + index;
                                    if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
                                }
                                dvEsperado = 11 - (suma % 11);
                                dv = (dv == 'K')?10:dv;
                                dv = (dv == 0)?11:dv;
                                if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
                                rut.setCustomValidity('');
                            }
                        </script>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Buscar datos por el rut</label>
                        <button class="form-control btn btn-primary" type="button" id="btnapisearch">Autocompletar</button>
                        <script>
                        $("#btnapisearch").click(function(){
                            $("#btnapisearch").html("Cargando");
                            $("#btnapisearch").attr("disabled",true);
                            var rut = $("#rutalumno").val();                           
                            var res = rut.substring(0,2)+"."+rut.substring(2,5)+"."+rut.substring(5,10);
                            $.ajax({
                                type: "GET",
                                url: "/get_info/",
                                data: "rut="+res,
                                success: function(data)
                                {
                                    if(data.length > 10){
                                        var obj = JSON.parse(data);
                                        var res2 = obj.full_name.split(" ");
                                        var names = "";
                                        for (i = 0; i < res2.length; i++) {
                                            if(i==0){
                                                $("#apellido_p").val(res2[i]);
                                            }else if(i==1){
                                                $("#apellido_m").val(res2[i]);
                                            }else{
                                                names = names + " " + res2[i];
                                            }
                                        }
                                        $("#nombres").val(names);
                                        $('#ddlgenero option[value="'+obj.gender+'"]').attr("selected", "selected");
                                        $("#btnapisearch").attr("disabled",true);
                                        $("#btnapisearch").removeClass("btn-primary");
                                        $("#btnapisearch").removeClass("btn-secondary");
                                        $("#btnapisearch").addClass("btn-success");
                                        $("#btnapisearch").html("Actualizado");
                                    }else{
                                        $("#btnapisearch").removeClass("btn-primary");
                                        $("#btnapisearch").addClass("btn-secondary");
                                        $("#btnapisearch").attr("disabled",true);
                                        $("#btnapisearch").html("No encontrad@ :(");
                                    }
                                },
                                error: function(data2){
                                    Swal.fire('Error! B', '', 'error')
                                }
                            });
                        });
                        </script>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Nombres</label>
                        <input id="nombres" type="text" class="form-control" required="" name="nombres" minlength="2" placeholder="Nombres">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Apellido Paterno</label>
                        <input id="apellido_p" type="text" class="form-control" required="" name="apellido_p" minlength="2" placeholder="Apellido paterno">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Apellido Materno</label>
                        <input id="apellido_m" type="text" class="form-control" required="" name="apellido_m" minlength="2" placeholder="Apellido materno ">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Género</label>
                        <select id="ddlgenero" class="custom-select mr-sm-2" autocomplete="off" name="ddlgenero" required="">
                            <option disabled="" selected="" value="">Seleccionar</option>
                            <option value="VAR">Hombre</option>
                            <option value="MUJ">Mujer</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Nacionalidad</label>
                        <input type="text" class="form-control" required="" name="nacionalidad" minlength="4" placeholder="Nacionalidad ">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Etnia</label>
                        <select class="custom-select mr-sm-2" autocomplete="off" name="ddletina" required="">
                            <option selected="">Ninguna</option>
                            <option>Mapuche</option>
                            <option>Aymara</option>
                            <option>Atacameña</option>
                            <option>Diaguita</option>
                            <option>Otro</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Fecha de Nacimiento</label>
                        <input id="thedate" class="form-control" type="date" name="fecha_nac" value="" required=""/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="btnapisearch">Edad</label>
                        <input id="age" class="form-control" type="text" value="" readonly=""/>
                        <script>
                            $('#thedate').change(function () {
                                var date = $("#thedate").val();
                                dob = new Date(date);
                                var today = new Date();
                                var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                                $('#age').val(age);
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-sm" style="text-align: center;" id="list_students">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Rut</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $row)
                    <tr>
                        <td>{{$row["names"]}} {{$row["last_f"]}} {{$row["last_m"]}}</td>
                        <td>{{$row["dni"]}}</td>
                        <td>{{$row["born_date"]}} </td>                                                                                                                                                    
                        <td>
                            <a href="del_student?dni={{$row["dni"]}}" class="btn btn-danger ">Eliminar</a>
                        </td>
                    </tr>               
                @endforeach                      
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready( function () {
            $('#list_students').DataTable({
                    order: [],
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Filas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Filas",
                        "infoFiltered": "(Filtrado de MAX total Filas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Filas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                            }
                    },
                });
        } );
    </script>
</div>
@endsection