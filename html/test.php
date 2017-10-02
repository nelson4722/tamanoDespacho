<?php
// Put in classpath all needed librararies
$classpath = join(PATH_SEPARATOR, array(
   dirname(__FILE__).DIRECTORY_SEPARATOR.'.',
   dirname(__FILE__).DIRECTORY_SEPARATOR.'ifxjdbc.jar', // JDBC driver
   dirname(__FILE__).DIRECTORY_SEPARATOR.'json-simple-1.1.1.jar',
));
 
// Prepare command to run (SimpleSelect is java program name)
$cmd = sprintf("java -cp '%s' SimpleSelect", $classpath);
 
$descriptorspec = array(
   0 => array("pipe", "r"),
   1 => array("pipe", "w"),
   2 => array("file", "/tmp/error-output.txt", "a")
);
 
$process = proc_open($cmd, $descriptorspec, $pipes);
if (is_resource($process)) {
   // $pipes now looks like this:
   // 0 => writeable handle connected to child stdin
   // 1 => readable handle connected to child stdout
 
   // Send query to Java program
   $command = array(
      'dsn' => 'jdbc:db2://198.101.175.114:50051/WC036S01',
      'query' => 'select wscomusr.CATENTRY.FIELD5,
	   wscomusr.CATENTRY.PARTNUMBER, 
	   wscomusr.CALCODE.CODE,
	   wscomusr.CATENTRY.CATENTTYPE_ID,
	   wscomusr.CATENTSHIP.WEIGHT,
	   wscomusr.CATENTRY.MARKFORDELETE

FROM wscomusr.CATENTRY
LEFT JOIN wscomusr.CATENTDESC ON wscomusr.CATENTDESC.CATENTRY_ID = wscomusr.CATENTRY.CATENTRY_ID
LEFT JOIN wscomusr.CATENCALCD ON wscomusr.CATENTRY.CATENTRY_ID = wscomusr.CATENCALCD.CATENTRY_ID
LEFT JOIN wscomusr.CALCODE ON wscomusr.CALCODE.CALCODE_ID = wscomusr.CATENCALCD.CALCODE_ID
LEFT JOIN wscomusr.CATENTSHIP ON wscomusr.CATENTSHIP.CATENTRY_ID = wscomusr.CATENTRY.CATENTRY_ID
WHERE wscomusr.CATENTRY.MARKFORDELETE = 0
AND wscomusr.CATENTRY.CATENTTYPE_ID <> 'PackageBean' 
AND wscomusr.CATENTDESC.PUBLISHED = 1
AND wscomusr.CATENTRY.BUYABLE = 1
ORDER BY wscomusr.CATENTRY.CATENTTYPE_ID ASC',
      'param' => array(1)
   );
   fwrite($pipes[0], json_encode($command));
   fclose($pipes[0]);
   $output = stream_get_contents($pipes[1]);
   fclose($pipes[1]);
   $return_value = proc_close($process);
 
   // Decode output
   $res = json_decode($output, true);
   if (!empty($res['error'])) throw new Exception($res['error']);
 
   return $res;

?>



<!--<?php
echo "HOLA MUNDO<br>";
jdbc:db2://198.101.175.114:50051/WC036S01
$cmc=jdbc_connect("198.101.175.114","WC036S01","oprparis","4b4544b7","50051");
if (!$cmc) {
    echo "NO CONECTADO";
}

$query="SELECT wscomusr.CATENTRY.FIELD5,
	   wscomusr.CATENTRY.PARTNUMBER, 
	   wscomusr.CALCODE.CODE,
	   wscomusr.CATENTRY.CATENTTYPE_ID,
	   wscomusr.CATENTSHIP.WEIGHT,
	   wscomusr.CATENTRY.MARKFORDELETE

FROM wscomusr.CATENTRY
LEFT JOIN wscomusr.CATENTDESC ON wscomusr.CATENTDESC.CATENTRY_ID = wscomusr.CATENTRY.CATENTRY_ID
LEFT JOIN wscomusr.CATENCALCD ON wscomusr.CATENTRY.CATENTRY_ID = wscomusr.CATENCALCD.CATENTRY_ID
LEFT JOIN wscomusr.CALCODE ON wscomusr.CALCODE.CALCODE_ID = wscomusr.CATENCALCD.CALCODE_ID
LEFT JOIN wscomusr.CATENTSHIP ON wscomusr.CATENTSHIP.CATENTRY_ID = wscomusr.CATENTRY.CATENTRY_ID
WHERE wscomusr.CATENTRY.MARKFORDELETE = 0
AND wscomusr.CATENTRY.CATENTTYPE_ID <> 'PackageBean' 
AND wscomusr.CATENTDESC.PUBLISHED = 1
AND wscomusr.CATENTRY.BUYABLE = 1
ORDER BY wscomusr.CATENTRY.CATENTTYPE_ID ASC";

$res=odbc_exec($cmc,query);
while(odbc_fetch_row($res))
{
	$FIELD5=odbc_result($res, 1);
	echo $FIELD5 . "<br>";
}
?>-->