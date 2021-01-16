<!DOCTYPE html> 
@extends("layouts.mcdn")
@section("title")
Test Section
@endsection

@section("headex")

@endsection

@section("context")
<br>
<h5 class="card-title">Correos</h5>
<div class="row" style="margin:0;">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-select_group-tab" data-toggle="pill" href="#v-pills-select_group" role="tab" aria-controls="v-pills-select_group" aria-selected="true">Seleccionar Grupo</a>
      <a class="nav-link" id="v-pills-create_group-tab" data-toggle="pill" href="#v-pills-create_group" role="tab" aria-controls="v-pills-create_group" aria-selected="false">Crear Grupo</a>   
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-select_group" role="tabpanel" aria-labelledby="v-pills-select_group-tab">
      <div class="card card-mt-3 ml-3 mr-3"  >
            <div class="card-body">      
                <form  action="" method="GET">
                    <div class="table-responsive-sm table-bordered ">
                        <table class="table" id="createdGroups">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Encargado</th>
                                    <th scope="col">Seleccionar</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_groups as $row)
                                    <tr>                                                                               
                                        <td>{{$row["nombre"]}}</td>
                                        <td>{{$row["encargado"]}}</td>                                        
                                        <td><button class="btn btn-primary btn-sm" id="group_selected">Seleccionar</button></td>
                                        <td>
                                            @if($row["id_creador"] != "INS")
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" id="modalEditGroup{{$row["id_creador"]}}">Editar</button>                           
                                            @else
                                                <button type="button" class="btn btn-primary" disabled="" data-toggle="modal" data-target=".bd-example-modal-xl" >Editar</button>
                                            @endif
                                            <script>
                                                $("#modalEditGroup{{$row["id_creador"]}}").click(function(){
                                                    // Swal.fire({
                                                    //     icon: 'info',
                                                    //     title: 'Cargando',
                                                    //     showConfirmButton: false,
                                                    // })
                                                    $.ajax({
                                                        type: "GET",
                                                        url: "/modal_edit_group",
                                                        data:{
                                                            nombre:'{{$row["nombre"]}}',
                                                            encargado:'{{$row["encargado"]}}',
                                                            id_grupo:'{{$row["id_grupo"]}}'
                                                        },
                                                        success: function (data)
                                                        {
                                                            $("#modalContent").html(data);
                                                            // Toast.fire({
                                                            //     icon: 'success',
                                                            //     title: 'Completado'
                                                            // })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </td>
                                        <td>
                                            @if($row["id_creador"] != "INS")
                                                <button class="btn btn-danger btn-sm" id="group_del">Eliminar</button></td>                          
                                            @else
                                                <button class="btn btn-danger btn-sm" disabled="" id="group_del">Eliminar</button></td>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <div class="modal fade bd-example-modal-xl" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" >
                                        <div class="modal-content" id="modalContent">
                                        </div>
                                    </div>
                                </div> 
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-create_group" role="tabpanel" aria-labelledby="v-pills-create_group-tab">
        <div class="card card-mt-3 ml-3 mr-3"  >
            <div class="card-body">      
                <form  action="/create_group" method="GET">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="nombre_grupo" minlength="4" placeholder="Nombre de Grupo" id="nombre_grupo" required="">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<script>
        $(document).ready( function () {
            $('#createdGroups').DataTable({
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
@endsection