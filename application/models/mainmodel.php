<?php
class mainmodel extends CI_model
{
	/*@function name:encapswd
******Password hashing***
    *@author:Varsha S
    *$date:02/03/2021
    ****login action***
    ******/  
	public function encapswd($pass)
	{
		return password_hash($pass, PASSWORD_BCRYPT);
	}
	/*@function name:inreg
******user insertion***
    *@author:Varsha S
    *$date:02/03/2021
    ****login action***
    ******/  
	public function inreg($a,$b)
	{
		$this->db->insert("login",$b);
		$loginid=$this->db->insert_id();
		$a['loginid']=$loginid;
	   $this->db->insert("register",$a);
	}
	/*@function name:verifypass
******Password verification***
    *@author:Varsha S
    *$date:02/03/2021
    ****login action***
    ******/  
// public function verifypass($pass,$qry)
// 	   {
//          return  password_verify($pass,$qry);
          
//         }
        /*@function name:getuserid
******getting id from login***
    *@author:Varsha S
    *$date:02/03/2021
    ****login action***
    ******/  
 //  public function getuserid($email)
	// {
	// 	$this->db->select('id');
	// 	$this->db->from("login");
	// 	$this->db->where("email",$email);
	// 	return $this->db->get()->row('id');
	// }
	/*@function name:selectpass
******selecting password using email***
    *@author:Varsha S
    *$date:02/03/2021
    ****login action***
    ******/  
 //        public function selectpass($email,$pass)
	// {
	// 	$this->db->select('password');
	// 	$this->db->from("login");
	// 	$this->db->where("email",$email);
	// 	$qry=$this->db->get()->row('password');
	// 	//echo"$qry";exit;
	// 	return $this->verifypass($pass,$qry);
	// }
	/*@function name:getuser
******fetching userdata using id***
    *@author:Varsha S
    *$date:02/03/2021
    ****login action***
    ******/  
	// public function getuser($id)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from("login");
	// 	$this->db->where("id",$id);
	// 	return $this->db->get()->row();
	// }
public function selectpass($email,$pass)
{
$this->db->select('password');
$this->db->where("username=","$email");
$this->db->or_where("email=","$email");
$this->db->or_where("mobile=","$email");

$this->db->from('login');
$qry=$this->db->get()->row("password");
return $this->verifypas($pass,$qry);
}
public function verifypas($pass,$qry)
{
return password_verify($pass,$qry);
}
public function getuserid($email)
{
$this->db->select('id');
$this->db->from("login");
$this->db->where("username=","$email");
$this->db->or_where("email=","$email");
$this->db->or_where("mobile=","$email");

return $this->db->get()->row('id');
}
public function getuser($id)
{
$this->db->select('*');
$this->db->from("login");
$this->db->where("id",$id);
return $this->db->get()->row();
}

	/*@function name:view
    *@author:Varsha S
    *$date:02/03/2021
    ****login action***
    ******/  
	public function view()
	{
		$this->db->select('*');
		$this->db->join('login','login.id=register.loginid','inner');
		$qry=$this->db->where("usertype",'1');
		$qry=$this->db->get("register");
        return $qry;

	}
	public function approve($id)
    {   $this->db->set('userstatus','1');
        $qry=$this->db->where("id",$id);
        $qry=$this->db->update("login");
        return $qry;
    }
    public function reject($id)
    {   $this->db->set('userstatus','2');
        $qry=$this->db->where("id",$id);
        $qry=$this->db->update("login");
        return $qry;
    }
    public function update($id)
		{
			
			$this->db->select('*');
			$this->db->join('login','register.loginid=login.id','inner');
			$qry=$this->db->where("loginid",$id);
			$qry=$this->db->get("register");
			return $qry;
		}
		public function updateaction($a,$b,$id)
		{
		$this->db->select('*');
		$qry=$this->db->where("register.loginid",$id);
		$qry=$this->db->join('login','login.id=register.loginid','inner');
		$qry=$this->db->update("register",$a);
		$qry=$this->db->where("login.id",$id);
		$qry=$this->db->update("login",$b);
		return $qry;
		}
  public function delete($id)
{
    $this->db->where('id',$id);
    $this->db->delete("login");
}
function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  	
      function is_mobile_available($mobile)  
      {  
           $this->db->where('mobile', $mobile);  
           $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  	
      function is_username_available($username)  
      {  
           $this->db->where('username',$username);  
           $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }   
}
?>