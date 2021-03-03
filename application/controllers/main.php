<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    /*****
    *@function name:register
    ***register form***
    *@author:Varsha S
    *$date:02/03/2021
    *****/
    public function register()
    {
        $this->load->view('register');
    }
    /****
    *@function name:index
    ***index page***
    *$date:02/03/2021
    *****/
    public function index()
    {
        $this->load->view('index');
    }
    /****
    *@function name:userhome
    ***User home***
    *$date:02/03/2021
    *****/
    public function userhome()
    {
        if($_SESSION['logged_in']==true && $_SESSION['usertype']=='1')
        {
             $this->load->view('userhome');
        }
        else
        {
            redirect(base_url().'main/log'); 
        }
    }
    /****
    *@function name:adminhome
    ***admin home***
    *$date:02/03/2021
    *****/
    public function adminhome()
    {
          if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0')
           {
                 $this->load->view('adminhome');
           }
          else
          {
            redirect(base_url().'main/log'); 
          }
    }
    /****
}
*@function name:reginsert
******user insertion*****
    *$date:02/03/2021
    ******/
public function reginsert()
{
        $this->load->library('form_validation');
        $this->form_validation->set_rules("fname","fname",'required');
        $this->form_validation->set_rules("lname","lname",'required');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("mobile","mobile",'required');
        $this->form_validation->set_rules("dob","dob",'required');
        $this->form_validation->set_rules("address","address",'required');
        $this->form_validation->set_rules("district","district",'required');
        $this->form_validation->set_rules("pin","pin",'required');
        $this->form_validation->set_rules("username","username",'required');
        $this->form_validation->set_rules("password","password",'required');
        if($this->form_validation->run())
        {
        $this->load->model('mainmodel');
        $pass=$this->input->post("password");
        $encpass=$this->mainmodel->encapswd($pass);
        $b=array("fname"=>$this->input->post("fname"),
                 "lname"=>$this->input->post("lname"),
                "address"=>$this->input->post("address"),
                "district"=>$this->input->post("district"),
                "pin"=>$this->input->post("pin"),
                "dob"=>$this->input->post("dob")
               );
         $c=array( "email"=>$this->input->post("email"),
                  "mobile"=>$this->input->post("mobile"),
                  "username"=>$this->input->post("username"),
                "password"=>$encpass,
                "usertype"=>'1');
        $this->mainmodel->inreg($b,$c);    
        redirect(base_url().'main/log'); 
        }
}
 /****
*@function name:log
    *@author:Varsha S
    *$date:02/03/2021
    ******/
public function log()
{
    $this->load->view('loginform');
}
 /****
*@function name:login
    *$date:02/03/2021
    ****login action***
    ******/
public function login()
{
        $this->load->library('form_validation');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("password","password",'required');
            if($this->form_validation->run())
            {
                $this->load->model('mainmodel');
                $email=$this->input->post("email");
                $pass=$this->input->post("password");
               // echo"$pass";exit;
                $rslt=$this->mainmodel->selectpass($email,$pass);
                if($rslt)
                {
                    $id=$this->mainmodel->getuserid($email);
                    $user=$this->mainmodel->getuser($id);
                    $this->load->library(array('session'));
                    $this->session->set_userdata(array('id'=>$user->id,'usertype'=>$user->usertype,'userstatus'=>$user->userstatus,'logged_in'=>(bool)true));
                    if($_SESSION['usertype']=='0' && $_SESSION['logged_in']==true && $_SESSION['userstatus']=='1' )
                    {
                                redirect(base_url().'main/adminhome');
                    }
                    elseif($_SESSION['usertype']=='1' && $_SESSION['logged_in']==true && $_SESSION['userstatus']=='1')
                    {

                            redirect(base_url().'main/userhome');
                    }
                  
                   else
                    {
                        echo "Waiting for Approval";
                    }
                }
                    else
                    {
                        echo "invalid user";
                    }
                }
                else
                {
                    redirect(base_url().'main/login','refresh');
                }
        
        
}
/*@function name:view
*******user view*****
    *$date:02/03/2021
    ******/
public function view()
{
       if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0')
        {
            $this->load->model('mainmodel');
            $data['n']=$this->mainmodel->view();
            $this->load->view('view',$data);
        }
        else
        {
            redirect("main/log","refresh");
        }
}
/*@function name:approve
******approval of user***
    *$date:02/03/2021
    ******/
 public function approve()
    {   
        if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0')
        {
            $this->load->model('mainmodel');
            
            $id=$this->uri->segment(3);
            $this->mainmodel->approve($id);
            redirect('main/view','refresh');
        } 
        else
        {  
            redirect("main/log","refresh");

        }
    }
    /*@function name:reject
******approval of reject***
    *$date:02/03/2021
    ******/  
    public function reject()
    {
     if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0')
        {
            $this->load->model('mainmodel');
            
            $id=$this->uri->segment(3);
            $this->mainmodel->reject($id);
            redirect('main/view','refresh');
        }
    else
       {
          redirect("main/log","refresh");        
        }
    }

/*@function name:update
******Update form for user***
    *$date:02/03/2021
    ******/  
  public function update()
        {
             if($_SESSION['logged_in']==true && $_SESSION['usertype']=='1')
             {
                    $id=$this->session->id;
                    $this->load->model('mainmodel');
                    $data['user_data']=$this->mainmodel->update($id);
                    $this->load->view("updateuser",$data);
              }
              else
              {
                 redirect("main/log","refresh");  
              }
          }
/*@function name:updateaction
******Update action***
    *$date:02/03/2021
    ******/  
  public function updateaction()
    {     
        if($_SESSION['logged_in']==true && $_SESSION['usertype']=='1')
             {
                  $a= array("fname"=>$this->input->post("fname"),
                        "lname"=>$this->input->post("lname"),
                        "dob"=>$this->input->post("dob"),
                         "address"=>$this->input->post("address"),
                         "district"=>$this->input->post("district"),
                         "pin"=>$this->input->post("pin"));
                  $b=array("email"=>$this->input->post("email"),
                        "mobile"=>$this->input->post("mobile"),
                        "username"=>$this->input->post("username") );
                $this->load->model('mainmodel');
             if($this->input->post("update"))
                {
                    $id=$this->session->id;
                    $this->mainmodel->updateaction($a,$b,$id);
                    redirect('main/update','refresh');
                }
            }
            else
            {
               redirect('main/index','refresh');   
            }

}
 /*@function name:check_email_avalibility
******checking if email is available***
    *$date:02/03/2021
    ******/  
 public  function check_email_avalibility()  
      {  
           if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  
           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("mainmodel");  
                if($this->mainmodel->is_email_available($_POST["email"]))  
                {   
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already Exist</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';  
                }  
           }  
      }
 /*@function name:check_mobile_avalibility
******checking if mobile number is available***
    *$date:02/03/2021
    ******/ 
public  function check_mobile_avalibility()  
      {  
                $this->load->model("mainmodel");  
                if($this->mainmodel->is_mobile_available($_POST["mobile"]))  
                {   
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> mobile number Already Exist</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Mobile number Available</label>';  
                }  
            
      }
      public  function check_username_avalibility()  
      {  
                $this->load->model("mainmodel");  
                if($this->mainmodel->is_username_available($_POST["username"]))  
                {   
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> username Already Exist</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span>username Available</label>';  
                }  
            
      }
/*@function name:delete
*****deleting users***
    *$date:02/03/2021
    ******/ 
      
public function delete()
 { 
    if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0')
    {
            $this->load->model('mainmodel');
            $id=$this->uri->segment(3);
            $this->mainmodel->delete($id);
            redirect('main/view','refresh');
 }
 else
 {
    redirect('main/index','refresh');
 }
}

 /*@function name:logout
    *$date:02/03/2021
    ******/ 
    public function logout()
    {
        $data=new stdClass();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true)
        {
            foreach ($_SESSION as $key => $value) 
            {
               unset($_SESSION[$key]);
            }
            $this->session->set_flashdata('logout_notification','logged_out');
            redirect('main/index','refresh');
        }
        else{
            redirect('/');
        }
    }
  public function forgotpswd()
    {
        $this->load->view('forgetpswd');
    }
    public function send()
{
    $to =  $this->input->post('from');  // User email pass here
    $subject = 'Welcome To Elevenstech';

    $from = 'team2ojt@gmail.com';              // Pass here your mail id

    $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://elevenstechwebtutorials.com/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
    $emailContent .='<tr><td style="height:20px"></td></tr>';


    $emailContent .= $this->input->post('message');  //   Post message available here


    $emailContent .='<tr><td style="height:20px"></td></tr>';
    $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://elevenstechwebtutorials.com/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.elevenstechwebtutorials.com</a></p></td></tr></table></body></html>";
                


    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '60';

    $config['smtp_user']    = 'team2ojt@gmail.com';    //Important
    $config['smtp_pass']    = 'nikhila@123';  //Important

    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not 

     

    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->from($from);
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($emailContent);
    $this->email->send();

    $this->session->set_flashdata('msg',"Mail has been sent successfully");
    $this->session->set_flashdata('msg_class','alert-success');
    return redirect('main/forgotpswd');
}
}