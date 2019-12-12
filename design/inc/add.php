
        <script>
$(document).ready(function(){
$("#cvcx").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
    var form=$("#form");
    var data=form.serialize();
    var idold=$("#idold").val();
     var idrep=$("#idrep").val();

    if(idold==2&&idrep==2){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,

        success: function(response){
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
$(".mainbutton").prop('disabled', false);
$("#idold").val(1);
$("#idrep").val(1);
$(":text").val('');
$(":password").val('');
        }  else {
           toastr.error("<?= lang("there_error")?>");
            $(".mainbutton").prop('disabled', false);
        }
        
        }
    });
    }
    else {
       toastr.error("<?= lang("valid_data")?>");
       $(".mainbutton").prop('disabled', false);
    }
});
});
</script>




        <script>
$(document).ready(function(){
$(".add_test").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
    var form=$("#myForm");
    var data=form.serialize();
    var title=$("#title").val();
       var service_type=$("#service_type").val();
    
    if(title!=""){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,

        success: function(response){
           // alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
           if(service_type==1){
            $(":text").val('');
           }
           $(".mainbutton").prop('disabled', false);
        }  else {
           toastr.error("<?= lang("there_error")?>");
        
            $(".mainbutton").prop('disabled', false);
        }
        
        }
    });
    }
    else {
       toastr.error("<?= lang("valid_data")?>");
       $(".mainbutton").prop('disabled', false);
    }
});
});
</script>



<script>
$(document).ready(function(){
$(".teamworkbutton").click(function(){
$(".mainbutton").attr("disabled", "disabled");
var fname=$("#fname").val();
var sname=$("#sname").val();
var lname=$("#lname").val();
var email=$("#email").val();


if (fname==""){
toastr.error("<?= lang("fname_error");?>",  {timeOut: 5000});
$(".mainbutton").prop('disabled', false);
} 
if (sname==""){
toastr.error("<?= lang ("sname_error");?>",  {timeOut: 5000});
$(".mainbutton").prop('disabled', false);
}

if (lname==""){
toastr.error("<?= lang("lname_error");?>",  {timeOut: 5000});
$(".mainbutton").prop('disabled', false);
}

if (email==""){
toastr.error("<?= lang("email_error");?>",  {timeOut: 5000});
$(".mainbutton").prop('disabled', false);
}


var emailid=0;
var send_emailid=0;
var passwordid=0;
var send_email=$("#send_email").val();
var password=$("#password").val();
var conpassword=$("#conpassword").val();
var service_type=$("#service_type").val();	
var formData = new FormData(data);
var form = $('#myForm')[0];
var data = new FormData(form);

if(service_type==1){
  var url= "<?php echo base_url()?>admin/teamwork/product_action";
if (password=="") {passwordid=1;}
  }
else   if(service_type==2){
var url= "<?php echo base_url()?>admin/teamwork/edit_action"; 
  }

var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
if (!reg.test(email)){
toastr.error("<?= lang("email_error");?>",  {timeOut: 5000});
emailid=1;
$(".mainbutton").prop('disabled', false);
} 



else { 
if(service_type==1){
 var emaildata={email:email};

  $.ajax({
        type:"POST",
        url:"<?php echo base_url()?>admin/teamwork/checkmail",
        data:emaildata,
        success: function(response){
        //alert(response);
if(response == 1){
toastr.error("<?= lang("email_exist_error");?>",  {timeOut: 5000});
 $(".mainbutton").prop('disabled', false);
}
else {

if (!reg.test(send_email)&&send_email!="") {
toastr.error("<?= lang("email_error");?>",  {timeOut: 5000});
send_emailid=1;
 $(".mainbutton").prop('disabled', false);
		}     
 if (password!="") {
if (password!=conpassword) {
toastr.error("<?= lang("password_error");?>",  {timeOut: 5000});
passwordid=1;
 $(".mainbutton").prop('disabled', false);
}
else {
 passwordid=0;   
}

}


if(fname!=""&&sname!=""&&lname!=""&&email!=""&&passwordid==0&&send_emailid==0){
$.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:url,
        data:data,
         processData: false,
            contentType: false,
            cache: false,
        success: function(response){
      //alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
           if(service_type==1){
            $(":text").val('');
            $(":file").val('');
            $(":password").val('');
             }
        }  else {
            //show error
           toastr.error("<?= lang("there_error")?>");
        }
        $(".mainbutton").prop('disabled', false);
        }
    });
}
else {
toastr.error("<?= lang("valid_data")?>");
$(".mainbutton").prop('disabled', false);
    
}

    
}
}

});

    
}



else {
 if(fname!=""&&sname!=""&&lname!=""&&email!=""&&passwordid==0&&send_emailid==0){
$.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:url,
        data:data,
         processData: false,
            contentType: false,
            cache: false,
        success: function(response){
     // alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
           if(service_type==1){
            $(":text").val('');
            $(":file").val('');
            $(":password").val('');
             }
        }  else {
            //show error
           toastr.error("<?= lang("there_error")?>");
        }
        $(".mainbutton").prop('disabled', false);
        }
    });
}
else {
toastr.error("<?= lang("valid_data")?>");
$(".mainbutton").prop('disabled', false);
    
}   
}
    
    
}

		

});
});
</script>




<script>
$(document).ready(function(){
$(".projectkbutton").click(function(){
   $(".mainbutton").attr("disabled", "disabled");
var mainid=$("#mainid").val();
var typeproject=$('input[type=checkbox]:checked').length;
var service_type=$("#service_type").val();

var start_date=$("#start_date").val();
var enddate=$("#enddate").val();
var hrs_num=$("#hrs_num").val();
var daies_num=$("#daies_num").val();

var form = $('#myForm')[0];
var data = new FormData(form);
if(service_type==1){
var url= "<?php echo base_url()?>admin/projects/add_action";
}
  
else   if(service_type==2){
var url= "<?php echo base_url()?>admin/projects/edit_action"; 
}

  
if(mainid==""){
toastr.error("<?= lang("project_title_error"); ?>"); 
$(".mainbutton").prop('disabled', false);
}


if(start_date==""){
toastr.error("<?= lang("project_start_date"); ?>"); 
$(".mainbutton").prop('disabled', false);
}
if(enddate==""){
toastr.error("<?= lang("project_enddate"); ?>"); 
$(".mainbutton").prop('disabled', false);
}
if(hrs_num==""){
toastr.error("<?= lang("project_hrs_num"); ?>"); 
$(".mainbutton").prop('disabled', false);
}

if(daies_num==""){
toastr.error("<?= lang("project_daies_num"); ?>"); 
$(".mainbutton").prop('disabled', false);
}
  
if(typeproject==0){
toastr.error("<?= lang("project_type");?>"); 
$(".mainbutton").prop('disabled', false);
}

if(mainid!=""&&typeproject!=0){
$.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:url,
        data:data,
              processData: false,
            contentType: false,
            cache: false,
        success: function(response){
   //alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
           if(service_type==1){
            $(":text").val('');
             $("textarea").val('');
             $(".txt_typeproject").css("display","none");
             $(".txt_typeproject").val("0");
             
            $("#select_manager_id option:first").attr('selected','selected');
            $(".typeproject").removeAttr('checked');
          // alert("fff");
             }
             $(".mainbutton").prop('disabled', false);
            
        }  else {
            //show error
           toastr.error("<?= lang("there_error")?>");
            $(".mainbutton").prop('disabled', false);
        }
        $(".mainbutton").prop('disabled', false);
        }
    });
}

 //$(".mainbutton").prop('disabled', false);
});
});
</script>




<script>
$(document).ready(function(){
$(".taskbutton").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
var mainid=$("#mainid").val();
var contentsid=$("#contents").val();
var enddate=$("#enddate").val();
var start_date=$("#start_date").val();


var num=$("#num").val();
var service_type=$("#service_type").val();

var form = $('#myForm')[0];
var data = new FormData(form);
if(service_type==1){
  var url= "<?php echo base_url()?>admin/task/add_action";
  }
else   if(service_type==2){
var url= "<?php echo base_url()?>admin/task/edit_action"; 
  }
 else   if(service_type==3){
var url= "<?php echo base_url()?>admin/other/add_action"; 
  }
  else   if(service_type==4){
var url= "<?php echo base_url()?>admin/other/edit_action"; 
  }
if(mainid==""){
toastr.error("<?= lang("task_title_error");?>",  {timeOut: 5000});    
}

if(contentsid==""){
toastr.error("<?= lang("task_content_error");?>",  {timeOut: 5000});    
}

if(start_date==""){
toastr.error("<?= lang("task_start_date_error");?>",  {timeOut: 5000});    
}

if(enddate==""){
toastr.error("<?= lang("task_enddate_error");?>",  {timeOut: 5000});    
}


if(num<=0||num==""){
toastr.error("<?= lang("total_hrs_error")?>",  {timeOut: 5000});      
}


    var formx=$("#myForm");
    var datax=formx.serialize();
   // alert(datax);
if(mainid!=""&&num!=""&&contentsid!=""&&start_date!=""&&enddate!=""){
$.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:url,
        data:data,
            processData: false,
            contentType: false,
            cache: false,
        success: function(response){
 //alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
           if(service_type==1||service_type==3){
            $(":text").val('');
             $("textarea").val('');
            $("#select_manager_id option:first").attr('selected','selected');
            $("#user_id option:first").attr('selected','selected');
            
            $("#num").val('');
             
             }
       $(".mainbutton").prop('disabled', false);
        }  else {
            //show error
           toastr.error("<?= lang("there_error")?>",  {timeOut: 5000});
         $(".mainbutton").prop('disabled', false);
            
        }
        }
       
    });
}
else {
toastr.error("<?= lang("valid_data")?>",  {timeOut: 5000});
 $(".mainbutton").prop('disabled', false);
}

});
});
</script>





<script>
$(document).ready(function(){
$(".taskstatusbutton").click(function(){
         $(".mainubtton").attr("disabled", "disabled");
    var form=$("#myForm");
    var data=form.serialize();
    var title= $("input[name='status']:checked").val();
    var idresult=$("#idresult").val();
       
    //alert(data);
    if(title!=""&&idresult==0){
  
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,

        success: function(response){
    //alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
             $(".mainubtton").addClass('taskfinishbutton')
            $(".mainubtton").removeClass('taskstatusbutton');
           // $(".taskstatusbutton").off("click");
           $("#idresult").val(2);
           window.history.back();

        }  else {
            //show error
           toastr.error("<?= lang("there_error")?>");
        }
        }
    });
    }
 else  if(title!=""&&idresult==2){  
     toastr.error("<?= lang("status_task_not_allowed")?>");

 }
    else {
       toastr.error("<?= lang("valid_data")?>");
    }
});
});
</script>


<script>
$(document).ready(function(){
$(".taskfinishbutton").click(function(){
toastr.error("<?= lang("status_task_not_allowed")?>");
});
});
</script>





<script>
$(document).ready(function(){
$(".projectstatusbutton").click(function(){
     $(".mainubtton").attr("disabled", "disabled");
    var form=$("#myForm");
    var data=form.serialize();
    var title= $("#status_executed").val();
    var idresult=$("#idresult").val();
    if(title!=""&&idresult==0){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,
        success: function(response){
        //   alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
            
             $(".mainubtton").addClass('projectfinishbutton')
            $(".mainubtton").removeClass('projectstatusbutton');
           $("#idresult").val(2);
if(title==1){
$(".status_project").html("<span class='label label-sm label-danger' style='background-color:#e7505a !important'><?= lang("working_progress");?></span>");
}

if(title==2){
$(".status_project").html("<span class='label label-sm label-success'><?= lang("project_wait");?></span>");
}

    if(title==3){
               $(".status_project").html("<span class='label label-sm label-success'><?= lang("project_Future");?></span>");
           }
    if(title==4){
               $(".status_project").html("<span class='label label-sm label-success' style='background-color:#4099ff !important'><?= lang("project_end");?></span>");
           }         
          window.history.back();
        } 
        
        else {
            //show error
           toastr.error("<?= lang("there_error")?>");
        }
        }
    });
    }
 else  if(title!=""&&idresult==2){  
     toastr.error("<?= lang("status_task_not_allowed")?>");

 }
    else {
       toastr.error("<?= lang("valid_data")?>");
    }
});
});
</script>


<script>
$(document).ready(function(){
$(".projectfinishbutton").click(function(){
toastr.error("<?= lang("status_task_not_allowed")?>");
});
});
</script>





<script>
$(document).ready(function(){
$(".permissionsstatusbutton").click(function(){
         $(".mainubtton").attr("disabled", "disabled");
    var form=$("#myForm");
    var data=form.serialize();
    var title= $("input[type='checkbox']").val();
    var txt=$("#txt").val();
    var idresult=$("#idresult").val();
   var service_type=$("#service_type").val();
    if(title!=""&&idresult==0&&txt!=""){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,
        success: function(response){
        //alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
           if(service_type==1){
             $("input").val('');
           }
           
       $(".mainubtton").prop('disabled', false);
        } 
        else {
           toastr.error("<?= lang("there_error")?>");
            $(".mainubtton").prop('disabled', false);
        }
        
        }
    });
    }

else {
toastr.error("<?= lang("valid_data")?>");
$(".mainubtton").prop('disabled', false);
}
});
});
</script>


<script>
$(document).ready(function(){
$(".taskstartdatebutton").click(function(){
  var form=$("#myForm");
    var data=form.serialize();
 $(".mainubtton").attr("disabled", "disabled");
         var select_date = $("input[name='select_date']:checked").val();
         var select_enddate = $("input[name='select_enddate']:checked").val();
         var enddate = $("#enddate").val();
         var meeting_start = $("#meeting_start").val();
         var mainid=0;
         var mainend=0;

if(select_date==2&&meeting_start==""){
  toastr.error("<?= lang("start_date_error")?>"); 
$(".mainubtton").prop('disabled', false);  
mainid=1;
}

if(select_enddate==2&&enddate==""){
  toastr.error("<?= lang("end_date_error")?>"); 
$(".mainubtton").prop('disabled', false);  
mainend=1;
} 

if(mainend==0&&mainid==0){
$.ajax({
        type:"POST",
        url:"<?php echo base_url() ?>admin/task/start_date_action",
        data:data,
        success: function(response){
      // alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
       $(".mainubtton").prop('disabled', false);
        } 
        else {
           toastr.error("<?= lang("there_error")?>");
            $(".mainubtton").prop('disabled', false);
        }
        
        }
    });
    }
   


});
});
</script>

<script>
$(document).ready(function(){
$(".model_bag").click(function(){
     var user_task=$(this).nextAll(".user_task").val();
    var title=$(this).nextAll(".title_task").val();
    var hrs_task=$(this).nextAll(".hrs_task").val();
    var details_task=$(this).nextAll(".details_task").val();
        var over_time=$(this).nextAll(".over_time").val();
$(".title_user").html(user_task);
$(".title_txt").html(title);
$(".title_hrs").html(hrs_task);
$(".title_details").html(details_task);
$(".over_time_title_hrs").html(over_time);

});
});
</script>


<script>
$(document).ready(function(){
$(".model_details").click(function(){
var user_task=$(this).nextAll(".user_task").val();
var title=$(this).nextAll(".title_task").val();
var hrs_task=$(this).nextAll(".hrs_task").val();
var over_time=$(this).nextAll(".over_time").val();

var actual_start=$(this).nextAll(".actual_start").val();
var actual_end=$(this).nextAll(".actual_end").val();

var start_task=$(this).nextAll(".start_task").val();
var end_task=$(this).nextAll(".end_task").val();
var actual_time=$(this).nextAll(".actual_time").val();



$(".title_user").html(user_task);
$(".title_txt").html(title);
$(".title_hrs").html(hrs_task);
$(".over_time_title_hrs").html(over_time);
$(".start_date_t").html(start_task);

$(".start_date_t").html(start_task);
$(".end_date_t").html(end_task);
$(".timing_start_date_t").html(actual_start);
$(".timing_end_date_t").html(actual_end);
$(".timing_period").html(actual_time);

});
});
</script>







<script>
$(document).ready(function(){
$(".teamwork_button").click(function(){
var typeproject=$('input[type=checkbox]:checked').length;

//  var form=$("#myfor");
//var data=form.serialize();

var service_type=$("#service_type").val();
if(service_type==1){
  var url= "<?= base_url()?>admin/projects/teamwork_action";
  }
else   if(service_type==2){
var url= "<?= base_url()?>admin/projects/teamworkedit_action"; 
  }

if(typeproject==0){
    toastr.error("<?= lang("team_work_error");?>"); 
    $(".mainbutton").prop('disabled', false);
}
else{

var form = $('#myForm')[0];
var data = new FormData(form);

$.ajax({
        type:"POST",
        url:url,
        data:data,
                processData: false,
            contentType: false,
            cache: false,
        success: function(response){
      //alert(response);
        if(response == 1){
            toastr.success("<?= lang("done_success")?>");
       $(".mainubtton").prop('disabled', false);
        } 
        else {
           toastr.error("<?= lang("there_error")?>");
            $(".mainubtton").prop('disabled', false);
        }
        
        }
    });
    
}

});
});
</script>






<script>
$(document).ready(function(e) {
$(".fliter").click(function(e) {
var id = $("#id_user").val();
var id_project=$("#id_project").val();

if(id==0){
window.location.reload();
e.preventdefault();
}
else {
   $("#myform").submit(); 
}
	});
});
</script>


<script>
$(document).ready(function(e) {
$("#id_user_other").change(function(e) {
var id = $(this).val();
if(id!=0){
window.open("<?= base_url()?>admin/other/tasks_user?user_id="+id,"_blank");
}
	});
});
</script>


