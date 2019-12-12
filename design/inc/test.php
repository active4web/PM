<?php
/*ob_end_clean();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');*/
session_start() ;
$data_name=$_SESSION['admin_name'];
echo "data: The server time is: {$data_name}\n\n";
//
//sleep(1);

?>
