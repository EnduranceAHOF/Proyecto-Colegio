
<div class="modal-header">
    <h5 class="modal-title" id="result">Editar grupo</h5>
</div>
<div class="modal-body">
    <div class="table-responsive-sm table-bordered ">
        <h5>Integrantes del grupo {{$nombre}}</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ajsdas</td>
                </tr>
            </tbody>
        </table>
    </div>
    <button class="btn btn-success " type="button" data-toggle="collapse" data-target="#collapseGroups" aria-expanded="false" aria-controls="collapseGroups">Añadir Grupo</button>
    <br>
    <div class="collapse mt-2" id="collapseGroups">
        <div class="table-responsive-sm table-bordered ">
            <h5>Añadir grupo</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Encargado</th>
                        <th scope="col">Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_groups as $row)
                        
                        @if($id_grupo != $row["id_grupo"])
                            <tr>
                                <td>{{$row["nombre"]}}</td>
                                <td>{{$row["encargado"]}}</td>
                                <td><button class="btn btn-primary btn-sm">Seleccionar</button></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>
