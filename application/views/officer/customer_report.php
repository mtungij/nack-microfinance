



<?php
include_once APPPATH . "views/partials/officerheader.php";
?>
<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">


	<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="w-full">


        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
               <div id="tab-profile" class="tab-content w-full dark:bg-gray-800 rounded shadow-xl overflow-hidden">
      <div class="h-[140px] bg-gradient-to-r from-cyan-500 to-blue-500"></div>
      <div class="px-5 py-2 flex flex-col gap-3 pb-6">
        <div class="h-[90px] shadow-md w-[90px] rounded-full border-4 overflow-hidden -mt-14 border-white">
          <img class="w-full h-full rounded-full object-center object-cover" src="<?= base_url('assets/img/customer21.png') ?>" alt="Customer Image">
        </div>
        <div>
          <h3 class="uppercase text-xl text-slate-900 font-bold leading-6 dark:text-white"><?= $customer->f_name ." ". $customer->m_name ." ". $customer->l_name?></h3>
          <p class="text-sm text-gray-600  dark:text-white"><?= $customer->phone_no?></p>
        </div>
                <div class="w-full md:w-1/2">
                 
                </div>
      <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
    <!-- <a href="<?php echo base_url("oficer/print_customer_statement/{$customer_id}/{$loan_id}"); ?>" 
       class="flex items-center justify-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path fill-rule="evenodd" d="M3 14a1 1 0 011-1h3V4a1 1 0 112 0v9h3a1 1 0 010 2H4a1 1 0 01-1-1zm7 0a1 1 0 001-1V8a1 1 0 10-2 0v5a1 1 0 001 1z" clip-rule="evenodd"/>
        </svg>
        Download Repoti
    </a> -->
</div>

 
	

            </div>
            <div class="overflow-x-auto">
  



 <!--begin: Datatable -->
                <?php
                // Chukua mkopo mmoja
                $loan = $customer_report[0];

                // Tarehe ya kuanzia (loan_stat_date + 1 day)
                $startDate = new DateTime($loan->loan_stat_date);
                $startDate->modify('+1 day');

                // Aina ya interval kulingana na day
                if ($loan->day == 1) {
                    $intervalSpec = 'P1D'; // kila siku
                } elseif ($loan->day == 7) {
                    $intervalSpec = 'P1W'; // kila wiki
                } elseif ($loan->day == 30 || $loan->day == 31) {
                    $intervalSpec = 'P1M'; // kila mwezi
                } else {
                    $intervalSpec = 'P1D'; // default kila siku
                }

                $interval = new DateInterval($intervalSpec);

                // Tengeneza ratiba ya tarehe kulingana na session
                $dates = [];
                $currentDate = clone $startDate;
                for ($i = 0; $i < $loan->session; $i++) {
                    $dates[] = clone $currentDate;
                    $currentDate->add($interval);
                }

                // Weka malipo yaliyofanyika
                $payments = [];
                foreach ($customer_report as $r) {
                    if (!empty($r->depost_day)) {
                        $payDate = date('Y-m-d', strtotime($r->depost_day));
                        $payments[$payDate] = $r->depost;
                    }
                }

                // Salio la mkopo
                $balance = $loan->loan_int;
                $i = 1;
                ?>

                <table id="shareholder_table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                     <thead class="text-xs text-cyan-500 uppercase bg-gray-50 dark:bg-cyan-500 dark:text-gray-50">
                        <tr class="font-bold text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700">
                            <th scope="col" class="px-4 py-3">Idadi ya marejesho</th>
                            <th scope="col" class="px-4 py-3">Tarehe</th>
                            <th scope="col" class="px-4 py-3">Rejesho</th>
                            <th scope="col" class="px-4 py-3">Lipwa</th>
                            <th scope="col" class="px-4 py-3">Faini</th>
                            <th scope="col" class="px-4 py-3">Salio La Mkopo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dates as $date): 
                            $d = $date->format('Y-m-d');
                            $paid = $payments[$d] ?? 0;
                            $balance -= $paid;
                        ?>
                        <tr class="font-bold text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700">
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $i++; ?></td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $date->format('d-m-Y'); ?></td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"> <?= $loan->restration?></td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= number_format($paid); ?></td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= !empty($loan->penart_amount) ? number_format($loan->penart_amount) : 0; ?></td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= number_format($balance); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
          
        </div>
    </div>
    </section>


</div>
</div>
<!-- ========== END MAIN CONTENT BODY ========== -->

<?php
include_once APPPATH . "views/partials/footer.php";
?>
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




















