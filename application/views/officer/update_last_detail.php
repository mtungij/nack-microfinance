<?php include('incs/header_1.php'); ?>
<?php include('incs/side_1.php'); ?>
<?php include('incs/subheader.php'); ?>
	


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

         <?php if ($das = $this->session->flashdata('error')): ?>
	  <div class="alert alert-danger fade show alert-danger" role="alert">
                            <div class="alert-icon"><i class="flaticon2-delete"></i></div>
                            <div class="alert-text"><?php echo $das;?></div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                  </div>
         <?php endif; ?>
     <?php if ($last == TRUE) {
     ?>
<div class="row">
	<div class="col-lg-12">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
					Update Customer Detail
					</h3>
				</div>
			</div>
			<!--begin::Form-->
			<!-- <form method="post" action="ss" class="kt-form kt-form--label-right" id="kt_form_2"> -->
				<?php echo form_open_multipart("oficer/modify_update_lastData/{$customer->customer_id}",['class'=>'kt-form kt-form--label-right','novalidate']); ?>
				<div class="kt-portlet__body">
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="form-group form-group-last row">
								<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Nick name:</label>
							<input type="text" name="famous_area" value="<?php echo $last->famous_area; ?>" autocomplete="off" class="form-control input-sm" placeholder="Eg.Mama James, Baba Samwel" required>
								</div>
								<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Martial Status:</label>
							<select type="text" name="martial_status" class="form-control kt-selectpicker" required required data-live-search="true">
								<option value="<?php echo $last->martial_status; ?>"><?php echo $last->martial_status; ?></option>
								<option value="Married">Married</option>
								<option value="Single">Single</option>
								<option value="Widow">Widow</option>
								<option value="Separated">Separated</option>
								<option value="Devorced">Devorced</option>
								
							</select>
								</div>
									<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Account Type:</label>
							<select type="number" name="account_id" class="form-control input-sm" required>
								<option value="<?php echo $last->account_id; ?>"><?php echo $last->account_name;; ?></option>
								<?php foreach ($account as $accounts): ?>
								<option value="<?php echo $accounts->account_id; ?>"><?php echo $accounts->account_name; ?></option>
								<?php endforeach; ?>
								
							</select>
								</div>
								
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*National Identity Number:</label>
									<input type="number" value="<?php echo $last->natinal_identity; ?>" name="natinal_identity" placeholder="Natinal Identity Number" autocomplete="off" class="form-control input-sm" required >
								</div>
							<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Working status:</label>
							
							<select type="text" name="work_status" class="form-control kt-selectpicker" required data-live-search="true" required>
								<option value="<?php echo $last->work_status; ?>"><?php echo $last->work_status; ?></option>
								<option value="Employee">Employee</option>
								<option value="Government Employee">Government Employee</option>
								<option value="Private Sector Employee">Private Sector Employee</option>
								<option value="Bussines Owner">Bussines Owner</option>
								<option>Student</option>
								<option value="Overseas Worker">Overseas Worker</option>
								<option value="Pensioner">Pensioner</option>
								<option value="Unemployed">Unemployed</option>
								<option value="Self Employed">Self Employed</option>
							</select>
								</div>

								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Bussiness Type:</label>
							<input type="text"  name="bussiness_type" placeholder="Bussiness Type" value="<?php echo $last->bussiness_type; ?>" autocomplete="off" class="form-control input-sm" required>
								</div>
							
							
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Place Employment/Business:</label>
							<input type="text" name="place_imployment" value="<?php echo $last->place_imployment; ?>" placeholder="Place Imployment" autocomplete="off" class="form-control input-sm" required>
								</div>
									<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Number of Dependents:</label>
							<input type="number" name="number_dependents" value="<?php echo $last->number_dependents; ?>" placeholder="Number of Dependents" autocomplete="off" class="form-control input-sm" required>
								</div>
						
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Monthly Income:</label>
							<input type="number"  name="month_income" value="<?php echo $last->month_income; ?>" autocomplete="off" placeholder="Monthly Income" class="form-control input-sm" required>
								</div>
							
								
							</div>
						</div>
					</div>
					<input type="hidden" name="code" value="C<?php echo substr($customer->customer_day ,0, 4)?><?php echo substr($customer->customer_day ,5, 2)?><?php echo $customer->customer_id; ?>">
                     <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id; ?>">
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-12">
								<div class="text-center">
								<button type="submit" class="btn btn-brand  btn-elevate btn-pill btn-sm">Update</button>
								<a href="<?php echo base_url("oficer/viw_ID_sig/{$customer->customer_id}") ?>" class="btn  btn-info btn-elevate btn-pill btn-sm">Next</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
	</div>
</div>
<?php }elseif ($last == FALSE) {
?>

<div class="row">
	<div class="col-lg-12">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
					Update Customer Detail
					</h3>
				</div>
			</div>
			<!--begin::Form-->
			<!-- <form method="post" action="ss" class="kt-form kt-form--label-right" id="kt_form_2"> -->
				<?php echo form_open_multipart("oficer/create_update_lastData/{$customer->customer_id}",['class'=>'kt-form kt-form--label-right','novalidate']); ?>
				<div class="kt-portlet__body">
					<div class="kt-section">
						<div class="kt-section__content">
							<div class="form-group form-group-last row">
								<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Nick name:</label>
							<input type="text" name="famous_area" autocomplete="off" class="form-control input-sm" placeholder="Eg.Mama James, Baba Samwel" required>
								</div>
								<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Martial Status:</label>
							<select type="text" name="martial_status" class="form-control kt-selectpicker" required required data-live-search="true">
								<option value="">Select</option>
								<option value="Married">Married</option>
								<option value="Single">Single</option>
								<option value="Widow">Widow</option>
								<option value="Separated">Separated</option>
								<option value="Devorced">Devorced</option>
								
							</select>
								</div>
									<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Account Type:</label>
							<select type="number" name="account_id" class="form-control input-sm" required>
								<option value="">Select</option>
								<?php foreach ($account as $accounts): ?>
								<option value="<?php echo $accounts->account_id; ?>"><?php echo $accounts->account_name; ?></option>
								<?php endforeach; ?>
								
							</select>
								</div>
								
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*National Identity Number:</label>
									<input type="number" name="natinal_identity" placeholder="Natinal Identity Number" autocomplete="off" class="form-control input-sm" required >
								</div>
							<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Working status:</label>
							
							<select type="text" name="work_status" class="form-control kt-selectpicker" required data-live-search="true" required>
								<option value="">Select Work status</option>
								<option value="Employee">Employee</option>
								<option value="Government Employee">Government Employee</option>
								<option value="Private Sector Employee">Private Sector Employee</option>
								<option value="Bussines Owner">Bussines Owner</option>
								<option>Student</option>
								<option value="Overseas Worker">Overseas Worker</option>
								<option value="Pensioner">Pensioner</option>
								<option value="Unemployed">Unemployed</option>
								<option value="Self Employed">Self Employed</option>
							</select>
								</div>

								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Bussiness Type:</label>
							<input type="text" name="bussiness_type" placeholder="Bussiness Type" autocomplete="off" class="form-control input-sm" required>
								</div>
							
							
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Place Employment/Business:</label>
							<input type="text" name="place_imployment" placeholder="Place Imployment" autocomplete="off" class="form-control input-sm" required>
								</div>
									<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Number of Dependents:</label>
							<input type="number" name="number_dependents" placeholder="Number of Dependents" autocomplete="off" class="form-control input-sm" required>
								</div>
						
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Monthly Income:</label>
							<input type="number"  name="month_income" autocomplete="off" placeholder="Monthly Income" class="form-control input-sm" required>
								</div>
							
								
							</div>
						</div>
					</div>
					<input type="hidden" name="code" value="C<?php echo substr($customer->customer_day ,0, 4)?><?php echo substr($customer->customer_day ,5, 2)?><?php echo $customer->customer_id; ?>">
                     <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id; ?>">
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-12">
								<div class="text-center">
								<button type="submit" class="btn btn-brand  btn-elevate btn-pill btn-sm">Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
	</div>
</div>

<?php }  ?>




<!-- end:: Content -->
<!-- end:: Content -->
				</div>				
				
<?php include('incs/footer_1.php') ?>


<!-- <script>
	function getDate(data){
  let now = new Date();
  let bod = (new Date(data));

  let age = now.getFullYear() - bod.getFullYear();
   let _age = document.querySelector("#age");
   _age.value = age;
 //alert(age)
}
</script> -->