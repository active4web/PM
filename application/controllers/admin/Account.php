<?php
class Account extends MY_Controller
{
    public function index()
    {
        $this->login();
    }
   /*
    * log in method
    */
    public function login()
    {
       $this->load->model('user_model');

       // check if logged in to redirect to home
       if($this->session->has_userdata('cp_logged'))
         redirect(base_url().admin_dir());

       $data['message'] = '';
       if($this->input->post('do_login'))
       {
            $this->load->library('form_validation');
       	    $this->form_validation->set_rules('email', "البريد الالكتروني", 'trim|required');
            $this->form_validation->set_rules('password', "كلمة المرور", 'trim|required');
            if ($this->form_validation->run() != FALSE)
    		{
                $email = $this->input->post('email');
                $password = md5($this->input->post('password'));

                $result = $this->user_model->login_check($email, $password);

                if(!empty($result) && count($result) > 0)
                {
                     // set session
                     $sesdata = array(
                         'user_id'  => $result['id'],
                         'cp_logged' => TRUE
                     );

                     // for rmember me
                     if($this->input->post('remember') == 1)
                     {
                        $sesdata['new_expiration'] = 60*60*24*30;//30 days
                        $this->session->sess_expiration = $sesdata['new_expiration'];
                     }

                     $this->session->set_userdata($sesdata);

                     redirect(base_url().admin_dir());
                     exit();
                }
                else
                {
                    $data['message'] = message_error('البانات التى ادخلتها غير صحيحه');
                }
            }
       }

       $this->load->view(admin_dir().'/account/login',$data);
    }

   /*
    * log out
    * returned void
    */
    public function logout()
    {
       if($this->session->has_userdata('cp_logged'))
       {
           $array_items = array('user_id', 'cp_logged');
           $this->session->unset_userdata($array_items);
       }
       redirect(base_url().admin_dir());
    }



    /*
    * reset Password
    *
    */
    public function reset_password()
    {
       $this->load->model('user_model');

       if($this->session->has_userdata('cp_logged'))
          redirect(base_url().admin_dir());

       $data['message']='';

       if($this->input->post('rese_pass'))
       {
             $this->load->library('form_validation');
             $this->form_validation->set_rules('email', 'البريد الالكتروني', 'trim|required|valid_email');
             if ($this->form_validation->run() != FALSE)
             {
                 $email  = $this->input->post('email');
                 $userInfo = $this->user_model->_table_name = 'users';
                 $userInfo = $this->user_model->get_single(' email="'.$email.'" ');
                 if(!empty($userInfo) && count($userInfo) > 0)
                 {

                    if( $this->session->flashdata('page_token'))
                    {
                          redirect(base_url().admin_dir().'/account/reset_password');
                    }

                    $userId    = $userInfo['id'];
                    $userEmail = $userInfo['email'];
                    $userName  = $userInfo['name'];
                    $userCode = $this->user_model->hash(mt_rand(10000,99999).time().$userEmail);
                    $this->user_model->change_code($userCode, $userId);

                    $this->load->library('email');
                    $this->load->library('my_email');
                    $init  = $this->my_email->init();

                    $subject = 'استرجاع كلمة مرور الادارة';
                    $message = '';
                    $message.= '<center><h3>استرجاع كلمة مرور الادارة</h3></center>';
                    $message.= '<br>لاسترجاع كلمة المرور الخاصه بالحساب الخاصه بك يجب اتباع الرابط التالي<br>';
                    $message.= '<br>{unwrap}<a href="'.base_url().admin_dir().'/account/resend_password/'.$userCode.'">'.base_url().admin_dir().'/account/resend_password/'.$userCode.'</a>{/unwrap}<br>';

                    $sendMail = $this->my_email->send_email(NULL,$userEmail, $subject, $message);

                    $msgtxt = 'تم ارسال طريقة استرجاع كلمة المرور على بريدك الالكتروني وسوف تصلك فى خلال دقائق';
                    $msgtxt.= '<br />';
                    $msgtxt.= 'اذا لم تصلك الرساله يرجى مراجعة بريدك الإلكتروني صندوق الرسائل الغير هامة (spam/junk)';
                    $data['message']= message_done($msgtxt);

                    $this->session->set_flashdata('page_token', time());

                 }
                 else
                 {
                   $data['message'] = message_error('البريد الالكتروني الذى ادخلته غير مسجل لدينا!');
                 }

             }
       }
       $this->load->view(admin_dir().'/account/reset_password', $data);

    }

    /*
    * resend password
    *
    */
    public function resend_password($code=null)
    {
        $this->load->model('user_model');

        if($this->session->has_userdata('cp_logged'))
           redirect(base_url(admin_dir()));

        $data['message']    = '';

        if($code!=NULL)
        {
            $userInfo = $this->user_model->_table_name = 'users';
            $userInfo = $this->user_model->get_single('activation_code="'.$code.'" ');
            if(!empty($userInfo) && count($userInfo) > 0)
            {
                if($this->session->flashdata('page_token'))
                {
                    redirect(base_url(admin_dir().'/account/reset_password'));
                }
                $userEmail            = $userInfo['email'];
                $newPassword           = rand(000000,999999);
                $userId               = $userInfo['id'];

                //update new password in db
                $this->user_model->change_password($this->user_model->password_encrypt($newPassword), $userId);

                // change user code
                $userCode = $this->user_model->hash(mt_rand(10000,99999).time().$userEmail);
                $this->user_model->change_code($userCode, $userId);
                $this->load->library('email');
                $this->load->library('my_email');
                $init  = $this->my_email->init();

                $subject = 'استرجاع كلمة مرور الاداره';
                $message = '';
                $message.= '<center><h3>استرجاع كلمة مرور الاداره </h3></center>';
                $message.= '<br>كلمة المرور الجديده الخاصه بحساب الادارة الخاص بيك<br>';
                $message.= '<br>'.$newPassword.'<br>';

                $sendMail = $this->my_email->send_email(NULL, $userEmail, $subject, $message);

                $msgtxt = 'تم ارسال كلمة المرور على بريدك الالكتروني وسوف تصلك في خلال دقائق';
                $msgtxt.='<br />';
                $msgtxt.='اذا لم تصلك الرساله يرجى مراجعة بريدك الإلكتروني صندوق الرسائل الغير هامة (spam/junk)';
                $data['message']= message_done($msgtxt);

                $this->session->set_flashdata('page_token', time());
            }
            else
            {
                $data['message'] = message_error("عفوا لقد اتعبت رابط خطأ!!", admin_dir());
            }

            $this->load->view(admin_dir().'/account/reset_password_message',$data);
        }

    }

}