<form action="edit_student" method="GET" id="form{{$stu["id"]}}">
<input  value="{{$stu["id"]}}" name="id" type="text" hidden="">
    <div class="modal-header">
        <h5 class="modal-title" id="stuModalLabel">Datos Estudiante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="rutalumno">Rut</label>
                <input id="rutalumno{{$stu["id"]}}" value="{{$stu["dni"]}}" class="form-control" autocomplete="off" name="rut" type="text" required=""  oninput="checkRut{{$stu["id"]}}(this)" placeholder="Rut del alumno" minlength="6" maxlength="11">
                <script>
                    function checkRut{{$stu["id"]}}(rut) {                        
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
                <label for="btnapisearch">Nombres</label>
                <input id="nombres{{$stu["id"]}}" value="{{$stu["names"]}}" type="text" class="form-control" required="" name="nombres" minlength="2" placeholder="Nombres">
            </div>
            <div class="form-group col-md-6">
                <label for="btnapisearch">Apellido Paterno</label>
                <input id="apellido_p{{$stu["id"]}}" value="{{$stu["last_f"]}}" type="text" class="form-control" required="" name="apellido_p" minlength="2" placeholder="Apellido paterno">
            </div>
            <div class="form-group col-md-6">
                <label for="btnapisearch">Apellido Materno</label>
                <input id="apellido_m{{$stu["id"]}}" value="{{$stu["last_m"]}}" type="text"  class="form-control" required="" name="apellido_m" minlength="2" placeholder="Apellido materno ">
            </div>
            <div class="form-group col-md-6">
                <label for="btnapisearch">Género</label>
                <select id="ddlgenero{{$stu["id"]}}" class="custom-select mr-sm-2" autocomplete="off" name="ddlgenero" required="">
                    <option value="{{$stu["sex"]}}" selected="">@if($stu["sex"]=="VAR") Hombre @else Mujer @endif</option>
                    <option value="VAR">Hombre</option>
                    <option value="MUJ">Mujer</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="btnapisearch">Nacionalidad</label>
                <input type="text" value="{{$stu["nationality"]}}" class="form-control" required="" name="nacionalidad" minlength="4" placeholder="Nacionalidad ">
            </div>
            <div class="form-group col-md-6">
                <label for="btnapisearch">Etnia</label>
                <select class="custom-select mr-sm-2"  autocomplete="off" name="ddletina" required="">
                    <option selected="">{{$stu["ethnic"]}}</option>
                    <option>Mapuche</option>
                    <option>Aymara</option>
                    <option>Atacameña</option>
                    <option>Diaguita</option>
                    <option>Otro</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="btnapisearch">Fecha de Nacimiento</label>
                <input id="thedate{{$stu["id"]}}" value="{{$stu["born_date"]}}" class="form-control" type="date" name="fecha_nac" value="" required=""/>
            </div>
            <div class="form-group col-md-6">
                <label for="btnapisearch">Edad</label>
                <input id="age{{$stu["id"]}}" class="form-control" type="text" value="" readonly=""/>
                <script>
                    $(document).ready(function(){
                        var date = "{{$stu["born_date"]}}";
                        dob = new Date(date);
                        var today = new Date();
                        var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                        $('#age{{$stu["id"]}}').val(age);
                    });
                    $('#thedate{{$stu["id"]}}').change(function () {
                        var date = $("#thedate{{$stu["id"]}}").val();
                        dob = new Date(date);
                        var today = new Date();
                        var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                        $('#age{{$stu["id"]}}').val(age);
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="saveBtn{{$stu["id"]}}" class="btn btn-primary">Guardar</button>
        <script>
            $("#saveBtn{{$stu["id"]}}").on("click", function() {
                $(this).prop("disabled", true);
                $("#form{{$stu["id"]}}").submit();
            });
        </script>
    </div>
</form>