<?php
ob_end_clean();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
$data_name=$this->session->userdata('id_admin');
$notification=$this->db->get_where("tbl_discussions",array("reciver_view"=>'0','to_id'=>$data_name,'reply_id'=>'0'))->result();
$count_notify=count($notification);
echo "data: {$count_notify}\n\n";
sleep(1);
?>
