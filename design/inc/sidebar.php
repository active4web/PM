        <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item start <?php if($curt=='home'){echo'active open';}?>">
                        <a href="<?=$url;?>admin" class="nav-link ">
                            <i class="icon-home"></i>
                                        <span class="title"><?= lang("home");?></span>
                                        <span class="selected"></span>
                                    </a>
                    </li>
                    
                    
<li class="nav-item <?php if($curt=='setting'){echo'open';}?>">
<a href="javascript:;" class="nav-link nav-toggle">
<i class="icon-settings"></i>
<span class="title"><?= lang("setting");?></span>
<span class="arrow"></span>
</a>
<ul class="sub-menu">
                                
                                
<li class="nav-item start">
<?php #endregion
if($this->session->userdata('settings')=="settings"){
?><a href="<?=$url;?>admin/setting" class="nav-link ">	
<?php } else {?>
<a class="nav-link message_premmions">	
<?php }?>
<i class="icon-settings"></i>
<span class="title"><?= lang("setting");?></span>
<span class="selected"></span>
</a>
 </li>
			
					
					
					
<li class="nav-item start">
<?php if($this->session->userdata('emails_sending')=="emails_sending"){?>    
<a href="<?=$url;?>admin/emails/emails_sending" class="nav-link">
<?php }else {?>
<a class="nav-link message_premmions">				    
<?php }?>
<i class="icon-envelope"></i>
<span class="title"><?= lang("sendemail");?></span>
<span class="selected"></span>
</a>
</li>
					

<li class="nav-item start">
<?php #endregion
if($this->session->userdata('company_serivces')=="company_serivces"){
?>    
<a href="<?=$url;?>admin/services" class="nav-link ">
<?php }else {?>
<a class="nav-link message_premmions">				    
<?php }?>   
<i class="icon-note"></i>
<span class="title"><?= lang("department");?></span>
<span class="selected"></span></a>
</li>
											


<li class="nav-item start">
<?php #endregion
if($this->session->userdata('log_projects')=="log_projects"){
?>    
<a href="<?=$url;?>admin/log/projects" class="nav-link ">
<?php }else {?>
<a class="nav-link message_premmions">				    
<?php }?>     
<i class="fa fa-history"></i>
<span class="title"><?= lang("trakproject");?> </span>
<span class="selected"></span>
</a>
</li>

<li class="nav-item start">
<?php #endregion
if($this->session->userdata('log_services')=="log_services"){
?>    
<a href="<?=$url;?>admin/log/services" class="nav-link ">
<?php }else {?>
<a class="nav-link message_premmions">				    
<?php }?>     
<i class="fa fa-history"></i>
<span class="title"><?= lang("trakdep");?></span>
<span class="selected"></span>
</a>
</li>


<li class="nav-item start">
 <?php #endregion
if($this->session->userdata('log_task')=="log_task"){
?>   
<a href="<?=$url;?>admin/log/tasks" class="nav-link ">
<?php }else {?>
<a class="nav-link message_premmions">				    
<?php }?>         
<i class="fa fa-history"></i>
<span class="title"><?= lang("traktask");?></span>
<span class="selected"></span>
</a>
</li>

<li class="nav-item start">
 <?php #endregion
if($this->session->userdata('log_othertasks')=="log_othertasks"){
?>    
<a href="<?=$url;?>admin/log/othertasks" class="nav-link ">
<?php }else {?>
<a class="nav-link message_premmions">				    
<?php }?>      
<i class="fa fa-history"></i>
<span class="title"><?= lang("trakothertask");?></span>
<span class="selected"></span>
</a>
</li>

</ul>
</li>	

					
<li class="nav-item <?php if($curt=='teamwork'){echo'open';}?>">
<a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title"><?= lang("employees");?></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
						
<li class="nav-item start <?php if($curt=='emails_sending'){echo'active open';}?>">
<?php #endregion
if($this->session->userdata('permissions')=="permissions"){
?>  
<a href="<?=$url;?>admin/teamwork/permissions" class="nav-link">
<?php }else {?>
<a class="nav-link message_premmions">				    
<?php }?>     
<i class="icon-envelope"></i>
<span class="title"><?= lang("gpermission");?></span>
<span class="selected"></span>
</a>
</li>

<li class="nav-item start <?php if($curt=='teamwork'){echo'active open';}?>">
<?php if($this->session->userdata('teamwork')=="teamwork"){?>
<a href="<?=$url;?>admin/teamwork" class="nav-link ">
<?php } else {?>
<a class="nav-link message_premmions">
<?php }?>
<i class="icon-users"></i>
<span class="title"><?= lang("employees");?></span>
<span class="selected"></span>
</a>
</li>
					
 </ul></li>




						
			<!--	<li class="nav-item start <?php if($curt=='services'){echo'active open';}?>">
			<?php #endregion
						if($this->session->userdata('company_serivces')=="company_serivces"){
						?>
					<a href="<?=$url;?>admin/services" class="nav-link "><?php }?>
						<i class="icon-note"></i>
									<span class="title">خدمات الشركة</span>
									<span class="selected"></span>
					</a>
				      </li>
						
                        <li class="nav-item <?php if($curt=='allprojects' || $curt=='tasks' || $curt=='finished' || $curt=='mz_details'){echo'open';}?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-diamond"></i>
                                <span class="title">المشاريع</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu" <?php if($curt=='now' || $curt=='add_mazad' || $curt=='finished' || $curt=='mz_details'){echo' style="display: block;" ';}?>>
							<?php #endregion
					if($this->session->userdata('projects_add')=="projects_add"){
					?>	
							<li class="nav-item <?php if($curt=='add_mazad'){echo'active open';}?>">
                                    <a href="<?=$url;?>admin/projects/add" class="nav-link ">
                                        <span class="title">إضافة جديد</span>
                                    </a>
								</li>
					<?php }?>
                    <?php #endregion
					if($this->session->userdata('allprojects_view')=="allprojects_view"){
					?>	
                               <li class="nav-item <?php if($curt=='now'){echo'active open';}?>">
                                    <a href="<?=$url;?>admin/projects/allprojects" class="nav-link ">
                                        <span class="title">المشاريع كل </span>
                                    </a>
								</li>
                    <?php #endregion
                      }
                      if($this->session->userdata('current_project')=="current_project"||$this->session->userdata('allprojects_view')=="allprojects_view"){
					?>	
                              
                                <li class="nav-item <?php if($curt=='now'){echo'active open';}?>">
                                    <a href="<?=$url;?>admin/projects/current_projects" class="nav-link ">
                                        <span class="title">المشاريع الحالية </span>
                                    </a>
								</li>
                                <?php #endregion
                      }
                      if($this->session->userdata('wait_project')=="wait_project"||$this->session->userdata('allprojects_view')=="allprojects_view"){
					?>
								<li class="nav-item <?php if($curt=='now'){echo'active open';}?>">
                                    <a href="<?=$url;?>admin/projects/wait" class="nav-link ">
                                        <span class="title">المشاريع المنتظرة </span>
                                    </a>
								</li>
                                <?php #endregion
                      }
                      if($this->session->userdata('future_project')=="future_project"||$this->session->userdata('allprojects_view')=="allprojects_view"){
					?>
								<li class="nav-item <?php if($curt=='now'){echo'active open';}?>">
                                    <a href="<?=$url;?>admin/projects/future" class="nav-link ">
                                        <span class="title">المشاريع المستقبلية </span>
                                    </a>
                                </li>
                                <?php #endregion
                      }
                      if($this->session->userdata('finished_project')=="finished_project"||$this->session->userdata('allprojects_view')=="allprojects_view"){
					?>
                                <li class="nav-item <?php if($curt=='finished'){echo'active open';}?>">
                                    <a href="<?=$url;?>admin/projects/finished" class="nav-link ">
                                        <span class="title">المشاريع المنتهية</span>
                                    </a>
                                </li>
                                   <?php #endregion
                                    }
					                 ?>
                            </ul>
                        </li>
                      


						<?php #endregion
					if($this->session->userdata('add_other_task')=="add_other_task"){
					?>
			<li class="nav-item start <?php if($curt=='other_task'){echo'active open';}  ?>">
				<a href="<?=$url;?>admin/other/tasks" class="nav-link ">
					<i class="icon-note"></i>
								<span class="title">المهام الاخرى</span>
								<span class="selected"></span>
				</a>
			</li>--->
					<?php }?>

						<?php #endregion
						if($this->session->userdata('chat')=="chat"){
						?>
				<!--<li class="nav-item start <?php if($curt=='chat'){echo'active open';}?>">
					<a href="<?=$url;?>admin/chat" class="nav-link " target="new">
						<i class="fa fa-comments-o"></i>
									<span class="title">الدردشة</span>
									<span class="selected"></span>
					</a>
				      </li>--->
                        <?php }?>
                        


                        <?php #endregion
					/*	if($this->session->userdata('notification')=="notification"){
                        $total_notification=get_table_data('notification',array('id_user'=>$this->session->userdata('id_admin'),'view'=>'0'));
						?>
				<li class="nav-item start <?php if($curt=='notification'){echo'active open';}?>">
					<a href="<?=$url;?>admin/notification" class="nav-link ">
						<i class="fa fa-bell"></i>
                        <span class="title" style="<?php if(count($total_notification)>0){?>color:#ff0919<?php }?>"><?php if(count($total_notification)>0){?>التنبيهات(<span class="total_notification"><?=count($total_notification);?></span>)<?php } else {?>التنبيهات<?php }?></span>
						<span class="selected"></span>
					</a>
				      </li>
						<?php }*/
					
					//	$total_emails=get_table_data('tbl_discussions',array('to_id'=>$this->session->userdata('id_admin'),'reciver_view'=>'0','reply_id'=>'0'));
						?>

						<!--<li class="nav-item start <?php if($curt=='emails'){echo'active open';}?>">
                        <a href="<?=$url;?>admin/emails/inbox_email" class="nav-link ">
                            <i class="icon-envelope"></i>
										<span class="title" style="<?php if(count($total_emails)>0){?>color:#ff0919<?php }?>"><?php if(count($total_emails)>0){?>البريد الداخلى(<span class="total_email">
										<?=count($total_emails);?></span>)<?php } else {?>البريد الداخلى<?php }?></span>
                                        <span class="selected"></span>
                        </a>
						</li>-->
	

	
						
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
