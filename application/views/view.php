<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style> table,th,tr,td{
			
            border:2px solid black;
            border-collapse:collapse;
            padding: 10px;
            margin:50px;
		}
	</style>
	</head>
	<body>
    	
		<table>
			<thead>
			  <tr>	
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email id</th>
				<th>Mobile number</th>
				<th>Date of birth</th>
				<th>Address</th>
				<th>District</th>
				<th>Pincode</th>
				<th>Username</th>
				<th colspan="3">Action</th>
		       </tr>
		    </thead>
		    <tbody>
		    	<?php
			        if($n->num_rows()>0)  
			  		{
			  			foreach($n->result() as $row)
			  			{
			  				?>
			  				<tr>
			  					<td><?php echo $row->fname;?></td>
			  					<td><?php echo $row->lname;?></td>
			  					<td><?php echo $row->email;?></td>
			  					<td><?php echo $row->mobile;?></td>
			  					<td><?php echo $row->dob;?></td>
			  					<td><?php echo $row->address;?></td>
			  					<td><?php echo $row->district;?></td>
			  					<td><?php echo $row->pin;?></td>
			  					<td><?php echo $row->username;?></td>
			  					
			  					<?php
			  						if($row->userstatus==1)
			  						{
			  							?>
			  							<td>Approved</td>
			  							<td><a href="<?php echo base_url()?>main/reject/<?php echo $row->id;?>">reject</a></td>
			  							<td><a href="<?php echo base_url()?>main/delete/<?php echo $row->id;?>">delete</a></td>
			  							<?php
			  						}
			  						elseif($row->userstatus==2)
			  						{
			  							?>
			  							<td>rejected</td>
			  							<td><a href="<?php echo base_url()?>main/approve/<?php echo $row->id;?>">approve</a></td>
			  							<td><a href="<?php echo base_url()?>main/delete/<?php echo $row->id;?>">delete</a></td>
			  							<?php
			  						}
			  						elseif($row->userstatus==0)
			  						{
			  							?>

			  					<td><a href="<?php echo base_url()?>main/approve/<?php echo $row->id;?>">approve</a></td>
			  					<td><a href="<?php echo base_url()?>main/reject/<?php echo $row->id;?>">reject</a></td>
			  					<td><a href="<?php echo base_url()?>main/delete/<?php echo $row->id;?>">delete</a></td>

			  					<?php 
			  				}
			  				else
			  				{
			  					?>
			  					
			  				
			  				<?php
			  			}
			  			
                        		   }
			  		}
			  		?>
		
		    </tbody>


				
		   </table>
	</form>
	</body>	
</html>