<?php
$fecha = date("Y") . "-" . date("m") . "-" . date("d");
include_once '../../Conexion/consulSQL.php';
$año = date("Y");
$accion = $_POST['accion'];
$id_tipo = $_POST['id_tipo'];
$id_cargo = $_POST['id_cargo'];
$id_region = $_POST['id_region'];
$region = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nombre_region FROM regiones WHERE id=" . $_POST['id_region']));


if ($accion == "all") { // 
    //Nombre del archivo
    //        header('Content-Type:text/csv; charset=latin1');
    header('Content-Type: aplication/xls; charset=UTF-8');
    header('Content-Disposition: attachment;filename=incidentes_o_novedades.xls');
    if ($id_tipo <= 2 || ($id_cargo >= 2 && $id_cargo <= 7)) {
        $sql = "SELECT V.nombre_completo, R.nombre_region, I.fecha_creacion, I.estado, I.fecha, I.hora, I.evento, I.tipo, I.departamento, I.municipio, I.direccion, I.cant_personal, I.personal, I.afectado, I.heridos, I.desaparecidos, I.muertos, I.lesionados, I.traslado, I.quien_traslado, I.viviendas_averiadas, I.viviendas_destruidas, I.familias_afectadas, I.otros, I.observaciones FROM incidentes I JOIN regiones R ON I.id_region=R.id JOIN voluntarios V ON I.id_voluntario=V.id ORDER BY I.id_region";
    } else {
        $sql = "SELECT V.nombre_completo, R.nombre_region, I.fecha_creacion, I.estado, I.fecha, I.hora, I.evento, I.tipo, I.departamento, I.municipio, I.direccion, I.cant_personal, I.personal, I.afectado, I.heridos, I.desaparecidos, I.muertos, I.lesionados, I.traslado, I.quien_traslado, I.viviendas_averiadas, I.viviendas_destruidas, I.familias_afectadas, I.otros, I.observaciones FROM incidentes I JOIN regiones R ON I.id_region=R.id JOIN voluntarios V ON I.id_voluntario=V.id AND I.id_region=$id_region";
    }

    $resultado = ejecutarSQL::consultar($sql);
?>
    <h3 align="center" bgcolor="#320a48"><?= utf8_decode('FUNDACIÓN EQUIPO SCOUT DE EMERGENCIA <br> FORMATO DE REPORTE DE INCIDENTES Y NOVEDADES <br>'.$region[0])?></h3>
    <table width="100%" border="1" align="center">        
        <tr align="center">
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CREADO POR</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">REGION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FECHA CREACION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">ESTADO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FECHA</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">HORA DEL INCIDENTE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EVENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TIPO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DEPARTAMENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">MUNICIPIO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DIRECCION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># PERSONAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">PERSONAL DEL ESE QUE ATIENDE EL REQUERIMIENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE AFECTADO O RESPONSABLE DEL EVENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># HERIDOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># DESAPARECIDOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># MUERTOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># LESIONADOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TRASLADO CENTRO ASISTENCIAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">QUIEN TRASLADO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">VIVIENDAS AVERIADAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">VIVIENDAS DESTRUIDAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FAMILIAS AFECTADAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OTROS ELEMENTOS AFECTADOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OBSERVACIONES</h5>
            </td>            
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($resultado)) {
        ?>
            <tr align="center">
                <td><?php echo utf8_decode($row['nombre_completo']) ?></td>
                <td><?php echo utf8_decode($row['nombre_region']) ?></td>
                <td><?php echo utf8_decode($row['fecha_creacion']) ?></td>
                <td><?php echo utf8_decode($row['estado']) ?></td>
                <td><?php echo utf8_decode($row['fecha']) ?></td>
                <td><?php echo utf8_decode($row['hora']) ?></td>
                <td><?php echo utf8_decode($row['evento']) ?></td>
                <td><?php echo utf8_decode($row['tipo']) ?></td>
                <td><?php echo utf8_decode($row['departamento']) ?></td>
                <td><?php echo utf8_decode($row['municipio']) ?></td>
                <td><?php echo utf8_decode($row['direccion']) ?></td>
                <td><?php echo utf8_decode($row['cant_personal']) ?></td>
                <td><?php echo utf8_decode($row['personal']) ?></td>
                <td><?php echo utf8_decode($row['afectado']) ?></td>
                <td><?php echo utf8_decode($row['heridos']) ?></td>
                <td><?php echo utf8_decode($row['desaparecidos']) ?></td>
                <td><?php echo utf8_decode($row['muertos']) ?></td>
                <td><?php echo utf8_decode($row['lesionados']) ?></td>
                <td><?php echo utf8_decode($row['traslado']) ?></td>
                <td><?php echo utf8_decode($row['quien_traslado']) ?></td>
                <td><?php echo utf8_decode($row['viviendas_averiadas']) ?></td>
                <td><?php echo utf8_decode($row['viviendas_destruidas']) ?></td>
                <td><?php echo utf8_decode($row['familias_afectadas']) ?></td>
                <td><?php echo utf8_decode($row['otros']) ?></td>
                <td><?php echo utf8_decode($row['observaciones']) ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
    exit;
}

// nuevos

if ($accion == "new") { // 
    //Nombre del archivo
    //        header('Content-Type:text/csv; charset=latin1');
    header('Content-Type: aplication/xls; charset=UTF-8');
    header('Content-Disposition: attachment;filename=incidentes_o_novedades_nuevos.xls');
    if ($id_tipo <= 2 || ($id_cargo >= 2 && $id_cargo <= 7)) {
        $sql = "SELECT V.nombre_completo, R.nombre_region, I.fecha_creacion, I.estado, I.fecha, I.hora, I.evento, I.tipo, I.departamento, I.municipio, I.direccion, I.cant_personal, I.personal, I.afectado, I.heridos, I.desaparecidos, I.muertos, I.lesionados, I.traslado, I.quien_traslado, I.viviendas_averiadas, I.viviendas_destruidas, I.familias_afectadas, I.otros, I.observaciones FROM incidentes I JOIN regiones R ON I.id_region=R.id JOIN voluntarios V ON I.id_voluntario=V.id WHERE I.estado='Nuevo' ORDER BY I.id_region";
    } else {
        $sql = "SELECT V.nombre_completo, R.nombre_region, I.fecha_creacion, I.estado, I.fecha, I.hora, I.evento, I.tipo, I.departamento, I.municipio, I.direccion, I.cant_personal, I.personal, I.afectado, I.heridos, I.desaparecidos, I.muertos, I.lesionados, I.traslado, I.quien_traslado, I.viviendas_averiadas, I.viviendas_destruidas, I.familias_afectadas, I.otros, I.observaciones FROM incidentes I JOIN regiones R ON I.id_region=R.id JOIN voluntarios V ON I.id_voluntario=V.id WHERE I.id_region=$id_region AND I.estado='Nuevo'";
    }

    $resultado = ejecutarSQL::consultar($sql);
?>
    <h3 align="center" bgcolor="#320a48"><?= utf8_decode('FUNDACIÓN EQUIPO SCOUT DE EMERGENCIA <br> FORMATO DE REPORTE DE INCIDENTES Y NOVEDADES <br>'.$region[0])?></h3>
    <table width="100%" border="1" align="center">        
        <tr align="center">
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CREADO POR</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">REGION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FECHA CREACION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">ESTADO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FECHA</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">HORA DEL INCIDENTE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EVENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TIPO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DEPARTAMENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">MUNICIPIO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DIRECCION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># PERSONAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">PERSONAL DEL ESE QUE ATIENDE EL REQUERIMIENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE AFECTADO O RESPONSABLE DEL EVENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># HERIDOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># DESAPARECIDOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># MUERTOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># LESIONADOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TRASLADO CENTRO ASISTENCIAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">QUIEN TRASLADO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">VIVIENDAS AVERIADAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">VIVIENDAS DESTRUIDAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FAMILIAS AFECTADAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OTROS ELEMENTOS AFECTADOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OBSERVACIONES</h5>
            </td>            
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($resultado)) {
        ?>
            <tr align="center">
                <td><?php echo utf8_decode($row['nombre_completo']) ?></td>
                <td><?php echo utf8_decode($row['nombre_region']) ?></td>
                <td><?php echo utf8_decode($row['fecha_creacion']) ?></td>
                <td><?php echo utf8_decode($row['estado']) ?></td>
                <td><?php echo utf8_decode($row['fecha']) ?></td>
                <td><?php echo utf8_decode($row['hora']) ?></td>
                <td><?php echo utf8_decode($row['evento']) ?></td>
                <td><?php echo utf8_decode($row['tipo']) ?></td>
                <td><?php echo utf8_decode($row['departamento']) ?></td>
                <td><?php echo utf8_decode($row['municipio']) ?></td>
                <td><?php echo utf8_decode($row['direccion']) ?></td>
                <td><?php echo utf8_decode($row['cant_personal']) ?></td>
                <td><?php echo utf8_decode($row['personal']) ?></td>
                <td><?php echo utf8_decode($row['afectado']) ?></td>
                <td><?php echo utf8_decode($row['heridos']) ?></td>
                <td><?php echo utf8_decode($row['desaparecidos']) ?></td>
                <td><?php echo utf8_decode($row['muertos']) ?></td>
                <td><?php echo utf8_decode($row['lesionados']) ?></td>
                <td><?php echo utf8_decode($row['traslado']) ?></td>
                <td><?php echo utf8_decode($row['quien_traslado']) ?></td>
                <td><?php echo utf8_decode($row['viviendas_averiadas']) ?></td>
                <td><?php echo utf8_decode($row['viviendas_destruidas']) ?></td>
                <td><?php echo utf8_decode($row['familias_afectadas']) ?></td>
                <td><?php echo utf8_decode($row['otros']) ?></td>
                <td><?php echo utf8_decode($row['observaciones']) ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
    exit;
}

// verificados

if ($accion == "verify") { // 
    //Nombre del archivo
    //        header('Content-Type:text/csv; charset=latin1');
    header('Content-Type: aplication/xls; charset=UTF-8');
    header('Content-Disposition: attachment;filename=incidentes_o_novedades_verificados.xls');
    if ($id_tipo <= 2 || ($id_cargo >= 2 && $id_cargo <= 7)) {
        $sql = "SELECT V.nombre_completo, R.nombre_region, I.fecha_creacion, I.estado, I.fecha, I.hora, I.evento, I.tipo, I.departamento, I.municipio, I.direccion, I.cant_personal, I.personal, I.afectado, I.heridos, I.desaparecidos, I.muertos, I.lesionados, I.traslado, I.quien_traslado, I.viviendas_averiadas, I.viviendas_destruidas, I.familias_afectadas, I.otros, I.observaciones FROM incidentes I JOIN regiones R ON I.id_region=R.id JOIN voluntarios V ON I.id_voluntario=V.id WHERE I.estado='Verificado' ORDER BY I.id_region";
    } else {
        $sql = "SELECT V.nombre_completo, R.nombre_region, I.fecha_creacion, I.estado, I.fecha, I.hora, I.evento, I.tipo, I.departamento, I.municipio, I.direccion, I.cant_personal, I.personal, I.afectado, I.heridos, I.desaparecidos, I.muertos, I.lesionados, I.traslado, I.quien_traslado, I.viviendas_averiadas, I.viviendas_destruidas, I.familias_afectadas, I.otros, I.observaciones FROM incidentes I JOIN regiones R ON I.id_region=R.id JOIN voluntarios V ON I.id_voluntario=V.id WHERE I.id_region=$id_region AND I.estado='Verificado'";
    }

    $resultado = ejecutarSQL::consultar($sql);
?>
    <h3 align="center" bgcolor="#320a48"><?= utf8_decode('FUNDACIÓN EQUIPO SCOUT DE EMERGENCIA <br> FORMATO DE REPORTE DE INCIDENTES Y NOVEDADES <br>'.$region[0])?></h3>
    <table width="100%" border="1" align="center">        
        <tr align="center">
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">CREADO POR</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">REGION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FECHA CREACION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">ESTADO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FECHA</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">HORA DEL INCIDENTE</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">EVENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TIPO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DEPARTAMENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">MUNICIPIO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">DIRECCION</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># PERSONAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">PERSONAL DEL ESE QUE ATIENDE EL REQUERIMIENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">NOMBRE AFECTADO O RESPONSABLE DEL EVENTO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># HERIDOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># DESAPARECIDOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># MUERTOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6"># LESIONADOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">TRASLADO CENTRO ASISTENCIAL</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">QUIEN TRASLADO</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">VIVIENDAS AVERIADAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">VIVIENDAS DESTRUIDAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">FAMILIAS AFECTADAS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OTROS ELEMENTOS AFECTADOS</h5>
            </td>
            <td bgcolor="#320a48">
                <h5 style="color: #F6F6F6">OBSERVACIONES</h5>
            </td>            
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($resultado)) {
        ?>
            <tr align="center">
                <td><?php echo utf8_decode($row['nombre_completo']) ?></td>
                <td><?php echo utf8_decode($row['nombre_region']) ?></td>
                <td><?php echo utf8_decode($row['fecha_creacion']) ?></td>
                <td><?php echo utf8_decode($row['estado']) ?></td>
                <td><?php echo utf8_decode($row['fecha']) ?></td>
                <td><?php echo utf8_decode($row['hora']) ?></td>
                <td><?php echo utf8_decode($row['evento']) ?></td>
                <td><?php echo utf8_decode($row['tipo']) ?></td>
                <td><?php echo utf8_decode($row['departamento']) ?></td>
                <td><?php echo utf8_decode($row['municipio']) ?></td>
                <td><?php echo utf8_decode($row['direccion']) ?></td>
                <td><?php echo utf8_decode($row['cant_personal']) ?></td>
                <td><?php echo utf8_decode($row['personal']) ?></td>
                <td><?php echo utf8_decode($row['afectado']) ?></td>
                <td><?php echo utf8_decode($row['heridos']) ?></td>
                <td><?php echo utf8_decode($row['desaparecidos']) ?></td>
                <td><?php echo utf8_decode($row['muertos']) ?></td>
                <td><?php echo utf8_decode($row['lesionados']) ?></td>
                <td><?php echo utf8_decode($row['traslado']) ?></td>
                <td><?php echo utf8_decode($row['quien_traslado']) ?></td>
                <td><?php echo utf8_decode($row['viviendas_averiadas']) ?></td>
                <td><?php echo utf8_decode($row['viviendas_destruidas']) ?></td>
                <td><?php echo utf8_decode($row['familias_afectadas']) ?></td>
                <td><?php echo utf8_decode($row['otros']) ?></td>
                <td><?php echo utf8_decode($row['observaciones']) ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
    exit;
}
?>