<?php include 'header.php'; ?>
    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo DIR_TRAKY; ?>welcome">
                <i class="fa fa-dashboard"></i><span>Dashboard</span></i>
              </a>
            </li>
			<li class="treeview">
              <a href="<?php echo DIR_TRAKY; ?>client">
                <i class="fa fa-users"></i><span>Clients</span></i>
              </a>
            </li>
            <li class="active treeview">
              <a href="<?php echo DIR_TRAKY; ?>tax_types">
                <i class="fa fa-files-o "></i><span>Tax Types</span></i>
              </a>
            </li>   
            <li class="treeview">
              <a href="<?php echo DIR_TRAKY; ?>calendar">
                <i class="fa fa-calendar "></i><span>Calendar</span></i>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
                    
                    <div class="example-modal" 
                            <?php  if($this->session->flashdata('error') === TRUE):
                                echo 'style="display:block;"';
                            else:
                                echo 'style="display:none;"';
                            endif;
                    ?>>
                        <div class="modal modal-danger">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tax Type Management Error</h4>
                              </div>
                              <div class="modal-body">
                                <p><?php echo $this->session->flashdata('error_message'); ?></p>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                      </div><!-- /.example-modal -->
         
         <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="<?php echo DIR_TRAKY; ?>tax_types/add_new" method="post">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Tax Type</h4>
                          </div>
                          <div class="modal-body">
                            <!--Form to add tax_type-->
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">Tax Type Form</span>
                                    <input name="tax_type_form" class="form-control" placeholder="e.g. 1601C" type="text">
                            </div>
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">Classification</span>
                                    <input name="classification" class="form-control" placeholder="e.g. Withholding Tax – Compensation" type="text">
                            </div>     
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">Frequency</span>
                                    <input name="frequency" class="form-control" placeholder="e.g. annually" type="text">
                            </div>  
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">Due Date</span>
                                    <input name="due_date" class="form-control" placeholder="e.g. 10, January 25" type="text">
                            </div> 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                            </form>
                        </div>
                      </div>
                    </div>
          
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tax Types
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../welcome"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tax Types</li>
          </ol>
        </section>

      
        <!-- Main content -->
		<div class="row">
            <div class="col-xs-12">
              
				<div class="box">
					<div class="box-header">
					  <h3 class="box-title"><?php echo $status; ?></h3>
                                          <a class="btn btn-sm" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2x" title="add tax type"></i></a>
					</div><!-- /.box-header -->
					<div class="box-body">
						
					  <table id="taxtype-datatable" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th></th>
							<th>Tax Form</th>
							<th>Frequency</th>
							<th>Form Description</th>
                                                        <th>Due Date</th>
						  </tr>
						</thead>
						<tbody>
							<?php if($taxtypes):
                                                        foreach($taxtypes as $types): ?>
						  <tr>
							<td>
								<div class="btn-group">		
									<a class="btn btn-default edit-client" href="<?php echo DIR_TRAKY; ?>tax_types/view_all_clients/<?php echo $types->tax_type_id; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>							  
								</div>
							</td>
							<td><?php echo $types->tax_type_form; ?></td>
							<td><?php echo $types->frequency; ?></td>
							<td><?php echo $types->classification; ?></td>
                                                        <td><?php echo $types->due_date; ?></td>
						  </tr>            
							<?php endforeach;
                                                        endif;?>          
						</tbody>
						<tfoot>
						  <tr>
							<th></th>
							<th>Tax Form</th>
							<th>Frequency</th>
							<th>Form Description</th>
                                                        <th>Due Date</th>
						  </tr>
						</tfoot>
					  </table>
					
</div><!-- /.box-body -->
			  </div><!-- /.box -->
            </div><!-- /.col -->
	  </div><!-- /.row -->
        
  </div><!-- /.content-wrapper -->      
		
<?php include 'footer.php'; ?>