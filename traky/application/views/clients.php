<?php include 'header.php'; ?>
    <style>
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent !important;
      }
    </style>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo DIR_TRAKY; ?>welcome">
                <i class="fa fa-dashboard"></i><span>Dashboard</span></i>
              </a>
            </li>
			<li class="active treeview">
              <a href="<?php echo DIR_TRAKY; ?>client">
                <i class="fa fa-users"></i><span>Clients</span></i>
              </a>
            </li>
            <li class="treeview">
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
                                <h4 class="modal-title">Client Management Error</h4>
                              </div>
                              <div class="modal-body">
                                <p><?php echo $this->session->flashdata('error_message'); ?></p>
                              </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                      </div><!-- /.example-modal -->
         
         <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="<?php echo DIR_TRAKY; ?>client/add_new" method="post">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Client</h4>
                          </div>
                          <div class="modal-body">
                            <!--Form to add client-->
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">Client Name</span>
                                    <input name="client_name" class="form-control" type="text">
                            </div>
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">Signatory</span>
                                    <input name="client_signatory" class="form-control" type="text">
                            </div>
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">Business Name</span>
                                    <input name="business_name" class="form-control" type="text">
                            </div>
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">TIN</span>
                                    <input name="tin" class="form-control" type="text" placeholder="e.g. 456-789-963-000">
                            </div>
                            <div class="input-group"> 
                                    <span class="input-group-addon" id="basic-addon1">Client Address</span>
                                    <input name="client_address" class="form-control" type="text">
                            </div>
                            <select name="rdo" class="form-control">
                                    <option>RDO</option>
                                    <?php foreach($rdos as $rdo): ?>
                                            <option value="<?php echo $rdo->rdo_id; ?>"><?php $rdo = trim($rdo->rdo_number.'-'.$rdo->rdo_location); echo $rdo;?></option>
                                    <?php endforeach; ?>
                            </select>
                            <select name="business_line" class="form-control">
                                    <option>Business line</option>
                                    <?php foreach($lines as $line): ?>
                                            <option value="<?php echo $line->line_id; ?>"><?php  $line = trim($line->business_line);echo $line; ?></option>
                                    <?php endforeach; ?>
                            </select>
                            <div class="input-group" style="padding-left: 5px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date_started" placeholder="Date started" class="form-control" id="taxes-due-date">
                            </div>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary">
                                    <input type="radio" name="client_status" id="is_corp" value="true" required> Corporation
                                  </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="client_status" id="is_single" value="false" required> Single
                                  </label>
                            </div>
                            <div class="btn-group stock_status" data-toggle="buttons" style="display:none;">
                                <label class="btn btn-primary">
                                    <input type="radio" name="stock" id="has_stock" value="true"> Stock
                                  </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="stock" id="no_stock" value="false"> Non-Stock
                                  </label>    
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
         
         <!--DIV class box for client delete client-->
        <div class="modal fade modal-danger" id="del_client_modal" tabindex="-1" role="dialog" aria-labelledby="mytaxModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <form action="" method="post" id="del_client">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Client Management</h4>
                </div>
                      <div class="modal-body">
                            <label>You sure you will be deleting</label>
                            <h3 id="del_client"></h3>
                      </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Nevermind</button>
                    <button type="submit" class="btn btn-primary">SURE</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
          
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Client
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../welcome"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Clients</li>
          </ol>
        </section>

      
        <!-- Main content -->
		<div class="row">
            <div class="col-xs-12">
              
				<div class="box">
					<div class="box-header">
					  <h3 class="box-title"><?php echo $status; ?></h3>
                                          <a class="btn btn-sm" href="<?php echo DIR_TRAKY; ?>client/print_this/all"><i class="fa fa-print fa-2x" title="print preview"></i></a>
                                          <a class="btn btn-sm" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2x" title="add client"></i></a>
					</div><!-- /.box-header -->
					<div class="box-body">
						
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th></th>
							<th></th>
							<th>Client</th>
							<th>TIN</th>
							<th>Address</th>
							<th>Signatory</th>
						  </tr>
						</thead>
						<tbody>
							<?php foreach($clients as $client): ?>
						  <tr>
							<td>
								<a class="btn btn-danger delete-client" data-target="#del_client_modal" data-toggle="modal" href="#" id="<?php echo DIR_TRAKY; ?>client/delete_client/<?php echo $client->client_id; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
							<td>
								<div class="btn-group">		
                                                                    <a class="btn btn-default edit-client" href="<?php echo DIR_TRAKY; ?>client/view_client/<?php echo $client->client_id; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>							  
								</div>
							</td>
							<td><?php echo $client->client_name; ?></td>
							<td><?php echo $client->tin; ?></td>
							<td><?php echo $client->address; ?></td>
							<td><?php echo $client->signatory; ?></td>
						  </tr>            
							<?php endforeach; ?>          
						</tbody>
						<tfoot>
						  <tr>
							<th></th>
							<th></th>
							<th>Client</th>
							<th>TIN</th>
							<th>Address</th>
							<th>Signatory</th>
						  </tr>
						</tfoot>
					  </table>
					
</div><!-- /.box-body -->
			  </div><!-- /.box -->
            </div><!-- /.col -->
	  </div><!-- /.row -->
        
  </div><!-- /.content-wrapper -->      
		
<?php include 'footer.php'; ?>