<?php include('incs/header_1.php'); ?>
<?php include('incs/side_1.php'); ?>
<?php include('incs/subheader.php'); ?>
<style>
    .select2-container .select2-selection--single{
    height:37px !important;
}
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important; 
     border-radius: 0px !important; 
}
</style>	


<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">					

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--begin::Portlet-->
	

	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
											<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
</div>
<?php if ($das = $this->session->flashdata('massage')): ?>
	  <div class="alert alert-success fade show" role="alert">
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
<!-- end:: Content Head -->
<!-- begin:: Content -->
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--tabs">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_apps_user_edit_tab_1" role="tab">
                        <svg xmlns="" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Bound" points="0 0 24 0 24 24 0 24"/>
        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero"/>
        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3"/>
    </g>
</svg>                        Personal Information
                    </a>
</li>
 
        <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_3" role="tab">
                        <svg xmlns="" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3"/>
        <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" id="Mask" fill="#000000" opacity="0.3"/>
        <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" id="Mask-Copy" fill="#000000" opacity="0.3"/>
    </g>
</svg>                        Adition Details
                    </a>
                </li>


                        <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_4" role="tab">
                        <svg xmlns="" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3"/>
        <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" id="Mask" fill="#000000" opacity="0.3"/>
        <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" id="Mask-Copy" fill="#000000" opacity="0.3"/>
    </g>
</svg>                        Sponser
                    </a>
                </li>


                                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_5" role="tab">
                        <svg xmlns="" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3"/>
        <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" id="Mask" fill="#000000" opacity="0.3"/>
        <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" id="Mask-Copy" fill="#000000" opacity="0.3"/>
    </g>
</svg>                        All Loans
                    </a>
                </li>


                                                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("oficer/all_customer"); ?>" role="tab">
                        <svg xmlns="" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
   
</svg>                        Back
                    </a>
                </li>


                
  
            </ul>
        </div>
    </div>
    <div class="kt-portlet__body">

        <!-- <form action="#" method=""> -->
        	<?php echo form_open_multipart("oficer/update_customer_details/{$customer_profile->customer_id}"); ?>
            <div class="tab-content">
                <div class="tab-pane active" id="kt_apps_user_edit_tab_1" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Personal Information:</h3>
                                        </div>
                                    </div>
                                  
                                    <div class="form-group row">
                                        <div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*First Name:</label>
							<input type="text" name="f_name"  readonly  placeholder="First name" value="<?php echo $customer_profile->f_name; ?>" autocomplete="off" class="form-control input-sm" required>
								</div>
								<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Middle name:</label>
									<input type="text"readonly name="m_name" placeholder="Middle name" value="<?php echo $customer_profile->m_name; ?>" autocomplete="off" class="form-control input-sm" required>
								</div>
								
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Last name:</label>
									<input type="text"  readonly name="l_name" value="<?php echo $customer_profile->l_name; ?>" placeholder="Last name" autocomplete="off" class="form-control input-sm" required>
								</div>

								<!-- <div class="col-lg-3 form-group-sub">
									<label  class="form-control-label">*Branch:</label>
								<select type="number" name="blanch_id" class="form-control select2 input-sm" id="blanch" required class="form-control input-sm">
								<option value="<?php //echo $customer_profile->blanch_id; ?>"><?php //echo $customer_profile->blanch_name; ?></option>
								<?php foreach ($blanch as $blanchs): ?>
								<option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
								<?php endforeach;?>
							</select>
								</div> -->

								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Employee:</label>
								<input type="tetx" readonly  name="" class="form-control" value="<?php echo $customer_profile->empl_name; ?>" readonly>
								
							</select>
								</div>
						
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Gender:</label>
								<select type="text"  name="gender" class="form-control select2 input-sm" required class="form-control input-sm">
								<option value="<?php echo $customer_profile->gender; ?>"><?php echo $customer_profile->gender; ?></option>

							</select>
								</div>
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Date of Birth:</label>
							<input type="text" readonly name="date_birth" onchange="getDate(this.value)" placeholder="Date of Birth" autocomplete="off" class="form-control input-sm" value="<?php echo $customer_profile->date_birth; ?>" required>
								</div>
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Year:</label>
							<input type="" id="age"  name="age" readonly class="form-control input-sm" value="<?php echo $customer_profile->age; ?>">
								</div>
									<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Phone Number:</label>
							<input type="number" readonly name="phone_no" value="<?php echo $customer_profile->phone_no; ?>" placeholder="Eg,7538, 6283" autocomplete="off" class="form-control input-sm" required >
								</div>
									
									<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*District:</label>
							<input type="text" name="district" placeholder="district" value="<?php echo $customer_profile->district; ?>" autocomplete="off" class="form-control input-sm" required>
								</div>
									<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Ward:</label>
							<input type="text" name="ward" placeholder="Ward" value="<?php echo $customer_profile->ward; ?>" autocomplete="off" class="form-control input-sm" required>
								</div>
										<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Street:</label>
							<input type="text" name="street" placeholder="street" value="<?php echo $customer_profile->street; ?>" autocomplete="off" class="form-control input-sm" required>
								</div>
                                    
                                    </div>
                                   
                                    <br>
                                    <div class="text-center">
                                    	  <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <?php echo form_close(); ?>



             
                <div class="tab-pane" id="kt_apps_user_edit_tab_3" role="tabpanel">
                    <div class="kt-form kt-form--label-right">

                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Adition Details:</h3>
                                        </div>
                                    </div>
                                    <?php echo form_open("admin/sss"); ?>
                                    <div class="form-group row">
	                            <div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Nick name:</label>
							<input type="text" name="famous_area" autocomplete="off" value="<?php echo $customer_profile->famous_area; ?>" class="form-control input-sm" placeholder="Eg.Mama James, Baba Samwel" required>
								</div>
								<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Martial Status:</label>
							<select type="text" name="martial_status" class="form-control input-sm" required>
								<option value="<?php echo $customer_profile->martial_status; ?>"><?php echo $customer_profile->martial_status; ?></option>
								<option value="Married">Married</option>
								<option value="Single">Single</option>
								<option value="Widow">Widow</option>
								<option value="Separated">Separated</option>
								<option value="Devorced">Devorced</option>
								
							</select>
								</div>
									<div class="col-lg-4 form-group-sub">
									<label class="form-control-label">*Account Type:</label>
							<select type="number" name="account_id" class="form-control input-sm" data-required="true">
								<option value="<?php echo $customer_profile->account_id; ?>"><?php echo $customer_profile->account_name; ?></option>
								<?php foreach ($account as $accounts): ?>
								<option value="<?php echo $accounts->account_id; ?>"><?php echo $accounts->account_name; ?></option>
								<?php endforeach; ?>
								
							</select>
								</div>
								
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*National Identity Number:</label>
									<input type="number" name="natinal_identity" value="<?php echo $customer_profile->natinal_identity; ?>" placeholder="Natinal Identity Number" autocomplete="off" class="form-control input-sm" required >
								</div>
							<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Working status:</label>
							
							<select type="text" name="work_status" class="form-control" required data-live-search="true" required>
								<option value="<?php echo $customer_profile->work_status; ?>"><?php echo $customer_profile->work_status; ?></option>
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
									<label  class="form-control-label">*Place Employment/Business:</label>
							<input type="text" name="place_imployment" placeholder="Place Imployment" value="<?php echo $customer_profile->place_imployment; ?>" autocomplete="off" class="form-control input-sm">
								</div>

								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Bussiness Type:</label>
							<input type="text" name="bussiness_type" placeholder="Bussiness Type" value="<?php echo $customer_profile->bussiness_type; ?>" autocomplete="off" class="form-control input-sm">
								</div>
								<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Number of Dependents:</label>
							<input type="number" name="number_dependents" value="<?php echo $customer_profile->number_dependents; ?>" placeholder="Number of Dependents" autocomplete="off" class="form-control input-sm">
								</div>
							<div class="col-lg-4 form-group-sub">
									<label  class="form-control-label">*Monthly Income:</label>
							<input type="number"  name="month_income" autocomplete="off" value="<?php echo $customer_profile->month_income; ?>" placeholder="Monthly Income" class="form-control input-sm">
								</div>
                                </div>
                                 
                                </div>
                            </div>
                        </div>
                        <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                            
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-xl-3"></div>
                                <div class="col-lg-9 col-xl-6">
                                    <!-- <button type="submit" class="btn btn-primary">Update</a> -->
                                    <!-- button type="reset" class="btn btn-clean btn-bold">Cancel</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>




                           <div class="tab-pane" id="kt_apps_user_edit_tab_5" role="tabpanel">
                    <div class="kt-form kt-form--label-right">

                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <!-- <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">All Loans:</h3>
                                        </div>
                                    </div> -->
                                   
                                <div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon-list-2"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				All Loans List
			</h3>
			
		</div>
		<div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
	<div class="kt-portlet__head-actions">
		 <!--  <a href="" class="btn btn-info" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_4"><i class="kt-menu__link-icon flaticon2-search-1"></i>Filter</a> -->
		  
		
	</div>	
</div>		</div>
	</div>
	

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
									     <thead>
			  						          <tr>
				  							    <th>S/No.</th>
												<th>Employee</th>
												<th>Loan Aproved</th>
												<th>Principal + Interest</th>
												<th>Duration type</th>
												<th>Number Of Repayment</th>
												<th>Collection</th>
												<th>Paid Amount</th>
												<th>Remain Amount</th>
												<th>Penart Amount</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th>Status</th>
												<th>Action</th>
				  						         </tr>
						                  </thead>
			
								    <tbody>
                                          <?php $no = 1; ?>
									<?php foreach ($all_customer_loan as $loan_collections): ?>
									          <tr>
				  					<td><?php echo $no++; ?>.</td>
				  					<td class="c">
				  						<?php if ($loan_collections->username == TRUE) {
				  						 ?>
				  					   <?php echo $loan_collections->username; ?> 
				  					<?php }else{ ?>
				  						Admin
				  						<?php } ?>
				  					</td>
				  					<td><?php echo number_format($loan_collections->loan_aprove); ?></td>
				  					<td>
				  						<?php echo number_format($loan_collections->loan_int); ?>
				  					</td>
				  					<td>
				  						<?php if ($loan_collections->day == '1') {
				  							echo "Daily";
				  						 ?>
				  						<?php }elseif ($loan_collections->day == '7') {
				  							echo "Weekly";
				  						 ?>
				  						<?php }elseif ($loan_collections->day == '31' || $loan_collections->day == '30' || $loan_collections->day == '28' || $loan_collections->day == '29') {
				  							echo "Monthly";
				  						 ?>
				  						 <?php } ?>
				  						<?php //echo $loan_collections->day; ?>
				  						
				  					</td>
				  					<td><?php echo $loan_collections->session; ?></td>
				  					<td><?php echo number_format($loan_collections->restration); ?></td> 
				  					<td><?php echo number_format($loan_collections->total_depost); ?></td> 
				  					<td>
				  						<?php if ($loan_collections->total_depost > $loan_collections->loan_int) {
				  						 ?>
				  						 0
				  						<?php }else{?>
				  						<?php echo number_format($loan_collections->loan_int - $loan_collections->total_depost); ?>
				  							<?php } ?>
				  						</td> 
				  					<td>
				  						<?php if ($loan_collections->penart_paid > $loan_collections->total_penart_amount) {
				  						 ?>
				  						 0
				  						<?php }else{ ?>
				  						<?php echo number_format($loan_collections->total_penart_amount - $loan_collections->penart_paid); ?>
				  							<?php } ?>
				  						</td> 
				  				    <td><?php echo $loan_collections->loan_stat_date; ?></td>
				  					<td><?php echo substr($loan_collections->loan_end_date, 0,10); ?></td> 
				  					<td>
				  						<?php if ($loan_collections->loan_status == 'open') {
				  						 ?>
				  						<a href="javascript:;" class="badge badge-warning">Pending</a>
				  						<?php }elseif($loan_collections->loan_status == 'aproved'){ ?>
                                          <a href="javascript:;" class="badge badge-info">Aproved</a>
				  							<?php }elseif($loan_collections->loan_status == 'withdrawal'){ ?>
                                             <a href="javascript:;" class="badge badge-primary">Active</a>
				  								<?php }elseif($loan_collections->loan_status == 'done'){ ?>
				  								<a href="javascript:;" class="badge badge-success">Done</a>
				  									<?php }elseif ($loan_collections->loan_status == 'out') { ?>
				  							<a href="javascript:;" class="badge badge-danger">Default</a>
				  										
				  									<?php }elseif($loan_collections->loan_status == 'disbarsed'){ ?> 
				  								<a href="javascript:;" class="badge badge-secondary">Disbursed</a>
				  								<?php } ?>
				  							
				  						</td> 
				  						<td>
			<div class="dropdown dropdown-inline">
            <button type="button" class="btn btn-info  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class=""></i> Action     
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <ul class="kt-nav">
                    <li class="kt-nav__section kt-nav__section--first">
                        <span class="kt-nav__section-text">Choose an option</span>
                    </li>
                    <li class="kt-nav__item">
                        <a href="<?php echo base_url("oficer/view_collateral/{$loan_collections->loan_id}/{$loan_collections->customer_id}") ?>" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-eye" ></i>
                            <span class="kt-nav__link-text">Collateral</span>
                        </a>
                    </li>

                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_<?php echo $loan_collections->loan_id; ?>">
                            <i class="kt-nav__link-icon flaticon-eye" ></i>
                            <span class="kt-nav__link-text">Loan Agrement</span>
                        </a>
                    </li>
                </ul>
            </div>
    </div>
				  						</td>	  											  							
                                   </tr>


       <div class="modal fade" id="kt_modal_<?php echo $loan_collections->loan_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Loan Agrement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
               
                    <div class="kt-portlet__bod">
                    <div class="kt-section">
                        <div class="kt-section__content">
                            <div class="form-group form-group-last row">
									<div class="col-lg-3 form-group-sub">
									<label class="form-control-label">*Name of Officer:</label>
							<input type="text" name="oficer" placeholder="Name of Officer" readonly autocomplete="off" class="form-control input-sm" value="<?php echo $loan_collections->oficer; ?>" required >
								</div>
								
									<div class="col-lg-3 form-group-sub">
									<label class="form-control-label">*Officer Phone Number:</label>
							<input type="number" name="phone_oficer" placeholder="Officer Phone Number" readonly autocomplete="off" class="form-control input-sm" value="<?php echo $loan_collections->phone_oficer; ?>" required>
								</div>
							<div class="col-lg-3 form-group-sub">
									<label class="form-control-label">*Officer Position:</label>
							<input type="text" name="phone_oficer" placeholder="Officer Position" readonly autocomplete="off" class="form-control input-sm" value="<?php echo $loan_collections->oficer_position; ?>" required>
								</div>
							<div class="col-lg-3 form-group-sub">
									<label class="form-control-label">*Region:</label>
							<input type="text" name="phone_oficer" placeholder="Region" readonly autocomplete="off" class="form-control input-sm" value="<?php echo $loan_collections->region_name; ?>" required>
								</div>
							<input type="hidden" name="loan_id" value="<?php //echo $loan_attach->loan_id; ?>">
										<div class="col-lg-3 form-group-sub">
									<label class="form-control-label">*District:</label>
							<input type="text" name="district_oficer" value="<?php echo $loan_collections->district_oficer; ?>" placeholder="District" autocomplete="off" class="form-control input-sm" readonly required>
								</div>
					<div class="col-lg-3 form-group-sub">
					<label class="form-control-label">*Street:</label>
						<input type="text" name="street_oficer" value="<?php echo $loan_collections->street_oficer; ?>" placeholder="Street" autocomplete="off" class="form-control input-sm" readonly required>
						</div>
					   <div class="col-lg-3 form-group-sub">
									<label class="form-control-label">*Ward:</label>
							<input type="text" name="ward_oficer" value="<?php echo $loan_collections->ward_oficer; ?>" placeholder="Ward" autocomplete="off" class="form-control input-sm" readonly required>
						</div> 

						 <div class="col-lg-3 form-group-sub">
									<label class="form-control-label">*Loan Agreement:</label>
                                     <br>
                                     <?php if ($loan_collections->cont_attachment == TRUE) {
                                      ?>
									<a href="<?php echo base_url().'oficer/download_attach/'.@$loan_collections->attach_id; ?>" class="btn btn-primary"><i class="flaticon2-file">Download</i></a>
								<?php }elseif ($loan_collections->cont_attachment == FALSE) {
								 ?>
								 <a href="javascript:;" class="btn btn-danger"><i class="flaticon2-file">No Loan Agrement</i></a>
								 <?php } ?>
							</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  
                      <?php endforeach; ?>
									
	                </tbody>
	                <tfoot>

                    
                   </tfoot>
                   </table>
		<!--end: Datatable -->
	</div>
</div>
                                 
                                </div>
                            </div>
                        </div>
                        
                            
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-xl-3"></div>
                                <div class="col-lg-9 col-xl-6">
                                   <!--  <button type="submit" class="btn btn-primary">Update</a> -->
                                    <!-- button type="reset" class="btn btn-clean btn-bold">Cancel</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            






<div class="tab-pane" id="kt_apps_user_edit_tab_4" role="tabpanel">
                    <div class="kt-form kt-form--label-right">

                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Guarantors:</h3>
                                        </div>
                                    </div>
                                      <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-list-2"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Guarantors  List
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
    <div class="kt-portlet__head-actions">

    
        <!-- &nbsp;
        <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
            <i class="la la-plus"></i>
            New Record
        </a> -->
    </div>  
</div>      </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->

        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                <thead>
                                    <tr>
                                    <th>S/No.</th>
                                    <th>Full Name </th>
                                    <th>Phone number</th>
                                    <th>Nature of Settlement</th>
                                    <th>Relationship</th>
                                     <th>Identites</th>
                                    <th>Region</th>
                                    <th>District</th>
                                    <th>Ward</th>
                                    <th>Street</th>                               
                                    <!-- <th>Action</th>  -->                              
                                    </tr>
                                 </thead>
            
                                    <tbody>
                                          <?php $no = 1; ?>
                                    <?php foreach($sponser as $sponsers_datas): ?>
                                              <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $sponsers_datas->sp_name; ?> <?php echo $sponsers_datas->sp_mname; ?> <?php echo $sponsers_datas->sp_lname; ?></td>
                                    <td><?php echo $sponsers_datas->sp_phone_no; ?></td>
                                    <td><?php echo $sponsers_datas->nature; ?></td>
                                    
                                    <td><?php echo $sponsers_datas->sp_relation; ?></td>
                                    <td><?php echo $sponsers_datas->sp_nation; ?></td>
                                    <td><?php echo $sponsers_datas->region_name; ?></td>
                                    <td><?php echo $sponsers_datas->sp_district; ?></td>
                                    <td><?php echo $sponsers_datas->sp_ward; ?></td>
                                    <td><?php echo $sponsers_datas->sp_street; ?></td>
 <!--                                <td>    
                            <div class="dropdown dropdown-inline">
            <button type="button" class="btn btn-info  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class=""></i> Action     
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <ul class="kt-nav">
                    <li class="kt-nav__section kt-nav__section--first">
                        <span class="kt-nav__section-text">Choose an option</span>
                    </li>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_<?php //echo $sponsers_datas->sp_id; ?>">
                            <i class="kt-nav__link-icon flaticon-edit" ></i>
                            <span class="kt-nav__link-text">Edit</span>
                        </a>
                    </li>
                </ul>
            </div>
    </div>
</td>  -->                                                                                  
</tr>
<!--end::Modal-->
<?php endforeach; ?>                               
</tbody>
</table>
        <!--end: Datatable -->

   </div>

</div>

</div>

</div>


</div>
</div>
</div>				
		<br>		
<?php include('incs/footer_1.php') ?>

<script>
	function getDate(data){
  let now = new Date();
  let bod = (new Date(data));

  let age = now.getFullYear() - bod.getFullYear();
   let _age = document.querySelector("#age");
   _age.value = age;
 //alert(age)
}
</script>

<script>
    $('.select2').select2();
</script>	



<script>
$(document).ready(function(){
$('#blanch').change(function(){
var blanch_id = $('#blanch').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_employee_blanch",
method:"POST",
data:{blanch_id:blanch_id},
success:function(data)
{
$('#empl').html(data);
//$('#district').html('<option value="">All</option>');
}
});
}
else
{
$('#empl').html('<option value="">Select Employee</option>');
//$('#district').html('<option value="">All</option>');
}
});



// $('#customer').change(function(){
// var customer_id = $('#customer').val();
//  //alert(customer_id)
// if(customer_id != '')
// {
// $.ajax({
// url:"<?php echo base_url(); ?>admin/fetch_data_vipimioData",
// method:"POST",
// data:{customer_id:customer_id},
// success:function(data)
// {
// $('#loan').html(data);
// //$('#malipo_name').html('<option value="">select center</option>');
// }
// });
// }
// else
// {
// $('#loan').html('<option value="">Select Active loan</option>');
// //$('#malipo_name').html('<option value="">chagua vipimio</option>');
// }
// });

// $('#social').change(function(){
//  var district_id = $('#social').val();
//  if(district_id != '')
//  {
//   $.ajax({
//    url:"<?php echo base_url(); ?>user/fetch_data_malipo",
//    method:"POST",
//    data:{district_id:district_id},
//    success:function(data)
//    {
//     $('#malipo_name').html(data);
//     //$('#malipo').html('<option value="">chagua malipo</option>');
//    }
//   });
//  }
//  else
//  {
//   //$('#vipimio').html('<option value="">chagua vipimio</option>');
//   $('#malipo_name').html('<option value="">chagua vipimio</option>');
//  }
// });


});
</script>