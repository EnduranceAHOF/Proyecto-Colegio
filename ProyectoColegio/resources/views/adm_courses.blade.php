
<!DOCTYPE html> 


@extends("layouts.mcdn")
@section("title")
Administrar Estudiantes
@endsection

@section("headex")

@endsection

@section("context")
<div class="container">
        <br>
        <h2 style="text-align: center;">Administrar Cursos</h2>
        <br>
        <button class="btn btn-success " type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Agregar nuevo usuario</button>
        <br>
        <div class="collapse mt-2" id="collapseExample">
            <form class="row" action="add_course" method="GET">
                <div class="form-group col-4">
                    <label for="grade_name">Nivel</label>
                    <input type="text" class="form-control" name="grade_name" placeholder="1 medio / básico" required="">
                </div>

                <div class="input-group">
                    <br>
                    <div class="input-group-prepend ">
                        <label for="letter" class="input-group-text" for="inputGroupSelect01">Letra</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="letter">
                        <option selected>Seleccionar</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        <option value="5">E</option>
                        <option value="6">F</option>
                    </select>
                </div>
                <br>
                <div class="form-group col-4">
                    <br>
                    <label for="number_students">Cantidad Estudiantes</label>
                    <input type="number" min="0" max="100"class="form-control" name="number_students" placeholder="20" required="">
                </div>
                <div class="form-group col-4">
                    <br>
                    <label for="year">Año</label>
                    <input type="number" min="2000" max="2100"class="form-control" name="year" placeholder="2021" required="">
                </div>

                <div class="form-group col-4">
                    <br>
                    <label for="year" style="color: white;">.</label>
                    <button id="sendform" type="submit" class="form-control btn btn-success">Agregar</button>
                </div>
            </form>
        </div>
        <br>
        <br>
        <button class="btn btn-success " type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">Agregar Estudiante</button>
        <br>
        <div class="collapse mt-2" id="collapseExample2">
            <form class="row" action="add_course" method="GET">
                <div class="form-group col-4">
                    <label for="grade_name">Nivel</label>
                    <input type="text" class="form-control" name="grade_name" placeholder="1 medio / básico" required="">
                </div>

                <div class="input-group">
                    <br>
                    <div class="input-group-prepend ">
                        <label for="letter" class="input-group-text" for="inputGroupSelect01">Letra</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="letter">
                        <option selected>Seleccionar</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        <option value="5">E</option>
                        <option value="6">F</option>
                    </select>
                </div>
                <br>
                <div class="form-group col-4">
                    <br>
                    <label for="full_name_stu">Nombre</label>
                    <input type="text" class="form-control" name="full_name_stu" placeholder="Nombre" required="">
                </div>
                <div class="form-group col-4">
                    <br>
                    <label for="dni_stu">Rut</label>
                    <input type="number" min="0" max="100"class="form-control" name="dni_stu" placeholder="12.345.678-9" required="">
                </div>
                <div class="form-group col-4">
                    <br>
                    <label for="year_stu">Año</label>
                    <input type="number" min="2000" max="2100"class="form-control" name="year" placeholder="2021" required="">
                </div>

                <div class="form-group col-4">
                    <label for="year" style="color: white;">.</label>
                    <button id="sendform" type="submit" class="form-control btn btn-success">Agregar</button>
                </div>
            </form>
        </div>

        <br>
        <div class="table-responsive">
            <table class="table table-sm" style="text-align: center;" id="list_course">
            <!-- id="lista_staff" -->
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nivel</th>
                        <th scope="col">Letra</th>
                        <th scope="col">Código</th>
                        <th scope="col">Cantidad Estudiantes</th>
                        <th scope="col">Ver Estudiantes</th>
                        <th scope="col">Año</th>
                        <th scope="col">Docente Guía</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>1 medio</td>                    
                            <td>A</td>                
                            <td>1MA2020(?)</td>                
                            <td>35</td>                        
                            <td><a href="" class="btn btn-primary btn-sm" >Ver Estudiantes</a></td>                        
                            <td>2020</td>                  
                            <td>Lalo Landa</td>                  
                            <td>                 
                                <a href="" class="btn btn-primary btn-sm">Activado</a>         
                            </td>
                        </tr>               
                        <tr>
                            <td>1 medio</td>                    
                            <td>B</td>                
                            <td>1MB2020(?)</td>                
                            <td>35</td>
                            <td><a href="" class="btn btn-primary btn-sm" >Ver Estudiantes</a></td>                         
                            <td>2020</td>      
                            <td>Búfualo Cornudo</td>            
                            <td>                 
                                <a href="" class="btn btn-primary btn-sm">Activado</a>         
                            </td>
                        </tr>               
                        <tr>
                            <td>1 medio</td>                    
                            <td>C</td>                
                            <td>1MC2020(?)</td>                
                            <td>35</td>  
                            <td><a href="" class="btn btn-primary btn-sm" >Ver Estudiantes</a></td>                       
                            <td>2020</td>      
                            <td>Cangrejo con Ruedas</td>            
                            <td>                 
                                <a href="" class="btn btn-primary btn-sm">Activado</a>         
                            </td>
                        </tr>               
                        <tr>
                            <td>2 medio</td>                    
                            <td>A</td>                
                            <td>2MA2020(?)</td>                
                            <td>40</td>  
                            <td><a href="" class="btn btn-primary btn-sm" >Ver Estudiantes</a></td>                       
                            <td>2020</td>      
                            <td>Hongo alucinógenos</td>            
                            <td>                 
                                <a href="" class="btn btn-primary btn-sm">Activado</a>         
                            </td>
                        </tr>               
                        <tr>
                            <td>2 básico</td>                    
                            <td>A</td>                
                            <td>2BA2020(?)</td>                
                            <td>40</td>    
                            <td><a href="" class="btn btn-primary btn-sm" >Ver Estudiantes</a></td>                     
                            <td>2020</td>      
                            <td>Hongo alucinógenos</td>            
                            <td>                 
                                <a href="" class="btn btn-primary btn-sm">Activado</a>         
                            </td>
                        </tr>               
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready( function () {
                $('#list_course').DataTable({
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