
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
            <th class="py-3 px-6 text-start">S/No.</th>
            <th class="py-3 px-6 text-start">Customer Name</th>
            <th class="py-3 px-6 text-start">Phone Number</th>
            <th class="py-3 px-6 text-start">Branch</th>
            <th class="py-3 px-6 text-start">Loan Amount Applied</th>
            <th class="py-3 px-6 text-start">Duration Type</th>
            <th class="py-3 px-6 text-start">Loan Type</th>
            <th class="py-3 px-6 text-end">Loan Status</th>
            <th class="py-3 px-6 text-end">Application Date</th>
            <th class="py-3 px-6 text-end">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

    <?php if (!empty($loan_pending) && is_array($loan_pending)): ?>

        <?php 
            $no = 1; 
            $total_loan = 0;
        ?>

        <?php foreach ($loan_pending as $loan_pendings): 
            $total_loan += (float)$loan_pendings->how_loan;
        ?>

        <tr>
            <td class="px-6 py-4 text-sm"><?php echo $no++; ?>.</td>

            <td class="px-6 py-4 text-sm uppercase">
                <?php echo htmlspecialchars($loan_pendings->f_name . ' ' . $loan_pendings->m_name . ' ' . $loan_pendings->l_name, ENT_QUOTES, 'UTF-8'); ?>
            </td>

            <td class="px-6 py-4 text-sm">
                <?php echo htmlspecialchars($loan_pendings->phone_no, ENT_QUOTES, 'UTF-8'); ?>
            </td>

            <td class="px-6 py-4 text-sm">
                <?php echo htmlspecialchars($loan_pendings->blanch_name, ENT_QUOTES, 'UTF-8'); ?>
            </td>

            <td class="px-6 py-4 text-sm">
                <?php echo number_format((float)$loan_pendings->how_loan, 0, '.', ','); ?>
            </td>

            <td class="px-6 py-4 text-sm">
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

            <td class="px-6 py-4 text-sm">
                <?php echo htmlspecialchars($loan_pendings->loan_name, ENT_QUOTES, 'UTF-8'); ?>
            </td>

            <td class="px-6 py-4 text-sm">
                <?php echo ($loan_pendings->loan_count > 1) ? 'Sio Mteja Mpya' : 'Mteja Mpya'; ?>
            </td>

            <td class="px-6 py-4 text-sm">
                <?php echo htmlspecialchars(date('d M, Y', strtotime($loan_pendings->loan_day)), ENT_QUOTES, 'UTF-8'); ?>
            </td>

            <!-- <?php if ($empl_data->position_id == '21'): ?>
            <td class="px-6 py-4 text-end text-sm">
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-table-action-sh-<?php echo $loan_pendings->loan_id; ?>" type="button"
                        class="hs-dropdown-toggle py-1.5 px-2.5 border rounded-lg">
                        Action
                    </button>

                    <div class="hs-dropdown-menu hidden mt-2 bg-white shadow-lg rounded-lg p-2">

                        <?php if (!empty($loan_pendings->group_id)): ?>
                            <a href="<?= base_url("oficer/view_LoanCustomerData/{$loan_pendings->customer_id}/{$loan_pendings->comp_id}") ?>"
                               class="block px-3 py-2 text-sm hover:bg-gray-100">
                                Approve Group
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url("oficer/view_Dataloan/{$loan_pendings->customer_id}/{$loan_pendings->comp_id}") ?>"
                               class="block px-3 py-2 text-sm hover:bg-gray-100">
                                Approve Loan
                            </a>
                        <?php endif; ?>

                        <a href="<?= base_url("oficer/delete_loan/{$loan_pendings->loan_id}") ?>"
                           onclick="return confirm('Are you sure?')"
                           class="block px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                            Delete
                        </a>

                    </div>
                </div>
            </td>
            <?php endif; ?> -->

        </tr>

        <?php endforeach; ?>

        <!-- TOTAL ROW -->
        <tr class="bg-gray-100 font-semibold">
            <td colspan="4" class="px-6 py-4 text-end">TOTAL:</td>
            <td class="px-6 py-4">
                <?php echo number_format($total_loan, 0, '.', ','); ?>
            </td>
            <td colspan="5"></td>
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
