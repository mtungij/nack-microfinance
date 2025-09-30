<?php
include_once APPPATH . "views/partials/header.php";
?>

<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-6">



    
    <!-- Tabs -->
    <div class="w-full bg-white rounded shadow-md mb-6">
      <div class="border-b border-gray-200">
        <nav class="flex space-x-4 px-4 py-2" id="tabs-nav">
          <button class="tab-btn text-sm font-medium text-blue-600 border-b-2 border-blue-600 py-2 px-4" data-tab="profile">Personal Information</button>
          <!-- <button class="tab-btn text-sm font-medium text-gray-600 hover:text-blue-600 hover:border-blue-600 py-2 px-4" data-tab="tab-about">Guarantors Informations</button> -->
          <button class="tab-btn text-sm font-medium text-gray-600 hover:text-blue-600 hover:border-blue-600 py-2 px-4" data-tab="experience">All Loans</button>
        </nav>
      </div>
    </div>

    <!-- Profile Card -->
    <div id="tab-profile" class="tab-content w-full dark:bg-gray-800 rounded shadow-xl overflow-hidden">
      <div class="h-[140px] bg-gradient-to-r from-cyan-500 to-blue-500"></div>
      <div class="px-5 py-2 flex flex-col gap-3 pb-6">
        <div class="h-[90px] shadow-md w-[90px] rounded-full border-4 overflow-hidden -mt-14 border-white">
          <img class="w-full h-full rounded-full object-center object-cover" src="<?= base_url('assets/img/customer21.png') ?>" alt="Customer Image">
        </div>
        <div>
          <h3 class="uppercase text-xl text-slate-900 font-bold leading-6 dark:text-white"><?= $customer_profile->f_name ." ". $customer_profile->m_name ." ". $customer_profile->l_name?></h3>
          <p class="text-sm text-gray-600  dark:text-white">@daddasoft</p>
        </div>

   


        <div class="w-full">
        <div class="flex flex-col bg-white border shadow-sm r`ounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 md:p-6">
            <?php echo form_open("admin/update_customer_details/{$customer_profile->customer_id}"); ?>
                    <div class="grid sm:grid-cols-12 gap-4 sm:gap-6">
                        <div class="sm:col-span-4">
                            <label for="share_name" class="block text-sm font-medium mb-2 dark:text-gray-300">* First Name:</label>
                            <input type="text" id="share_name" name="f_name" placeholder="Full name" autocomplete="off" required
                                   class="uppercase py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo $customer_profile->f_name; ?>">
                            <?php echo form_error("f_name", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="share_name" class="block text-sm font-medium mb-2 dark:text-gray-300">*Middle Name:</label>
                            <input type="text" id="share_name" name="m_name" placeholder="Full name" autocomplete="off" required
                                   class="uppercase py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo $customer_profile->m_name; ?>">
                            <?php echo form_error("m_name", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="share_name" class="block text-sm font-medium mb-2 dark:text-gray-300">* Last Name:</label>
                            <input type="text" id="share_name" name="l_name" placeholder="Full name" autocomplete="off" required
                                   class="uppercase py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo $customer_profile->l_name; ?>">
                            <?php echo form_error("l_name", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="share_mobile" class="block text-sm font-medium mb-2 dark:text-gray-300">* Mobile no:</label>
                            <input type="number" id="share_mobile" name="phone_no" placeholder="Mobile no" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600"  value="<?php echo $customer_profile->phone_no; ?>" >
                            <?php echo form_error("phone_no", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>
                        
                     


							
                                <div class="sm:col-span-4">
            <label for="method" class="block text-sm font-medium mb-2 dark:text-gray-300">
              * Chagua Tawi:
            </label>
            <select id="blanch" name="blanch_id"
              class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600">
                 <?php foreach ($blanch as $blanchs): ?>
                                <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?> </option>
                                    <?php endforeach; ?>
            </select>
            <?php echo form_error("blanch_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
          </div>


          <div class="sm:col-span-4">
            <label for="method" class="block text-sm font-medium mb-2 dark:text-gray-300">
              * Chagua Staff:
            </label>
            <select name="empl_id" id="empl"
              class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600">
              <option value="<?php echo $customer_profile->empl_id; ?>"><?php echo $customer_profile->empl_name; ?></option>
              <option value="">Select Employee</option>
            
            </select>
            <?php echo form_error("empl_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
          </div>
					

                       

						

                    </div>

			

<!-- End Table Section -->


                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center gap-x-2">
                        
          <button type="submit" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded hover:bg-blue-600">Update Information</button>
        </div>
                      
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        </div>
        
      </div>
    </div>

    <!-- About Tab -->
    <div id="tab-about" class="tab-content hidden w-full bg-white dark:bg-gray-800 rounded shadow-xl overflow-hidden p-6">

    </div>

    <!-- Experience Tab -->
    <div id="tab-experience" class="tab-content hidden w-full bg-white dark:bg-gray-800 rounded shadow-xl overflow-hidden p-6 space-y-4">
    
   
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                
               
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-cyan-500 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">S/No</th>
                            <th scope="col" class="px-4 py-3">Staff Name</th>
                            <th scope="col" class="px-4 py-3">Loan Approved</th>
                            <th scope="col" class="px-4 py-3">Duration Type</th>
                            <th scope="col" class="px-4 py-3">Collection</th>
                            <th scope="col" class="px-4 py-3">Start Date</th>
                            <th scope="col" class="px-4 py-3">End Date</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                         <?php foreach ($all_customer_loan as $loan_collections): ?>

                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $i++; ?>.</th>
                            <td class="px-4 py-3">
                            <?php if ($loan_collections->username == TRUE) {
                                         ?>
                                       <?php echo $loan_collections->empl_name; ?> 
                                    <?php }else{ ?>
                                        not selected
                                        <?php } ?>
                            </td>
                            <td class="px-4 py-3"><?php echo number_format($loan_collections->loan_aprove); ?></td>
                            <td class="px-4 py-3">
                            <?php
        $frequency = '';
        if ($loan_collections->day == '1') {
            $frequency = 'Daily';
        } elseif ($loan_collections->day == '7') {
            $frequency = 'Weekly';
        } elseif (in_array($loan_collections->day, ['28', '29', '30', '31'])) {
            $frequency = 'Monthly';
        }

        echo $frequency . ' (' . $loan_collections->session . ')';
    ?>
                            </td>
                            <td class="px-4 py-3"><?php echo $loan_collections->restration ? number_format($loan_collections->restration) : '0'; ?>
                            </td>
                            <td class="px-4 py-3"><?php echo date('jS M Y', strtotime($loan_collections->loan_stat_date)); ?>
                            </td>
                            <td class="px-4 py-3"><?php echo date('jS M Y',strtotime($loan_collections->loan_end_date)); ?>
                            </td>
                            <td class="px-4 py-3">
                            <?php
$status = $loan_collections->loan_status;

switch ($status) {
    case 'open':
        $color = 'bg-yellow-100 text-yellow-800 border-yellow-300';
        $label = 'Pending';
        break;
    case 'aproved':
        $color = 'bg-sky-100 text-sky-800 border-sky-300';
        $label = 'Approved';
        break;
    case 'withdrawal':
        $color = 'bg-blue-100 text-blue-800 border-blue-300';
        $label = 'Active';
        break;
    case 'done':
        $color = 'bg-green-100 text-green-800 border-green-300';
        $label = 'Done';
        break;
    case 'out':
        $color = 'bg-red-100 text-red-800 border-red-300';
        $label = 'Default';
        break;
    case 'disbarsed':
        $color = 'bg-gray-100 text-gray-800 border-gray-300';
        $label = 'Disbursed';
        break;
    default:
        $color = 'bg-slate-100 text-slate-800 border-slate-300';
        $label = ucfirst($status);
}
?>

<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border <?php echo $color; ?>">
    <?php echo $label; ?>
</span>

                            </td>
                        </tr>
                        <?php endforeach;?>

                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
   

  </div>
</div>

<?php
include_once APPPATH . "views/partials/footer.php";
?>

<!-- Scripts -->

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
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const tabButtons = document.querySelectorAll(".tab-btn");
    const tabContents = document.querySelectorAll(".tab-content");

    tabButtons.forEach(button => {
      button.addEventListener("click", () => {
        const target = button.getAttribute("data-tab");

        // Remove active states
        tabButtons.forEach(btn => {
          btn.classList.remove("text-blue-600", "border-blue-600");
          btn.classList.add("text-gray-600");
        });

        tabContents.forEach(content => {
          content.classList.add("hidden");
        });

        // Activate selected
        button.classList.remove("text-gray-600");
        button.classList.add("text-blue-600", "border-b-2", "border-blue-600");

        const selectedContent = document.getElementById("tab-" + target);
        if (selectedContent) {
          selectedContent.classList.remove("hidden");
        }
      });
    });
  });
</script>