<!DOCTYPE html> 


@extends("layouts.mcdn")
@section("title")
Administrar Usuarios
@endsection

@section("headex")

@endsection

@section("context")
    <div class="container">
        <br>
        <h2 style="text-align: center;">Administrar Staff</h2>
        <br>
        <table class="table table-sm" style="text-align: center;" id="lista_staff">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Rut</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col">Administrador</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $row)
                    <tr>
                        <td>{{$row["dni"]}}</td>
                        <td>{{$row["full_name"]}}</td>
                        <td>{{$row["email"]}}</td>
                        <td>{{$row["birth_date"]}}</td>
                        <td>{{$row["is_admin"]}}</td>
                        <td>{{$row["status"]}}</td>
                    </tr>                
                @endforeach             
            </tbody>
        </table>
        <script>
            $(document).ready( function () {
                $('#lista_staff').DataTable({
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