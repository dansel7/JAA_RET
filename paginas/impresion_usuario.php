<?php
header("Content-Type: text/html;charset=utf-8");
	include("conexion.php");
mysql_query("SET NAMES 'utf8'");
	require("fpdf.php");
	
	$id=$_GET['id'];
	$consulta_hermano="SELECT hermanos.nombres,hermanos.pago,hermanos.apellidos,hermanos.f_nac,hermanos.edad,hermanos.genero,hermanos.telefono,hermanos.celular,hermanos.correo,hermanos.direccion, hermanos.bautizado,hermanos.ccdl,modulos_ccdl.nombre as modulo,hermanos.jaa,hermanos.gj,hermanos.ed,hermanos.fv,hermanos.esp_aler,hermanos.medicamento,hermanos.contacto1,hermanos.telefono1,hermanos.celular1,hermanos.parentesco1,hermanos.correo1,hermanos.contacto2,hermanos.telefono2,hermanos.celular2,hermanos.parentesco2,hermanos.correo2,tallas.nombre,hermanos.ged,hermanos.ministerio FROM hermanos
	INNER JOIN modulos_ccdl
	ON modulos_ccdl.id_modulo=hermanos.modulo
	INNER JOIN tallas
	ON tallas.id_talla=hermanos.talla
	WHERE id_hermano=$id";
	$res=mysql_query($consulta_hermano);
	while($row=mysql_fetch_array($res)){
				$nombre=ucwords(utf8_decode($row['nombres']));
				$apellido=ucwords(utf8_decode($row['apellidos']));
				$nombres=$nombre." ".$apellido;
				//$nombres=ucwords($nombres);
				//$nombres=html_entity_decode($nombres);
				$f_nac=$row['f_nac'];
				$edad=$row['edad'];
				if($row['genero']=="m"){
					$genero="Masculino";
				}else{
					$genero="Femenino";
				}
				$telefono=$row['telefono'];
				$celular=$row['celular'];
				$email=$row['correo'];
				$direccion=ucfirst(utf8_decode($row['direccion']));
				$bautizado=ucfirst($row['bautizado']);
				$ccdl=ucfirst($row['ccdl']);
				$modulo=ucfirst(html_entity_decode($row['modulo']));
				$lista="";
				if($row['jaa']=="si"){
					$lista="JAA   ";
				}
				if($row['gj']=="si"){
					$lista=$lista."Grupo Juvenil   ";
				}
				if($row['ed']=="si"){
					$lista=$lista."Escuela Dominical   ";
				}
				if($row['fv']=="si"){
					$lista=$lista."Formando vidas   ";
				}				
				$ministerios=$lista;
				$esp_aler=ucfirst(utf8_decode($row['esp_aler']));
				$medicamento=ucfirst(utf8_decode($row['medicamento']));
				$contacto1=$row['contacto1'];
				$contacto1=ucwords($contacto1);
				$contacto1=utf8_decode($contacto1);
				$contacto2=$row['contacto2'];
				$contacto2=ucwords($contacto2);
				$contacto2=utf8_decode($contacto2);
				$telefono1=$row['telefono1'];
				$celular1=$row['celular1'];
				$correo1=$row['correo1'];
				$telefono2=$row['telefono2'];
				$celular2=$row['celular2'];
				$correo2=$row['correo2'];
				$parentesco1=ucfirst($row['parentesco1']);
				$parentesco2=ucfirst(utf8_decode($row['parentesco2']));
				$pago = $row['pago'];
			}
			$contador=0;
			$pago="no";
			$consulta_inscripcion="SELECT id_inscripcion, pago FROM inscripcion WHERE id_hermano='".$id."'";
			$res_i=mysql_query($consulta_inscripcion);
			while($row_i=mysql_fetch_array($res_i)){
				$contador=$row_i['id_inscripcion'];
				$pago=$row_i['pago'];
			}
			if($pago=="no"){ $contador=0; }	
	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,9,'IGLESIA CRISTIANA JOSUE',0,1,'C',false);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,'JOVENES CON ALAS DE AGUILA',0,1,'C',false);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,11,'FORMATO INSCRIPCION RETIRO',0,1,'C',false);
	$pdf->Image('../diseno/img/aguila.png',20,8,43);	
	
	$pdf->Cell(160);
	$pdf->Cell(20,10,'Nº '.$contador.'',1,1,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,0,'  DATOS GENERALES ',0,1,'L',false);
	$pdf->Ln(5);
	$pdf->Cell(50,0,'_______________________________________________________________________________________',0,1,'L',false);
	$pdf->Ln(10);
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(65,0,'  Nombre completo: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$nombres.'',0,0,'L',false);
	$pdf->Ln(5);
	
	$pdf->Cell(50,0,'  Fecha de nacimiento: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$f_nac.'',0,0,'L',false);
	$pdf->Cell(72);
	$pdf->Cell(1,0,'  Edad:',0,1,'L',false);
	$pdf->Cell(140);
	$pdf->Cell(1,0,''.$edad.'',0,1,'L',false);
	$pdf->Ln(5);
	$pdf->Cell(50,0,'  Genero: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$genero.'',0,0,'L',false);
	$pdf->Ln(5);
	
	$pdf->Cell(50,0,'  Telefono de casa: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$telefono.'',0,0,'L',false);
	$pdf->Cell(70);
	$pdf->Cell(1,0,'  Celular:',0,1,'L',false);
	$pdf->Cell(140);
	$pdf->Cell(1,0,''.$celular.'',0,1,'L',false);
	$pdf->Ln(5);
	
	$pdf->Cell(50,0,'  Email: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$email.'',0,0,'L',false);
	$pdf->Ln(5);
	
	$pdf->Cell(50,0,'  Alergias: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$esp_aler.'',0,0,'L',false);
	$pdf->Ln(5);
	$pdf->Cell(50,0,'  Medicamento:',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$medicamento.'',0,1,'L',false);
	$pdf->Ln(5);
	
	$pdf->Cell(50,5,'  Direccion: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->MultiCell(101,5,''.$direccion.'');
	$pdf->Ln(10);
	
	$pdf->Cell(50,0,'  Ministerios: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$ministerios.'',0,0,'L',false);
	$pdf->Ln(10);
	
	$pdf->Cell(50,0,'  Bautizado: ',0,1,'L',false);
	$pdf->Cell(27);
	$pdf->Cell(1,0,''.$bautizado.'',0,0,'L',false);
	$pdf->Cell(21);
	$pdf->Cell(1,0,' CCDL: ',0,1,'L',false);
	$pdf->Cell(70);
	$pdf->Cell(1,0,''.$ccdl.'',0,1,'L',false);
	$pdf->Cell(122);
	$pdf->Cell(1,0,'Modulo: ',0,1,'L',false);
	$pdf->Cell(137);
	$pdf->Cell(1,0,''.$modulo.'',0,1,'L',false);
	$pdf->Ln(10);

	$pdf->Cell(50,0,'  Nombre de encargado: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$contacto1.'',0,0,'L',false);
	$pdf->Cell(70);
	$pdf->Cell(1,0,'Telefono: ',0,1,'L',false);
	$pdf->Cell(140);
	$pdf->Cell(1,0,''.$telefono1.'',0,1,'L',false);
	$pdf->Ln(5);
	$pdf->Cell(50,0,'  Parentesco: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$parentesco1.'',0,0,'L',false);
	$pdf->Cell(70);
	$pdf->Cell(1,0,'Celular: ',0,1,'L',false);
	$pdf->Cell(140);
	$pdf->Cell(1,0,''.$celular1.'',0,1,'L',false);
	$pdf->Ln(5);	
	$pdf->Cell(50,0,'  Email: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$correo1.'',0,0,'L',false);
	$pdf->Ln(10);
	
	$pdf->Cell(50,0,'  Nombre de encargado: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$contacto2.'',0,0,'L',false);
	$pdf->Cell(70);
	$pdf->Cell(1,0,'Telefono: ',0,1,'L',false);
	$pdf->Cell(140);
	$pdf->Cell(1,0,''.$telefono2.'',0,1,'L',false);
	$pdf->Ln(5);
	$pdf->Cell(50,0,'  Parentesco: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$parentesco2.'',0,0,'L',false);
	$pdf->Cell(70);
	$pdf->Cell(1,0,'Celular: ',0,1,'L',false);
	$pdf->Cell(140);
	$pdf->Cell(1,0,''.$celular2.'',0,1,'L',false);
	$pdf->Ln(5);	
	$pdf->Cell(50,0,'  Email: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,''.$correo2.'',0,0,'L',false);
	$pdf->Ln(10);
	
	$pdf->Cell(50,0,'  Nombre de responsable: ',0,1,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(1,0,' ',1,0,'L',false);
	$pdf->Ln(5);
	$pdf->Cell(50,0,'  Telefono: ',0,1,'L',false);
	$pdf->Cell(140);
	$pdf->Cell(1,0,' ',0,1,'L',false);
	$pdf->Ln(25);
	
	$pdf->Cell(0,9,'_________________________________                 _________________________________',0,1,'C',false);
	$pdf->Cell(0,10,'Firma de responsable                                  Firma de asistente',0,1,'C',false);
	$pdf->Cell(0,11,'CLAUSURA DE COMPROMISO',1,1,'C',false);
	$pdf->Ln(5);
	$pdf->MultiCell(185,3,'Por este medio doy fe que es de mi conocimiento el reglamento establecido por el Ministerio JAA y me comprometo a cumplirlo y acatar todas las indicaciones que se me den en el centro de retiros. Además me comprometo a permanecer dentro de las instalaciones del Centro de Retiros  Dado que  la falta al reglamento  es considerada como falta grave por el Ministerio JAA, asumo las consecuencias que conlleve esto.');
	$pdf->Output();

?>