<?php
include_once '../Conexion/Conexion.php';
class Usuario
{
     var $objetos;
     public function __CONSTRUCT()
     {
          $db = new Conexion();
          $this->acceso = $db->pdo;
     }

     function loguearse($usuario, $pass)
     {
          $sql = "SELECT U.id, U.nombre_completo, T.nombre_tipo, U.id_tipo_usuario, U.id_cargo, U.id_sede, U.usuario, S.nombre_sede, U.estado, S.estado_sede FROM usuario U JOIN tipo_usuario T ON U.id_tipo_usuario=T.id JOIN sedes S ON U.id_sede=S.id WHERE U.usuario=:usuario AND U.pass=:pass";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':usuario' => $usuario, ':pass' => $pass));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function buscar_datos_general($id)
     {
          $sql = "SELECT * FROM usuario U JOIN sedes R ON U.id_sede=R.id JOIN cargo C ON U.id_cargo=C.id JOIN tipo_usuario T ON U.id_tipo_usuario=T.id WHERE U.id=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function editar_general($id, $nombre_completo, $doc_id, $fecha_nac, $lugar_nac, $tel_usuario, $celular, $dir_usuario, $email_usuario, $inf_usuario, $twitter, $facebook, $instagram, $genero)
     {
          $sql = "UPDATE usuario SET nombre_completo=:nombre_completo, doc_id=:doc_id, fecha_nac=:fecha_nac, lugar_nac=:lugar_nac, tel_usuario=:tel_usuario, cel_usuario=:celular, dir_usuario=:dir_usuario, email_usuario=:email_usuario, inf_usuario=:inf_usuario, twitter=:twitter, facebook=:facebook, instagram=:instagram, genero=:genero WHERE id=:id";
          $query = $this->acceso->prepare($sql);
          if ($query->execute(array(':id' => $id, ':nombre_completo' => $nombre_completo, ':doc_id' => $doc_id, ':fecha_nac' => $fecha_nac, ':lugar_nac' => $lugar_nac, ':tel_usuario' => $tel_usuario, ':celular' => $celular, ':dir_usuario' => $dir_usuario, ':email_usuario' => $email_usuario, ':inf_usuario' => $inf_usuario, ':twitter' => $twitter, ':facebook' => $facebook, ':instagram' => $instagram, ':genero' => $genero))) {
               echo 'editado';
          } else {
               echo 'noEditado';
          }
     }

     function update_pass($id, $nameUser, $oldpass, $newpass)
     {
          $sql = "SELECT id FROM usuario WHERE usuario=:nameUser AND id=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id, ':nameUser' => $nameUser));
          $this->objetos = $query->fetchall();
          if (!empty($this->objetos)) {
               //Guardar cambiando usuario
               $sql = "SELECT id FROM usuario WHERE usuario=:nameUser";
               //Buscar si existe un usuario con ese nombre
               $query = $this->acceso->prepare($sql);
               $query->execute(array(':nameUser' => $nameUser));
               $this->objetos = $query->fetchall();
               if (!empty($this->objetos)) {
                    //Guardar cambios
                    $sql = "SELECT id FROM usuario WHERE pass=:oldpass AND id=:id";
                    $query = $this->acceso->prepare($sql);
                    $query->execute(array(':id' => $id, ':oldpass' => $oldpass));
                    $this->objetos = $query->fetchall();
                    if (!empty($this->objetos)) { // Si el password coincide continua guardando
                         $sql = "UPDATE usuario SET usuario=:nameUser, pass=:newpass WHERE id=:id";
                         $query = $this->acceso->prepare($sql);
                         if ($query->execute(array(':id' => $id, ':nameUser' => $nameUser, ':newpass' => $newpass))) {
                              echo 'update';
                         } else {
                              echo 'Error al actualizar el usuario';
                         }
                    } else {
                         echo 'Error al verificar el password actual';
                    }
               } else {
                    echo 'Ya existe un usuario con ese nombre de usuario';
               }
          } else {
               //Guardar sin cambiar usuario
               $sql = "SELECT id FROM usuario WHERE pass=:oldpass AND id=:id";
               $query = $this->acceso->prepare($sql);
               $query->execute(array(':id' => $id, ':oldpass' => $oldpass));
               $this->objetos = $query->fetchall();
               if (!empty($this->objetos)) { // Si el password coincide continua guardando
                    $sql = "UPDATE usuario SET usuario=:nameUser, pass=:newpass WHERE id=:id";
                    $query = $this->acceso->prepare($sql);
                    if ($query->execute(array(':id' => $id, ':nameUser' => $nameUser, ':newpass' => $newpass))) {
                         echo 'update';
                    } else {
                         echo 'Error al actualizar el usuario';
                    }
               } else {
                    echo 'Error al verificar el password actual';
               }
          }
     }

     function cambiar_avatar($id, $avatar)
     {
          $sql = "SELECT avatar FROM usuario WHERE id=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();

          $sql = "UPDATE usuario SET avatar=:avatar WHERE id=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id, ':avatar' => $avatar));
          return $this->objetos;
     }

     function buscar_datos_adm()
     {
          $cargo = $_POST['id_cargo'];
          $sede = $_POST['id_sede'];
          $tipo = $_POST['tipo_usuario'];
          if (!empty($_POST['consulta'])) {
               if ($tipo <= 2 || ($cargo <> 1 && ($cargo >= 1 && $cargo <= 7))) {
                    $sql = "SELECT U.id, U.nombre_completo, U.fecha_nac, U.avatar, U.cel_usuario, U.tel_usuario, U.dir_usuario, U.email_usuario, T.nombre_tipo, C.nombre_cargo, R.nombre_sede, U.twitter, U.facebook, U.instagram, U.estado, U.id_tipo_usuario, U.genero FROM usuario U JOIN sedes R ON U.id_sede=R.id JOIN cargo C ON U.id_cargo=C.id JOIN tipo_usuario T ON U.id_tipo_usuario=T.id  WHERE U.id<>1 AND (U.nombre_completo LIKE :consulta OR U.cel_usuario LIKE :consulta OR R.nombre_sede LIKE :consulta) ORDER BY U.nombre_completo";
               } else {
                    $sql = "SELECT U.id, U.nombre_completo, U.fecha_nac, U.avatar, U.cel_usuario, U.tel_usuario, U.dir_usuario, U.email_usuario, T.nombre_tipo, C.nombre_cargo, R.nombre_sede, U.twitter, U.facebook, U.instagram, U.estado, U.id_tipo_usuario, U.genero FROM usuario U JOIN sedes R ON U.id_sede=R.id JOIN cargo C ON U.id_cargo=C.id JOIN tipo_usuario T ON U.id_tipo_usuario=T.id  WHERE U.id<>1 AND U.id_sede=$sede AND (U.nombre_completo LIKE :consulta OR U.cel_usuario LIKE :consulta OR R.nombre_sede LIKE :consulta) ORDER BY U.nombre_completo";
               }

               $consulta = $_POST['consulta'];

               $query = $this->acceso->prepare($sql);
               $query->execute(array(':consulta' => "%$consulta%"));
               $this->objetos = $query->fetchall();
               return $this->objetos;
          } else {
               if ($tipo <= 2 || ($cargo <> 1 && ($cargo >= 1 && $cargo <= 7))) {
                    $sql = "SELECT U.id, U.nombre_completo, U.fecha_nac, U.avatar, U.cel_usuario, U.tel_usuario, U.dir_usuario, U.email_usuario, T.nombre_tipo, C.nombre_cargo, R.nombre_sede, U.twitter, U.facebook, U.instagram, U.estado, U.id_tipo_usuario, U.genero FROM usuario U JOIN sedes R ON U.id_sede=R.id JOIN cargo C ON U.id_cargo=C.id JOIN tipo_usuario T ON U.id_tipo_usuario=T.id WHERE U.nombre_completo NOT LIKE '' AND U.id<>1 ORDER BY U.nombre_completo ";
               } else {
                    $sql = "SELECT U.id, U.nombre_completo, U.fecha_nac, U.avatar, U.cel_usuario, U.tel_usuario, U.dir_usuario, U.email_usuario, T.nombre_tipo, C.nombre_cargo, R.nombre_sede, U.twitter, U.facebook, U.instagram, U.estado, U.id_tipo_usuario, U.genero FROM usuario U JOIN sedes R ON U.id_sede=R.id JOIN cargo C ON U.id_cargo=C.id JOIN tipo_usuario T ON U.id_tipo_usuario=T.id WHERE U.id<>1 AND U.id_sede=$sede AND (U.nombre_completo NOT LIKE '')  ORDER BY U.nombre_completo ";
               }

               $query = $this->acceso->prepare($sql);
               $query->execute();
               $this->objetos = $query->fetchall();
               return $this->objetos;
          }
     }

     function crear_usuario($nombre, $documento, $id_cargo, $id_sede, $tipo, $avatar, $pass)
     {
          $sql = "SELECT id FROM usuario WHERE doc_id=:documento";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':documento' => $documento));
          $this->objetos = $query->fetchall();
          if (!empty($this->objetos)) {
               echo 'Ya existe un usuario con este número de documento';
          } else {
               $sql2 = "INSERT INTO usuario(nombre_completo, cel_usuario, fecha_nac, doc_id, email_usuario, id_cargo, id_sede, id_tipo_usuario, avatar, estado, usuario, pass)                
               values(:nombre,'','0000-00-00',:documento,'',:id_cargo,:id_sede,:tipo,:avatar,'Activo',:documento,:pass)";
               $query2 = $this->acceso->prepare($sql2);
               $query2->execute(array(':nombre' => $nombre, ':documento' => $documento, ':id_cargo' => $id_cargo, ':id_cargo' => $id_cargo, ':id_sede' => $id_sede, ':tipo' => $tipo, ':avatar' => $avatar, ':pass' => $pass));
               echo 'agregado';
          }
     }

     function ascender($id, $pass, $id_usuario)
     {
          $sql = "SELECT id FROM usuario WHERE pass=:pass AND id=:id_usuario";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':pass' => $pass, ':id_usuario' => $id_usuario));
          $this->objetos = $query->fetchall();
          if (!empty($this->objetos)) {
               $sql2 = "UPDATE usuario SET id_tipo_usuario=2 WHERE id=:id";
               $query2 = $this->acceso->prepare($sql2);
               $query2->execute(array(':id' => $id));
               echo 'ascendido';
          } else {
               echo 'no_verificado' + $id_usuario + " " + $pass;
          }
     }

     function descender($id, $pass, $id_usuario)
     {
          $sql = "SELECT id FROM usuario WHERE pass=:pass AND id=:id_usuario";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':pass' => $pass, ':id_usuario' => $id_usuario));
          $this->objetos = $query->fetchall();
          if (!empty($this->objetos)) {
               $sql2 = "UPDATE usuario SET id_tipo_usuario=3 WHERE id=:id";
               $query2 = $this->acceso->prepare($sql2);
               $query2->execute(array(':id' => $id));
               echo 'descendido';
          } else {
               echo 'no_verificado';
          }
     }

     function activacion($id, $pass, $id_usuario, $estado)
     {
          $sql = "SELECT estado FROM usuario WHERE pass=:pass AND id=:id_usuario";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':pass' => $pass, ':id_usuario' => $id_usuario));
          $this->objetos = $query->fetch();
          if (!empty($this->objetos)) {
               if ($estado == "Inactivo") {
                    $sql2 = "UPDATE usuario SET estado='Activo' WHERE id=:id";
               } else {
                    $sql2 = "UPDATE usuario SET estado='Inactivo' WHERE id=:id";
               }
               $query2 = $this->acceso->prepare($sql2);
               if ($query2->execute(array(':id' => $id))) {
                    echo 'actualizado';
               } else {
                    echo 'Error';
               }
          } else {
               echo 'no_actualizado';
          }
     }

     function restablecer_login($id, $pass, $id_usuario)
     {
          $sql = "SELECT id, doc_id FROM usuario WHERE pass=:pass AND id=:id_usuario";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':pass' => $pass, ':id_usuario' => $id_usuario));
          if (!empty($query->fetchall())) {
               $sql = "SELECT doc_id FROM usuario WHERE id=:id";
               $query = $this->acceso->prepare($sql);
               $query->execute(array(':id' => $id));
               while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $usuario = $row->doc_id;
                    $pass = md5($row->doc_id);
               }
               $sql2 = "UPDATE usuario SET usuario='$usuario', pass='$pass' WHERE id=:id";
               $query2 = $this->acceso->prepare($sql2);
               if ($query2->execute(array(':id' => $id))) {
                    echo 'exito';
               } else {
                    echo 'Error al restablecer el login';
               }
          } else {
               echo 'Error al validar las credenciales de administrador';
          }
     }


     function buscar_avatar($id)
     {
          $sql = "SELECT avatar FROM usuario WHERE id=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function update_familiar($id, $madre, $ocuMadre, $telMadre, $padre, $ocuPadre, $telPadre, $conEmergencia, $parentezco, $telEmergencia)
     {
          $sql2 = "UPDATE usuario SET nombre_madre=:madre, ocupacion_madre=:ocuMadre, tel_madre=:telMadre, nombre_padre=:padre, ocupacion_padre=:ocuPadre, tel_padre=:telPadre, contacto_emergencia=:conEmergencia, parentezco_emergencia=:parentezco, cel_emergencia=:telEmergencia WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':madre' => $madre, ':ocuMadre' => $ocuMadre, ':telMadre' => $telMadre, ':padre' => $padre, ':ocuPadre' => $ocuPadre, ':telPadre' => $telPadre, ':conEmergencia' => $conEmergencia, ':parentezco' => $parentezco, ':telEmergencia' => $telEmergencia))) {
               echo 'update';
          } else {
               echo "Error al actualizar la información";
          }
     }

     function update_sociodemografica($id, $estrato, $estado_civil, $grupo_etnico, $personas_cargo, $cabeza_familia, $hijos, $fuma, $fuma_frecuencia, $bebidas, $bebe_frecuencia, $deporte, $deporte_frecuencia,  $talla_camisa, $talla_pantalon, $talla_calzado, $tipo_vivienda, $licencia_conduccion, $licencia_descr, $act_tiempo_libre)
     {
          $sql2 = "UPDATE usuario SET estrato=:estrato, estado_civil=:estado_civil, grupo_etnico=:grupo_etnico, personas_cargo=:personas_cargo, cabeza_familia=:cabeza_familia, hijos=:hijos, fuma=:fuma, fuma_frecuencia=:fuma_frecuencia, bebidas=:bebidas, bebe_frecuencia=:bebe_frecuencia, deporte=:deporte, deporte_frecuencia=:deporte_frecuencia, talla_camisa=:talla_camisa, talla_pantalon=:talla_pantalon, talla_calzado=:talla_calzado, tipo_vivienda=:tipo_vivienda, licencia_conduccion=:licencia_conduccion, licencia_descr=:licencia_descr, act_tiempo_libre=:act_tiempo_libre WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':estrato' => $estrato, ':estado_civil' => $estado_civil, ':grupo_etnico' => $grupo_etnico, ':personas_cargo' => $personas_cargo, ':cabeza_familia' => $cabeza_familia, ':hijos' => $hijos, ':fuma' => $fuma, ':fuma_frecuencia' => $fuma_frecuencia , ':bebidas' => $bebidas, ':bebe_frecuencia' => $bebe_frecuencia, ':deporte' => $deporte, ':deporte_frecuencia' => $deporte_frecuencia, 
          ':talla_camisa' => $talla_camisa, ':talla_pantalon' => $talla_pantalon, ':talla_calzado' => $talla_calzado, ':tipo_vivienda' => $tipo_vivienda, ':licencia_conduccion' => $licencia_conduccion, ':licencia_descr' => $licencia_descr, ':act_tiempo_libre' => $act_tiempo_libre))) {
               echo 'update';
          } else {
               echo "Error al actualizar la información";
          }
     }

     function cargarusuarioEdit($id)
     {
          $sql = "SELECT * FROM usuario WHERE id=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function crear_estudio($id, $nivel, $tipo, $titulo, $institucion, $año, $ciudad)
     {
          $sql2 = "INSERT INTO estudios(id_usuario, nivel, tipo_nivel, titulo, institucion, ano ,ciudad) 
          VALUES($id,'$nivel','$tipo','$titulo','$institucion',$año,'$ciudad')";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute()) {
               echo 'update';
          } else {
               echo "Error al registrar el estudio";
          }
     }

     function buscarEstudios($id)
     {
          $sql = "SELECT * FROM estudios WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function crear_otro_estudio($id, $tipo, $descripcion)
     {
          $sql2 = "INSERT INTO otros_estudios(id_usuario, tipo, descripcion) 
          VALUES(:id, :tipo, :descripcion)";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':tipo' => $tipo, ':descripcion' => $descripcion))) {
               echo 'update';
          } else {
               echo "Error al registrar el estudio";
          }
     }

     function buscarOtrosEstudios($id)
     {
          $sql = "SELECT * FROM otros_estudios WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function update_laboral($id, $profesion, $ocupacion, $empresa, $cargo, $direccion, $telefono)
     {
          $sql2 = "UPDATE usuario SET formacion_prof=:profesion, ocupacion=:ocupacion, lab_emp=:empresa, cargo_lab=:cargo, dir_lab=:direccion, tel_lab=:telefono WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':profesion' => $profesion, ':ocupacion' => $ocupacion, ':empresa' => $empresa, ':cargo' => $cargo, ':direccion' => $direccion, ':telefono' => $telefono))) {
               echo 'update';
          } else {
               echo "Error al actualizar la información";
          }
     }

     function buscarMedicamento($id)
     {
          $sql = "SELECT * FROM medicamentos WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function buscarEnfermedades($id)
     {
          $sql = "SELECT * FROM enfermedad WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function buscarAlergias($id)
     {
          $sql = "SELECT * FROM alergias WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function buscarCirugias($id)
     {
          $sql = "SELECT * FROM cirugias WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function buscarLesiones($id)
     {
          $sql = "SELECT * FROM lesiones WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function buscarAntecedentes($id)
     {
          $sql = "SELECT * FROM antecedentes WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function buscarCursos($id)
     {
          $sql = "SELECT * FROM cursos WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function crear_medicamento($id, $medicamento, $indicaciones)
     {
          $sql2 = "INSERT INTO medicamentos(id_usuario, nombre, indicaciones) 
          VALUES(:id, :medicamento, :indicaciones)";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':medicamento' => $medicamento, ':indicaciones' => $indicaciones))) {
               echo 'update';
          } else {
               echo "Error al registrar el medicamento";
          }
     }

     function crear_enfermedad($id, $enfermedad)
     {
          $sql2 = "INSERT INTO enfermedad(id_usuario, nombre) 
          VALUES(:id, :enfermedad)";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':enfermedad' => $enfermedad))) {
               echo 'update';
          } else {
               echo "Error al registrar la enfermedad";
          }
     }

     function crear_alergia($id, $tipo, $nombre)
     {
          $sql2 = "INSERT INTO alergias(id_usuario, tipo, nombre) 
          VALUES(:id, :tipo, :nombre)";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':tipo' => $tipo, ':nombre' => $nombre))) {
               echo 'update';
          } else {
               echo "Error al registrar la alergia";
          }
     }

     function crear_cirugia($id, $nombre)
     {
          $sql2 = "INSERT INTO cirugias(id_usuario, nombre) 
          VALUES(:id, :nombre)";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':nombre' => $nombre))) {
               echo 'update';
          } else {
               echo "Error al registrar la cirugía";
          }
     }

     function crear_lesion($id, $tipo, $nombre)
     {
          $sql2 = "INSERT INTO lesiones(id_usuario, tipo, nombre) 
          VALUES(:id, :tipo, :nombre)";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':tipo' => $tipo, ':nombre' => $nombre))) {
               echo 'update';
          } else {
               echo "Error al registrar la lesión";
          }
     }

     function crear_antecedente($id, $nombre)
     {
          $sql2 = "INSERT INTO antecedentes(id_usuario, nombre) 
          VALUES(:id, :nombre)";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':nombre' => $nombre))) {
               echo 'update';
          } else {
               echo "Error al registrar el antecedente";
          }
     }

     function crear_curso($id, $fecha, $institucion, $descripcion, $horas)
     {
          $sql2 = "INSERT INTO cursos(id_usuario, fecha, institucion, descripcion, horas) 
          VALUES(:id, :fecha,:institucion,:descripcion,:horas)";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':fecha' => $fecha, ':institucion' => $institucion, ':descripcion' => $descripcion, ':horas' => $horas))) {
               echo 'update';
          } else {
               echo "Error al registrar el curso";
          }
     }

     function update_salud($id, $eps, $carnet, $tipo_sangre, $arl, $pension, $caja_compensacion)
     {
          $sql2 = "UPDATE usuario SET eps=:eps, carnet=:carnet, tipo_sangre=:tipo_sangre, arl=:arl, pension=:pension, caja_compensacion=:caja_compensacion WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':eps' => $eps, ':carnet' => $carnet, ':tipo_sangre' => $tipo_sangre, ':arl' => $arl, ':pension' => $pension, ':caja_compensacion' => $caja_compensacion))) {
               echo 'update';
          } else {
               echo "Error al actualizar los datos";
          }
     }

     function delEstudio($id)
     {
          $sql2 = "DELETE FROM estudios WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function delOtroEstudio($id)
     {
          $sql2 = "DELETE FROM otros_estudios WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id))) {
               echo 'si';
          }
     }

     function delMedicamento($id)
     {
          $sql2 = "DELETE FROM medicamentos WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function delEnfermedad($id)
     {
          $sql2 = "DELETE FROM enfermedad WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function delAlergia($id)
     {
          $sql2 = "DELETE FROM alergias WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function delCirugia($id)
     {
          $sql2 = "DELETE FROM cirugias WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function delLesion($id)
     {
          $sql2 = "DELETE FROM lesiones WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function delAntecedente($id)
     {
          $sql2 = "DELETE FROM antecedentes WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function delCurso($id)
     {
          $sql2 = "DELETE FROM cursos WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function crear_soporte($id_usuario, $tipo_soporte, $nombre_soporte, $soporte)
     {
          $sql = "INSERT INTO soportes_usuario(id_usuario, tipo_soporte, nombre_soporte,soporte) VALUES(:id_usuario,:tipo_soporte,:nombre_soporte,:soporte)";
          $query = $this->acceso->prepare($sql);
          if ($query->execute(array(':id_usuario' => $id_usuario, ':tipo_soporte' => $tipo_soporte, ':nombre_soporte' => $nombre_soporte, ':soporte' => $soporte))) {
               echo 'creado';
          } else {
               echo 'Error al guardar el soporte';
          }
     }

     function buscarSoportes($id)
     {
          $sql = "SELECT * FROM soportes_usuario WHERE id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function delSoporte($id)
     {
          $sql2 = "DELETE FROM soportes_usuario WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          $query2->execute(array(':id' => $id));
     }

     function update_cc($id, $doc, $id_sede, $id_cargo)
     {
          $sql2 = "UPDATE usuario SET doc_id=:doc, id_sede=:id_sede, id_cargo=:id_cargo  WHERE id=:id";
          $query2 = $this->acceso->prepare($sql2);
          if ($query2->execute(array(':id' => $id, ':doc' => $doc, ':id_sede' => $id_sede, ':id_cargo' => $id_cargo))) {
               echo 'update';
          } else {
               echo "Error al actualizar los datos";
          }
     }

     function cargarCc($id)
     {
          $sql = "SELECT doc_id, id_sede, id_cargo FROM usuario WHERE id=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function reporteGeneral($id_sede, $id_tipo, $id_cargo)
     {
          if ($id_tipo <= 2 || ($id_cargo >= 2 && $id_cargo <= 7)) {
               $sql = "SELECT U.estado, R.nombre_sede, C.nombre_cargo, U.nombre_completo, U.doc_id, U.fecha_nac, U.lugar_nac, U.genero, U.tel_usuario, U.cel_usuario, U.email_usuario, U.formacion_prof, U.ocupacion, U.lab_emp, U.cargo_lab, U.dir_lab, U.tel_lab, U.eps, U.carnet, U.tipo_sangre, U.contacto_emergencia, U.parentezco_emergencia, U.cel_emergencia, U.nombre_madre, U.ocupacion_madre, U.tel_madre, U.nombre_padre, U.ocupacion_padre, U.tel_padre FROM usuario U JOIN cargo C ON U.id_cargo=C.id JOIN sedes R ON U.id_sede=R.id WHERE U.id<>1 AND U.estado='Activo' ORDER BY U.nombre_completo ASC";
          } else {
               $sql = "SELECT U.estado, R.nombre_sede, C.nombre_cargo, U.nombre_completo, U.doc_id, U.fecha_nac, U.lugar_nac, U.genero, U.tel_usuario, U.cel_usuario, U.email_usuario, U.formacion_prof, U.ocupacion, U.lab_emp, U.cargo_lab, U.dir_lab, U.tel_lab, U.eps, U.carnet, U.tipo_sangre, U.contacto_emergencia, U.parentezco_emergencia, U.cel_emergencia, U.nombre_madre, U.ocupacion_madre, U.tel_madre, U.nombre_padre, U.ocupacion_padre, U.tel_padre FROM usuario U JOIN cargo C ON U.id_cargo=C.id JOIN sedes R ON U.id_sede=R.id WHERE U.id<>1 AND U.estado='Activo' AND U.id_sede=$id_sede ";
          }
          $query = $this->acceso->prepare($sql);
          $query->execute();
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function estadisticas($id_sede, $id_cargo)
     {
          if ($id_cargo <= 7) {
               $sql = "SELECT (SELECT COUNT(id) FROM usuario WHERE id<>1) AS registrados, 
          (SELECT COUNT(id) FROM usuario WHERE estado='Activo' AND id<>1) AS activos, 
          (SELECT COUNT(id) FROM usuario WHERE estado='Inactivo' AND id<>1) AS inactivos, 
          (SELECT COUNT(id) FROM usuario WHERE (cel_usuario='' OR eps='' OR tipo_sangre='' OR soporte_cedula='') AND id<>1) AS faltantes 
          FROM usuario GROUP BY registrados, activos, inactivos, faltantes";
          } else {
               $sql = "SELECT (SELECT COUNT(id) FROM usuario WHERE id_sede=$id_sede AND id<>1) AS registrados, 
               (SELECT COUNT(id) FROM usuario WHERE estado='Activo' AND id_sede=$id_sede AND id<>1) AS activos, 
               (SELECT COUNT(id) FROM usuario WHERE estado='Inactivo' AND id_sede=$id_sede AND id<>1) AS inactivos, 
               (SELECT COUNT(id) FROM usuario WHERE (cel_usuario='' OR eps='' OR tipo_sangre='' OR soporte_cedula='') AND id_sede=$id_sede AND id<>1) AS faltantes 
               FROM usuario GROUP BY registrados, activos, inactivos, faltantes";
          }
          $query = $this->acceso->prepare($sql);
          $query->execute();
          $this->objetos = $query->fetchall();
          return $this->objetos;
     }

     function permisosCargo($id)
     {
          $sql = "SELECT C.cobertura, C.adm, C.sedes, C.servicios, C.galeria, C.esal, C.noticias, C.eventos, C.usuarios, C.msj_contacto, C.agenda, C.notas FROM usuario U JOIN cargo C ON U.id_cargo=C.id WHERE U.id=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id' => $id));
          $this->permisos = $query->fetchall();
          return $this->permisos;
     }     
}
