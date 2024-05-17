<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class AndonForklift extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('M_AndonForklift');

    if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '8' OR $this->session->userdata('level') == '9' OR $this->session->userdata('level') == '6' OR $this->session->userdata('level') == '10') {
			echo "";
		} else {
			redirect('login','refresh');			
		}

		$this->output->delete_cache();
      $data = [];
    }

    public function index()
    {
      $this->list_andon();
    }

    public function list_andon($date = null, $shift = null, $page = null)
    {
        $time_now = date('H:i');
        // $time_now = '14:00';
        // var_dump($time_now); die();
        if($shift == null) {
          if($time_now < '07:30' && $time_now > '00:30') {
            $shift = 3;
          } else if($time_now < '16:30') {
            $shift = 1;
          } else {
            $shift = 2;
          }
        }

        if ($date == null) {
          $filterDate = date('Y-m-d');
          $getAndon = $this->M_AndonForklift->getQueueScheduleAndonForklift($filterDate,$shift);
        } else {
          $filterDate = $date;
          $getAndon = $this->M_AndonForklift->getQueueScheduleAndonForklift($filterDate,$shift);
        }
        
        $open = array_filter($getAndon, function ($var) {                                    
          return ($var['status'] == 'Open' || $var['status'] == 'On Progress');
        });
        $num = array_keys($open);

        if ($page == null) {
          if (!empty($num[0])) {
            $count = $num[0];
          } else {
            $count = 0;
          }            
        } else {
          $count = $page - 1;
        }

        $data['data'] = $getAndon;
        $data['date'] = $filterDate;
        $data['count'] = $count;
        $data['shift'] = $shift;
        
        $this->load->view('template/header');
        $this->load->view('andon_forklift/list_andon', $data);
        $this->load->view('template/footer');
    }

    public function confirmAndon()
    {
      $id_andon_forklift = $this->input->post('id_andon_forklift');
      $action = $this->input->post('action');
      $operator = $this->input->post('operator');
      $time_now = date('Y-m-d H:i:s');

        if ($action == 'On Progress') {
            $data = array(
              'operator' => $operator,
              'start_progress' => $time_now,
              'status' => 'On Progress',
            );
            $this->M_AndonForklift->update_andon_forklift($id_andon_forklift, $data);
        } else {
            $data = array(
              'end_progress' => $time_now,
              'status' => 'Closed',
            );

            $this->M_AndonForklift->update_andon_forklift($id_andon_forklift, $data);
        }
        redirect('AndonForklift/list_andon/');
    }
}

 ?>