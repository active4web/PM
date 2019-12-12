<?php
ob_end_clean();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
$data_name=$this->session->userdata('id_admin');
$notification=$this->db->get_where("notification",array("view"=>'0','id_user'=>$data_name))->result();
$count_notify=count($notification);
echo "data: {$count_notify}\n\n";
sleep(1);
?>
