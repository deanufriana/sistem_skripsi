 <?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  

 class Lupa_password extends CI_Controller {  


   public function index()  
   {  

     $this->form_validation->set_rules('email', 'Email', 'required|valid_email');   

     if($this->form_validation->run() == FALSE) {  
       $data['title'] = 'Halaman Reset Password | Tutorial reset password CodeIgniter @ https://recodeku.blogspot.com';  
       $this->load->view('lupa',$data);  
     } else{  
       $email = $this->input->post('email');   
       $clean = $this->security->xss_clean($email);  
       $userInfo = $this->M_Account->getUserInfoByEmail($clean);  

       if(!$userInfo){  
         $this->session->set_flashdata('sukses', 'email address salah, silakan coba lagi.');  
         redirect(site_url('lupa'),'refresh');   
       }    


       $token = $this->M_Account->insertToken($userInfo->nim);              
       $qstring = $this->base64url_encode($token);           
       $url = base_url() . '/lupa_password/reset_password/token/' . $qstring;  
       $link = '<a href="' . $url . '">' . $url . '</a>';   

       $message = '';             
       $message .= '<strong>Hai, anda menerima email ini karena ada permintaan untuk memperbaharui  
       password anda.</strong><br>';  
       $message .= '<strong>Silakan klik link ini:</strong> ' . $link;         

       echo $message;
       exit;  

     }  

   }
   

   public function reset_password()  
   {  
     $token = $this->base64url_decode($this->uri->segment(4));           
     $cleanToken = $this->security->xss_clean($token);  

     $user_info = $this->M_Account->isTokenValid($cleanToken);    

     if(!$user_info){  
       $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');  
       redirect(site_url('login'),'refresh');   
     }    

     $data = array(  
       'title'=> 'Halaman Reset Password | Tutorial reset password CodeIgniter @ https://recodeku.blogspot.com',  
       'nama'=> $user_info->nama_mhs,   
       'email'=>$user_info->email_mhs,   
       'token'=>$this->base64url_encode($token)  
     );  

     $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');  
     $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');         

     if ($this->form_validation->run() == FALSE) {    
       $this->load->view('reset', $data);  
     }else{  

       $post = $this->input->post(NULL, TRUE);          
       $cleanPost = $this->security->xss_clean($post);          
       $hashed = md5($cleanPost['password']);          
       $cleanPost['password'] = $hashed;  
       $cleanPost['id_user'] = $user_info->nim;  
       unset($cleanPost['passconf']);          
       if(!$this->M_Account->updatePassword($cleanPost)){  
         $this->session->set_flashdata('sukses', 'Update password gagal.');  
       }else{  
         $this->session->set_flashdata('sukses', 'Password anda sudah  
           diperbaharui. Silakan login.');  
       }  
       redirect(site_url('login'),'refresh');         
     }  
   }  

   public function base64url_encode($data) {   
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   
  }   

  public function base64url_decode($data) {   
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   
  }    
}  a