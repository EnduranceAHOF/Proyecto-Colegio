<!DOCTYPE html> 


@extends("layouts.mcdn")
@section("title")
Admin Cursos
@endsection

@section("headex")
<script>
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
})
</script>
@endsection

@section("context")

<div class="container">
    <br>
    <h2 style="text-align: center;" id="temp1">Administrar Estudiantes 
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
    <!-- <button class="btn btn-primary btn-sm ">Administrador de Matrículas</button> -->
    <a target="_blank" href="https://www.scc.cloupping.com/admin" class="btn btn-primary btn-sm">Proceso de Matrículas</a>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-sm" style="text-align: center;" id="list_students">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Rut</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Apoderado</th>
                    <th scope="col">Centro de Padres</th>
                    <th scope="col">Matrícula</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $row)
                    <tr>
                        <td>{{$row["id_stu"]}}</td>
                        <td>{{$row["nombre_stu"]}}</td>
                        <td>{{$row["dni_stu"]}}</td>
                        <td>{{$row["curso"]}} </td>
                        <td>{{$row["apoderado"]}} </td>
                        <td>{{$row["centro_padres"]}} </td>
                        <td>
                            <div class="custom-control custom-switch">
                                @if($row["matricula"] == "si")
                                    <input type="checkbox" class="custom-control-input" id="customSwitch{{$row["id_stu"]}}" checked="">
                                    <label class="custom-control-label text-success" for="customSwitch{{$row["id_stu"]}}" style="width:112px" id="labelMatricula{{$row["id_stu"]}}">Matriculado</label>
                                @else
                                    <input type="checkbox" class="custom-control-input" id="customSwitch{{$row["id_stu"]}}" >
                                    <label class="custom-control-label text-danger" for="customSwitch{{$row["id_stu"]}}" style="width:112px" id="labelMatricula{{$row["id_stu"]}}">No Matriculado</label>
                                @endif
                            </div>
                            <script>
                            
                            $("#customSwitch{{$row["id_stu"]}}").click(function (){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Cargando',
                                    showConfirmButton: false,
                                })
                                $.ajax({
                                    type: "GET",
                                    url: "/student_activate",
                                    data:{
                                    id_stu: '{{$row["id_stu"]}}'  
                                    },
                                    success: function (data)
                                    {
                                        $("#result").html(data);
                                        if($("#customSwitch{{$row["id_stu"]}}").is(":checked")){                                       
                                            $("#labelMatricula{{$row["id_stu"]}}").removeClass('text-danger');
                                            $("#labelMatricula{{$row["id_stu"]}}").addClass('text-success');
                                            $("#labelMatricula{{$row["id_stu"]}}").html('Matriculado');
                                        }
                                        else{                                       
                                            $("#labelMatricula{{$row["id_stu"]}}").removeClass('text-succes');
                                            $("#labelMatricula{{$row["id_stu"]}}").addClass('text-danger');
                                            $("#labelMatricula{{$row["id_stu"]}}").html('No Matriculado');
                                        }
                                        Toast.fire({
                                            icon: 'success', 
                                            title: 'Completado'
                                        })
                                    }
                                });
                            });
                            </script>
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