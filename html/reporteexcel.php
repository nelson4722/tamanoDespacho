<?php
header('Content-Type: text/html; charset=utf-8');

    $conexion = new mysqli('localhost', 'root', '123456', 'pruebas', '3306');
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
	$consulta = "SELECT * FROM datos";
	$resultado = $conexion->query($consulta);
	if($resultado->num_rows > 0 ){
						
		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de alumnos")
							 ->setKeywords("reporte alumnos carreras")
							 ->setCategory("Reporte excel");

		$tituloReporte = "Relación de alumnos por carrera";
		$titulosColumnas = array('PM','NDepto','Depto','NSubDepto','SubDepto','Nclase','Clase','TAMANO','FIELD5','ShippingCalculationCode','Weight','Pequeno','SmallProduct-ShipCode');
		
		//$objPHPExcel->setActiveSheetIndex(0)
        ///		    ->mergeCells('A1:M1');
						
		// Se agregan los titulos del reporte
				$objPHPExcel->setActiveSheetIndex(0)
//					->setCellValue('A1',  $tituloReporte)
					->setCellValue('A1',  $titulosColumnas[0])
        		    ->setCellValue('B1',  $titulosColumnas[1])
		            ->setCellValue('C1',  $titulosColumnas[2])
        		    ->setCellValue('D1',  $titulosColumnas[3])
            		->setCellValue('E1',  $titulosColumnas[4])
            		->setCellValue('F1',  $titulosColumnas[5])
            		->setCellValue('G1',  $titulosColumnas[6])
            		->setCellValue('H1',  $titulosColumnas[7])
            		->setCellValue('I1',  $titulosColumnas[8])
            		->setCellValue('J1',  $titulosColumnas[9])
            		->setCellValue('K1',  $titulosColumnas[10])
            		->setCellValue('L1',  $titulosColumnas[11])
            		->setCellValue('M1',  $titulosColumnas[12]);
		
		//Se agregan los datos de los alumnos
		$i = 2;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i, utf8_encode($fila['PM']))
		            ->setCellValue('B'.$i,  utf8_encode($fila['NDepto']))
        		    ->setCellValue('C'.$i,  utf8_encode($fila['Depto']))
            		->setCellValue('D'.$i, utf8_encode($fila['NSubDepto']))
            		->setCellValue('E'.$i, utf8_encode($fila['SubDepto']))
            		->setCellValue('F'.$i, utf8_encode($fila['Nclase']))
            		->setCellValue('G'.$i, utf8_encode($fila['Clase']))
            		->setCellValue('H'.$i, utf8_encode($fila['TAMANO']))
            		->setCellValue('I'.$i, utf8_encode($fila['FIELD5']))
            		->setCellValue('J'.$i, utf8_encode($fila['ShippingCalculationCode']))
            		->setCellValue('K'.$i, utf8_encode($fila['Weight']))
            		->setCellValue('L'.$i, utf8_encode($fila['Pequeno']))
            		->setCellValue('M'.$i, utf8_encode($fila['SmallProduct-ShipCode']));
					$i++;
		}
		
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>16,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'c47cf2'
        		),
        		'endcolor'   => array(
            		'argb' => 'FF431a5d'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFd9b7f4')
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => '3a2a47'
                   	)
               	)             
           	)
        ));
		 
		//$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A2:M".($i-1));
				
		for($i = 'A'; $i <= 'M'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Alumnos');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reportedealumnos.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>