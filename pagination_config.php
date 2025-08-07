<?php
//konfigurasi pagination
$config["total_rows"] = $total_rows;
$config["per_page"] = 20;  //show record per halaman
$config["uri_segment"] = 3;  // uri parameter
$choice = $config["total_rows"] / $config["per_page"];
$config["num_links"] = 5;
$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
// Membuat Style pagination untuk BootStrap v4
$config['first_link'] = '<i class="fa fa-angle-double-left "></i>';
$config['last_link'] = '<i class="fa fa-angle-double-right  "></i>';
$config['next_link'] = '<i class="fa fa-angle-right  "></i>';
$config['prev_link'] = '<i class="fa fa-angle-left  "></i>';
$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
$config['full_tag_close'] = '</ul></nav></div>';
$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['num_tag_close'] = '</span></li>';
$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close'] = '</span>Next</li>';
$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['last_tagl_close'] = '</span></li>';

