<?php  
// output headers so that the file is downloaded rather than displayed
$anio=$_GET["anio"];
$mes=$_GET["mes"];
$dia=$_GET["dia"];
header('Content-Type: text/html; charset=utf-8');
header('Content-Disposition: attachment; filename=informeTamañoProducto-'.$anio.$mes.$dia.'.csv');
 
 $csv_end = "  
";   
$csv_sep = ";";  
$csv="";  
 // create a file pointer connected to the output stream
 $output = fopen('php://output', 'w');
 // output the column headings

 $csv.='NDepto'.$csv_sep.'Depto'.$csv_sep.'NSubDepto'.$csv_sep.'SubDepto'.$csv_sep.'Nclase'.$csv_sep.'Clase'.$csv_sep.'TAMAÑO'.$csv_sep.'FIELD5'.$csv_sep.'ShippingCalculationCode'.$csv_sep.'Weight'.$csv_end;

  // fetch the data

$conn = mysqli_connect('localhost', 'root', '123456', 'pruebas', '3306');
if (!$conn) {
    echo('Could not connect to MySQL: ' . mysqli_connect_error());
}

$res = mysqli_query($conn, "SELECT NDepto,Depto,NSubDepto,SubDepto,Nclase,Clase,TAMANO,FIELD5,ShippingCalculationCode,Weight FROM datos");
 // loop over the rows, outputting them
 while(($row=mysqli_fetch_array($res, MYSQLI_ASSOC)) != NULL) {
    if($row['TAMANO']=='Pequeno'){
        $csv.=$row['NDepto'].$csv_sep.$row['Depto'].$csv_sep.$row['NSubDepto'].$csv_sep.$row['SubDepto'].$csv_sep.$row['Nclase'].$csv_sep.$row['Clase'].$csv_sep.'Pequeño'.$csv_sep.$row['FIELD5'].$csv_sep.$row['ShippingCalculationCode'].$csv_sep.$row['Weight'].$csv_end;}
        else {
                $csv.=$row['NDepto'].$csv_sep.$row['Depto'].$csv_sep.$row['NSubDepto'].$csv_sep.$row['SubDepto'].$csv_sep.$row['Nclase'].$csv_sep.$row['Clase'].$csv_sep.$row['TAMANO'].$csv_sep.$row['FIELD5'].$csv_sep.$row['ShippingCalculationCode'].$csv_sep.$row['Weight'].$csv_end;
        }

}
if (!$output) {  
    echo "Cannot open file";  
exit; }   
if (fwrite($output, ($csv)) === FALSE) {
        echo "Cannot write to file";
        exit;}
 fclose($output); 
?>
 

