<?php
include_once APPPATH . "views/partials/officerheader.php";

?>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">					
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
   
</div>
<!-- end:: Subheader -->										
<!-- begin:: Content -->
<!-- begin:: Content -->

<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">


 <div class="col-lg-12">
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 md:p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Requisition Form
                </h3>
            </div>
            <!--begin::Form-->
            
               <div class="container py-4">

    <?php echo form_open_multipart("oficer/create_requstion_form", ['novalidate' => true]); ?>
    <div id="dynamic_field">
        <div class="grid sm:grid-cols-12 gap-4 sm:gap-6">
            <div class="sm:col-span-4">
                <label for="ex_id" class="block text-sm font-medium mb-2 dark:text-gray-300">Select Expenses:</label>
                <select name="ex_id" id="ex_id" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" required>
                    <option value="">Select Expenses</option>
                    <?php foreach ($expns as $expnss): ?>
                        <option value="<?php echo $expnss->ex_id; ?>"><?php echo $expnss->ex_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="sm:col-span-4">
                <label for="req_amount" class="block text-sm font-medium mb-2 dark:text-gray-300">Amount:</label>
                <input type="number" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" id="req_amount" placeholder="Amount" name="req_amount" autocomplete="off" required>
            </div>

            <div class="sm:col-span-4">
                <label for="trans_id" class="block text-sm font-medium mb-2 dark:text-gray-300">Branch Account:</label>
                <select id="trans_id" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" name="trans_id" required>
                    <option value="">--Select Branch Account--</option>
                    <?php foreach ($blanch_account as $blanch_accounts): ?>
                        <option value="<?php echo $blanch_accounts->trans_id; ?>"><?php echo $blanch_accounts->account_name; ?> - Salio: <?php echo number_format(isset($blanch_accounts->blanch_capital) ? $blanch_accounts->blanch_capital : 0); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="sm:col-span-12">
                <label for="req_description" class="block text-sm font-medium mb-2 dark:text-gray-300">Description:</label>
                <textarea class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" id="req_description" rows="4" placeholder="Description" name="req_description" autocomplete="off" required></textarea>
            </div>

            <input type="hidden" name="comp_id" id="comp_id" value="<?php echo $empl_data->comp_id; ?>">
            <input type="hidden" name="blanch_id" id="blanch_id" value="<?php echo $empl_data->blanch_id; ?>">
            <?php $date = date("Y-m-d"); ?>
            <input type="hidden" name="req_date" id="req_date" value="<?php echo $date; ?>">
        </div>
    </div>

    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <div class="text-center">
            <input type="submit" name="submit" id="submit" class="py-2 px-4 btn-primary-sm bg-cyan-800 hover:bg-cyan-700 text-white rounded-md" value="Submit" />
        </div>
    </div>
  <?php echo form_close(); ?>
</div>
            <!--end::Form-->
        </div>
    </div>



<div class="kt-portlet kt-portlet--mobile">
    <div class="flex flex-col bg-white border shadow-sm rounded-xl mt-6 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 md:p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                Expense Requests List
            </h3>
        </div>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="w-full">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table id="kt_table_1" class="w-full text-sm text-left text-gray-500 dark:text-gray-200">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-cyan-600 dark:text-white">
                            <tr>
                                <th scope="col" class="px-4 py-3">Branch</th>
                                <th scope="col" class="px-4 py-3">Expenses</th>
                                <th scope="col" class="px-4 py-3">Amount</th>
                                <th scope="col" class="px-4 py-3">From Branch Account</th>
                                <th scope="col" class="px-4 py-3">Description</th>
                                <th scope="col" class="px-4 py-3">Date</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $datas): ?>
                                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $datas->blanch_name; ?></td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $datas->ex_name; ?></td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo number_format($datas->req_amount); ?></td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $datas->account_name; ?></td>
                                        <td class="px-4 py-2 font-medium text-gray-900 dark:text-white"><?php echo $datas->req_description; ?></td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $datas->req_date; ?></td>
                                        <td class="px-4 py-2">
                                            <?php if ($datas->req_status == 'accept'): ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100">Accepted</span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-100">Pending Approval</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="<?php echo base_url("oficer/delete_expences/{$datas->req_id}") ?>" class="inline-flex items-center justify-center py-2 px-3 rounded-md bg-red-600 hover:bg-red-700 text-white" onclick="return confirm('Are You Sure?')" title="Delete"><i class="flaticon2-delete"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="px-4 py-3 text-center text-gray-500 dark:text-gray-200">No expense requests found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

</div>
</div>

</div>
<!--End::Section--> 

<!-- end:: Content -->
<!-- end:: Content -->
				</div>	

				 <?php //endforeach; ?>			
<?php
include_once APPPATH . "views/partials/footer.php";
?>

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