<?php
include_once APPPATH . "views/partials/officerheader.php";
?>

<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

        <!-- Page Title / Subheader -->
        <div class="mb-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-200">
               Loan Application Form
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Loan Application Form.
            </p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div id="flash-error-toast" class="max-w-xs bg-red-500 text-sm text-red-500 rounded-xl shadow-lg" role="alert" tabindex="-1" aria-labelledby="hs-toast-solid-color-red-label">
                <div id="hs-toast-solid-color-red-label" class="flex p-4">
                    <?= htmlspecialchars($this->session->flashdata('error'), ENT_QUOTES, 'UTF-8'); ?>
                    <div class="ms-auto">
                        <button type="button" onclick="document.getElementById('flash-error-toast').style.display='none'" class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-white hover:text-white opacity-50 hover:opacity-100 focus:outline-hidden focus:opacity-100" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('massage')): ?>
            <div class="max-w-xs bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700" role="alert" tabindex="-1" aria-labelledby="hs-toast-success-example-label">
                <div class="flex p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                    </div>
                    <div class="ms-3">
                        <p id="hs-toast-success-example-label" class="text-sm text-gray-700 dark:text-neutral-400">
                            <?= $this->session->flashdata('massage'); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 md:p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Loan Application Form
                </h3>

               <?php 
$form_action = isset($existing_loan) 
    ? "oficer/modify_loanapplication/{$customer->customer_id}/{$existing_loan->loan_id}" 
    : "oficer/create_loanapplication/{$customer->customer_id}";

echo form_open($form_action, ['novalidate' => true]); 
?>


                <div class="grid sm:grid-cols-12 gap-4 sm:gap-6">

                    <!-- Loan Product -->
                    <div class="sm:col-span-4">
                        <label for="branchSelect" class="block text-sm font-medium mb-2 dark:text-gray-300">* Loan Product Name:</label>
                        <select id="branchSelect" name="category_id" class="py-3 px-4 pe-9 block w-full  border-gray-200 rounded-lg text-sm select2">
                            <option value="">Select Loan Product</option>
                            <?php foreach ($loan_category as $loan_categorys): ?>
                                <option value="<?= $loan_categorys->category_id; ?>"
                                    <?= isset($existing_loan) && $existing_loan->category_id == $loan_categorys->category_id
                                        ? 'selected' 
                                        : set_select('category_id', $loan_categorys->category_id); ?>>
                                    <?= $loan_categorys->loan_name; ?> / <?= $loan_categorys->loan_price; ?> - <?= $loan_categorys->loan_perday; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error("category_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                    </div>

                    <!-- Employee -->
                    <div class="sm:col-span-4">
                        <label for="StaffSelect" class="block text-sm font-medium mb-2 dark:text-gray-300">* Select Employee:</label>
                        <select id="StaffSelect" name="empl_id" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm">
                            <option value="">Select Officer</option>
                            <?php foreach ($empl_blanch as $empl_blanchs): ?>
                                <option value="<?= $empl_blanchs->empl_id; ?>"
                                    <?= set_select('empl_id', $empl_blanchs->empl_id, 
                                        (isset($existing_loan) && $existing_loan->empl_id == $empl_blanchs->empl_id) ||
                                        (!isset($existing_loan) && $empl_blanchs->empl_id == $empl_data->empl_id)
                                    ); ?>>
                                    <?= $empl_blanchs->empl_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error("empl_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                    </div>

                    <!-- Hidden Inputs -->
                    <input type="hidden" name="comp_id" value="<?= $_SESSION['comp_id']; ?>">
                    <input type="hidden" name="customer_id" value="<?= isset($customer) && is_object($customer) ? $customer->customer_id : ''; ?>">
                    <input type="hidden" name="blanch_id" value="<?= isset($customer) && is_object($customer) ? $customer->blanch_id : ''; ?>">
                    <input type="hidden" name="fee_status" value="YES">

                    <!-- Loan Amount -->
                    <div class="sm:col-span-4">
                        <label for="how_loan" class="block text-sm font-medium mb-2 dark:text-gray-300">* Loan Amount:</label>
                      <!-- Visible input with formatting -->
<input
    type="text"
    id="how_loan_formatted"
    placeholder="Kiasi cha mkopo kinachoombwa bila riba"
    autocomplete="off"
    required
    class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
    value="<?= set_value('how_loan', isset($existing_loan) ? number_format($existing_loan->how_loan) : ''); ?>"
>

<!-- Hidden input to submit actual number -->
<input type="hidden" id="how_loan" name="how_loan" value="<?= set_value('how_loan', isset($existing_loan) ? $existing_loan->how_loan : ''); ?>">

                        <?= form_error("how_loan", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                    </div>

                    <!-- Loan Duration -->
                    <div class="sm:col-span-4">
                        <label for="durationselect" class="block text-sm font-medium mb-2 dark:text-gray-300">* Loan Duration:</label>
                        <select id="durationselect" name="day" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm select2">
                            <option value="">Loan Duration</option>
                            <option value="1" <?= (isset($existing_loan) && $existing_loan->day == 1) ? 'selected' : set_select('day', '1'); ?>>Siku</option>
                            <option value="7" <?= (isset($existing_loan) && $existing_loan->day == 7) ? 'selected' : set_select('day', '7'); ?>>Wiki</option>
                            <option value="30" <?= (isset($existing_loan) && $existing_loan->day == 30) ? 'selected' : set_select('day', '30'); ?>>Mwezi</option>
                        </select>
                        <?= form_error("day", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                    </div>

                    <!-- Repayment Sessions -->
                    <div class="sm:col-span-4">
                        <label for="session" class="block text-sm font-medium mb-2 dark:text-gray-300">* Number of Repayment:</label>
                        <input type="number" id="session" name="session" placeholder="Andika idadi ya marejesho"
                            value="<?= set_value('session', isset($existing_loan) ? $existing_loan->session : ''); ?>"
                            autocomplete="off" required
                            class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <?= form_error("session", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                    </div>

                    <!-- Reason -->
                    <div class="sm:col-span-4">
                        <label for="reason" class="block text-sm font-medium mb-2 dark:text-gray-300">* Biashara/Kazi ya mkopaji:</label>
                        <input type="text" id="reason" name="reason" placeholder="Kazi au biashara ya mkopaji"
                            value="<?= set_value('reason', isset($existing_loan) ? $existing_loan->reason : ''); ?>"
                            autocomplete="off" required
                            class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <?= form_error("reason", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                    </div>

                    <!-- Interest Formula -->
                        <div class="sm:col-span-4">
										<label class="block text-sm font-medium mb-2 dark:text-gray-300"><b>*Interest Formular:</b></label>
										<select type="number" name="rate" class="py-3 px-4 pe-9 block w-full  border-gray-200 rounded-lg text-sm select2" required>
											<option value="">Select interest Formular</option>
											<?php foreach ($formular as $formulars): ?>	
											<option value="<?php echo $formulars->formular_name; ?>"><?php if ($formulars->formular_name == 'SIMPLE') {
												 ?>
												 SIMPLE FORMULAR
												<?php }elseif($formulars->formular_name == 'FLAT RATE'){ ?>
                                                 FLAT RATE FORMULAR
													<?php }elseif ($formulars->formular_name == 'REDUCING') {
													 ?>
													 REDUCING FORMULAR
													 <?php } ?>
													 	
													 </option>
											<?php endforeach; ?>
										</select>
									</div>

                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-center gap-x-2">
                        <button type="submit" class="py-2 px-4 btn-primary-sm bg-cyan-800 hover:bg-cyan-700 text-white">Next</button>
                    </div>
                </div>

                <?= form_close(); ?>

            </div>
        </div>
    </div>
</div>
<!-- ========== END MAIN CONTENT BODY ========== -->

<?php
include_once APPPATH . "views/partials/footer.php";
?>

<!-- Your scripts and styles below remain unchanged -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const formattedInput = document.getElementById('how_loan_formatted');
    const hiddenInput = document.getElementById('how_loan');

    function formatNumber(value) {
        return value.replace(/\D/g, '') // Remove non-digit chars
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Add commas
    }

    function unformatNumber(value) {
        return value.replace(/,/g, ''); // Remove commas
    }

    // On input, format the visible field and update hidden field with raw number
    formattedInput.addEventListener('input', function () {
        let cursorPosition = this.selectionStart;
        let originalLength = this.value.length;

        let unformatted = unformatNumber(this.value);
        hiddenInput.value = unformatted;

        this.value = formatNumber(unformatted);

        // Try to maintain cursor position
        let newLength = this.value.length;
        cursorPosition = cursorPosition + (newLength - originalLength);
        this.setSelectionRange(cursorPosition, cursorPosition);
    });

    // Initialize hidden input with unformatted value on page load
    hiddenInput.value = unformatNumber(formattedInput.value);
});
</script>
