<?php

function get_date($time)
{
    $format = "d/m/Y";
    $date = date($format, $time);
    return $date;
}

function get_days_count_down($from_date, $to_date=null)
{
    $from_date = str_replace('/','-', $from_date);
    $datetime1 = new DateTime($from_date);

    if($to_date !=null)
    {
        $to_date = str_replace('/','-', $to_date);
        $datetime2 = new DateTime($to_date);
    }
    else {
        $datetime2 = (new DateTime())->setTime(0, 0);
    }

    $interval = $datetime1->diff($datetime2);

    $deff = $interval->format('%a');
    if($datetime2 > $datetime1)
        return intval( '-'.$deff );
    else
        return $deff;
}



function admin_dir()
{
   $config_admin_dir = config_item("admin_dir");
   return $config_admin_dir;
}
function generate_random_string($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function create_thumb( $image_path, $image_name, $height, $width )
{
    // Get the CodeIgniter super object
    $CI =& get_instance();

    $thumb_path = $image_path.'/thumb/';
    !file_exists($thumb_path) && mkdir($thumb_path , 0777);
    // Path to image thumbnail
    $image_thumb = $thumb_path . $image_name;

    if ( !file_exists( $image_thumb ) ) {
        // LOAD LIBRARY
        $CI->load->library( 'image_lib' );

        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path.'/'.$image_name;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
        $config['height']           = $height;
        $config['width']            = $width;
        $CI->image_lib->initialize( $config );
        $CI->image_lib->resize();
        $CI->image_lib->clear();
    }

    return  $image_thumb ;
}

function upload_file($field, $start_name = 'file', $path = './assets/uploads/')
{
    $CI =& get_instance();
    $ext                     = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
    $config['upload_path']   = $path;
    $config['allowed_types'] = config_item('allowed_files');
    $config['max_size']      = (config_item('max_file_size')*1024);
    $config['file_name']     = $start_name.'-'.time().rand(000,999).'.'.$ext;

    $CI->load->library('upload');
    $CI->upload->initialize($config);
    if($CI->upload->do_upload($field))
    {
        $data = $CI->upload->data();
        return $data;
    }
    else
    {
        $error = $CI->upload->display_errors();
        $message_type= "error";
        $message_text = $error;
        set_message($message_type, $message_text);
        return FALSE;
    }

}

function multi_upload_files($field, $start_name = 'file', $path = './assets/uploads/')
{
    $CI =& get_instance();
    $result = array();
    for($i=0; $i<count($_FILES[$field]['name']); $i++)
    {
        $_FILES['file']['name']      = $_FILES[$field]['name'][$i];
        $_FILES['file']['type']      = $_FILES[$field]['type'][$i];
        $_FILES['file']['tmp_name']  = $_FILES[$field]['tmp_name'][$i];
        $_FILES['file']['error']     = $_FILES[$field]['error'][$i];
        $_FILES['file']['size']      = $_FILES[$field]['size'][$i];

        $ext                     = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $config['upload_path']   = $path;
        $config['allowed_types'] = config_item('allowed_files');
        $config['max_size']      = (config_item('max_file_size')*1024);
        $config['file_name']     = $start_name.'-'.time().rand(000,999).'.'.$ext;

        $CI->load->library('upload');
        $CI->upload->initialize($config);
        if($CI->upload->do_upload('file'))
        {
            $filedata = $CI->upload->data();
            $result[] = $filedata;

        }
        else
        {
            $error = $CI->upload->display_errors();
            $type = "error";
            $message = $error;
            set_message($type, $message);
            return False;
        }
    }
    return $result;
}
