<?php 

class M_image extends CI_Model{

    public $uploads_path;

    var $original_path;

    var $size1_path;

    var $size2_path;

    var $size3_path;

    var $size4_path;

    var $slider_path;

    function __construct() {

        parent::__construct();

        $this->uploads_path = realpath(APPPATH . '../assets/uploads/files');

        $this->original_path = realpath(APPPATH.'../assets/uploads/files');

        $this->size1_path = realpath(APPPATH.'../assets/uploads/size1');

        $this->size2_path = realpath(APPPATH.'../assets/uploads/size2');

        $this->size3_path = realpath(APPPATH.'../assets/uploads/size3');

        $this->size4_path = realpath(APPPATH.'../assets/uploads/size4');

        $this->slider_path = realpath(APPPATH.'../assets/uploads/slider');

    }

    function do_upload($field = null,$quality=null){

        $this->load->library('image_lib');

        if(!empty($field)){

        $config = array(

            'allowed_types'     => 'jpg|JPG|JPEG|GIF|PNG|jpeg|gif|png|xlsx|avi|flv|wmv|mp3|mp4|3gp', //only accept these file types

            'max_size'          => 4256, //2MB max

            'upload_path'       => $this->original_path //upload directory

        );

        if(!empty($quality))

        $config['quality']     = $quality;

        $this->load->library('upload', $config);

        $this->upload->do_upload($field);

        $image_data = $this->upload->data(); //upload the image

        }



        //your desired config for the resize() function

        $config = array(

            'image_library'     => 'gd2',

            'source_image'      => $image_data['full_path'], //path to the uploaded image

            'new_image'         => $this->size1_path, //path to

            'maintain_ratio'    => false,

            'width'             => 1920,

            'height'            => 781

        );



        //this is the magic line that enables you generate multiple thumbnails

        //you have to call the initialize() function each time you call the resize()

        //otherwise it will not work and only generate one thumbnail

        $this->image_lib->initialize($config);

        $this->image_lib->resize();

        

        $config = array(

            'image_library'     => 'gd2',

            'source_image'      => $image_data['full_path'],

            'new_image'         => $this->size2_path,

            'maintain_ratio'    => false,

            'width'             => 850,

            'height'            => 430

        );

        //here is the second thumbnail, notice the call for the initialize() function again

        $this->image_lib->initialize($config);

        $this->image_lib->resize();

        



        

        // size 3



        $config = array(

            'image_library'     => 'gd2',

            'source_image'      => $image_data['full_path'],

            'new_image'         => $this->size3_path,

            'maintain_ratio'    => false,

            'width'             => 262,

            'height'            => 195

        );

        //here is the second thumbnail, notice the call for the initialize() function again

        $this->image_lib->initialize($config);

        $this->image_lib->resize();

        

        

        // size 4



        $config = array(

            'image_library'     => 'gd2',

            'source_image'      => $image_data['full_path'],

            'new_image'         => $this->size4_path,

            'maintain_ratio'    => false,

            'width'             => 200,

            'height'            => 200

        );

        //here is the second thumbnail, notice the call for the initialize() function again

        $this->image_lib->initialize($config);

        $this->image_lib->resize();

        return $image_data;

    }

    function base64_upload($img = "") {

        $img = str_replace('data:image/jpg;base64,', '', $img);

        $img = str_replace(' ', '+', $img);

        $data = base64_decode($img);

        $filename = uniqid();

        $file = $this->original_path ."/". $filename . '.jpg';

        $success = file_put_contents($file, $data);

        return $filename.'.jpg';

    }

    function custom_upload($field = "",$width=null,$height=null) {

        $this->load->library('image_lib');

        $config = array(

            'allowed_types'     => 'jpg|jpeg|gif|png', //only accept these file types

            'max_size'          => 4256, //2MB max

            'upload_path'       => $this->original_path //upload directory

        );



        $this->load->library('upload', $config);

        $this->upload->do_upload($field);

        $image_data = $this->upload->data(); //upload the image

        if (!empty($width) && !empty($height)) {

        //your desired config for the resize() function

        $config = array(

            'source_image'      => $image_data['full_path'], //path to the uploaded image

            'new_image'         => $this->slider_path, //path to

            'maintain_ratio'    => false,

            'width'             => $width,

            'height'            => $height

        );



        //this is the magic line that enables you generate multiple thumbnails

        //you have to call the initialize() function each time you call the resize()

        //otherwise it will not work and only generate one thumbnail

        $this->image_lib->initialize($config);

        $this->image_lib->resize();

        }





        return $image_data;

    }

    function do_upload_file($field = "") {

        $data = array();

        $config = array(

            'allowed_types' => 'doc|pdf|docx|xls|xlsx',

            'upload_path' => $this->uploads_path,

            'max_size' => 100000

        );

        $this->load->library('upload', $config);

        $this->upload->do_upload($field);

        $data = $this->upload->data();

        return $data;

    }



    function create_thumbnail($source_path, $thumbWidth, $thumbHeight)
    {
        $this->load->library('image_lib');
        $config_manip = array(
        'image_library' => 'gd2',
        'source_image' => $source_path,
        'new_image' => dirname(BASEPATH) . '/uploads/site_setting/products/',
        'maintain_ratio' => FALSE,
        'width' => $thumbWidth,
        'height' => $thumbHeight
    );
       //$this->load->library('image_lib', $config_manip);
        $this->image_lib->initialize($config_manip);
         if (!$this->image_lib->resize()) {
            return $this->image_lib->display_errors();
        }
       // clear //
       $this->image_lib->clear();
       return true;
    }



   function create_thumbnail2($source_path, $folder ,$thumbWidth, $thumbHeight)

    {

        $this->load->library('image_lib');

        $config_manip = array(

        'image_library' => 'gd2',

        'source_image' => $source_path,

        'new_image' => dirname(BASEPATH) . '/assets/uploads/' . $folder,

        'maintain_ratio' => FALSE,

        'width' => $thumbWidth,

        'height' => $thumbHeight

    );

       //$this->load->library('image_lib', $config_manip);

        $this->image_lib->initialize($config_manip);

         if (!$this->image_lib->resize()) {

            return $this->image_lib->display_errors();

        }

       // clear //

       $this->image_lib->clear();

       return true;

    }


        function video_upload($field = null,$quality=null){
        $this->load->library('image_lib');
        if(!empty($field)){
        $config = array(
            'allowed_types'     => 'avi|flv|wmv|mp3|mp4|3gp', //only accept these file types
            'max_size'          => 4256, //2MB max
            'upload_path'       => $this->original_path //upload directory
        );
        if(!empty($quality))
        $config['quality']     = $quality;
        $this->load->library('upload', $config);
        $this->upload->do_upload($field);
        $image_data = $this->upload->data(); //upload the image
        }
        //your desired config for the resize() function
        $config = array(
            'image_library'     => 'gd2',
            'source_image'      => $image_data['full_path'], //path to the uploaded image
            'new_image'         => $this->size1_path, //path to
            'maintain_ratio'    => false,
            'width'             => 1920,
            'height'            => 781
        );

        //this is the magic line that enables you generate multiple thumbnails
        //you have to call the initialize() function each time you call the resize()
        //otherwise it will not work and only generate one thumbnail
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $config = array(
            'image_library'     => 'gd2',
            'source_image'      => $image_data['full_path'],
            'new_image'         => $this->size2_path,
            'maintain_ratio'    => false,
            'width'             => 850,
            'height'            => 430
        );
        //here is the second thumbnail, notice the call for the initialize() function again
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        // size 3
        $config = array(
            'image_library'     => 'gd2',
            'source_image'      => $image_data['full_path'],
            'new_image'         => $this->size3_path,
            'maintain_ratio'    => false,
            'width'             => 262,
            'height'            => 195
        );
        //here is the second thumbnail, notice the call for the initialize() function again
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        // size 4
        $config = array(
            'image_library'     => 'gd2',
            'source_image'      => $image_data['full_path'],
            'new_image'         => $this->size4_path,
            'maintain_ratio'    => false,
            'width'             => 200,
            'height'            => 200
        );
        //here is the second thumbnail, notice the call for the initialize() function again
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        return $image_data;
    }
}

 ?>