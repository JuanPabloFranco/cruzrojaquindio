<?php

include '../../Conexion/consulSQL.php';
$sql = "SELECT eventos.nombre_evento, eventos.fecha_inicial, eventos.logo_evento, eventos.tel_contacto FROM eventos WHERE eventos.id=" . $_GET['id'];
$consultaVP = mysqli_fetch_row(ejecutarSQL::consultar($sql));
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="divInscripcion">
        <form class="form-horizontal" method="post" action="DAO/eventoDAO.php" id="rev_visitante">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Inscripción a <?php echo $consultaVP[0]; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body center-all-contens" style="width: 90%"> 
                    <div class="form-group">
                        <div class="input-group" >
                            <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                            <input class="form-control all-elements-tooltip" id="txtCedula" type="text" placeholder="Ingrese su número de Cedula" required name="doc_id" data-toggle="tooltip" data-placement="top" title="Ingrese su número de Cedula. Solamente números y guiones(-)" maxlength="30" pattern="[0-9]{7,30}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="divNombre">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input class="form-control all-elements-tooltip" id="txtNombre" type="text" placeholder="Ingrese su nombre completo" required name="nombre_completo" data-toggle="tooltip" data-placement="top" title="Ingrese su nombre completo"  maxlength="100">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="divTel">
                            <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                            <input class="form-control all-elements-tooltip" id="txtTelefono" type="tel" placeholder="Ingrese su número fijo o celular" required name="telefono" maxlength="11" pattern="[0-9]{8,11}" data-toggle="tooltip" data-placement="top" title="Ingrese su número telefónico. Mínimo 8 digitos máximo 11">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="divPais">
                            <div class="input-group-addon"><i class="fa fa-flag-o"></i></div>
                            <input class="form-control all-elements-tooltip" id="txtPais" type="text" placeholder="Ingrese su país de residencia" required name="pais" data-toggle="tooltip" data-placement="top" title="Ingrese su país de residencia" maxlength="100">
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="input-group"id="divCiudad">
                            <div class="input-group-addon" ><i class="fa fa-building-o"></i></div>
                            <input class="form-control all-elements-tooltip" id="txtCiudad" type="text" placeholder="Ingrese su ciudad de residencia" required name="ciudad" data-toggle="tooltip" data-placement="top" title="Ingrese su ciudad de residencia" maxlength="100">
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="input-group" id="divSangre">
                            <div class="input-group-addon"><i class="fa fa-heart-o"></i></div>
                            <select class="form-control all-elements-tooltip" id="selSangre" required name="tipo_sangre"> 
                                <option value="" selected>Seleccione una opción</option>
                                <option value="O negativo">O negativo</option>
                                <option value="O positivo">O positivo</option>
                                <option value="A negativo">A negativo</option>
                                <option value="A positivo">A positivo</option>
                                <option value="B negativo">B negativo</option>
                                <option value="B positivo">B positivo</option>
                                <option value="AB negativo">AB negativo</option>
                                <option value="AB positivo">AB positivo</option>
                            </select>                                        
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="divEps" >
                            <div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
                            <input class="form-control all-elements-tooltip" id="txtEps" type="text" placeholder="Ingrese su eps" required name="eps" data-toggle="tooltip" data-placement="top" title="Ingrese su eps" maxlength="100">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="input-group" id="divEmail" >
                            <div class="input-group-addon"><i class="fa fa-at"></i></div>
                            <input class="form-control all-elements-tooltip" id="txtEmail" type="email" placeholder="Ingrese su Email" required name="email" data-toggle="tooltip" data-placement="top" title="Ingrese la dirección de su Email" maxlength="50">
                        </div>
                    </div>
                </div>
                <div id="resFormInscr" style="width: 100%; text-align: center; margin: 0;"></div>          
                <div class="modal-footer">
                    <input type="text" value="<?php echo $_GET['id']; ?>" name="id_evento" style="display: none">
                    <input type="hidden" name="funcion" value="inscripcion">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info" >Registrar</button>
                </div>
            </div> 
        </form>
        <script>
            /*Envio del formulario con Ajax para inscribirse a un evento*/
            $(document).ready(function () {
                $('#divInscripcion form').submit(function (e) {
                    e.preventDefault();
                    var informacion = $('#divInscripcion form').serialize();
                    var metodo = $('#divInscripcion form').attr('method');
                    var peticion = $('#divInscripcion form').attr('action');
                    $.ajax({
                        type: metodo,
                        url: peticion,
                        data: informacion,
                        beforeSend: function () {
                            $("#resFormInscr").html('Inscribiendo Participante <br><img src="recursos/img/enviando.gif" class="center-all-contens">');
                        },
                        error: function () {
                            $("#resFormInscr").html("Ha ocurrido un error en el sistema");
                        },
                        success: function (data) {
                            $("#resFormInscr").html(data);
                        }
                    });
                    return false;
                });
            });
        </script>
    </div>
</div>