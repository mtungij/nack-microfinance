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

          <?php //foreach ($customer_profile as $customer_profiles): ?>
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
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text"><?php echo $das;?></div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                  </div>
         <?php endif; ?>



 <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon kt-hidden">
                    <i class="la la-gear"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                    Requisition form
                    </h3>
                </div>
            </div>
            <!--begin::Form-->
            
               <div class="container">
  
    <?php echo form_open_multipart("oficer/create_requstion_form",['class'=>'form-horizontal']) ?>
    <div id="dynamic_field">
        <div class="row">
            <div class="col-lg-4">
    <div class="form-group">
      <label class="control-label">Select Expenses:</label>
        <select type="number" name="ex_id" id="ex_id" class="form-control" required>
         <option type="">Select Expenses</option>
        <?php foreach ($expns as $expnss): ?>
          <option value="<?php echo $expnss->ex_id; ?>"><?php echo $expnss->ex_name; ?></option>
          <?php endforeach; ?>
        </select>
    </div>
    </div>

    <div class="col-lg-4">
    <div class="form-group">
      <label>Amount:</label>
        <input type="number" class="form-control" id="req_amount" placeholder="Amount" name="req_amount" autocomplete="off" required>
    </div>
    </div>
    <div class="col-lg-4">
    <div class="form-group">
      <label>Branch Account:</label>
        <select type="number" class="form-control" name="trans_id" required>
            <option value="">--Select Branch Account--</option>
            <?php foreach ($blanch_account as $blanch_accounts): ?>
            <option value="<?php echo $blanch_accounts->trans_id; ?>"><?php echo $blanch_accounts->account_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    </div>

     <div class="col-lg-12">
    <div class="form-group">
      <label>Description:</label>
        <textarea type="text" class="form-control" id="req_description" rows="4" placeholder="Description" name="req_description" autocomplete="off" required></textarea>
    </div>
    </div>

    <input type="hidden" name="comp_id"  id="comp_id" value="<?php echo $empl_data->comp_id; ?>">
    <input type="hidden" name="blanch_id"  id="blanch_id" value="<?php echo $empl_data->blanch_id; ?>">
    <?php $date = date("Y-m-d"); ?>
    <input type="hidden" name="req_date"  id="req_date" value="<?php echo $date; ?>">
    </div> 
    </div>
   
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
<!--         <button type="button" name="add" id="add" class="btn btn-success"><i class="
kt-menu__link-icon flaticon-add"></i>Add More</button> -->
      </div>
       <div class="text-center">
     <input type="submit" name="submit" id="submit" class="btn btn-info btn-sm" value="Submit" />
    </div>

     </div>
  <?php echo form_close(); ?>
</div>
            <!--end::Form-->
        </div>
    </div>



<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-list-2"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Accepted Expences list
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
                                                <th>Branch</th>
                                                <th>Expenses</th>
                                                <th>Amount</th>
                                                <th>From Blanch Account</th>
                                                <th>Descrption </th>
                                               <!--  <th>Comment</th> -->
                                                <th>Date</th>
                                             <!--    <th>status</th> -->
                                                <th>Action</th>
                                                    
                                                    
                                                 </tr>
                                          </thead>
            
                                    <tbody>
                                          <?php $no = 1; ?>
                                    <?php foreach ($data as $datas): ?>
                                              <tr>
                                    <td><?php echo $datas->blanch_name; ?></td>
                                    <td><?php echo $datas->ex_name; ?></td>
                                    <td><?php echo number_format($datas->req_amount); ?></td>
                                    <td><?php echo $datas->account_name; ?></td>
                                    <td><?php echo $datas->req_description; ?></td>
                                   <!--   <td><?php echo $datas->req_comment; ?></td> -->
                                     <td><?php echo $datas->req_date; ?></td>
                                     <td><a href="<?php echo base_url("oficer/delete_expences/{$datas->req_id}") ?>" class="btn btn-danger" onclick="return confirm('Are You Sure?')"><i class="flaticon2-delete"></i></a></td>
                                                                                                                      
                                  </tr>

                            <?php endforeach; ?>
                                    
                    </tbody>
                  
                   </table>
        <!--end: Datatable -->
    </div>
</div>

</div>
<!--End::Section--> 

<!-- end:: Content -->
<!-- end:: Content -->
				</div>	

				 <?php //endforeach; ?>			
				
<?php include('incs/footer_1.php') ?>
<script type="text/javascript">
    $(document).ready(function(){      
      var i=1;  
   
      $('#add').click(function(){  
           i++;             
           $('#dynamic_field').append('<div id="row'+i+'">                                            <hr>                                                                                     <div class="row">                                                                    <div class="col-lg-6"><div class="form-group">                                                                 <label>Select Expenses:</label>                                                                                                            <select type="number" class="form-control" name="ex_id[]" id="ex_id"><option value="">select Expenses</option> <?php foreach ($expns as $expnss): ?>
               <option value="<?php echo $expnss->ex_id; ?>"><?php echo $expnss->ex_name; ?></option><?php endforeach; ?></select>                                                                                                                                                    </div></div> <div class="col-lg-5"><div class="form-group">                                                <label>Amount:</label>                                                                                                                                                         <input type="number" class="form-control" placeholder="Amount" name="req_amount[]" id="req_amount" autocomplete="off" required>                                                                                                                                                                    </div></div> <div class="col-lg-10"><div class="form-group">                                                <label>Desciption:</label>                                                                                                                                           <textarea type="text" class="form-control" placeholder="Description" rows="4" name="req_description[]" id="req_description" autocomplete="off" required></textarea>                                                                                                                                                                    </div></div> <input type="hidden" name="comp_id[]"  id="loan_id" value="<?php echo $empl_data->comp_id; ?>">  <input type="hidden" name="req_date[]"  id="req_date" value="<?php echo $date; ?>"> <input type="hidden" name="blanch_id[]"  id="blanch_id" value="<?php echo $empl_data->blanch_id; ?>">                                                                                                                                                                                                                         <div class="col-lg-2"><br><br><br><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></div></div></div></div>');
     });
     
     $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id"); 
           var res = confirm('Are You Sure You Want To Remove This?');
           if(res==true){
           $('#row'+button_id+'').remove();  
           $('#'+button_id+'').remove();  
           }
      });  
  
    });  
</script>

<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied: " + copyText.value;
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}
</script>