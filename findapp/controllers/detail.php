<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detail extends CI_Controller {

    public $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('captcha');
        $this->load->model('Lost', 'lost', TRUE);
        $this->load->model('Found', 'found', TRUE);
        $this->data = array();
    }
    
    public function detailfunc($qslx, $id)
    {
        $this->_detailfunc($qslx, $id);
        $this->load->view('detail', $this->data);
    }

    public function ajaxdetailfunc($qslx, $id)
    {
        $this->_detailfunc($qslx, $id);
        echo json_encode($this->data);
    }
    public function _detailfunc($qslx, $id)
    {
        $qslx = $this->security->xss_clean($qslx);
        $id = $this->security->xss_clean($id);
        $id = intval($id);
        switch ($qslx)
        {
            case 'zlxx':
                $this->data = $this->found->get_detail_info($id);
                $this->data['qslx'] = '招领启事';
                $this->data['qs'] = 'zlxx';
                break;
            case 'xwxx':
                $this->data = $this->lost->get_detail_info($id);
                $this->data['qslx'] = '寻物启事';
                $this->data['qs'] = 'xwxx';
                break;
            default:
                $this->data = 'error';
                show_404();
        }
        $this->data['captcha'] = $this->_captcha();
               
    }
    
    public function ajaxphone($id)
    {
        $this->data['ajax'] = TRUE;
        $this->phone($id);
    }

    public function phone($id)
    {
        $id = $this->security->xss_clean($id);
        $id = intval($id);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', '验证码', 'required|xss_clean');
        $this->form_validation->set_rules('path', 'path', 'required|xss_clean|callback_path_check');
        if ($this->form_validation->run() == TRUE)
        {
            $code = $this->input->post('code', TRUE);
            $path = $this->input->post('path', TRUE);
            // 删除过期的验证码
            $expiration = time()-900;
            $this->db->where('captcha_time <' , $expiration);
            $this->db->delete('captcha');
            // 验证
            $this->db->select('captcha_id');
            $this->db->from('captcha');
            $this->db->where('word', $code);
            $this->db->where('ip_address', $this->input->ip_address() );
            $this->db->where('captcha_time >', $expiration);
            $query = $this->db->get();
            if ($query->num_rows() > 0)
            {
                $this->db->select('phone');
                switch ($path)
                {
                    case 'zlxx':
                        $this->data['phone'] = $this->found->get_phone($id);
                        break;
                    case 'xwxx':
                        $this->data['phone'] = $this->lost->get_phone($id);
                        break;
                }
                $this->load->view('ajax/detail', $this->data);
            }
           # echo 'error';
        }
        else
        {
            echo 'error';
        }
    }
    
    public function path_check($path)
    {
        $path = $this->security->xss_clean($path);
        switch ($path)
        {
            case 'zlxx':
            case 'xwxx':
                return true;
            default:
                return false;
        }
    }
    
    private function _captcha()
    {
        $vals = array(
            'word' => get_random_string(4),
            'img_path' => './captcha/',
            'img_url' => '/captcha/',
            'font_path' => './static/simhei.ttf',
            'img_width' => 70,
            'img_height' => 30,
            'expiration' => 900
        );
        $captcha = create_captcha($vals);
        $data = array(
            'captcha_time' => $captcha['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $captcha['word']
        );
        $this->db->insert('captcha', $data);
        return $captcha['image'];
    }
}
