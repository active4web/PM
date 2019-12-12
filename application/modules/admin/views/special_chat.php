<!DOCTYPE html>
<html>
<head>
	<title>شات نظام ادارة المشروعات</title>
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=DIR;?>design/assets/global/plugins/font-awesome/css/font-awesome.min.css">

  	<link rel="stylesheet" href="<?php echo base_url();?>design/assets/chat.css">

</head>
<body>
	<div class="row">
		<div class="col-md-12">
			<div class="main_section">
			   <div>
			      <div class="chat_container">
			         <div class="col-sm-3 chat_sidebar">
			    	 <div class="row">
			            <div id="custom-search-input">
			            	<p>Welcome <b><?php echo $this->session->userdata('admin_name');?></b></p>
			            </div>
			            <div class="dropdown all_conversation">
			               <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			               <i class="fa fa-weixin" aria-hidden="true"></i>
			               Online
			               </button>
			            </div>
			            <div class="member_list">
			               <ul class="list-unstyled" id="appendponline">
			               	  <?php 
			               	  
			               	  	$id_project=$this->input->get('id_project');
			               	  foreach($active_members as $value){
			               	  
			           
		 $list_user=$this->db->get_where("tbl_tasks",array("user_id"=>$value->id,'project_id'=>$id_project))->result();
		 if(count($list_user)>0){
			               	  ?>	
							<a href="<?=DIR?>admin/chat/special_chat?user=<?= $value->id?>&id_project=<?=$id_project?>"> <strong class="primary-font">
			                  <li class="left clearfix">
			                     <span class="chat-img pull-left">
			                     <img src="<?=DIR?>uploads/site_setting/faq_man.png" class="img-circle">
			                     </span>
			                     <div class="chat-body clearfix">
			                        <div class="header_sec">
								<?= $value->fname?>&nbsp<?= $value->lname?></strong>
			                        </div>
			                     </div>
			                  </li>
								</a>
								<?php }?>
			                  <?php }?>
			               </ul>
			            </div>
		            </div>
		         </div>
			         <!--chat_sidebar-->
					 
					 
			         <div class="col-sm-9 message_section">
						 <div class="row">
							 <div class="new_message_head">
								<div class="pull-right"><div class="dropdown">
								  <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="fa fa-cogs" aria-hidden="true"></i>  Setting
								    <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
								    <li><a href="<?php echo base_url();?>login/logout">خروج</a></li>
								  </ul>
								</div></div>
							 </div><!--new_message_head-->
							 
							 <div class="chat_area">
								 <ul id="appendchat" class="list-unstyled">
									 <?php
									 $userid=$this->input->get('user');
									 $id_my=$this->session->userdata('id_admin');
									  	$id_project=$this->input->get('id_project');
									 $total_message=$this->db->get_where("chat",array("type"=>'0','id_to'=>$id_my,'id_from'=>$userid,'id_project'=>$id_project))->result();
									 if(count($total_message)>0){
										 foreach($total_message as $total_message){
											$fname=	get_table_filed("tbl_users",array("id"=>$total_message->id_from),"fname");
											$lname=	get_table_filed("tbl_users",array("id"=>$total_message->id_from),"lname");
												$sname=	get_table_filed("tbl_users",array("id"=>$total_message->id_from),"sname");
											 ?>
										 <?php #endregion
										 if($total_message->id_from==$this->session->userdata('id_admin')){
										
										 ?>
										<li class="left clearfix">
				<span class="chat-img1 pull-left">
					<img src="<?=DIR?>uploads/site_setting/faq_man.png" alt="User Avatar" class="img-circle">
				</span>
				<div class="chat-body1 clearfix">
					<p class="font-else"><b><?=$fname."&nbsp&nbsp".$sname."&nbsp&nbsp".$lname?></b>:<?=$total_message->content;?></b>:<?=$total_message->content;?></p>
					<div class="chat_time pull-right"><?=$total_message->date;?></div>
				</div>
			</li>
										 <?php }else {?>
											<li class="left clearfix admin_chat">
				<span class="chat-img1 pull-left">
					<img src="<?=DIR?>uploads/site_setting/faq_man.png" alt="User Avatar" class="img-circle">
				</span>
				<div class="chat-body1 clearfix">
					<p class="font-me"><b><?=$fname."&nbsp&nbsp".$sname."&nbsp&nbsp".$lname?></b>:<?=$total_message->content;?></b>:<?=$total_message->content;?></p>
					<div class="chat_time pull-right"><?=$total_message->date;?></div>
				</div>
			</li>

										 <?php }?>

									 <?php
										 }
									}
									 ?>
								 </ul>
								 
								 
								 
								 
								 			 <ul id="appendchat" class="list-unstyled">
									 <?php
									 $userid=$this->input->get('user');
									 $id_my=$this->session->userdata('id_admin');
									  	$id_project=$this->input->get('id_project');
									 $total_message=$this->db->get_where("chat",array("type"=>'0','id_to'=>$userid,'id_from'=>$id_my,'id_project'=>$id_project))->result();
									 if(count($total_message)>0){
										 foreach($total_message as $total_message){
											$fname=	get_table_filed("tbl_users",array("id"=>$total_message->id_from),"fname");
											$lname=	get_table_filed("tbl_users",array("id"=>$total_message->id_from),"lname");
												$sname=	get_table_filed("tbl_users",array("id"=>$total_message->id_from),"sname");
											 ?>
										 <?php #endregion
										 if($total_message->id_from==$this->session->userdata('id_admin')){
										
										 ?>
										<li class="left clearfix">
				<span class="chat-img1 pull-left">
					<img src="<?=DIR?>uploads/site_setting/faq_man.png" alt="User Avatar" class="img-circle">
				</span>
				<div class="chat-body1 clearfix">
					<p class="font-else"><b><?=$fname."&nbsp&nbsp".$sname."&nbsp&nbsp".$lname?></b>:<?=$total_message->content;?></b>:<?=$total_message->content;?></p>
					<div class="chat_time pull-right"><?=$total_message->date;?></div>
				</div>
			</li>
										 <?php }else {?>
											<li class="left clearfix admin_chat">
				<span class="chat-img1 pull-left">
					<img src="<?=DIR?>uploads/site_setting/faq_man.png" alt="User Avatar" class="img-circle">
				</span>
				<div class="chat-body1 clearfix">
					<p class="font-me"><b><?=$fname."&nbsp&nbsp".$sname."&nbsp&nbsp".$lname?></b>:<?=$total_message->content;?></b>:<?=$total_message->content;?></p>
					<div class="chat_time pull-right"><?=$total_message->date;?></div>
				</div>
			</li>

										 <?php }?>

									 <?php
										 }
									}
									 ?>
								 </ul>
								 
							 </div><!--chat_area-->
						         <div class="message_write">
						    	<textarea class="form-control" id="message" placeholder="type a message"></textarea>
								 <div class="clearfix"></div>
								 <div class="chat_bottom"><a id="sendchat" href="#" class="pull-right btn btn-success">ارسال</a></div>
							 </div>
						 </div>
			         </div> <!--message_section-->
			      </div>
			   </div>
			</div>
		</div>
		  <!-- Modal -->

	</div>
	
	<input type="hidden" value="<?= $id_project?>" id="id_project">
</body>
</html>
<!-- Scripts -->
<script src="<?=DIR;?>design/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=DIR;?>design/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=DIR;?>design/assets/layouts/layout4/scripts/pusher.min.js" type="text/javascript"></script>
<script type="text/javascript">
	// Enable pusher logging - don't include this in production
	$(document).ready(function(){
		Pusher.log = function(message) {
			if (window.console && window.console.log) {
				window.console.log(message);
			}
		};

		var pusher = new Pusher('191dbef1780135573650');
		var channel = pusher.subscribe('chatglobal');

		channel.bind('my_event', function(data) {
			sendmessage(data);
		});
		channel.bind('appendponline', function(data) {
			appendponline(data);
		});
		function appendponline(data){
			html = '';
			html += '<li class="left clearfix">';
			html += ' <span class="chat-img pull-left">';
			html += ' <img src="<?=DIR?>uploads/site_setting/faq_man.png" class="img-circle">';
			html += ' </span>';
			html += '<div class="chat-body clearfix">';
			html += '<div class="header_sec">';
			html += ' <strong class="primary-font">'+data.message+'</strong>';
			html += '</div>';
			html += '</div>';
			html += '</li>';
			$('#appendponline').append(html);
		}
		function sendmessage(data){
			var ses_id = <?php echo $this->session->userdata('id_admin');?>;



			if(data.id == ses_id){
			//	alert(data.username);
				html = '';
				html += '<li class="left clearfix">'; 
				html += ' <span class="chat-img1 pull-left">'; 
				html += '<img src="<?=DIR?>uploads/site_setting/faq_man.png" alt="User Avatar" class="img-circle">'; 
				html += '</span>'; 
				html += '<div class="chat-body1 clearfix">'; 
				html += '<p class="font-else"><b>'+data.username+'</b>:'+data.message+'</p>'; 
				html += '<div class="chat_time pull-right">'+data.date+'</div>'; 
				html += '</div>'; 
				html += '</li>'; 
				$("html, body .chat_area").animate({ scrollTop: $(document).height() }, 1000);
				$('#appendchat').append(html);
				$('#message').val("");
			}else{
				html = '';
				html += '<li class="left clearfix admin_chat">'; 
				html += '<span class="chat-img1 pull-right">'; 
				html += '<img src="<?=DIR?>uploads/site_setting/faq_man.png" alt="User Avatar" class="img-circle">'; 
				html += '</span>'; 
				html += '<div class="chat-body1 clearfix">'; 
				html += '<p class="font-me"><b>'+data.username+'</b>:'+data.message+'</p>'; 
				html += '<div class="chat_time pull-right">'+data.date+'</div>'; 
				html += '</div>'; 
				html += '</li>'; 
				$("html, body .chat_area").animate({ scrollTop: $(document).height() }, 1000);
				$('#appendchat').append(html);
			}
//alert(ses_id);
var id_project=$("#id_project").val();
//alert(id_project);
			var data={id_project:id_project,ses_id:ses_id,message:data.message,userd:<?=$userid?>};
			$.ajax({
				url: '<?php echo base_url("admin/chat/add_mess_user") ?>',
                type: 'POST',
                data: data,				
                success: function( data ) {				}
         });
		}

		$('#sendchat').click(function(){
	        message = $('#message').val();
	        $.ajax({
	          url: "<?php echo base_url(); ?>admin/chat/chatsend/",
	          type: 'POST',
	          data:{
	          message : message, 
	           },
	          success:function()
	          { 
	          }    
          	});
		});
		$('#updateuser').click(function(){
	        email    = $('#email').val();
	        password = $('#password').val();
	        username = $('#username').val();
	        $.ajax({
	          url: "<?php echo base_url(); ?>chat/update_user/",
	          type: 'POST',
	          data:{
	          email    : email, 
	          password : password, 
	          username : username, 
	           },
	          success:function()
	          { 
	          	location.reload();
	          }    
          	});
		});
	});
	
</script>
