<?php include 'header.php'; ?>


          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="/traky/welcome">
                <i class="fa fa-dashboard"></i><span>Dashboard</span></i>
              </a>
            </li>
			<li class="active treeview">
              <a href="/traky/client">
                <i class="fa fa-users"></i><span>Clients</span></i>
              </a>
            </li>
            <li class="treeview">
              <a href="/traky/tax_types">
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
                    
                                      
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $client->business_name; ?>
            <small>Control Panel</small>
          </h1>
            <a class="" href="<?php echo DIR_TRAKY; ?>client/"><i class="fa fa-hand-o-left fa-2x" title="Go Back"></i></a>            
          <ol class="breadcrumb">
            <li><a href="../welcome"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Clients</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile -->
              <div class="box box-primary">
                <div class="box-body box-profile">                  
                  <h3 class="profile-username text-center"><?php echo $client->business_name; ?></h3>
                  <p class="text-muted text-center"><?php echo $client->client_name; ?></p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item" style="height: 80px;">
                      <b>Business Line</b> <a class="pull-right"><?php echo $client->business_line; ?></a>
                    </li>
                    <li class="list-group-item" style="height: 80px;">
                      <b>TIN</b> <a class="pull-right"><?php echo $client->tin; ?></a>
                    </li>
                    <li class="list-group-item" style="height: 80px;">
                      <b>Address</b> <a class="pull-right"><?php echo $client->address; ?></a>
                    </li>
                    <li class="list-group-item" style="height: 80px;">
                      <b>RDO</b> <a class="pull-right"><?php echo $client->rdo_number.' - '.$client->rdo_location; ?></a>
                    </li>
                    <li class="list-group-item" style="height: 80px;">
                      <b>Signatory</b> <a class="pull-right"><?php echo $client->signatory; ?></a>
                    </li>
                    <li class="list-group-item" style="height: 80px;">
                      <b>Date Started</b> <a class="pull-right"><?php echo $client->date_started; ?></a>
                    </li>
                    <li class="list-group-item" style="height: 80px;">
                      <b>Phone Number</b> <a class="pull-right"><?php echo $client->contact_number; ?></a>
                    </li>
                  </ul>
                  
                  <!--<a href="#" class="btn btn-primary btn-block" ><b>Update</b></a>-->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#taxes" data-toggle="tab">Taxes</a></li>
                  <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="taxes">
                    
                      <form method="post" action="<?php echo DIR_TRAKY; ?>client/add_taxes"  style="padding-bottom: 10px; padding-left: 5px;">
                      <input type="hidden" name="client_id" value="<?php echo $client->client_id; ?>">
                      <select name="tax_type[]" id="tax_select_multiple" multiple="multiple" style="width: 50%" disabled="disabled">
                            <?php foreach($tax_types as $tax_type): ?>
                                    <option value="<?php echo $tax_type->tax_type_id; ?>"><?php echo $tax_type->tax_type_form; ?></option>                                                                    
                            <?php endforeach; ?>
                        </select>
                      <div aria-label="Programmatic enabling and disabling" role="group" class="btn-group btn-group-sm">
                        <button class="js-programmatic-enable btn btn-default" type="button">
                          Enable
                        </button>
                        <button class="js-programmatic-disable btn btn-default" type="button">
                          Disable
                        </button>
                          <button class="js-programmatic-submit btn btn-default" type="submit">
                          Submit
                        </button>
                      </div>
                    </form>
                      
                      <div class="box box-danger">
                        <div class="box-header">
                          <!-- Date Due -->
                                <div class="form-group col-md-4 hide">
                                  <label>Due Date:</label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="taxes-due-date">
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                
                                <!-- Date Filed -->
                                <div class="form-group col-md-4 hide">
                                  <label>Filed Date:</label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="taxes-filing-date">
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                
                                <!-- Taxes to View -->
                                <div class="form-group col-md-4 hide">
                                    <label>Tax Type:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-file-o"></i>
                                        </div>
                                         <select name="tax_type[]" id="tax_to_view" multiple="multiple" style="width: 50%">
                                            <?php foreach($tax_types as $tax_type): ?>
                                                    <option value="<?php echo $tax_type->tax_type_id; ?>"><?php echo $tax_type->tax_type_form; ?></option>                                                                    
                                            <?php endforeach; ?>
                                        </select>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                        </div>
                          <div class="box-body">               
                              <table class="table table-bordered">
                                  <tr>
                                      <th>Tax Form</th>
                                      <th></th>
                                  </tr>
                              
                              <!-- checkbox of TAXES -->
                                <?php if($taxes):
                                foreach($taxes as $tax): ?>
                                    <tr>
                                        <td>
                                            <label class="text-green">                                    
                                                <?php echo $tax['tax_type_form']; ?>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="btn-group" data-toggle="buttons" style="padding-left: 10px;">
                                    
                                                <?php switch($tax['frequency']): 
                                                    case 'monthly':
                                                        $ar_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                                        foreach ($ar_month as $month):
                                                            if(!empty($tax['payments'])):
                                                                foreach($tax['payments'] as $payment):
                                                                    
                                                                    if($month.' '.date('Y') === date('M Y', strtotime($payment->period))):
                                                        ?>
                                                                        <button class="btn btn-success tax-to-pay" id="<?php echo $tax['tax_id']; ?>" type="button" data-toggle="modal" data-target="#tax-modal"><?php echo $month; ?></button>                                                                                        
                                                                        <input type="hidden" value="<?php echo $payment->tax_payment_id.'/'.$payment->amount.'/'.$payment->date_filed.'/'.$payment->bank.'/'.$payment->period.'/'.$payment->form_copy; ?>">
                                                        <?php 
                                                                    else:
                                                        ?>
                                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $tax['tax_id']; ?>" type="button" data-toggle="modal" data-target="#tax-modal"><?php echo $month; ?></button>
                                                        <?php
                                                                    endif;
                                                                endforeach;
                                                            else:
                                                        ?>
                                                                <button class="btn btn-danger tax-to-pay" id="<?php echo $tax['tax_id']; ?>" type="button" data-toggle="modal" data-target="#tax-modal"><?php echo $month; ?></button>
                                                        <?php
                                                            endif;
                                                        endforeach;
                                                        break;
                                                    case 'annually':?>
                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $tax['tax_id']; ?>" type="button" data-toggle="modal" data-target="#tax-modal">2016</button>
                                                        <?php  break;
                                                    case 'quarterly':?>
                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $tax['tax_id']; ?>" type="button" data-toggle="modal" data-target="#tax-modal">1<sup>st</sup> Quarter</button>
                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $tax['tax_id']; ?>" type="button" data-toggle="modal" data-target="#tax-modal">2<sup>nd</sup> Quarter</button>
                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $tax['tax_id']; ?>" type="button" data-toggle="modal" data-target="#tax-modal">3<sup>rd</sup> Quarter</button>
                                                        <button class="btn btn-danger tax-to-pay" id="<?php echo $tax['tax_id']; ?>" type="button" data-toggle="modal" data-target="#tax-modal">4<sup>th</sup> Quarter</button>
                                                        <?php  break;

                                                endswitch;
                                    ?>                                    
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; 
                                endif;?>
                            
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
                                                                <input type="radio" name="form_copy" id="taxPaymentFile" autocomplete="off"> On hand
                                                            </label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="file" id="taxPaymentFile" autocomplete="off"> Client
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
                                    
                                    
                                    
                          </div>
                      </div>
                      
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs">Read more</a>
                            <a class="btn btn-danger btn-xs">Delete</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                          <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-comments bg-yellow"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-camera bg-purple"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                          <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                      <form action="<?php echo DIR_TRAKY; ?>client/update" method="post" class="form-horizontal">
                       <!--Form to update client-->
                            <div class="form-group"> 
                                    <label for="inputClientName" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                    <input name="client_name" class="form-control" id="inputClientName" type="text" value="<?php echo $client->client_name; ?>">
                                    </div>
                                    <input type="hidden" name="client_id" value="<?php echo $client->client_id; ?>">
                            </div>
                            <div class="form-group"> 
                                    <label for="inputSignatory" class="col-sm-2 control-label">Signatory</label>
                                    <div class="col-sm-10">
                                    <input name="client_signatory" class="form-control"  for="inputSignatory" type="text" value="<?php echo $client->signatory; ?>">
                                    </div>
                            </div>
                            <div class="form-group"> 
                                    <label for="inputBusinessName" class="col-sm-2 control-label">Business Name</label>
                                    <div class="col-sm-10">
                                    <input name="business_name" class="form-control"  id="inputBusinessName" type="text" value="<?php echo $client->business_name; ?>">
                                    </div>
                            </div>
                            <div class="form-group"> 
                                    <label for="inputTIN" class="col-sm-2 control-label">TIN</label>
                                    <div class="col-sm-10">
                                    <input name="tin" class="form-control"  id="inputTIN" type="text" value="<?php echo $client->tin; ?>">
                                    </div>
                            </div>
                            <div class="form-group"> 
                                    <label for="inputClientAddress" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                    <input name="client_address" class="form-control" id="inputClientAddress" type="text" value="<?php echo $client->address; ?>">
                                    </div>
                            </div>
                              <div class="form-group"> 
                                    <label for="inputClientContact" class="col-sm-2 control-label">Contact Number</label>
                                    <div class="col-sm-10">
                                    <input name="contact_number" class="form-control"  id="inputClientContact" type="text" value="<?php echo $client->contact_number; ?>">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRDO" class="col-sm-2 control-label">RDO</label>
                                <div class="col-sm-10">
                                    <select name="rdo" class="form-control">
                                        <option>RDO</option>
                                        <?php foreach($rdos as $rdo): ?>
                                                <?php $rdo1 = trim($rdo->rdo_number.'-'.$rdo->rdo_location);
                                                if($client->rdo_number.'-'.$client->rdo_location === $rdo1): ?>
                                                    <option selected value="<?php echo $rdo->rdo_id; ?>"><?php  echo $rdo1;?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo $rdo->rdo_id; ?>"><?php  echo $rdo1;?></option>
                                                <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="inputBusinessLine" class="col-sm-2 control-label">Business line</label>
                                <div class="col-sm-10">
                                    <select name="business_line" class="form-control">
                                        <option>Business line</option>
                                        <?php foreach($lines as $line): ?>
                                            <?php $line1 = trim($line->business_line);
                                            if($client->business_line === $line1): ?>
                                                <option selected value="<?php echo $line->line_id; ?>"><?php echo $line1; ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $line->line_id; ?>"><?php echo $line1; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="padding-left: 5px;">
                                <label for="inputBusinessLine" class="col-sm-2 control-label"><i class="fa fa-calendar"></i> Date Started</label>
                                <div class="col-sm-10">
                                <input type="text" name="date_started" placeholder="Date started" class="form-control" id="client-started" value="<?php echo $client->date_started; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">Client Status</label>
                                <div class="col-sm-10 btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="client_status" class="is_corp" id="inputStatus" value="true" required<?php if( $client->corp === TRUE ): echo 'checked'; endif; ?>> Corporation
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="client_status" class="is_single" id="inputStatus" value="false" required <?php if( $client->corp === FALSE ): echo 'checked'; endif; ?>> Single
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputHasStock" class="col-sm-2 control-label">Has Stock?</label>
                                <div class="col-sm-10 btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="stock" class="has_stock" value="true" <?php if( $client->has_stock === TRUE ): echo 'checked'; endif; ?>> Stock
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="stock" id="no_stock" value="false" <?php if( $client->has_stock === FALSE ): echo 'checked'; endif;?>> Non-Stock
                                    </label>
                                </div>
                            </div>
                             
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include 'footer.php'; 

      
      //Just like my ideas, arts and design, I am awesomely astonishing. I design venues of any occasion. Need help? Talk soon :-*
      
      //Let me design the venues of your parties. #myfirstTweet #partydesign #decoration
      ?>
