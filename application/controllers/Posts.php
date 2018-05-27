<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Posts Management class created by Tutspointer
 */
class Posts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }
    
    public function index(){

        $config = [
         'useragent' => 'CodeIgniter',
         'protocol'  => 'smtp',
         'mailpath'  => '/usr/sbin/sendmail',
         'smtp_host' => 'ssl://smtp.gmail.com',
         'smtp_user' => 'silkyheart9@gmail.com',   // Ganti dengan email gmail Anda.
         'smtp_pass' => 'deanheart09',             // Password gmail Anda.
         'smtp_port' => 465,
         'smtp_keepalive' => TRUE,
         'smtp_crypto' => 'SSL',
         'wordwrap'  => TRUE,
         'wrapchars' => 80,
         'mailtype'  => 'text',
         'charset'   => 'utf-8',
         'validate'  => TRUE,
         'crlf'      => "\r\n",
         'newline'   => "\r\n",
     ];

     $this->load->library('email', $config);  

     $this->email->from('umusbrebes@gmail.com', 'Universitas Muhadi Setiabudi');
     $this->email->to('deanheart09@gmail.com');

     $this->email->subject('Lupa Password, ya?');
     $this->email->message('silahkan klik link di bawah ini untuk mereset passwordnya, misal ini bukan anda silahkan abaikan saja.');

     if ($this->email->send()) {
         echo "Sukses";
     } else {
        echo "gagal";
    }

    echo $this->email->print_debugger();
}

function info(){
   phpinfo();
}
}