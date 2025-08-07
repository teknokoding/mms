<?php
class Mod_auth extends CI_Model
{
    public function ceklogin($Username, $Password)
    {
        $this->db->where('username', $Username);
        $this->db->where('password', $Password);
        $row = $this->db->get('user')->row();
        if (isset($row)) {
            $namalengkap        =   $row->namalengkap;
            $id_level           =   $row->id_level;
            $username           =   $row->username;
            $foto               =   $row->foto;
            $pwd_stat           =   $row->pwd_stat;
            $iduser             =   $row->iduser;
            $id_sect            =   $row->id_sect;
            $id_dept            =   $row->id_dept;
            $last_login         =   $row->last_login;
            $ttd                =   $row->ip;
            $ip                 =   $row->ip;
            $host               =   $row->host;
            
            
            $this->db->where('id_level',$id_level);
            $rowlevel = $this->db->get('level')->row();
            $nama_level = $rowlevel->nama_level;
            // LOGING IP Adress pengguna, biar tau dia masuk darimana
            if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
                //check ip share internet
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                // Check ip proxy user
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else {
                $ip = $_SERVER["REMOTE_ADDR"];
            }
            // CHEK Hostname nya...
            $host = gethostbyaddr($ip);
            $data = array(
                "iduser" => $iduser,
                "namalengkap" => $namalengkap,
                "username"=>$username,
                "id_level" => $id_level,
                "Auth" => '1',
                "id_sect"=>$id_sect,
                "id_dept"=>$id_dept,
                "foto"=>$foto,
                "pwd_stat"=>$pwd_stat,
                "ip"=>$ip,
                "host"=>$host,
                "last_login"=>$last_login,
                "id_mesin"=>'ALL',
                "sesi"=>0,
            );
            $this->session->set_userdata($data);
            $this->db->where('iduser',$iduser);
            $this->db->update('user',array("host"=>$host,"ip"=>$ip));
        }
    }
    public function cekloginmonitor($Username, $Password)
    {
        $this->db->where('username', $Username);
        $this->db->where('password', $Password);
        $row = $this->db->get('user')->row();
        if (isset($row)) {
            $namalengkap        =   $row->namalengkap;
            $id_level           =   $row->id_level;
            $username           =   $row->username;
            $foto               =   $row->foto;
            $pwd_stat           =   $row->pwd_stat;
            $iduser             =   $row->iduser;
            $id_sect            =   $row->id_sect;
            $id_dept            =   $row->id_dept;
            $last_login         =   $row->last_login;
            $ttd                =   $row->ip;
            $ip                 =   $row->ip;
            $host               =   $row->host;
            
            
            $this->db->where('id_level',$id_level);
            $rowlevel = $this->db->get('level')->row();
            $nama_level = $rowlevel->nama_level;
            // LOGING IP Adress pengguna, biar tau dia masuk darimana
            if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
                //check ip share internet
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                // Check ip proxy user
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else {
                $ip = $_SERVER["REMOTE_ADDR"];
            }
            // CHEK Hostname nya...
            $host = gethostbyaddr($ip);
            
                set_cookie("mmsiduser" , $iduser,'2147483647');
                set_cookie("mmsnamalengkap" , $namalengkap,'2147483647');
                set_cookie("mmsusername",$username,'2147483647');
                set_cookie("mmsid_level" , $id_level,'2147483647');
                set_cookie("mmsauth" , '1','2147483647');
                set_cookie("mmsid_sect",$id_sect,'2147483647');
                set_cookie("mmsid_dept",$id_dept,'2147483647');
                set_cookie("mmsfoto",$foto,'2147483647');
                set_cookie("mmspwd_stat",$pwd_stat,'2147483647');
                set_cookie("mmsip",$ip,'2147483647');
                set_cookie("mmshost",$host,'2147483647');
                set_cookie("mmslast_login",$last_login,'2147483647');
                set_cookie("mmsid_mesin",'ALL','2147483647');
            
            $this->db->where('iduser',$iduser);
            $this->db->update('user',array("host"=>$host,"ip"=>$ip));
        }
    }
}
