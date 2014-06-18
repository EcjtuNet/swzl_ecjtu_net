<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

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
    
    public function index()
    {
        $this->infofunc();
    }
    
    public function infofunc($path = 'zlxx', $page = '1')
    {
        $path = $this->security->xss_clean($path);
        $page = $this->security->xss_clean($page);
        $page = intval($page);
        switch ($path)
        {
            case 'xwxx': // 寻物信息
            case 'zlxx': // 招领信息
                $this->_get_data($path, $page);
                $this->_pagination($path, $page);
                break;
            default:
                redirect('/', 'refresh');
        }
        $this->load->view('search', $this->data);
    }
    
    public function ajax($path='zlxx', $page = '1', $perpage = '9')
    {
	
        $path = $this->security->xss_clean($path);
        $page = $this->security->xss_clean($page);
	$page = intval($page);
        $perpage = $this->security->xss_clean($perpage);
	$perpage = intval($perpage);
        switch ($path)
        {
            case 'xwxx': // 寻物信息
            case 'zlxx': // 招领信息
                $this->_get_data($path, $page, $perpage, FALSE);
                echo json_encode($this->data);
                break;
            default:
                echo json_encode("error");
        }
	
    }   
    private function _get_data($path = 'zlxx', $page = '1', $perpage = 9, $cut = TRUE)
    {
        $path = $this->security->xss_clean($path);
        $page = $this->security->xss_clean($page);
        $perpage = intval($perpage);
        $page = intval($page);
        switch ($path)
        {
            case 'zlxx': // 招领信息
                $this->data['type'] = 'zlxx';
                $this->data['info'] = $this->found->get_info($page, $perpage);
                $this->data['per_page_count'] = $this->found->get_per_page_count();
                break;
            case 'xwxx': // 寻物信息
                $this->data['type'] = 'xwxx';
                $this->data['info'] = $this->lost->get_info($page, $perpage);
                $this->data['per_page_count'] = $this->lost->get_per_page_count();
                break;
            default:
                $this->data = array();
        }
        if($cut)
        {
            foreach ($this->data['info'] as $infodata)
            {
                $infodata->name = cut_string($infodata->name, 5);
                $infodata->place = cut_string($infodata->place, 5);
                $infodata->description = cut_string($infodata->description, 7);
            }
        }
    }
    
    private function _pagination($path = 'zlxx', $cur_page)
    {
        $path = $this->security->xss_clean($path);
        $this->pageconf['cur_page'] = $cur_page;
        $this->pageconf['base_url'] = site_url('info') . '/' . $path . '/';
	$this->pageconf['num_links'] = 3;
	$this->pageconf['first_link'] = '<span style="font-size:12px; color:#003399;">首页</span>';
	$this->pageconf['last_link'] = '<span style="font-size:12px; color:#003399;">末页</span>';
	$this->pageconf['prev_link'] = '<span style="font-size:12px; color:#003399;">上一页</span>';
	$this->pageconf['next_link'] = '<span style="font-size:12px; color:#003399;">下一页</span>';
        switch ($path)
        {
            case 'zlxx': // 招领信息
                $this->pageconf['total_rows'] = $this->found->get_total_rows();
		$this->data['pages'] = intval($this->found->get_total_rows()/9);
		if($this->found->get_total_rows()%9)  $this->data['pages']++;
                $this->pageconf['per_page'] = $this->found->get_per_page_count();
                break;
            case 'xwxx': // 寻物信息
                $this->pageconf['total_rows'] = $this->lost->get_total_rows();
		$this->data['pages'] = intval($this->lost->get_total_rows()/9);
		if($this->lost->get_total_rows()%9)  $this->data['pages']++;
                $this->pageconf['per_page'] = $this->lost->get_per_page_count();
                break;
        }
        $this->pageconf['use_page_numbers'] = TRUE;
        $this->pagination->initialize($this->pageconf);
        $this->data['page'] = $this->pagination->create_links();
    }
}
