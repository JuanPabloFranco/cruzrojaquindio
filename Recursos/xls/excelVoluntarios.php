<?php
$fecha = date("Y") . "-" . date("m") . "-" . date("d");
include_once '../../Conexion/consulSQL.php';
$año = date("Y");
$accion = $_POST['accion'];
$id_tipo = $_POST['id_tipo'];
$id_cargo = $_POST['id_cargo'];
$id_region = $_POST['id_region'];
$region = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nombre_region FROM regiones WHERE id=" . $_POST['id_region']));


if ($accion == "General") { // 
    //Nombre del archivo
    //        header('Content-Type:text/csv; charset=latin1');
    header('Content-Type: aplication/xls; charset=UTF-8');
    header('Content-Disposition: attachment;filename=voluntarios_activos.xls');
    if ($id_tipo <= 2 || ($id_cargo >= 2 && $id_cargo <= 7)) {
        $sql = "SELECT V.estado, R.nombre_region, C.nombre_cargo, V.nombre_completo, V.doc_id, V.fecha_nac, V.lugar_nac, V.tel_voluntario, V.cel_voluntario, V.email_voluntario, V.formacion_prof, V.ocupacion, V.lab_emp, V.cargo_lab, V.dir_lab, V.tel_lab, V.eps, V.carnet, V.tipo_sangre, V.contacto_emergencia, V.parentezco_emergencia, V.cel_emergencia, V.nombre_madre, V.ocupacion_madre, V.tel_madre, V.nombre_padre, V.ocupacion_padre, V.tel_padre FROM voluntarios V JOIN cargo C ON V.id_cargo=C.id JOIN regiones R ON V.id_region=R.id WHERE V.id<>1 AND V.estado='Activo' ORDER BY V.id_region";
    } else {
        $sql = "SELECT V.estado, R.nombre_region, C.nombre_cargo, V.nombre_completo, V.doc_id, V.fecha_nac, V.lugar_nac, V.tel_voluntario, V.cel_voluntario, V.email_voluntario, V.formacion_prof, V.ocupacion, V.lab_emp, V.cargo_lab, V.dir_lab, V.tel_lab, V.eps, V.carnet, V.tipo_sangre, V.contacto_emergencia, V.parentezco_emergencia, V.cel_emergencia, V.nombre_madre, V.ocupacion_madre, V.tel_madre, V.nombre_padre, V.ocupacion_padre, V.tel_padre FROM voluntarios V JOIN cargo C ON V.id_cargo=C.id JOIN regiones R ON V.id_region=R.id WHERE V.id<>1 AND V.estado='Activo' AND V.id_region=$id_region";
    }

    $resultado = ejecutarSQL::consultar($sql);
?>
    <h3 align="center" bgcolor="#320a48"> Voluntarios Activos</h3>
    <table width="100%" border="1" align="center">
        <tr bgcolor="#320a48" align="center">
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">ESTADO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">REGION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CARGO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE COMPLETO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DOCUMENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FECHA NACIMIENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">LUGAR DE NACIMIENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CELULAR</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DIRECCION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EMAIL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OCUPACION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EMPRESA EN QUE LABORA</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CARGO LABORAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DIRECCION LABORAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO LABORAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EPS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CARNET</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TIPO SANGRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CONTACTO EMERGENCIA</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">PARENTEZCO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE MADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OCUPACION MADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO MADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE PADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OCUPACION PADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO PADRE</h5>
            </td>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($resultado)) {
        ?>
            <tr align="center">
                <td><?php echo utf8_decode($row['estado']) ?></td>
                <td><?php echo utf8_decode($row['nombre_region']) ?></td>
                <td><?php echo utf8_decode($row['nombre_cargo']) ?></td>
                <td><?php echo utf8_decode($row['nombre_completo']) ?></td>
                <td><?php echo utf8_decode($row['doc_id']) ?></td>
                <td><?php echo utf8_decode($row['fecha_nac']) ?></td>
                <td><?php echo utf8_decode($row['lugar_nac']) ?></td>
                <td><?php echo utf8_decode($row['tel_voluntario']) ?></td>
                <td><?php echo utf8_decode($row['cel_voluntario']) ?></td>
                <td><?php echo utf8_decode($row['email_voluntario']) ?></td>
                <td><?php echo utf8_decode($row['formacion_prof']) ?></td>
                <td><?php echo utf8_decode($row['ocupacion']) ?></td>
                <td><?php echo utf8_decode($row['lab_emp']) ?></td>
                <td><?php echo utf8_decode($row['cargo_lab']) ?></td>
                <td><?php echo utf8_decode($row['dir_lab']) ?></td>
                <td><?php echo utf8_decode($row['tel_lab']) ?></td>
                <td><?php echo utf8_decode($row['eps']) ?></td>
                <td><?php echo utf8_decode($row['carnet']) ?></td>
                <td><?php echo utf8_decode($row['tipo_sangre']) ?></td>
                <td><?php echo utf8_decode($row['contacto_emergencia']) ?></td>
                <td><?php echo utf8_decode($row['parentezco_emergencia']) ?></td>
                <td><?php echo utf8_decode($row['cel_emergencia']) ?></td>
                <td><?php echo utf8_decode($row['nombre_madre']) ?></td>
                <td><?php echo utf8_decode($row['ocupacion_madre']) ?></td>
                <td><?php echo utf8_decode($row['tel_madre']) ?></td>
                <td><?php echo utf8_decode($row['nombre_padre']) ?></td>
                <td><?php echo utf8_decode($row['ocupacion_padre']) ?></td>
                <td><?php echo utf8_decode($row['tel_padre']) ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
    exit;
}

if ($accion == "Inactivos") { // 
    //Nombre del archivo
    //        header('Content-Type:text/csv; charset=latin1');
    header('Content-Type: aplication/xls; charset=UTF-8');
    header('Content-Disposition: attachment;filename=voluntarios_inactivos.xls');

    if ($id_tipo <= 2 || ($id_cargo >= 2 && $id_cargo <= 7)) {
        $sql = "SELECT V.estado, R.nombre_region, C.nombre_cargo, V.nombre_completo, V.doc_id, V.fecha_nac, V.lugar_nac, V.tel_voluntario, V.cel_voluntario, V.email_voluntario, V.formacion_prof, V.ocupacion, V.lab_emp, V.cargo_lab, V.dir_lab, V.tel_lab, V.eps, V.carnet, V.tipo_sangre, V.contacto_emergencia, V.parentezco_emergencia, V.cel_emergencia, V.nombre_madre, V.ocupacion_madre, V.tel_madre, V.nombre_padre, V.ocupacion_padre, V.tel_padre FROM voluntarios V JOIN cargo C ON V.id_cargo=C.id JOIN regiones R ON V.id_region=R.id WHERE V.id<>1 AND V.estado='Inactivo'";
    } else {
        $sql = "SELECT V.estado, R.nombre_region, C.nombre_cargo, V.nombre_completo, V.doc_id, V.fecha_nac, V.lugar_nac, V.tel_voluntario, V.cel_voluntario, V.email_voluntario, V.formacion_prof, V.ocupacion, V.lab_emp, V.cargo_lab, V.dir_lab, V.tel_lab, V.eps, V.carnet, V.tipo_sangre, V.contacto_emergencia, V.parentezco_emergencia, V.cel_emergencia, V.nombre_madre, V.ocupacion_madre, V.tel_madre, V.nombre_padre, V.ocupacion_padre, V.tel_padre FROM voluntarios V JOIN cargo C ON V.id_cargo=C.id JOIN regiones R ON V.id_region=R.id WHERE V.id<>1 AND V.estado='Inactivo' AND V.id_region=$id_region";
    }
    $resultado = ejecutarSQL::consultar($sql);
?>
    <h3 align="center" bgcolor="#320a48"> Voluntarios inactivos</h3>
    <table width="100%" border="1" align="center">
        <tr bgcolor="#320a48" align="center">
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">ESTADO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">REGION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CARGO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE COMPLETO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DOCUMENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FECHA NACIMIENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">LUGAR DE NACIMIENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CELULAR</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DIRECCION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EMAIL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OCUPACION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EMPRESA EN QUE LABORA</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CARGO LABORAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DIRECCION LABORAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO LABORAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EPS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CARNET</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TIPO SANGRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CONTACTO EMERGENCIA</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">PARENTEZCO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE MADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OCUPACION MADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO MADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE PADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OCUPACION PADRE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TELEFONO PADRE</h5>
            </td>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($resultado)) {
        ?>
            <tr align="center">
                <td><?php echo utf8_decode($row['estado']) ?></td>
                <td><?php echo utf8_decode($row['nombre_region']) ?></td>
                <td><?php echo utf8_decode($row['nombre_cargo']) ?></td>
                <td><?php echo utf8_decode($row['nombre_completo']) ?></td>
                <td><?php echo utf8_decode($row['doc_id']) ?></td>
                <td><?php echo utf8_decode($row['fecha_nac']) ?></td>
                <td><?php echo utf8_decode($row['lugar_nac']) ?></td>
                <td><?php echo utf8_decode($row['tel_voluntario']) ?></td>
                <td><?php echo utf8_decode($row['cel_voluntario']) ?></td>
                <td><?php echo utf8_decode($row['email_voluntario']) ?></td>
                <td><?php echo utf8_decode($row['formacion_prof']) ?></td>
                <td><?php echo utf8_decode($row['ocupacion']) ?></td>
                <td><?php echo utf8_decode($row['lab_emp']) ?></td>
                <td><?php echo utf8_decode($row['cargo_lab']) ?></td>
                <td><?php echo utf8_decode($row['dir_lab']) ?></td>
                <td><?php echo utf8_decode($row['tel_lab']) ?></td>
                <td><?php echo utf8_decode($row['eps']) ?></td>
                <td><?php echo utf8_decode($row['carnet']) ?></td>
                <td><?php echo utf8_decode($row['tipo_sangre']) ?></td>
                <td><?php echo utf8_decode($row['contacto_emergencia']) ?></td>
                <td><?php echo utf8_decode($row['parentezco_emergencia']) ?></td>
                <td><?php echo utf8_decode($row['cel_emergencia']) ?></td>
                <td><?php echo utf8_decode($row['nombre_madre']) ?></td>
                <td><?php echo utf8_decode($row['ocupacion_madre']) ?></td>
                <td><?php echo utf8_decode($row['tel_madre']) ?></td>
                <td><?php echo utf8_decode($row['nombre_padre']) ?></td>
                <td><?php echo utf8_decode($row['ocupacion_padre']) ?></td>
                <td><?php echo utf8_decode($row['tel_padre']) ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
    exit;
}
?>