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
            <li class="header">LEGEND</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>No Record Here</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Copy is on client</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-green"></i> <span>Copy is on-hand</span></a></li>
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
                                                        <th> TIN </th>
                                                        <th>Payments</th>
						  </tr>
						</thead>
						<tbody>
							<?php if($clients):
                                                        foreach($clients as $client):  ?>
						  <tr>							
							<td><?php echo $client->business_name; ?></td>
                                                        <td><?php echo $client->tin; ?></td>
                                                        <td>
                                                            <div class="btn-group" style="padding-left: 10px;">
                                    
                                                                <?php switch($taxtypes->frequency): 
                                                                    case 'monthly':
                                                                        $ar_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                                                        foreach ($ar_month as $month):
                                                                            if(!empty($client->payments)):
                                                                                foreach($client->payments as $payment):
                                                                                    if($month.' '.date('Y') === date('M Y', strtotime($payment->period))):
                                                                                       $color_change = ($payment->form_copy == 'on-hand')? 'btn-success' : 'btn-warning';
                                                                        ?>
                                                                                        <button class="btn <?php echo $color_change; ?> tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal"><?php echo $month; ?></button>                                                                                        
                                                                                        <input type="hidden" value="<?php echo $payment->tax_payment_id.'/'.$payment->amount.'/'.date('F d Y', strtotime($payment->date_filed)).'/'.$payment->bank.'/'.$payment->period.'/'.$payment->form_copy; ?>">
                                                                        <?php 
                                                                                    else:
                                                                        ?>
                                                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal"><?php echo $month; ?></button>
                                                                        <?php
                                                                                    endif;
                                                                                endforeach; 
                                                                            else:
                                                                        ?>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal"><?php echo $month; ?></button>
                                                                         <?php
                                                                            endif;
                                                                        endforeach;
                                                                        break;
                                                                    case 'annually':?>
                                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">2016</button>
                                                                        <?php  break;
                                                                    case 'quarterly':
                                                                            if(!empty($tax['payments'])):
                                                                        ?>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">1<sub>st</sub> Quarter</button>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">2<sub>nd</sub> Quarter</button>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">3<sub>rd</sub> Quarter</button>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">4<sub>th</sub> Quarter</button>
                                                                        <?php  
                                                                            else:
                                                                        ?>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">1<sub>st</sub> Quarter</button>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">2<sub>nd</sub> Quarter</button>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">3<sub>rd</sub> Quarter</button>
                                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $client->tax_id; ?>" type="button" data-toggle="modal" data-target="#tax-modal">4<sub>th</sub> Quarter</button>
                                                                        <?php
                                                                            endif;
                                                                            break;
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
                                              <form action="<?php echo DIR_TRAKY; ?>tax/filing" method="post" id="form-pay-tax" role="form">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">Tax Filing</h4>
                                                </div>
                                                  <input type="hidden" name="from" value="<?php echo uri_string(); ?>">
                                                  
                                                    <div class="col-md-3 form-group">
                                                        <label for="taxPaymentID">ID</label>
                                                        <input type="text" class="form-control" id="taxPaymentID" name="tax_id" readonly="readonly">
                                                    </div>
                                                    <div class="form-group col-md-9">
                                                        <label for="taxPaymentAmount">Amount</label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon">₱</span>
                                                          <input class="form-control" type="text" id="taxPaymentAmount" name="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="taxPaymentDateFiled">Date Filed</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                          <input type="text" id="taxPaymentDateFiled" name="date_filed" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="taxPaymentPeriod">Period</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        <input type="text" id="taxPaymentPeriod" name="period" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="taxPaymentBank">Bank</label>
                                                        <input type="text" id="taxPaymentBank" name="bank" class="form-control">
                                                    </div>
                                                   <div class="form-group  col-md-12">
                                                        <label for="taxPaymentFile">File Location</label>
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="form_copy" id="taxPaymentFile" autocomplete="off" value="on-hand"> On hand
                                                            </label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="form_copy" id="taxPaymentFile" autocomplete="off" value="client"> Client
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
					
</div><!-- /.box-body -->
			  </div><!-- /.box -->
            </div><!-- /.col -->
	  </div><!-- /.row -->
        
  </div><!-- /.content-wrapper -->      
		
<?php include 'footer.php'; ?>