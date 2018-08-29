<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
        <?php echo $pagetitle; ?>
        <small>advanced Search</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>admin/user-listing">Users Listing</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
		<div class="msg_noti"><?php echo $this->session->flashdata('verify_msg'); ?></div>
           <div class="box">
            <div class="box-header">
              <h2 class="box-title">List Of all Customers</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="customer_listingTable" class="table table-bordered table-striped">
                
				<thead>
					<tr>
						<th>Sr.</th>
						<th>Profile Image</th>
						<th>User Name</th>
						<th>First Name</th>
						<th>Email Id</th>
						<th>User Status</th>
						<th>Register Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php if(!empty($all_Customers)){ ?>
				<?php $count ='1'; ?>
					<?php foreach( $all_Customers as $key =>$userVal): ?>   
						<tr>
							<td><?php echo $count; ?></td>
							
							<?php (!empty($userVal->profileImage)) ? $imgPath = $userVal->profileImage  : $imgPath = base_url("assets/images/user-1.png");    ?>
							
							<td><img class="img-circle" height="60px" width="60px" src="<?php echo $imgPath;  ?>"/></td>
							<td><?php echo $userVal->userName; ?></td>
							<td><?php echo $userVal->firstName; ?></td>
							<td><?php echo $userVal->email; ?></td>
							<td>
							<?php if($userVal->is_active == '1'): ?>
									<span class="label label-success">Active</span>
							<?php elseif($userVal->is_active == '0'): ?>
									<span class="label label-warning">De-Active</span>
							<?php else: ?>
									<span class="label label-danger"><?php echo $userVal->is_active; ?></span>
							<?php endif; ?>
							</td>
							<td><?php echo date('d F Y  h:m A', strtotime($userVal->registerAt)); ?></td>
							<td>
								<a href="<?php echo base_url('admin/update-user/'.$userVal->user_id.''); ?>"><span class="label label-primary"><i class="fa fa-fw fa-edit"></i></span></a>
								
								<a href="<?php echo base_url('admin/delete-user/'.$userVal->user_id.''); ?>"><span class="label label-danger" onclick="return confirm('Are you sure want to delete this User ?')" ><i class="fa fa-trash-o"></i></span></a>
								
							</td>
						</tr>
						
						
					<?php $count++; ?>
					<?php endforeach; ?>		
				
				<?php } else { ?>
						<tr><td colspan="8" style="text-align:center;"><h2>There is now Record..</h2></td></tr>
				<?php } ?>		
				</tbody> 
				<tfoot>
                <tr>
					<th>Sr.</th>
					<th>Profile Image</th>
					<th>User Name</th>
					<th>First Name</th>
					<th>Email Id</th>
					<th>User Status</th>
					<th>Register Date</th>
					<th>Action</th>
                </tr>
                </tfoot>
				
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	
	<?php /******************** List of all Staff ******************************/ ?>
	<!-- Main content -->
   
    <!-- /.content -->
	
	
	
  </div>
  <!-- /.content-wrapper -->
  
  
  
  
  
  
