<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_mesin');
        $this->load->model('mod_preventive');
        $this->load->model('mod_breakdown');
        $this->load->model('mod_tpm'); 
    }
    public function qr($id_mesin)
    {
        $mesin['id_mesin']=$id_mesin;
        $id_mesin = $this->secure->decrypt($id_mesin);
        $data['mesin'] = $this->mod_mesin->readbyid($id_mesin);
        $this->load->view('header_monitor',$mesin);
		$this->load->view('sidebar_monitor',$mesin);
        $this->load->view('monitor/index',$data);
        $this->load->view('footer_monitor');
    }
    public function encrypt($id_mesin)
    {
        echo $this->secure->encrypt($id_mesin);
    }

    function qrlink($id_mesin) {
        header("location:".base_url('monitor/qr/').$this->secure->encrypt($id_mesin));
    }

    public function decrypt($id_mesin)
    {
        echo $this->secure->decrypt($id_mesin);
    }
    public function preventive($id_mesin)
    {
        $id_mesin_fix = $this->secure->decrypt($id_mesin);
        $start_cl = date('Y-m-d');
        $data['prev_mingguan']=$this->mod_preventive->readday_mesin($id_mesin_fix,$start_cl);
        $data['prev_bulanan']=$this->mod_preventive->readday_pass_mesin($id_mesin_fix,$start_cl);
        $data['prev_last']=$this->mod_preventive->readlast_mesin($id_mesin_fix);
        $mesin['id_mesin'] = $id_mesin;
        $this->load->view('header_monitor',$mesin);
		$this->load->view('sidebar_monitor',$mesin);
        $this->load->view('monitor/preventive',$data);
        $this->load->view('footer_monitor');

    }

    public function breakdown($id_mesin)
    {
        $id_mesin_fix = $this->secure->decrypt($id_mesin);
        $data['breakdown'] = $this->mod_breakdown->readbymesin($id_mesin_fix);
        $mesin['id_mesin'] = $id_mesin;
        $this->load->view('header_monitor',$mesin);
		$this->load->view('sidebar_monitor',$mesin);
        $this->load->view('monitor/breakdown',$data);
        $this->load->view('footer_monitor');

    }

    public function tpm($id_mesin)
    {
        $id_mesin_fix = $this->secure->decrypt($id_mesin);
        $data['tpm'] = $this->mod_tpm->read_mesin_qr($id_mesin_fix);
        $mesin['id_mesin'] = $id_mesin;
        $this->load->view('header_monitor',$mesin);
		$this->load->view('sidebar_monitor',$mesin);
        $this->load->view('monitor/tpm',$data);
        $this->load->view('footer_monitor');

    }

    public function riwayat($reff_id)
	{
        $this->load->model('mod_lkh');
		$data['riwayat']=$this->mod_lkh->readbyreffid($reff_id);
		$this->load->view('breakdown/riwayatmonitor',$data);

    }
    
    public function riwayat_tag($id_tag)
	{
        $this->load->model('mod_lkh');
		$data['riwayat']=$this->mod_tpm->readbyid($id_tag);
		$this->load->view('tpm/riwayat',$data);

    }
    
    public function scaner($id_mesin='0')
    {
        $mesin['id_mesin'] = $id_mesin;
		if($id_mesin=='0'){$this->load->view('monitor/scanersolo');}else{
        $this->load->view('header_monitor',$mesin);
		$this->load->view('sidebar_monitor',$mesin);
        $this->load->view('monitor/scanerhtml5');
        $this->load->view('footer_monitor');}
    }
    
    // FORM INPUT LKH LANJUTAN  DARI SISTEM MONITOR ===========================================
	public function createnextmonitor($reff_id,$id_mesin_enc)
	{
        if(get_cookie('mmsauth')=="")
        {
            $this->session->set_flashdata('id_mesin_enc', $id_mesin_enc);
            redirect('loginmonitor');
        }
        $this->load->model('mod_karyawan');
        $this->load->model('mod_user');
        $this->load->model('mod_lkh');
        //$data['mesin'] = $this->mod_mesin->readbymnt(get_cookie('mmsid_sect'));
		$data['karyawan']=$this->mod_karyawan->readbysect_aktif(get_cookie('mmsid_sect'));
		$data['user']=$this->mod_user->readbysect_aktif(get_cookie('mmsid_sect'));
		$data['reff_id']=$reff_id;
		$data['lkh']=$this->mod_lkh->readbyreffid($reff_id);
		$mesin['id_mesin'] = $id_mesin_enc;
		$this->load->view('header_monitor',$mesin);
		$this->load->view('sidebar_monitor',$mesin);
		$this->load->view('lkh/createnextmonitor',$data);
		$this->load->view('footer_monitor');
		
    }
    
    // EKSEKUSI INPUT LKH  DARI SISTEM ONITOR ===========================================
	public function inputmonitor()
	{
        $this->load->model('mod_lkh');
		if($this->input->post('status')!="OK")
		{
			$finish=0;
			if(empty($this->input->post('reff_id')))
			{
				$reff_id=random_string('alnum',8);
			}
			else
			{
				$reff_id = $this->input->post('reff_id');
			}
		}
		else
		{
			$finish=1;
			if(empty($this->input->post('reff_id')))
			{
				$reff_id="";
			}
			else
			{
				$reff_id = $this->input->post('reff_id');
				$this->mod_lkh->updatelanjutan($reff_id,$finish);

			}	
			
		}
		$data = array(
			'finish'=>$finish,
			'reff_id'=>$reff_id,
			'id_sect'=>$this->input->post('id_sect'),
			'id_dept'=>$this->input->post('id_dept'),
			'jenislkh'=>$this->input->post('jenislkh'),
			'tgllkh'=>$this->input->post('tgllkh'),
			'shift'=>$this->input->post('shift'),
			'id_mesin'=>$this->input->post('id_mesin'),
			'id_unit_mesin'=>$this->input->post('id_unit_mesin'),
			'detail'=>$this->input->post('detail'),
			'keluhan'=>$this->input->post('keluhan'),
			'uraian'=>$this->input->post('uraian'),
			'status'=>$this->input->post('status'),
			'waktumulai'=>$this->input->post('waktumulai'),
			'waktuselesai'=>$this->input->post('waktuselesai'),
			'pengisilaporan'=>$this->input->post('pengisilaporan'),
			'pelaksana1'=>$this->input->post('pelaksana[0]'),
			'pelaksana2'=>$this->input->post('pelaksana[1]'),
			'pelaksana3'=>$this->input->post('pelaksana[2]'),
			'pelaksana4'=>$this->input->post('pelaksana[3]'),
			'pelaksana5'=>$this->input->post('pelaksana[4]'),
			'pelaksana6'=>$this->input->post('pelaksana[5]'),
		);
		$id_mesin_enc = $this->secure->encrypt($this->input->post('id_mesin'));
		$this->mod_lkh->input($data);
		redirect('monitor/qr/'.$id_mesin_enc);
	}

}

/* End of file Monitor.php */
?>
