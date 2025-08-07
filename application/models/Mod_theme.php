<?php
class Mod_theme extends CI_Model
{
    public function tema()
    {
        $acak = random_string('nozero',1);

        switch ($acak) {
            case '1':
                $tema = "info";
                break;
            case '2':
                $tema = "success";
                break;
            case '3':
                $tema = "navy";
                break;
            case '4':
                $tema = "primary";
                break;
            case '5':
                $tema = "orange";
                break;
            case '6':
                $tema = "danger";
                break;
            case '7':
                $tema = "olive";
                break;
            case '8':
                $tema = "teal";
                break;
            case '9':
                $tema = "fuchsia";
                break;
            
            default:
                $tema = "primary";
                break;
        }
       
        $this->session->set_userdata("TEMA",$tema);
    }
        
    
}
