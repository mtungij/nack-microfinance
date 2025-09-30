<?php
include_once APPPATH . "views/partials/header.php";

// --- DUMMY DATA ---
// if (!isset($loan_category)) { // For the loan category list table
//     $loan_category = [
//         (object)['category_id' => 1, 'loan_name' => 'Personal Loan', 'loan_price' => 50000, 'loan_perday' => 500000, 'interest_formular' => 10],
//         (object)['category_id' => 2, 'loan_name' => 'Business Loan - Small', 'loan_price' => 500001, 'loan_perday' => 2000000, 'interest_formular' => 8],
//         (object)['category_id' => 3, 'loan_name' => 'Emergency Loan', 'loan_price' => 10000, 'loan_perday' => 100000, 'interest_formular' => 12],
//     ];
// }
// --- END DUMMY DATA ---
?>

<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

        <!-- Page Title / Subheader -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-200">
                    Manage Loan Categories
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Define different types and tiers of loan products.
                </p>
            </div>
        </div>
        <!-- End Page Title / Subheader -->

        <?php // Flash Messages ?>
        <?php if ($das = $this->session->flashdata('massage')): ?>
        <div class="bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-500">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
                    </span>
                </div>
                <div class="ms-3">
                    <h3 class="text-gray-800 font-semibold dark:text-white">Success</h3>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-400"><?php echo $das;?></p>
                </div>
                <div class="ps-3 ms-auto">
                    <div class="-mx-1.5 -my-1.5">
                        <button type="button" class="inline-flex bg-teal-50 rounded-lg p-1.5 text-teal-500 hover:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-teal-50 focus:ring-teal-600 dark:bg-transparent dark:hover:bg-teal-800/50 dark:text-teal-600" data-hs-remove-element="[role=alert]"><span class="sr-only">Dismiss</span><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg></button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Card: Add Loan Category Form -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 md:p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Add Loan Category
                </h3>
                <?php echo form_open("admin/create_loanCategory", ['novalidate' => true]); ?>
                    <div class="grid sm:grid-cols-12 gap-4 sm:gap-6">
                        <div class="sm:col-span-3">
                            <label for="loan_name" class="block text-sm font-medium mb-2 dark:text-gray-300">* Loan Product name:</label>
                            <input type="text" id="loan_name" name="loan_name" placeholder="E.g., Personal Loan" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('loan_name'); ?>">
                            <?php echo form_error("loan_name", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="loan_price" class="block text-sm font-medium mb-2 dark:text-gray-300">* From (Min Amount):</label>
                            <input type="text" id="loan_price" name="loan_price" placeholder="e.g., 1000" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('loan_price'); ?>">
                            <?php echo form_error("loan_price", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="loan_perday" class="block text-sm font-medium mb-2 dark:text-gray-300">* To (Max Amount):</label>
                            <input type="text" id="loan_perday" name="loan_perday" placeholder="e.g., 10000" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('loan_perday'); ?>">
                            <?php echo form_error("loan_perday", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="interest_formular" class="block text-sm font-medium mb-2 dark:text-gray-300">* Loan Interest (%):</label>
                            <input type="number" step="0.01" id="interest_formular" name="interest_formular" placeholder="e.g., 10.5" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('interest_formular'); ?>">
                            <?php echo form_error("interest_formular", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>
                    </div>

                    <input type="hidden" name="comp_id" value="<?php echo htmlspecialchars($_SESSION['comp_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center gap-x-2">
                            <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-cyan-600 text-white hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">Save</button>
                            <button type="reset" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800">Cancel</button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- End Card: Add Loan Category Form -->

        <!-- Card: Loan Category List Table -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Loan Category List</h2>
            </div>

            <div class="p-4" data-hs-datatable='{
                "pageLength": 10, "paging": true,
                "pagingOptions": { "pageBtnClasses": "min-w-10 h-10 inline-flex justify-center items-center text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:focus:bg-gray-700 dark:hover:bg-gray-700" },
                "language": { "zeroRecords": "<div class=\"py-10 px-5 flex flex-col justify-center items-center text-center\"><svg class=\"shrink-0 size-6 text-gray-500 dark:text-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"11\" cy=\"11\" r=\"8\"/><path d=\"m21 21-4.3-4.3\"/></svg><div class=\"max-w-sm mx-auto\"><p class=\"mt-2 text-sm text-gray-600 dark:text-gray-400\">No loan categories found.</p></div></div>" }
            }'>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                    <div class="relative max-w-xs w-full">
                        <label for="loan-category-table-search" class="sr-only">Search</label>
                        <input type="text" name="loan-category-table-search" id="loan-category-table-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" placeholder="Search categories..." data-hs-datatable-search="#loan_category_table">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3"><svg class="size-4 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg></div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="loan_category_table">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 text-start font-normal focus:outline-none"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">S/No.</span></div></th>
                                        <th scope="col" class="py-3 px-6 text-start font-normal focus:outline-none"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Category Name</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-start font-normal focus:outline-none"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Loan Level (Min - Max)</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-start font-normal focus:outline-none"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Interest (%)</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-end font-normal focus:outline-none --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Action</span></div></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <?php $no = 1; ?>
                                    <?php if (isset($loan_category) && is_array($loan_category) && !empty($loan_category)): ?>
                                        <?php foreach ($loan_category as $lc_item): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><?php echo $no++; ?>.</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($lc_item->loan_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo number_format($lc_item->loan_price) . ' - ' . number_format($lc_item->loan_perday); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($lc_item->interest_formular, ENT_QUOTES, 'UTF-8'); ?>%</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                                                    <button id="hs-table-action-lc-<?php echo $lc_item->category_id; ?>" type="button" class="hs-dropdown-toggle py-1.5 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">Action<svg class="hs-dropdown-open:rotate-180 size-2.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
                                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-40 z-20 bg-white shadow-2xl rounded-lg p-2 mt-2 dark:divide-gray-700 dark:bg-gray-800 dark:border dark:border-gray-700" aria-labelledby="hs-table-action-lc-<?php echo $lc_item->category_id; ?>">
                                                        <div class="py-2 first:pt-0 last:pb-0">
                                                            <span class="block py-2 px-3 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">Choose an option</span>
                                                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-cyan-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#" data-hs-overlay="#hs-edit-loancat-modal-<?php echo $lc_item->category_id; ?>"><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>Edit</a>
                                                        </div>
                                                        <div class="py-2 first:pt-0 last:pb-0">
                                                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:ring-2 focus:ring-red-500 dark:text-red-500 dark:hover:bg-gray-700" href="<?php echo base_url("admin/delete_loancategory/{$lc_item->category_id}"); ?>" onclick="return confirm('Are you sure?')"><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="py-3 px-4 border-t border-gray-200 dark:border-gray-700 hidden" data-hs-datatable-paging="">
                    <nav class="flex items-center space-x-1"><button type="button" class="p-2.5 min-w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700" data-hs-datatable-paging-prev=""><span aria-hidden="true">«</span><span class="sr-only">Previous</span></button><div class="flex items-center space-x-1 [&>.active]:bg-gray-100 dark:[&>.active]:bg-gray-700" data-hs-datatable-paging-pages=""></div><button type="button" class="p-2.5 min-w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700" data-hs-datatable-paging-next=""><span class="sr-only">Next</span><span aria-hidden="true">»</span></button></nav>
                </div>
            </div>
        </div>
        <!-- End Card: Loan Category List Table -->

        <?php // Modals for Edit Loan Category ?>
        <?php if (isset($loan_category) && is_array($loan_category)): ?>
            <?php foreach ($loan_category as $lc_item): ?>
            <div id="hs-edit-loancat-modal-<?php echo $lc_item->category_id; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
                <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                    <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
                            <h3 class="font-bold text-gray-800 dark:text-white">Edit Loan Category: <?php echo htmlspecialchars($lc_item->loan_name, ENT_QUOTES, 'UTF-8'); ?></h3>
                            <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" data-hs-overlay="#hs-edit-loancat-modal-<?php echo $lc_item->category_id; ?>"><span class="sr-only">Close</span><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                        </div>
                        <div class="p-4 sm:p-6 overflow-y-auto">
                            <?php echo form_open("admin/update_loanCategory/{$lc_item->category_id}"); ?>
                                <div class="space-y-4">
                                    <div>
                                        <label for="modal_loan_name_<?php echo $lc_item->category_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*Loan Category Name:</label>
                                        <input type="text" id="modal_loan_name_<?php echo $lc_item->category_id; ?>" name="loan_name" value="<?php echo htmlspecialchars($lc_item->loan_name, ENT_QUOTES, 'UTF-8'); ?>" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                                    </div>
                                    <div>
                                        <label for="modal_loan_price_<?php echo $lc_item->category_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*From:</label>
                                        <input type="number" id="modal_loan_price_<?php echo $lc_item->category_id; ?>" name="loan_price" value="<?php echo htmlspecialchars($lc_item->loan_price, ENT_QUOTES, 'UTF-8'); ?>" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                                    </div>
                                     <div>
                                        <label for="modal_loan_perday_<?php echo $lc_item->category_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*To:</label>
                                        <input type="number" id="modal_loan_perday_<?php echo $lc_item->category_id; ?>" name="loan_perday" value="<?php echo htmlspecialchars($lc_item->loan_perday, ENT_QUOTES, 'UTF-8'); ?>" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                                    </div>
                                    <div>
                                        <label for="modal_interest_formular_<?php echo $lc_item->category_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*Loan Interest(%):</label>
                                        <input type="number" step="0.01" id="modal_interest_formular_<?php echo $lc_item->category_id; ?>" name="interest_formular" value="<?php echo htmlspecialchars($lc_item->interest_formular, ENT_QUOTES, 'UTF-8'); ?>" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end items-center gap-x-2 py-3">
                                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700" data-hs-overlay="#hs-edit-loancat-modal-<?php echo $lc_item->category_id; ?>">Close</button>
                                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-cyan-600 text-white hover:bg-cyan-700">Update</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <!-- End Modals -->

    </div>
</div>
<!-- ========== END MAIN CONTENT BODY ========== -->

<?php
include_once APPPATH . "views/partials/footer.php";
?>

<?php // Script for cmd+a fix for DataTables search input (if used) ?>
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
  }, 500);
});
</script>

<script>
function formatNumberWithCommas(value) {
    const numeric = value.replace(/[^0-9]/g, '');
    return numeric.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

document.addEventListener('DOMContentLoaded', function () {
    const loanPrice = document.getElementById('loan_price');
    const loanPerDay = document.getElementById('loan_perday');

    [loanPrice, loanPerDay].forEach(input => {
        input.addEventListener('input', function (e) {
            const caretPos = this.selectionStart;
            const rawValue = this.value.replace(/,/g, '');
            this.value = formatNumberWithCommas(rawValue);
            this.setSelectionRange(caretPos, caretPos);
        });
    });

    // Unformat before submitting
    document.querySelector('form').addEventListener('submit', function () {
        loanPrice.value = loanPrice.value.replace(/,/g, '');
        loanPerDay.value = loanPerDay.value.replace(/,/g, '');
    });
});
</script>
