<!DOCTYPE html> 
@extends("layouts.mcdn")
@section("title")
Admin Profesores
@endsection

@section("headex")

@endsection

@section("context")
<div class="container">
    <br>
    <h2 style="text-align: center;">Administrar Profesores 
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
    
    <div class="table-responsive">
        <table class="table table-sm" style="text-align: center;" id="list_students">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Rut</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Administrar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $row)
                    <tr>
                        <td>{{$row["dni"]}}</td>
                        <td>{{$row["full_name"]}}</td>                                                
                        <td><button class="btn btn-primary">Administrar</button></td>
                    </tr>               
                @endforeach      
            </tbody>
        </table>
    </div>
</div>
@endsection