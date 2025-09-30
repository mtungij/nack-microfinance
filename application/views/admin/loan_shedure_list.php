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
				Loan Schedule (<?php echo $loan->loan_code; ?> - <?php echo number_format($loan->loan_aprove); ?>)
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
	<div class="kt-portlet__head-actions">

	
		&nbsp;
		<!-- <a href="<?php //echo base_url("admin/previous_blanchwise_data"); ?>" class="btn btn-brand btn-elevate btn-icon-sm">
			<i class="flaticon-event-calendar-symbol"></i>
			Previous
		</a> -->
		<a href="<?php echo base_url("admin/print_loan_shedure/{$loan_id}"); ?>" class="btn btn-brand btn-elevate btn-icon-sm" target="_blank">
			<i class="flaticon-technology"></i>
			Print
		</a>

	</div>	
</div>		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
									     <thead>
			  						          <tr>
												<th>S/No.</th>
												<th>Date</th>
												<th>Collection</th>
												<th>Status</th>
				  						         </tr>
						                  </thead>
								        <tbody>
								    	<?php $no = 1; ?>
									<?php foreach ($data_loan as $data_loans): ?>
									          <tr>
				  					<td class="c"><?php echo $no++; ?>.</td>
				  					<td class="c"><?php echo $data_loans->date; ?></td>
				  					<td>
				  						<?php echo number_format($data_loans->restration); ?></td>
				  					<td>
				  						<?php if ($data_loans->date_status == 'withdrawal') {
				  						 ?>
				  						 <a href="javascript:;" class="badge badge-warning">withdrawal</a>
				  						<?php }elseif($data_loans->date_status == 'paid'){ ?>
				  							<a href="javascript:;" class="badge badge-success"><i class="flaticon2-check-mark"></i></a>
				  							<?php }elseif($data_loans->date_status == 'not paid'){ ?>
				  						<a href="javascript:;" class="badge badge-danger"><i class="flaticon2-delete"></i></a>
				  					<?php } ?>
				  					</td>
                                   </tr>
                                 <?php endforeach; ?>
									
	                         </tbody>
                            </table>
		<!--end: Datatable -->
	               </div>
               </div>
             </div>
<!-- end:: Content -->
<!-- end:: Content -->
				</div>				
				
<?php include('incs/footer_1.php') ?>