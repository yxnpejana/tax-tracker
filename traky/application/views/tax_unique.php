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
        
          
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $taxtypes->tax_type_form; ?>
            <small><?php echo $taxtypes->frequency; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../welcome"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../view_all">Tax Types</a></li>
            <li class="active"><?php echo $status; ?></li>
          </ol>
        </section>

      
        <!-- Main content -->
		<div class="row">
            <div class="col-xs-12">
              
				<div class="box">
					<div class="box-header">
                                            <h3 class="box-title text-red"><?php echo $due; ?></h3>                                          
					</div><!-- /.box-header -->
					<div class="box-body">
						
					  <table id="taxtype-datatable" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th>Clients</th>
                                                        <th>Payments</th>
						  </tr>
						</thead>
						<tbody>
							<?php if($clients):
                                                        foreach($clients as $client):  ?>
						  <tr>							
							<td><?php echo $client->business_name; ?></td>
                                                        <td>
                                                            <div class="btn-group" style="padding-left: 10px;">
                                    
                                                                <?php switch($taxtypes->frequency): 
                                                                    case 'monthly':
                                                                        $ar_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                                                        foreach ($ar_month as $month):
                                                                            foreach($client->payments as $payment):
                                                                                if($month === date('M', strtotime($payment->date_filed))):
                                                                        ?>
                                                                                    <button class="btn btn-success tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal"><?php echo $month; ?></button>                                                                                        
                                                                                    <input type="hidden" value="<?php echo $payment->tax_payment_id.'/'.$payment->amount.'/'.$payment->date_filed.'/'.$payment->bank.'/'.$payment->period.'/'.$payment->form_copy; ?>">
                                                                        <?php 
                                                                                else:
                                                                        ?>
                                                                                    <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal"><?php echo $month; ?></button>
                                                                        <?php
                                                                                endif;
                                                                            endforeach; 
                                                                        endforeach;
                                                                        break;
                                                                    case 'annually':?>
                                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">2016</button>
                                                                        <?php  break;
                                                                    case 'quarterly':?>
                                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">1<sub>st</sub> Quarter</button>
                                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">2<sub>nd</sub> Quarter</button>
                                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">3<sub>rd</sub> Quarter</button>
                                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">4<sub>th</sub> Quarter</button>
                                                                        <?php  break;
                                                                endswitch;
                                                                ?>                                    
                                                            </div>
                                                        </td>
						  </tr>            
							<?php endforeach;
                                                        endif;?>     
                                                  
						</tbody>
						<tfoot>
						  <tr>
							<th>Clients</th>
                                                        <th>Payments</th>
						  </tr>
						</tfoot>
					  </table>
                                            
                                            <!--DIV class box for tax payments monthly-->
                                    <div class="modal fade modal-danger" id="tax-modal" tabindex="-1" role="dialog" aria-labelledby="mytaxModalLabel">
                                        <div class="modal-dialog modal-sm" role="document">
                                          <div class="modal-content">
                                              <form action="<?php echo DIR_TRAKY; ?>tax/filing" method="post" id="form-pay-tax">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel">Tax Filing</h4>
                                            </div>
                                                <input type="hidden" name="from" value="<?php echo uri_string(); ?>">
                                                <input type="hidden" name="tax_id" value="">
                                                
                                                <div class="col-md-3">
                                                      <input type="text" placeholder="ID" class="form-control" name="tax_payment_id" disabled>
                                                    </div>
                                                    <div class="input-group">
                                                      <span class="input-group-addon">₱</span>
                                                      <input class="form-control" type="text" placeholder="amount" name="amount">
                                                      <span class="input-group-addon">.00</span>
                                                    </div>
                                                    <div class="input-group">
                                                      <div class="input-group-addon">
                                                          <i class="fa fa-calendar"></i>
                                                      </div>
                                                        <input type="text" placeholder="Date Filed" name="date_filed" id="tax-paid" class="form-control">
                                                    </div>
                                                    <div>
                                                      <input type="text" placeholder="Period" name="period" class="form-control">
                                                    </div>
                                                    <div>
                                                      <input type="text" placeholder="Bank Name" name="bank" class="form-control">
                                                    </div>
                                                    <div>
                                                      <input type="text" placeholder="File" name="form_copy" class="form-control">
                                                    </div>


                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                              </form>
                                          </div>
                                        </div>
                                      </div>
					
</div><!-- /.box-body -->
			  </div><!-- /.box -->
            </div><!-- /.col -->
	  </div><!-- /.row -->
        
  </div><!-- /.content-wrapper -->      
		
<?php include 'footer.php'; ?>