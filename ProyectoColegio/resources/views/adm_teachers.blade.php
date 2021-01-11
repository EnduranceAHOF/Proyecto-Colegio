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
    
</div>
@endsection