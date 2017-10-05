<?php  
// output headers so that the file is downloaded rather than displayed
$anio=$_GET["anio"];
$mes=$_GET["mes"];
$dia=$_GET["dia"];
header('Content-Type: text/html; charset=utf-8');
header('Content-Disposition: attachment; filename=tamanodespacho-'.$anio.$mes.$dia.'.csv');
 
 $csv_end = "  
";   
$csv_sep = ";";  
$csv="";  
 // create a file pointer connected to the output stream
 $output = fopen('php://output', 'w');
 // output the column headings
 $csv.='DFC'.$csv_sep.'PARTNUMBER'.$csv_sep.'SHIPPINGCALCULATIONCODE'.$csv_sep.'TYPE'.$csv_sep.'WEIGHT'.$csv_sep.'DELETE'.$csv_end;

 date_default_timezone_set("America/Santiago");
                            if(isset($_GET['fecha_consulta'])){
                                $fecha = $_GET['fecha_consulta'];

                            }else{
                                $fecha = date('d/m/Y');
                            }
 // fetch the data

$conn = mysqli_connect('10.95.17.114', 'rivendel', '123456', 'COMMERCE', '3306');
if (!$conn) {
    echo('Could not connect to MySQL: ' . mysqli_connect_error());
}

$res = mysqli_query($conn, "SELECT FIELD5, PARTNUMBER, CODE, CATENTTYPE_ID, WEIGHT, MARKFORDELETE FROM datos WHERE fecha =".$anio.$mes.$dia);
 // loop over the rows, outputting them
 while(($row=mysqli_fetch_array($res, MYSQLI_ASSOC)) != NULL) {
    $csv.=$row['FIELD5'].$csv_sep.$row['PARTNUMBER'].$csv_sep.$row['CODE'].$csv_sep.$row['CATENTTYPE_ID'].$csv_sep.$row['WEIGHT'].$csv_sep.$row['MARKFORDELETE'].$csv_end;      
}
if (!$output) {  
    echo "Cannot open file";  
exit; }   
if (fwrite($output, utf8_decode($csv)) === FALSE) {
        echo "Cannot write to file";
        exit;}
 fclose($output); 
?>
 

