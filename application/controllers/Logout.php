<?php
Class Logout extends CI_Controller
{
    public function index()
    {
        $this->db->where('iduser',$this->session->userdata('iduser'));
        $this->db->update('user',array('last_login'=>date('Y-m-d H:i:s')));
        $this->session->sess_destroy();
        redirect('login');
    }
     
    public function monitor($id_mesin)
    {
        delete_cookie('mmsiduser');delete_cookie('mmsnamalengkap');delete_cookie('mmsusername');delete_cookie('mmsid_level');delete_cookie('mmsauth');delete_cookie('mmsid_sect');delete_cookie('mmsid_dept');delete_cookie('mmsfoto');delete_cookie('mmspwd_stat');delete_cookie('mmsip');delete_cookie('mmshost');delete_cookie('mmslast_login');delete_cookie('mmsid_mesin');
        
        $this->session->set_flashdata('id_mesin_enc', $id_mesin);
        $this->session->set_userdata("swal","Swal.fire(
			'Berhasil Logout',
			'Saat ini membuka sistem sebagai pengguna umum',
			'success'
		  )");
        redirect('monitor/qr/'.$id_mesin);
    }
   
}
?>