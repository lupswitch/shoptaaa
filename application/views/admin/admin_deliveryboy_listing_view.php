<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
        <?php echo $pagetitle; ?>
        <small>advanced Search</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>admin/user-listing">Delivery Boys Listing</a></li>
      </ol>
    </section>

<section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
            <div class="box-header">
              <h2 class="box-title">List Of all Delivery Boy</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="staff_listingTable" class="table table-bordered table-striped">
                
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
				<?php if(!empty($all_Staff)){ ?>
				<?php $count ='1'; ?>
					<?php foreach( $all_Staff as $key =>$staffVal): ?>   
						<tr>
							<td><?php echo $count; ?></td>
   							<?php
 

 (!empty($staffVal->profileImage)) ? $imgPath = $staffVal->profileImage  : $imgPath = base_url("assets/images/user-1.png");    ?>


							
							<td><img class="img-circle" height="60px" width="60px" src="<?php echo $imgPath;  ?>"/></td>
							<td><?php echo $staffVal->userName; ?></td>
							<td><?php echo $staffVal->firstName; ?></td>
							<td><?php echo $staffVal->email; ?></td>
							<td>
							<?php if($staffVal->is_active == '1'): ?>
									<span class="label label-success">Active</span>
							<?php elseif($staffVal->is_active == '0'): ?>
									<span class="label label-warning">De-Active</span>
							<?php else: ?>
									<span class="label label-danger"><?php echo $staffVal->is_active; ?></span>
							<?php endif; ?>
							</td>
							<td><?php echo date('d F Y  h:m A', strtotime($staffVal->registerAt)); ?></td>
							<td>
								<a href="<?php echo base_url('admin/update-user/'.$staffVal->user_id.''); ?>"><span class="label label-primary"><i class="fa fa-fw fa-edit"></i></span></a>
								
								<a href="<?php echo base_url('admin/delete-deliveryboy/'.$staffVal->user_id.''); ?>"><span class="label label-danger" onclick="return confirm('Are you sure want to delete this User ?')" ><i class="fa fa-trash-o"></i></span></a>
								
							</td>
						</tr>
					<?php $count++; ?>
					<?php endforeach; ?>		
				
				<?php } else { ?>
						<tr><td colspan="8" style="text-align:center;">There is now Record..</td></tr>
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

</div>
