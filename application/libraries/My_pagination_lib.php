<?php
class MY_Pagination_lib {

    protected $ci;

    public function __construct($config = array())
    {
         //parent::__construct($config);
         $this->ci =& get_instance();
    }

    public function init($base_url,$total_rows,$per_page=10,$uri_segment=3,$queryString=FALSE){
        $this->ci->load->library('pagination');
        
        $config['per_page']          = $per_page;
        $config['uri_segment']       = $uri_segment;
        $config['base_url']          = base_url().$base_url;
        $config['total_rows']        = $total_rows;
        $config['use_page_numbers']  = TRUE;

        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

        //$config['page_query_string'] = $queryString ;

        /*$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = "<li class='paginate_button page-item'>";
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li class='paginate_button page-item active'>";
        $config['cur_tag_close'] = "</li>";
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';*/
        $config['full_tag_open']   = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']   = '</span></li>';
        $config['cur_tag_open']   = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']   = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']   = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']   = '</span></li>';

        $this->ci->pagination->initialize($config);
        return $config;
    }

}
?>