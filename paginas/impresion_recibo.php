<?php
error_reporting(0);
header('Content-Type: text/html; charset=UTF-8');
	include("../class/conexion.php");

	require("fpdf.php");
	
	$id=$_GET['id'];
	$consulta_hermano="SELECT hermanos.nombres,hermanos.pago,hermanos.apellidos,hermanos.f_nac,hermanos.edad,hermanos.genero,hermanos.telefono,hermanos.celular,hermanos.correo,hermanos.direccion, hermanos.bautizado,hermanos.ccdl,modulos_ccdl.nombre as modulo,hermanos.jaa,hermanos.gj,hermanos.ed,hermanos.fv,hermanos.nom_grupo_fv,hermanos.esp_aler,hermanos.medicamento,hermanos.contacto1,hermanos.telefono1,hermanos.celular1,hermanos.parentesco1,hermanos.correo1,hermanos.contacto2,hermanos.telefono2,hermanos.celular2,hermanos.parentesco2,hermanos.correo2,tallas.nombre,hermanos.ged,hermanos.ministerio,hermanos.valorPago FROM hermanos
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
                                $fv=$row['fv'];
                                $nom_grupo_fv=$row['nom_grupo_fv'];
                                $valorPago=  $row['valorPago'];
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
                        if($fv=="si"){$fv="Si                  Grupo: ".$nom_grupo_fv;}
	
	$pdf = new FPDF();
	$pdf->AddPage();
        $pdf->Cell(160);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(20,6,'No. '.$contador.'',1,1,'C');
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,8,'IGLESIA CRISTIANA JOSUE',0,1,'C',false);
        $pdf->Image('../paginas/camara/'.$id.'.jpg',150,18,45);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,8,'JOVENES CON ALAS DE AGUILA',0,1,'C',false);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,5,'FORMATO INSCRIPCION RETIRO',0,1,'C',false);
	$pdf->Image('../diseno/img/aguila.png',20,15,43);
        $pdf->Image('../diseno/img/original.png',85,40,40);	

	$pdf->Ln(15);
        
        $pdf->Cell(12);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(65,0,'  Nombre completo: ',0,1,'L',false);
	$pdf->Cell(55);
	$pdf->Cell(1,0,''.$nombres.'',0,0,'L',false);
	$pdf->Ln(8);
	
        $pdf->Cell(12);
	$pdf->Cell(1,0,'  Edad:',0,1,'L',false);
	$pdf->Cell(25);
	$pdf->Cell(1,0,''.$edad.'',0,1,'L',false);
        $pdf->Cell(53);
	$pdf->Cell(50,0,'  Telefono de casa: ',0,1,'L',false);
	$pdf->Cell(90);
	$pdf->Cell(1,0,''.$telefono.'',0,0,'L',false);
	$pdf->Cell(30);
	$pdf->Cell(1,0,'  Celular:',0,1,'L',false);
	$pdf->Cell(145);
	$pdf->Cell(1,0,''.$celular.'',0,1,'L',false);
	$pdf->Ln(8);
	
        $pdf->Cell(12);
	$pdf->Cell(50,0,'  Email: ',0,1,'L',false);
	$pdf->Cell(30);
	$pdf->Cell(1,0,''.$email.'',0,0,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(50,0,'  Formando Vidas: ',0,1,'L',false);
	$pdf->Cell(115);
	$pdf->Cell(1,0,''.$fv.'',0,0,'L',false);
        $pdf->Ln(8);
	
        $pdf->Cell(12);
	$pdf->Cell(50,0,'  Nombre de Responsable: ',0,1,'L',false);
	$pdf->Cell(55);
	$pdf->Cell(1,0,''.$contacto1.'',0,0,'L',false);
	$pdf->Cell(68);
	$pdf->Cell(1,0,'Telefono: ',0,1,'L',false);
	$pdf->Cell(145);
	$pdf->Cell(1,0,''.$telefono1.'',0,1,'L',false);
	
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',9);
        $pdf->Cell(14);
        $pdf->Cell(1,0,'CLAUSULA COMPROMISO: ',0,1,'L',false);
        $pdf->Cell(125);
        $pdf->SetFont('Arial','B',14);
	$pdf->Cell(1,0,'Recibo por: $'.$valorPago.'',0,1,'L',false);
        $pdf->SetFont('Arial','',9);
	$pdf->Ln(5);
        $pdf->Cell(15);
	$pdf->MultiCell(160,4,'Por este medio doy fe que es de mi conocimiento el reglamento establecido por el Ministerio JAA y me comprometo a cumplirlo y acatar todas las indicaciones que se me den en el centro de retiros. Ademas me comprometo a permanecer dentro de las instalaciones del Centro de Retiros  Dado que  la falta al reglamento  es considerada como falta grave por el Ministerio JAA, asumo las consecuencias que conlleve esto.',1);
        $pdf->Ln(10);
	$pdf->Cell(0,9,'_________________________________                 _________________________________',0,1,'C',false);
	$pdf->Cell(185,10,'Firma de responsable                                                  Firma de asistente',0,1,'C',false);
        
            

        //PARTE 2 COPIA DE RECIBO
        
	$pdf->Cell(0,9,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _',0,1,'C',false);
	$pdf->Ln(4);
        $pdf->Cell(160);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(20,6,'No. '.$contador.'',1,1,'C');
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,8,'IGLESIA CRISTIANA JOSUE',0,1,'C',false);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,8,'JOVENES CON ALAS DE AGUILA',0,1,'C',false);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,5,'FORMATO INSCRIPCION RETIRO',0,1,'C',false);
	$pdf->Image('../diseno/img/aguila.png',20,153,43);	
        $pdf->Image('../diseno/img/copia.png',88,178,30);	
	$pdf->Ln(16);
        
        $pdf->Cell(12);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(65,0,'  Nombre completo: ',0,1,'L',false);
	$pdf->Cell(55);
	$pdf->Cell(1,0,''.$nombres.'',0,0,'L',false);
	$pdf->Ln(8);
	
        $pdf->Cell(12);
	$pdf->Cell(1,0,'  Edad:',0,1,'L',false);
	$pdf->Cell(25);
	$pdf->Cell(1,0,''.$edad.'',0,1,'L',false);
        $pdf->Cell(53);
	$pdf->Cell(50,0,'  Telefono de casa: ',0,1,'L',false);
	$pdf->Cell(90);
	$pdf->Cell(1,0,''.$telefono.'',0,0,'L',false);
	$pdf->Cell(30);
	$pdf->Cell(1,0,'  Celular:',0,1,'L',false);
	$pdf->Cell(145);
	$pdf->Cell(1,0,''.$celular.'',0,1,'L',false);
	$pdf->Ln(8);
	
        $pdf->Cell(12);
	$pdf->Cell(50,0,'  Email: ',0,1,'L',false);
	$pdf->Cell(30);
	$pdf->Cell(1,0,''.$email.'',0,0,'L',false);
	$pdf->Cell(50);
	$pdf->Cell(50,0,'  Formando Vidas: ',0,1,'L',false);
	$pdf->Cell(115);
	$pdf->Cell(1,0,''.$fv.'',0,0,'L',false);
        $pdf->Ln(8);
	
        $pdf->Cell(12);
	$pdf->Cell(50,0,'  Nombre de Responsable: ',0,1,'L',false);
	$pdf->Cell(55);
	$pdf->Cell(1,0,''.$contacto1.'',0,0,'L',false);
	$pdf->Cell(68);
	$pdf->Cell(1,0,'Telefono: ',0,1,'L',false);
	$pdf->Cell(145);
	$pdf->Cell(1,0,''.$telefono1.'',0,1,'L',false);
	
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',9);
        $pdf->Cell(14);
        $pdf->Cell(1,0,'CLAUSULA COMPROMISO: ',0,1,'L',false);
        $pdf->Cell(125);
        $pdf->SetFont('Arial','B',14);
	$pdf->Cell(1,0,'Recibo por: $'.$valorPago.'',0,1,'L',false);
        $pdf->SetFont('Arial','',9);
	$pdf->Ln(5);
        $pdf->Cell(15);
	$pdf->MultiCell(160,4,'Por este medio doy fe que es de mi conocimiento el reglamento establecido por el Ministerio JAA y me comprometo a cumplirlo y acatar todas las indicaciones que se me den en el centro de retiros. Ademas me comprometo a permanecer dentro de las instalaciones del Centro de Retiros  Dado que  la falta al reglamento  es considerada como falta grave por el Ministerio JAA, asumo las consecuencias que conlleve esto.',1);
        $pdf->Ln(10);
	$pdf->Cell(0,9,'_________________________________                 _________________________________',0,1,'C',false);
	$pdf->Cell(185,10,'Firma de responsable                                                  Firma de asistente',0,1,'C',false);
        
        
        
        $pdf->Output();

?>