<?php 
//Script para conexión con base de datos en Mysql
include("db_controller/mysql_script.php");

// Obtenemos parametros
$obj = (object)$_REQUEST;

switch ($obj->action) {
    case 'exportToWord':
    	//Obtenemos los 100 primeros registros mediante la siguiente consulta
    	$rows = query("SELECT * FROM personal ORDER BY nombres ASC LIMIT 100 ");
		// Establecemos un nombre al archivo
		$fileName = "exportWORD.doc";
		// estructuramos los datos en una tabla
		$html = '<table style="margin:auto;">
				<tr>
					<th colspan="4" align="center">NOMBRES MAS FRECUENTES DE MUJERES EN ESPAÑA</th>
				</tr>
				<tr>
					<th>Nro</th>
					<th>Nombres</th>
					<th>Fecuencia</th>
					<th>Serie</th>
				</tr>
		';
	    // De forma dinamica añadimos los registros obtenidos de MYSQL
	    foreach ($rows as $key => $row) {
	    	$html.= '<tr>
	    				<td>'.( (int)$key+1 ).'</td>
	    				<td>'.$row['nombres'].'</td>
	    				<td>'.$row['frecuencia'].'</td>
	    				<td>'.$row['serie'].'</td>
					</tr>
	    			';
	    }
				
		$html.='</table>';
		// Establecemos el tipo de archivo a exportar
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=".$fileName);
		// Imprimimos los datos
		echo $html;

    	break;
}
?>