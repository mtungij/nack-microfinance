
<?php
include_once APPPATH . "views/partials/header.php";

// --- DUMMY DATA - REMOVE AND LOAD FROM YOUR CONTROLLER ---
// Controller should pass $share, an array of shareholder objects.
// Each object should have 'share_id', 'share_name', 'share_mobile', 'share_email', 'share_sex', 'share_dob'.
// if (!isset($share)) {
//     $share = [
//         (object)['share_id' => 1, 'share_name' => 'Alice Wonderland', 'share_mobile' => '0712345001', 'share_email' => 'alice@example.com', 'share_sex' => 'female', 'share_dob' => '1985-06-15'],
//         (object)['share_id' => 2, 'share_name' => 'Bob The Builder', 'share_mobile' => '0712345002', 'share_email' => 'bob@example.com', 'share_sex' => 'male', 'share_dob' => '1978-11-02'],
//     ];
// }
// --- END DUMMY DATA ---header.php
?>


<div class="w-full lg:ps-64">
  <div class="= overflow-x-auto">


<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
  

            <div class="overflow-x-auto">
                <table id="shareholder_table"  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-cyan-500 dark:text-gray-400">
                        <tr>

							

                            <th scope="col" class="px-4 py-3 dark:text-white">S/No</th>
								 <th scope="col" class="px-4 py-3 dark:text-white">Branch</th> 
							<th scope="col" class="px-4 py-3 dark:text-white">Expenses Name</th>
							<th scope="col" class="px-4 py-3 dark:text-white">Amount</th>
                            <th scope="col" class="px-4 py-3 dark:text-white">From Account</th>
                           
						
                            <th scope="col" class="px-4 py-3 dark:text-white">Date</th>


					
                        </tr>
                    </thead>
					<tbody>
   
                                   <?php $no = 1; ?>
									<?php foreach ($data as $datas): ?>
        <tr class="border-b dark:border-gray-700">
            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $no++ ?></th>
            <td class="px-4 py-3 text-gray-900 dark:text-white"><?= $datas->blanch_name; ?></td>
			 <td class="uppercase text-gray-900 px-4 py-3 dark:text-white">
               <?= $datas->ex_name; ?>
            </td>
            <td class="px-4 py-3 text-gray-900 dark:text-white"><?= $datas->req_amount; ?></td>
            <td class="px-4 py-3 text-gray-900 dark:text-white"><?= $datas->account_name; ?></td>

            <!-- Principal -->
            <td class="px-4 py-3 dark:text-white"><?php echo $datas->req_date; ?></td>
            
          
    
        </tr>
    <?php endforeach; ?>

    <!-- Totals Row -->
 <!-- Totals Row -->
<!-- <tr class="bg-gray-200 dark:bg-gray-800 font-extrabold text-lg">
    <td colspan="5" class="px-4 py-3 dark:text-white text-right">Total</td>
    <td class="px-4 py-3 text-green-700 dark:text-green-400"><?= number_format($total_loan_aprove); ?></td> 
    <td class="px-4 py-3 text-blue-700 dark:text-blue-400"><?= number_format($total_loan_int); ?></td>    
    <td></td>
    <td class="px-4 py-3 text-purple-700 dark:text-purple-400"><?= number_format($total_restoration); ?></td> 
    <td colspan="5"></td>
</tr> -->

<!-- Accept Modal -->
<div id="hs-edit-shareholder-modal-<?= $datas->req_id; ?>" 
     class="hs-overlay hidden fixed top-0 left-0 w-full h-full z-50 overflow-x-hidden overflow-y-auto">
  <div class="sm:max-w-lg sm:w-full mx-auto mt-10">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Accept Expense</h3>

      <?php echo form_open("admin/expenses_request_accept/".$datas->req_id); ?>

        <!-- Hidden Inputs -->
        <input type="hidden" name="comp_id" value="<?= $datas->comp_id; ?>">
        <input type="hidden" name="blanch_id" value="<?= $datas->blanch_id; ?>">
        <input type="hidden" name="ex_id" value="<?= $datas->ex_id; ?>">

        <!-- Transaction (account) -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Account</label>
          <input type="text" name="trans_id" value="<?= $datas->trans_id; ?>" 
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <!-- Description / Comment -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Comment</label>
          <textarea name="req_comment" rows="2"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?= $datas->req_comment ?? ''; ?></textarea>
        </div>

        <!-- Amount -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
          <input type="number" name="req_amount" value="<?= $datas->req_amount; ?>" 
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end gap-x-2">
          <button type="button" data-hs-overlay="#hs-edit-shareholder-modal-<?= $datas->req_id; ?>"
                  class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
            Cancel
          </button>
          <button type="submit" 
                  class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Accept
          </button>
        </div>

      <?php echo form_close(); ?>
    </div>
  </div>
</div>




</tbody>

                </table>
				<div id="hs-basic-modal" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-80 opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
  <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="hs-basic-modal-label" class="font-bold text-gray-800 dark:text-white">
          Filter Data
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-basic-modal">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
	  <?php echo form_open("admin/get_blanch_withdraw"); ?>
  <div class="p-4 overflow-y-auto space-y-4">

    <!-- Gender Dropdown -->
    <div>
      <label for="blanch" class="block text-sm font-medium text-gray-700 dark:text-white">Chagua Tawi</label>
  <select id="branchSelect" name="blanch_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" data-live-search="true"> <option value="">Chagua Tawi</option> <?php foreach ($blanch as $blanchs): ?> <option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?> </option> <?php endforeach; ?> </select>

    </div>

    <!-- 2-Column Grid: Phone, Email, Company Name, Address -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Phone -->
      

      <!-- Email -->
    

      <!-- Company Name -->
	  <?php $date = date("Y-m-d"); ?>  

      <div>
        <label for="company" class="block text-sm font-medium text-gray-700 dark:text-white">Kwanzia Tarehe</label>
		<input type="date" value="<?php echo $date; ?>" name="from"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
      </div>

      <!-- Address -->
      <div>
        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-white">Mpaka Tarehe</label>
		<input type="date" name="to" value="<?php echo $date; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
      </div>
    </div>

  </div>

  <!-- Modal Footer Buttons -->
  <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-basic-modal">
      Close
    </button>
    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
      Apply Filters
    </button>
  </div>
  <?php echo form_close(); ?>


    </div>
  </div>
</div>

            </div>
          
        </div>
    </div>
    </section>

	</div>
  </div>


  <?php
  include_once APPPATH . "views/partials/footer.php";
  ?>

<script>
$(document).ready(function(){
$('#blanch').change(function(){
var blanch_id = $('#blanch').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_employee_blanch_deposit",
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

});
</script>


  <?php // Script for cmd+a fix for DataTables search input (if used) ?>
  <script>
$(document).ready(function() {
    $('#shareholder_table').DataTable({
        // optional: set to false if you don’t want it
        searching: true,
        paging: true,
        info: false
    });
});
</script>

  <script>
document.getElementById('simple-search').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const table = document.getElementById('shareholder_table');
    const trs = table.getElementsByTagName('tr');

    // Start from 1 to skip the header row
    for (let i = 1; i < trs.length; i++) {
        const tr = trs[i];
        const text = tr.textContent.toLowerCase();
        if (text.indexOf(filter) > -1) {
            tr.style.display = '';
        } else {
            tr.style.display = 'none';
        }
    }
});
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
.select2-container--default .select2-selection--single {
    background-color: #1f2937;
    border: 1px solid #374151;
    border-radius: 0.5rem;
    padding: 0.75rem 2.5rem 0.75rem 1rem;
    height: auto;
    color: #06b6d4; 
    font-size: 0.875rem;
    position: relative;
}
.select2-selection__rendered,
.select2-selection__clear,
.select2-selection__arrow {
    color: #d1d5db;
}
.select2-selection__arrow {
    right: 1rem;
    top: 0;
    width: 1.5rem;
    position: absolute;
}
.select2-selection__clear {
    right: 2.5rem;
    top: 50%;
    transform: translateY(-50%);
    position: absolute;
}
.custom-select2-dropdown {
    background-color: #1f2937;
    color: #d1d5db;
    border: 1px solid #374151;
    border-radius: 0.5rem;
    padding: 0.5rem;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #ffffff !important; /* Force white text */
}
.custom-select2-dropdown .select2-results__option--highlighted {
    background-color: #06b6d4 !important; /* Tailwind cyan-400 */
    color: #ffffff !important;
}

/* White text in the dropdown input if searchable */
.select2-search__field {
    color: #ffffff !important;
    background-color: #1f2937 !important; /* match dark bg */
    border: 1px solid #374151;
}
.custom-select2-dropdown .select2-results__option--highlighted {
    background-color: #06b6d4;
    color: #ffffff;
}
.custom-select2-container { margin: 0; }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        HSStaticMethods.autoInit(); // This is required to initialize all hs-select dropdowns
    });
</script>
<script>
window.addEventListener('load', () => {
  setTimeout(() => {
    const inputs = document.querySelectorAll('input[data-hs-datatable-search]');
    inputs.forEach((input) => {
      input.addEventListener('keydown', function (evt) {
        if ((evt.metaKey || evt.ctrlKey) && (evt.key === 'a' || evt.key === 'A')) {
          this.select();
        }
      });
    });
    // HSStaticMethods.autoInit(['select']); // If Preline selects need explicit init
  }, 500);
});
</script>

<script>
$(document).ready(function () {
    const selectConfig = {
        placeholder: "Select",
        allowClear: true,
        width: '100%',
        dropdownCssClass: 'custom-select2-dropdown',
        containerCssClass: 'custom-select2-container'
    };

    $('#branchSelect').select2({...selectConfig, placeholder: "Select Branch"});
    $('#employeeSelect').select2({...selectConfig, placeholder: "Select Employee"});

    $('#branchSelect').on('change', function () {
        const branchId = $(this).val();

        $.post('fetch_employee_blanch', { blanch_id: branchId }, function (data) {
            const employeeSelect = $('#employeeSelect');
            employeeSelect.html(data).select2({...selectConfig, placeholder: "Select Employee"});

            // If using Preline's hsSelect
            const customSelect = $('[data-hs-select]');
            if (customSelect.length) {
                customSelect.html(data);
                customSelect.hsSelect();
            }
        }).fail(function (xhr, status, error) {
            console.error('AJAX error:', status, error);
        });
    });
});

// Age Calculation
function getAge(dob) {
    const age = new Date().getFullYear() - new Date(dob).getFullYear();
    document.getElementById('age').value = isNaN(age) ? '' : age;
}
</script>







		