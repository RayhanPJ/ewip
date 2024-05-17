<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('sqlmodel');
	}

	public function index()
	{
		$this->load->view('login/header');
		$this->load->view('login/index');
		$this->load->view('login/footer');
	}

	public function aksi_login(){

            $valid_user=$this->login_model->check_credential();
            
			if ($valid_user==FALSE) {
				$this->session->set_flashdata('error','Wrong Username/Password');
				redirect('login');
			}else{
				$this->session->set_userdata('username',$valid_user->username);	
				$this->session->set_userdata('nama_user',$valid_user->name_user);	
				$this->session->set_userdata('pic',$valid_user->name_user);	
				$this->session->set_userdata('npk',$valid_user->npk);	
				$this->session->set_userdata('level',$valid_user->level);
				$this->session->set_userdata('departemen',$valid_user->dept);
				$this->session->set_userdata('id_users',$valid_user->id_user);	
				$this->session->set_userdata('password',$valid_user->password);	
				$this->session->set_userdata('seksi',$valid_user->section);
				
				switch ($valid_user->level) {
					case 1: //
							redirect('wip/batch');
                            break;	
                    case 2: //
                        redirect('wip/batch');
						break;	
					case 3: //
						redirect('whkom/batch');
						break;	
					case 4: //
						redirect('whkom/batch_prod');
						break;	
					case 5: //
						redirect('whfg/forklift_monitoring');
						break;	
					case 6: //
						redirect('order_timah/');
						break;	
					case 7: //
						redirect('order_timah/activity_supply');
						break;
					case 8: //
						redirect('order_plate/list_order');
					case 9: //
						redirect('order_plate/activity_supply_assy_a');
						break;
					case 10: //
						redirect('AndonForklift/list_andon');
						break;
					default:
						break;
				}
			}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */ 