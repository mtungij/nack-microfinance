<?php
// application/views/admin/transfer_amount_view.php (renamed for clarity)

include_once APPPATH . "views/partials/header.php";

// --- DUMMY DATA ---
// Your controller should pass:
// $account: array of account objects (trans_id, account_name) for "From" and "To" account dropdowns
// $blanch: array of branch objects (blanch_id, blanch_name) for "To Branch" dropdown
// $float: array of float transfer records (from_account, blanch_amount, blanch_name, to_account, charger, trans_day, trans_id, comp_id)
// $sum_froat: object with 'cashFloat' property
// $sum_chargers: object with 'total_chargers' property

// if (!isset($account)) {
//     $account = [
//         (object)['trans_id' => 1, 'account_name' => 'Main Company Account'],
//         (object)['trans_id' => 2, 'account_name' => 'Operational Account'],
//         (object)['trans_id' => 10, 'account_name' => 'NMB Bank (Branch Default)'],
//         (object)['trans_id' => 11, 'account_name' => 'Cash In Hand (Branch Default)'],
//     ];
// }
// if (!isset($blanch)) {
//     $blanch = [
//         (object)['blanch_id' => 101, 'blanch_name' => 'HQ Branch'],
//         (object)['blanch_id' => 102, 'blanch_name' => 'Northern Zone Branch'],
//     ];
// }
// if (!isset($float)) {
//     $float = [
//         (object)['trans_id' => 201, 'comp_id' => 1, 'from_account' => 'Main Company Account', 'blanch_amount' => 500000, 'blanch_id' => 101, 'blanch_name' => 'HQ Branch', 'to_account' => 'NMB Bank (Branch Default)', 'charger' => 500, 'trans_day' => '2023-10-26'],
//         (object)['trans_id' => 202, 'comp_id' => 1, 'from_account' => 'Operational Account', 'blanch_amount' => 300000, 'blanch_id' => 102, 'blanch_name' => 'Northern Zone Branch', 'to_account' => 'Cash In Hand (Branch Default)', 'charger' => 100, 'trans_day' => '2023-10-27'],
//     ];
// }
// if (!isset($sum_froat)) {
//     $sum_froat = (object)['cashFloat' => 800000];
// }
// if (!isset($sum_chargers)) {
//     $sum_chargers = (object)['total_chargers' => 600];
// }
// --- END DUMMY DATA ---
?>

<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

        <!-- Page Title / Subheader -->
        <div class="mb-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-200">
                Float Transfer
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Manage the transfer of funds to branches.
            </p>
        </div>
        <!-- End Page Title / Subheader -->

        <?php // Flash Messages ?>
        <?php if ($das = $this->session->flashdata('massage')): ?>
        <div class="bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
            <div class="flex">
                <div class="flex-shrink-0"><span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-500"><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg></span></div>
                <div class="ms-3"><h3 class="text-gray-800 font-semibold dark:text-white">Success</h3><p class="mt-2 text-sm text-gray-700 dark:text-gray-400"><?php echo $das;?></p></div>
                <div class="ps-3 ms-auto"><div class="-mx-1.5 -my-1.5"><button type="button" class="inline-flex bg-teal-50 rounded-lg p-1.5 text-teal-500 hover:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-teal-50 focus:ring-teal-600 dark:bg-transparent dark:hover:bg-teal-800/50 dark:text-teal-600" data-hs-remove-element="[role=alert]"><span class="sr-only">Dismiss</span><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg></button></div></div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($das = $this->session->flashdata('errors')): ?>
        <div class="bg-red-100 border border-red-200 text-sm text-red-800 rounded-lg p-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert">
            <div class="flex">
                <div class="flex-shrink-0"><span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-500"><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></span></div>
                <div class="ms-3"><h3 class="text-gray-800 font-semibold dark:text-white">Error</h3><p class="mt-2 text-sm text-gray-700 dark:text-gray-400"><?php echo $das;?></p></div>
                <div class="ps-3 ms-auto"><div class="-mx-1.5 -my-1.5"><button type="button" class="inline-flex bg-red-50 rounded-lg p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600 dark:bg-transparent dark:hover:bg-red-800/50 dark:text-red-600" data-hs-remove-element="[role=alert]"><span class="sr-only">Dismiss</span><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg></button></div></div>
            </div>
        </div>
        <?php endif; ?>


        <!-- Card: Float Transfer Form -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 md:p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Float Transfer
                </h3>
                <?php echo form_open("admin/create_float", ['novalidate' => true]); ?>
                    <div class="grid sm:grid-cols-12 gap-4 sm:gap-6">
                        <div class="sm:col-span-6 md:col-span-2">
                            <label for="from_trans_id" class="label-sm-dt">* From Company Account:</label>
                            <select id="from_trans_id" name="from_trans_id" required class="input-select-preline">
                                <option value="">Select Account</option>
                                <?php if (isset($account) && is_array($account)): foreach ($account as $acc_item): ?>
                                <option value="<?php echo htmlspecialchars($acc_item->trans_id, ENT_QUOTES, 'UTF-8'); ?>" <?php echo set_select('from_trans_id', $acc_item->trans_id); ?>>
                                    <?php echo htmlspecialchars($acc_item->account_name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                                <?php endforeach; endif; ?>
                            </select>
                            <?php echo form_error("from_trans_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-6 md:col-span-3">
                            <label for="blanch_amount" class="label-sm-dt">* Amount:</label>

                            <input type="text" id="blanch_amount" name="blanch_amount" placeholder="Amount" required class="input-text-preline" value="<?php echo set_value('blanch_amount'); ?>" inputmode="decimal">
                            <?php echo form_error("blanch_amount", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>
                        
                        <div class="sm:col-span-6 md:col-span-3">
                            <label for="blanch_id" class="label-sm-dt">* To Branch Name:</label>
                            <select id="blanch_id" name="blanch_id" required class="input-select-preline">
                                <option value="">Select Branch</option>
                                <?php if (isset($blanch) && is_array($blanch)): foreach ($blanch as $bl_item): ?>
                                <option value="<?php echo htmlspecialchars($bl_item->blanch_id, ENT_QUOTES, 'UTF-8'); ?>" <?php echo set_select('blanch_id', $bl_item->blanch_id); ?>>
                                    <?php echo htmlspecialchars($bl_item->blanch_name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                                <?php endforeach; endif; ?>
                            </select>
                            <?php echo form_error("blanch_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-6 md:col-span-2">
                            <label for="to_trans_id" class="label-sm-dt">* To Branch Account:</label>
                            <select id="to_trans_id" name="to_trans_id" required class="input-select-preline">
                                <option value="">Select Account</option>
                                <?php if (isset($account) && is_array($account)): foreach ($account as $acc_item): ?>
                                <option value="<?php echo htmlspecialchars($acc_item->trans_id, ENT_QUOTES, 'UTF-8'); ?>" <?php echo set_select('to_trans_id', $acc_item->trans_id); ?>>
                                    <?php echo htmlspecialchars($acc_item->account_name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                                <?php endforeach; endif; ?>
                            </select>
                            <?php echo form_error("to_trans_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>
                        
                        <div class="sm:col-span-12 md:col-span-2">
                            <label for="charger" class="label-sm-dt">* Withdrawal Chargers:</label>
                           <input type="text" id="charger" name="charger" placeholder="Chargers" required class="input-text-preline" value="<?php echo set_value('charger', '0'); ?>" inputmode="decimal">

                            <?php echo form_error("charger", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>
                    </div>
                    <input type="hidden" name="comp_id" value="<?php echo htmlspecialchars($_SESSION['comp_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="trans_day" value="<?php echo date("Y-m-d"); ?>">
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center gap-x-2">
                            <button type="submit" class="btn-primary-sm bg-cyan-600 hover:bg-cyan-700 text-white">Submit</button>
                            <button type="reset" class="btn-secondary-sm">Cancel</button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- End Card: Float Transfer Form -->

        <!-- Card: Float List Table -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Float List</h2>
            </div>

            <!-- Filters -->
            <div class="p-4 md:p-6 border-b border-gray-200 dark:border-gray-700">
                <?php echo form_open("admin/previous_transfor"); ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                        <div>
                            <label for="filter_from_date" class="label-sm-dt">From:</label>
                            <input type="date" name="from" id="filter_from_date" class="input-text-preline" required value="<?php echo set_value('from'); ?>">
                        </div>
                        <div>
                            <label for="filter_to_date" class="label-sm-dt">To:</label>
                            <input type="date" name="to" id="filter_to_date" class="input-text-preline" required value="<?php echo set_value('to'); ?>">
                        </div>
                        <div>
                            <label for="filter_blanch_id" class="label-sm-dt">Branch:</label>
                            <select name="blanch_id" id="filter_blanch_id" class="input-select-preline" required>
                                <option value="">Select Branch</option>
                                <?php if(isset($blanch) && !empty($blanch)): foreach ($blanch as $bl_item): ?>
                                <option value="<?php echo htmlspecialchars($bl_item->blanch_id); ?>" <?php echo set_select('blanch_id', $bl_item->blanch_id); ?>><?php echo htmlspecialchars($bl_item->blanch_name); ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="w-full py-2.5 px-4 btn-primary-sm bg-cyan-600 hover:bg-cyan-700 text-white">Get Data</button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <!-- End Filters -->

            <div class="p-4" data-hs-datatable='{
                "pageLength": 10, "paging": true, "searching": true, /* Enable default search if needed, or use custom above */
                "pagingOptions": { "pageBtnClasses": "min-w-10 h-10 btn-ghost-dt" },
                "language": { "zeroRecords": "<div class=\"dt-empty-message\">No float transfers found for the selected criteria.</div>" }
            }'>
                 <?php // If you want a dedicated search input for the table, different from filters:
                 /*
                <div class="mb-4">
                    <input type="text" class="input-search-dt" placeholder="Search in results..." data-hs-datatable-search="#float_table">
                </div>
                 */ ?>
                <div class="overflow-x-auto"><div class="min-w-full inline-block align-middle"><div class="border rounded-lg overflow-hidden dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="float_table">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="th-dt"><span>From Company Acc</span><svg class="sort-icon-dt"><path class="hs-datatable-ordering-desc:text-cyan-600" d="m7 15 5 5 5-5"/><path class="hs-datatable-ordering-asc:text-cyan-600" d="m7 9 5-5 5 5"/></svg></th>
                                <th class="th-dt"><span>Amount</span><svg class="sort-icon-dt"><path class="hs-datatable-ordering-desc:text-cyan-600" d="m7 15 5 5 5-5"/><path class="hs-datatable-ordering-asc:text-cyan-600" d="m7 9 5-5 5 5"/></svg></th>
                                <th class="th-dt"><span>To Branch</span><svg class="sort-icon-dt"><path class="hs-datatable-ordering-desc:text-cyan-600" d="m7 15 5 5 5-5"/><path class="hs-datatable-ordering-asc:text-cyan-600" d="m7 9 5-5 5 5"/></svg></th>
                                <th class="th-dt"><span>To Branch Acc</span><svg class="sort-icon-dt"><path class="hs-datatable-ordering-desc:text-cyan-600" d="m7 15 5 5 5-5"/><path class="hs-datatable-ordering-asc:text-cyan-600" d="m7 9 5-5 5 5"/></svg></th>
                                <th class="th-dt"><span>Withdrawal Chargers</span><svg class="sort-icon-dt"><path class="hs-datatable-ordering-desc:text-cyan-600" d="m7 15 5 5 5-5"/><path class="hs-datatable-ordering-asc:text-cyan-600" d="m7 9 5-5 5 5"/></svg></th>
                                <th class="th-dt"><span>Date</span><svg class="sort-icon-dt"><path class="hs-datatable-ordering-desc:text-cyan-600" d="m7 15 5 5 5-5"/><path class="hs-datatable-ordering-asc:text-cyan-600" d="m7 9 5-5 5 5"/></svg></th>
                                <?php // If an action column is needed later:
                                /* <th class="th-dt text-end --exclude-from-ordering"><span>Action</span></th> */
                                ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php if (isset($float) && !empty($float)): foreach ($float as $fl_item): ?>
                            <tr>
                                <td class="td-dt"><?php echo htmlspecialchars($fl_item->from_account); ?></td>
                                <td class="td-dt"><?php echo safe_number_format($fl_item->blanch_amount); ?></td>
                                <td class="td-dt"><?php echo htmlspecialchars($fl_item->blanch_name); ?></td>
                                <td class="td-dt"><?php echo htmlspecialchars($fl_item->to_account); ?></td>
                                <td class="td-dt"><?php echo safe_number_format($fl_item->charger); ?></td>
                                <td class="td-dt"><?php echo htmlspecialchars(date('d M, Y', strtotime($fl_item->trans_day))); ?></td>
                                <?php /*
                                <td class="td-dt text-end">
                                    <button type="button" class="btn-action-sm" data-hs-overlay="#hs-edit-float-modal-<?php echo $fl_item->trans_id; ?>">Edit</button>
                                </td>
                                */ ?>
                            </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="px-6 py-3 text-sm font-semibold text-gray-800 dark:text-gray-200">TOTAL</td>
                                <td class="px-6 py-3 text-sm font-semibold text-gray-800 dark:text-gray-200">
    <?php echo number_format(floatval(str_replace(',', '', $sum_froat->cashFloat ?? 0))); ?>
</td>

<td class="px-6 py-3" colspan="2"></td>

<td class="px-6 py-3 text-sm font-semibold text-gray-800 dark:text-gray-200">
    <?php echo number_format(floatval(str_replace(',', '', $sum_chargers->total_chargers ?? 0))); ?>
</td>

                                <td class="px-6 py-3"></td>
                                <?php /* if actions column exists <td class="px-6 py-3"></td> */ ?>
                            </tr>
                        </tfoot>
                    </table>
                </div></div></div>
                <div class="dt-paging-controls" data-hs-datatable-paging="#float_table"></div>
            </div>
        </div>
        <!-- End Card: Float List Table -->

        <?php // Modals for Edit Float (if actions are added to the table later) ?>
        <?php if (isset($float) && is_array($float)): foreach ($float as $fl_item): ?>
        <div id="hs-edit-float-modal-<?php echo $fl_item->trans_id; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                <div class="modal-content-dt">
                    <div class="modal-header-dt"><h3 class="modal-title-dt">Edit Float Transfer</h3><button type="button" class="btn-close-modal-dt" data-hs-overlay="#hs-edit-float-modal-<?php echo $fl_item->trans_id; ?>"><span class="sr-only">Close</span><svg class="modal-close-icon-dt" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button></div>
                    <div class="p-4 overflow-y-auto">
                        <?php echo form_open("admin/modify_float/{$fl_item->trans_id}/{$fl_item->comp_id}"); // Ensure comp_id is available ?>
                            <div class="space-y-4">
                                <div>
                                    <label class="label-sm-dt">*To Branch Name:</label>
                                    <select name="blanch_id" class="input-select-preline" required>
                                        <?php if (isset($blanch) && is_array($blanch)): foreach ($blanch as $bl_item_modal): ?>
                                        <option value="<?php echo $bl_item_modal->blanch_id; ?>" <?php echo ($fl_item->blanch_id == $bl_item_modal->blanch_id) ? 'selected' : ''; ?>><?php echo htmlspecialchars($bl_item_modal->blanch_name); ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="label-sm-dt">*Amount:</label>
                                    <input type="number" name="blanch_amount" value="<?php echo htmlspecialchars($fl_item->blanch_amount); ?>" class="input-text-preline" required>
                                </div>
                                <?php // Other fields like 'from account', 'to account', 'charger' might be non-editable or handled differently for an edit ?>
                            </div>
                            <div class="modal-footer-dt"><button type="button" class="btn-secondary-sm" data-hs-overlay="#hs-edit-float-modal-<?php echo $fl_item->trans_id; ?>">Close</button><button type="submit" class="btn-primary-sm bg-cyan-600 hover:bg-cyan-700 text-white">Update</button></div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; endif; ?>
        <?php // End Modals ?>

    </div>
</div>
<!-- ========== END MAIN CONTENT BODY ========== -->

<?php
include_once APPPATH . "views/partials/footer.php";
?>

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
    // If Preline selects need explicit init:
    // HSStaticMethods.autoInit(['select']);
  }, 500);
});
</script>

<script>
function formatNumberInput(input) {
    input.addEventListener('input', function (e) {
        // Remove non-digit characters except dot
        let rawValue = input.value.replace(/,/g, '').replace(/[^\d.]/g, '');

        // Handle decimal parts safely
        const parts = rawValue.split('.');
        const integerPart = parts[0];
        const decimalPart = parts[1] ? '.' + parts[1].slice(0, 2) : '';

        // Format with commas
        const formatted = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",") + decimalPart;

        // Update the input display
        input.value = formatted;
    });

    // On form submit: clean value
    input.form?.addEventListener('submit', function () {
        input.value = input.value.replace(/,/g, '');
    });
}

// Apply to your inputs
document.addEventListener("DOMContentLoaded", function () {
    const amountInput = document.getElementById('blanch_amount');
    const chargerInput = document.getElementById('charger');

    if (amountInput) formatNumberInput(amountInput);
    if (chargerInput) formatNumberInput(chargerInput);
});
</script>
