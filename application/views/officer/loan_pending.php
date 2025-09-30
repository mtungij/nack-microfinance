
<?php
include_once APPPATH . "views/partials/officerheader.php";

// --- DUMMY DATA - REMOVE AND LOAD FROM YOUR CONTROLLER ---
// Controller should pass $loan_pending, an array of shareholder objects.
// Each object should have 'loan_id', 'share_name', 'share_mobile', 'share_email', 'share_sex', 'share_dob'.
// if (!isset($loan_pending)) {
//     $loan_pending = [
//         (object)['loan_id' => 1, 'share_name' => 'Alice Wonderland', 'share_mobile' => '0712345001', 'share_email' => 'alice@example.com', 'share_sex' => 'female', 'share_dob' => '1985-06-15'],
//         (object)['loan_id' => 2, 'share_name' => 'Bob The Builder', 'share_mobile' => '0712345002', 'share_email' => 'bob@example.com', 'share_sex' => 'male', 'share_dob' => '1978-11-02'],
//     ];
// }
// --- END DUMMY DATA ---header.php
?>

<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

        <!-- Page Title / Subheader -->
        <div class="mb-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-200">
               Loan Pending Approve
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Omba upitishiwe ili uwahudumie.
            </p>
        </div>


		<div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                    <div class="relative max-w-xs w-full">
                        <label for="shareholder-table-search" class="sr-only">Search</label>
                        <input type="text" name="shareholder-table-search" id="shareholder-table-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" placeholder="Search share holders..." data-hs-datatable-search="#shareholder_table">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3"><svg class="size-4 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg></div>
                    </div>
                </div>

<!-- Table Section -->
<div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="border rounded-lg overflow-hidden dark:border-gray-700">
						<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="shareholder_table" data-hs-datatable>
    <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
            <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">S/No.</span></div></th>
            <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Customer Name</span></div></th>
            <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Phone Number</span></div></th>
            <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Branch</span></div></th>
            <th scope="col" class="py-3 px-6 text-start --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Loan Amount Applied</span></div></th>
            <th scope="col" class="py-3 px-6 text-start --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Duration Type</span></div></th>
            <th scope="col" class="py-3 px-6 text-start --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Loan Type</span></div></th>
            <th scope="col" class="py-3 px-6 text-end --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Loan Status</span></div></th>
            <th scope="col" class="py-3 px-6 text-end --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Application Date</span></div></th>
            <th scope="col" class="py-3 px-6 text-end --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Action</span></div></th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        <?php if (isset($loan_pending) && is_array($loan_pending) && !empty($loan_pending)): ?>
            <?php 
                $no = 1; 
                $total_loan = 0;
                foreach ($loan_pending as $loan_pendings): 
                    $total_loan += $loan_pendings->how_loan;
            ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><?php echo $no++; ?>.</td>
                <td class="px-6 py-4 uppercase whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    <?php echo htmlspecialchars($loan_pendings->f_name . ' ' . $loan_pendings->m_name . ' ' . $loan_pendings->l_name, ENT_QUOTES, 'UTF-8'); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($loan_pendings->phone_no, ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($loan_pendings->blanch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    <?php echo number_format((float) $loan_pendings->how_loan, 0, '.', ','); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    <?php
                        if ($loan_pendings->day == 1) {
                            echo "Siku";
                        } elseif ($loan_pendings->day == 7) {
                            echo "Wiki";
                        } elseif (in_array($loan_pendings->day, [28, 29, 30, 31])) {
                            echo "Mwezi";
                        } else {
                            echo "N/A";
                        }
                        echo " (" . htmlspecialchars($loan_pendings->session, ENT_QUOTES, 'UTF-8') . ")";
                    ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($loan_pendings->loan_name, ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                    <?php echo ($loan_pendings->loan_count > 1) ? 'Sio Mteja Mpya' : 'Mteja Mpya'; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars(date('d M, Y', strtotime($loan_pendings->loan_day)), ENT_QUOTES, 'UTF-8'); ?></td>
                <!-- </?php if ($empl_data->position_id == '1'): ?> -->
<!-- <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
    <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
        <button id="hs-table-action-sh-</?php echo $loan_pendings->loan_id; ?>" type="button" class="hs-dropdown-toggle py-1.5 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
            Action
            <svg class="hs-dropdown-open:rotate-180 size-2.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-40 z-20 bg-white shadow-2xl rounded-lg p-2 mt-2 dark:divide-gray-700 dark:bg-gray-800 dark:border dark:border-gray-700" aria-labelledby="hs-table-action-sh-<?php echo $loan_pendings->loan_id; ?>">
            <div class="py-2 first:pt-0 last:pb-0">
                <span class="block py-2 px-3 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">Choose an option</span>

                </?php if (!empty($loan_pendings->group_id)): ?>
                    <a href="</?= base_url("oficer/view_LoanCustomerData/{$loan_pendings->customer_id}/{$loan_pendings->comp_id}") ?>" class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-cyan-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
                        Approve Group
                    </a>
                </?php else: ?>
                    <a href="</?= base_url("oficer/view_Dataloan/{$loan_pendings->customer_id}/{$loan_pendings->comp_id}") ?>" class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-cyan-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
                        Approve Loan
                    </a>
                </?php endif; ?>
            </div>

            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:ring-2 focus:ring-red-500 dark:text-red-500 dark:hover:bg-gray-700"
               href="</?php echo base_url("oficer/delete_loan/{$loan_pendings->loan_id}"); ?>"
               onclick="return confirm('Are you sure?')">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                Delete
            </a>
        </div>
    </div>
</td> -->
<!-- </?php endif; ?> -->

            </tr>
            <?php endforeach; ?>
            <tr class="bg-gray-100 dark:bg-gray-800 font-semibold">
                <td colspan="4" class="px-6 py-4 text-end text-sm text-gray-900 dark:text-white">TOTAL:</td>
                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                    <?php echo number_format((float) $total_loan, 0, '.', ','); ?>
                </td>
                <td colspan="4"></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

                        </div>
                    </div>
                </div>
<!-- End Table Section -->
<?php
include_once APPPATH . "views/partials/footer.php";
?>
<?php // Script for cmd+a fix for DataTables search input (if used) ?>

<script>
  window.addEventListener('load', () => {
    window.HSStaticMethods.autoInit(); // Ensure Preline auto-inits all datatable components
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
