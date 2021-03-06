<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

    public $data;
    private $pageconf;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('Lost', 'lost', TRUE);
        $this->load->model('Found', 'found', TRUE);
        $this->data = array();
        $this->pageconf = array();
    }
    
    public function searchfunc()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('sslb', '搜索类别', 'required|xss_clean|callback_sslb_check');
        $this->form_validation->set_rules('sslr', '搜索内容', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE)
        {
            $sslb = $this->input->post('sslb', TRUE);
            $sslr = $this->input->post('sslr', TRUE);
	    #$sslr = urlencode($sslr);
            switch ($sslb)
            {
                case 'zlxx': // 招领信息
                case 'xwxx': // 寻物信息
                    $this->searchlist($path = $sslb, $page = '1', $key = $sslr);
		    break;
            }
        }
        else
        {
            redirect('/', 'refresh');
        }
    }
    
    public function sslb_check($sslb)
    {
        switch ($sslb)
        {
            case 'zlxx': // 招领信息
            case 'xwxx': // 寻物信息
                return TRUE;
            default:
                return FALSE;
        }
    }
    
    public function searchlist($path = 'zlxx', $page = '1', $key = '')
    {
        $path = $this->security->xss_clean($path);
        $page = $this->security->xss_clean($page);
        $key = $this->security->xss_clean($key);
        $page = intval($page);
        if (empty($key) )
        {
            redirect('/', 'refresh');
        }
        switch ($path)
        {
            case 'zlxx':
            case 'xwxx':
                $this->_get_data($path, $page, $key);
                $this->_pagination($path,$page, $key);
                break;
            default:
                redirect('/', 'refresh');
        }
        $this->load->view('search', $this->data);
    }
		  
    private function _get_data($path = 'zlxx', $page = '1', $key = '')
    {
        $path = $this->security->xss_clean($path);
        $page = $this->security->xss_clean($page);
        $key = $this->security->xss_clean($key);
        $page = intval($page);
        switch ($path)
        {
            case 'zlxx': // 招领信息
                $this->data['type'] = 'zlxx';
                $this->data['info'] = $this->found->search($page, $key);
                $this->data['per_page_count'] = $this->found->get_per_page_count($key);
                break;
            case 'xwxx': // 寻物信息
                $this->data['type'] = 'xwxx';
                $this->data['info'] = $this->lost->search($page, $key);
                $this->data['per_page_count'] = $this->lost->get_per_page_count($key);
                break;
            default:
                $this->data = array();
        }
        foreach ($this->data['info'] as $searchdata)
        {
            $searchdata->name = cut_string($searchdata->name, 5);
            $searchdata->place = cut_string($searchdata->place, 5);
            $searchdata->description = cut_string($searchdata->description, 7);
        }
    }
    
    private function _pagination($path = 'zlxx',$cur_page, $key = '')
    {
        $path = $this->security->xss_clean($path);
	$key  = $this->security->xss_clean($key);
	$this->pageconf['cur_page'] = $cur_page;
        $this->pageconf['base_url'] = site_url('search') . '/' . $path . '/' . $key . '/';
	$this->pageconf['num_links'] = 3;
	$this->pageconf['uri_segment'] = 4;
        $this->pageconf['first_link'] = '<span style="font-size:12px; color:#003399;">首页</span>';
        $this->pageconf['last_link'] = '<span style="font-size:12px; color:#003399;">末页</span>';
        $this->pageconf['prev_link'] = '<span style="font-size:12px; color:#003399;">上一页</span>';
        $this->pageconf['next_link'] = '<span style="font-size:12px; color:#003399;">下一页</span>';

        switch ($path)
        {
            case 'zlxx': // 招领信息
		$this->pageconf['total_rows'] = $this->found->get_total_rows($key);
		$this->data['pages'] = intval($this->found->get_total_rows($key)/9); 
		if($this->found->get_total_rows($key)%9)  $this->data['pages']++;
	        $this->pageconf['per_page'] = $this->found->get_per_page_count();
                break;
            case 'xwxx': // 寻物信息
                $this->pageconf['total_rows'] = $this->lost->get_total_rows($key);
	        $this->data['pages'] = intval($this->lost->get_total_rows($key)/9);
		if($this->lost->get_total_rows($key)%9)  $this->data['pages']++;
	        $this->pageconf['per_page'] = $this->lost->get_per_page_count();
                break;
        }
        $this->pageconf['use_page_numbers'] = TRUE;
        $this->pagination->initialize($this->pageconf);
        $this->data['page'] = $this->pagination->create_links();
    }
}
