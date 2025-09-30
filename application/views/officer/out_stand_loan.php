<?php include('incs/header_1.php'); ?>
<?php include('incs/side_1.php'); ?>
<?php include('incs/subheader.php'); ?>


                   <style>
                	    .c {
               text-transform: uppercase;
                 }
                
                </style>	


<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">					
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
   
</div>
<!-- end:: Subheader -->										
<!-- begin:: Content -->
<!-- begin:: Content -->


<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--begin::Portlet-->
	<?php if ($das = $this->session->flashdata('massage')): ?>
	  <div class="alert alert-success fade show alert-success" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text"><?php echo $das;?></div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                  </div>
         <?php endif; ?>

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon-list-2"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				Outstand  Loan Report
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
	<div class="kt-portlet__head-actions">

	
		&nbsp;
		<!-- <a href="<?php //echo base_url("admin/prev_cashtransaction"); ?>" class="btn btn-brand btn-elevate btn-icon-sm">
			<i class="flaticon-event-calendar-symbol"></i>
			Previous
		</a> -->
		<!-- <a href="<?php //echo base_url("admin/print_pending_report"); ?>" class="btn btn-brand btn-elevate btn-icon-sm" target="_blank">
			<i class="flaticon-technology"></i>
			Print
		</a> -->
	</div>	
</div>		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
									     <thead>
			  						          <tr>
				  							    <th>S/No.</th>
				  							    <th>Branch Name</th>
												<th>Customer Name</th>
												<th>Phone Number</th>
												<th>Loan Amount</th>
												<th>Restoration</th>
												<th>Duration Type</th>
												<th>Number of Repayment</th>
												<th>Remain Amount</th>
												<th>pending Day</th>
												<th>Satart date</th>
												<th>End date</th>
				  						         </tr>
						                  </thead>
			
								    <tbody>
                                          <?php $no = 1; ?>
									<?php foreach ($outstand as $outstands): ?>
									          <tr>
				  					<td class="c"><?php echo $no++; ?> </td>
				  					<td class="c">
				  					   <?php echo $outstands->blanch_name; ?>
				  					</td>
				  					<td class="c">
				  						<?php echo $outstands->f_name; ?> <?php echo $outstands->m_name; ?> <?php echo $outstands->l_name; ?>
				  					</td>
				  					<td><?php echo $outstands->phone_no; ?></td>
				  					<td><?php echo number_format($outstands->loan_int); ?></td> 
				  					<td><?php echo number_format($outstands->restration); ?></td> 
				  					<td>
				  						
				  						<?php if($outstands->day == '1'){ ?>
				  							<?php echo "Daily"; ?>
				  						
				  						<?php }elseif ($outstands->day == '7'){
				  							echo "Weekly";
				  						 ?>
				  						 <?php }elseif ($outstands->day == '30') {
				  						 	echo "Monthly";
				  						  ?>
				  						  <?php } ?>	
				  						</td> 
				  					 
				  			
				  			<td><?php echo $outstands->session; ?></td> 
				  			<td><?php echo number_format($outstands->remain_amount); ?></td> 
				  			<td style="color:red;"><?php echo $outstands->pending_day; ?></td> 
				  			<td><?php echo $outstands->loan_stat_date; ?></td> 
				  			<td><?php echo substr($outstands->loan_end_date, 0,10); ?></td> 
				  			
				  								  											  							
                                   </tr>
                      <?php endforeach; ?>
									
	                </tbody>
	                <tfoot>
                     <tr>
                    <th>TOTAL</th>
					<th></th>
					<th><?php //echo number_format($sum_depost->cash_depost); ?></th>
					<th><?php //echo number_format($sum_withdrawls->cash_withdrowal); ?></th>
					<th></th>
					<th></th>
					<th><?php //echo number_format($pend->total_pending); ?></th>
					<th><?php //echo number_format($pend->total_pending); ?></th>
					<th><?php echo number_format($total_remain->total_out); ?></th>
					<th><?php //echo number_format($pend->total_pending); ?></th>
					<th><?php //echo number_format($pend->total_pending); ?></th>
					<th><?php //echo number_format($pend->total_pending); ?></th>
					
                    </tr> 
                   </tfoot>
                   </table>
		<!--end: Datatable -->
	</div>
</div>
</div>
<!-- end:: Content -->
<!-- end:: Content -->
				</div>				
				
<?php include('incs/footer_1.php') ?>