<?php
class CI_Secure
{
    public function auth()
    {
        if (!$_SESSION['Auth']) {
            redirect('login');
        }
    }
    public function level($level)
    {
        $data = explode(',', $level);
        $max = count($data);
        $hasil = 0;
        $mylevel = $_SESSION['id_level'];
        for ($i = 0; $i < $max; $i++) {
            $data[$i] == $mylevel ? $res = 1 : $res = 0;
            $hasil += $res;
        }
        if ($hasil == 0) {
            redirect('forbidden');
        }
    }

public function encrypt($plain_text)
{
    $tambah = 4582;
    $kali = 8483;
    $string = $plain_text+$tambah;
    $string = $string*$kali;
    return base64_encode($string);
}
 
// fungsi base64 decrypt
// untuk mendekripsi string base64
public function decrypt($enc_text)
{
    $string = base64_decode($enc_text);
    $string = $string/8483;
    $string = $string-4582;
    return $string;
}
 


}
