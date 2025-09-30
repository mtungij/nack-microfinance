

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

<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

        <!-- Page Title / Subheader -->
        <div class="mb-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-200">
               Register Staff
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Register, edit, and view company staff.
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

        <!-- Card: Register Share Holder Form -->
        <div class="flex flex-col bg-white border shadow-sm r`ounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 md:p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Register Staff
                </h3>
                <?php echo form_open("admin/create_employee", ['novalidate' => true]); ?>
                    <div class="grid sm:grid-cols-12 gap-4 sm:gap-6">
                        <div class="sm:col-span-4">
                            <label for="share_name" class="block text-sm font-medium mb-2 dark:text-gray-300">* Full name:</label>
                            <input type="text" id="share_name" name="empl_name" placeholder="Full name" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('share_name'); ?>">
                            <?php echo form_error("share_name", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="share_mobile" class="block text-sm font-medium mb-2 dark:text-gray-300">* Mobile no:</label>
                            <input type="number" id="share_mobile" name="empl_no" placeholder="Mobile no" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('share_mobile'); ?>">
                            <?php echo form_error("share_mobile", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>
                        
                        <div class="sm:col-span-4">
                            <label for="share_email" class="block text-sm font-medium mb-2 dark:text-gray-300">* Email:</label>
                            <input type="email" id="share_email" name="empl_email" placeholder="Email" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('share_email'); ?>">
                            <?php echo form_error("share_email", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>


						<input type="hidden" name="comp_id" value="<?php echo $_SESSION['comp_id']; ?>">
								<input type="hidden" name="ac_status" value="empl">

							

                        <div class="sm:col-span-4">
                            <label for="blanch_id" class="block text-sm font-medium mb-2 dark:text-gray-300">*Branch:</label>
                            <select id="blanch_id" name="blanch_id" required
                                    data-hs-select='{
									"hasSearch": true,
                                        "placeholder": "Select branch",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600",
                                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-50 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-gray-800 dark:border-gray-700",
                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:focus:bg-gray-700",
                                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                      }'>
                             
                             

								
								<option value="">Select Branch</option>
								<?php foreach ($blanch as $blanchs): ?>
								<option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?></option>
								<?php endforeach; ?>
							
                            </select>
                            <?php echo form_error("blanch_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

 


<div class="sm:col-span-4">
                            <label for="position_id" class="block text-sm font-medium mb-2 dark:text-gray-300">*Position:</label>
                            <select id="position_id" name="position_id" required
                                    data-hs-select='{
									"hasSearch": true,
                                        "placeholder": "Select Position",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600",
                                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-50 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-gray-800 dark:border-gray-700",
                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:focus:bg-gray-700",
                                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                      }'>
                                
                                <option value="">Select Position</option>
								<?php foreach ($position as $positions): ?>
								<option value="<?php echo $positions->position_id; ?>"><?php echo $positions->position; ?></option>
								<?php endforeach; ?>
                            </select>
                            <?php echo form_error("position_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

					

                        <div class="sm:col-span-4">
                            <label for="share_dob" class="block text-sm font-medium mb-2 dark:text-gray-300">*System Username:</label>
                            <input type="text" id="username" name="username" placeholder="System Username" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('share_dob'); ?>">
                            <?php echo form_error("username", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

						<div class="sm:col-span-4">
                            <label for="empl_sex" class="block text-sm font-medium mb-2 dark:text-gray-300">* Gender:</label>
                            <select id="empl_sex" name="empl_sex" required
                                    data-hs-select='{
                                        "placeholder": "Select gender",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600",
                                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-50 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-gray-800 dark:border-gray-700",
                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:focus:bg-gray-700",
                                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                      }'>
                                <option value="">Select gender</option>
                                <option value="male" <?php echo set_select('empl_sex', 'male'); ?>>Male</option>
                                <option value="female" <?php echo set_select('empl_sex', 'female'); ?>>Female</option>
                            </select>
                            <?php echo form_error("share_sex", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>



						<div class="sm:col-span-4">
                            <label for="account_no" class="block text-sm font-medium mb-2 dark:text-gray-300">*Bank Account:</label>
                            <select id="account_no" name="account_no" required
                                    data-hs-select='{
									"hasSearch": true,
                                        "placeholder": "Select Bank Account",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600",
                                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-50 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-gray-800 dark:border-gray-700",
                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:focus:bg-gray-700",
                                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                      }'>
                                <option value="">Select Bank Account</option>
                                <option value="CASH" <?php echo set_select('account_no', 'CASH'); ?>>CASH</option>
                                <option value="NMB" <?php echo set_select('account_no', 'NMB'); ?>>NMB</option>
								<option value="CRDB" <?php echo set_select('account_no', 'CRDB'); ?>>CRDB</option>
                            </select>
                            <?php echo form_error("account_no", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

						<div class="sm:col-span-4">
                            <label for="salary" class="block text-sm font-medium mb-2 dark:text-gray-300">*Salary:</label>
                            <input type="number" id="salary" name="salary" placeholder="System salary" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('salary'); ?>">
                            <?php echo form_error("salary", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>


						<div class="sm:col-span-4">
                            <label for="account_no" class="block text-sm font-medium mb-2 dark:text-gray-300">*Bank Account No:</label>
                            <input type="number" id="account_no" name="account_no" placeholder="System account_no" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('account_no'); ?>">
                            <?php echo form_error("account_no", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>


						<div class="sm:col-span-4">
                            <label for="password" class="block text-sm font-medium mb-2 dark:text-gray-300">*Password:</label>
                            <input type="password" id="password" name="password" placeholder="write ur password" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('password'); ?>">
                            <?php echo form_error("password", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>


						<div class="sm:col-span-4">
                            <label for="passconf" class="block text-sm font-medium mb-2 dark:text-gray-300">*Confirm Password:</label>
                            <input type="password" id="passconf" name="passconf" placeholder="System passconf" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo set_value('passconf'); ?>">
                            <?php echo form_error("passconf", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                            
                            <p id="password-match-msg" class="text-xs mt-2"></p>

                        </div>

                    </div>

			
<!-- Table Section -->
<div id="management-access" style="display:none;" class="w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-gray-800 dark:border-gray-700">
          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
            <div>
              
              <p class="text-sm text-gray-600 uppercase font-bold dark:text-white">
              Management System Access
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
               

    <button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" type="button"
    onclick="toggleCheckboxes(this)"
    class="mb-3 px-4 py-2 bg-cyan-600 dark:bg-cyan-700 dark:text-cyan-700 text-white rounded hover:bg-cyan-700">
    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
    Chagua Zote
</button>
                
              </div>
            </div>
          </div>
       <?php foreach ($grouped_links as $group => $links): ?>
    <h2 class="text-lg font-semibold mt-6 mb-2 text-gray-800 dark:text-gray-200">
        <?= htmlspecialchars($group) ?>
    </h2>

    <div class="grid sm:grid-cols-2 mt-1 gap-2">
        <?php foreach ($links as $link): ?>
            <label for="link_<?= $link->id ?>" class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus-within:border-blue-500 focus-within:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400">
                <input
                    type="checkbox"
                    id="link_<?= $link->id ?>"
                    name="permissions[]"
                    value="<?= $link->id ?>"
                    class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500"
                >
                <span class="text-sm text-gray-700 ms-3 dark:text-gray-400">
                    <?= htmlspecialchars($link->link_name, ENT_QUOTES, 'UTF-8') ?>
                </span>
            </label>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
                    
              
        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
</div>
<!-- End Table Section -->

 <!-- Hidden field with Loan Officer ID -->
<input type="hidden" name="loan_officer_id" value="<?= $loan_officer_id ?>">

<!-- The conditional checkbox -->
<div id="loan-officer-privilege" style="display: none;" class="mt-4">
  <label class="inline-flex items-center">
    <input type="checkbox" id="can-make-payment" name="can_make_payment" class="form-checkbox text-blue-600" checked>
    <span class="ml-2 text-gray-700 dark:text-gray-300">Loan Officer have payment privilege</span>
  </label>
</div>


<div id="branch-manager-privilege" style="display: none;" class="mt-4 space-y-2">
  <label class="inline-flex items-center">
    <input type="checkbox" name="can_approve_loan" class="form-checkbox text-blue-600">
    <span class="ml-2 text-gray-700 dark:text-gray-300">Can Approve Loan</span>
  </label><br>
  <label class="inline-flex items-center">
    <input type="checkbox" name="can_disburse_loan" class="form-checkbox text-blue-600">
    <span class="ml-2 text-gray-700 dark:text-gray-300">Can Disburse Loan</span>
  </label><br>
  <label class="inline-flex items-center">
    <input type="checkbox" name="can_approve_expenses" class="form-checkbox text-blue-600">
    <span class="ml-2 text-gray-700 dark:text-gray-300">Can Approve Expenses</span>
  </label>
</div>




<div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center gap-x-2">
                            <button type="submit" class="py-2 px-4 btn-primary-sm bg-cyan-600 hover:bg-cyan-700 text-white">Save</button>
                            <button type="reset" class="py-2 px-4 btn-secondary-sm">Cancel</button>
                        </div>
                    </div>
  <?php echo form_close(); ?>
            </div>
        </div>
        <!-- End Card: Register Share Holder Form -->


        <!-- Card: Share Holder List Table -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Employee List</h2>
            </div>

            <div class="p-4" data-hs-datatable='{
                "pageLength": 10, "paging": true,
                "pagingOptions": { "pageBtnClasses": "min-w-10 h-10 inline-flex justify-center items-center text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:focus:bg-gray-700 dark:hover:bg-gray-700" },
                "language": { "zeroRecords": "<div class=\"py-10 px-5 flex flex-col justify-center items-center text-center\"><svg class=\"shrink-0 size-6 text-gray-500 dark:text-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"11\" cy=\"11\" r=\"8\"/><path d=\"m21 21-4.3-4.3\"/></svg><div class=\"max-w-sm mx-auto\"><p class=\"mt-2 text-sm text-gray-600 dark:text-gray-400\">No share holders found.</p></div></div>" }
            }'>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                    <div class="relative max-w-xs w-full">
                        <label for="shareholder-table-search" class="sr-only">Search</label>
                        <input type="text" name="shareholder-table-search" id="shareholder-table-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" placeholder="Search share holders..." data-hs-datatable-search="#shareholder_table">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3"><svg class="size-4 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg></div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="shareholder_table">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">S/No.</span></div></th>
                                        <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Name</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Phone</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Email</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-start --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Gender</span></div></th>
                                        <th scope="col" class="py-3 px-6 text-start --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Branch</span></div></th>
										
										<th scope="col" class="py-3 px-6 text-start --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Account Status</span></div></th>
                                        <th scope="col" class="py-3 px-6 text-end --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Action</span></div></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <?php $no = 1; ?>
                                    <?php if (isset($employee) && is_array($employee) && !empty($employee)): ?>
                                        <?php foreach ($employee as $employees): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><?php echo $no++; ?>.</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($employees->empl_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($employees->empl_no, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($employees->empl_email, ENT_QUOTES, 'UTF-8'); ?></td>
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($employees->empl_sex, ENT_QUOTES, 'UTF-8'); ?></td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo ucfirst(htmlspecialchars($employees->blanch_name, ENT_QUOTES, 'UTF-8')); ?></td>
										
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">											<?php
$status = strtolower($employees->empl_status);   // e.g. "open" or "close"

if ($status === 'open') { ?>
   
	<div>
      <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
          <path d="m9 12 2 2 4-4"></path>
        </svg>
        Active
      </span>
    </div>

<?php } elseif ($status === 'close') { ?>
	<div>
      <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
          <path d="M12 9v4"></path>
          <path d="M12 17h.01"></path>
        </svg>
        Blocked
      </span>
    </div>

<?php } ?></td>

                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                                                    <button id="hs-table-action-sh-<?php echo $employees->account_no; ?>" type="button" class="hs-dropdown-toggle py-1.5 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">Action<svg class="hs-dropdown-open:rotate-180 size-2.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
                                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-40 z-20 bg-white shadow-2xl rounded-lg p-2 mt-2 dark:divide-gray-700 dark:bg-gray-800 dark:border dark:border-gray-700" aria-labelledby="hs-table-action-sh-<?php echo $employees->empl_id; ?>">
                                                        <div class="py-2 first:pt-0 last:pb-0">
                                                            <span class="block py-2 px-3 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">Choose an option</span>
                                                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-cyan-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#" data-hs-overlay="#hs-edit-shareholder-modal-<?php echo $employees->empl_id; ?>"><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>Edit</a>
                                                        </div>
                                                        <div class="py-2 first:pt-0 last:pb-0">
                                                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:ring-2 focus:ring-red-500 dark:text-red-500 dark:hover:bg-gray-700" href="<?php echo base_url("admin/delete_employee/{$employees->empl_id}"); ?>" onclick="return confirm('Are you sure?')"><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>Delete</a>
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
        <!-- End Card: Share Holder List Table -->

        <?php // Modals for Edit Share Holder ?>
        <?php if (isset($employee) && is_array($employee)): ?>
            <?php foreach ($employee as $employees): ?>
            <div id="hs-edit-shareholder-modal-<?php echo $employees->empl_id; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
                <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all lg:max-w-3xl lg:w-full m-3 lg:mx-auto"> <?php // Wider modal for more fields ?>
                    <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
                            <h3 class="font-bold text-gray-800 dark:text-white">Edit Staff: <?php echo htmlspecialchars($employees->empl_name, ENT_QUOTES, 'UTF-8'); ?></h3>
                            <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" data-hs-overlay="#hs-edit-shareholder-modal-<?php echo $employees->empl_id; ?>"><span class="sr-only">Close</span><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                        </div>
                        <div class="p-4 sm:p-6 overflow-y-auto">
						<?php echo form_open("admin/modify_employee/{$employees->empl_id}"); ?>
                              



								<div class="grid sm:grid-cols-12 gap-4 sm:gap-6">
                        <div class="sm:col-span-4">
						<label for="empl_name_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">* Staff name:</label>
							<input class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600 type="text" id="empl_name_<?php echo $employees->empl_id; ?>" name="empl_name" value="<?php echo htmlspecialchars($employees->empl_name, ENT_QUOTES, 'UTF-8'); ?>" class="py-2.5 px-4 input-text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>

					

                        <div class="sm:col-span-4">
                            <label for="share_mobile_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">* Mobile no:</label>
                            <input type="number" id="share_mobile_<?php echo $employees->empl_id; ?>" name="empl_no" placeholder="Mobile no" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo htmlspecialchars($employees->empl_no, ENT_QUOTES, 'UTF-8'); ?>">
                            
                        </div>
                        
                        <div class="sm:col-span-4">
                            <label for="empl_email_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">* Email:</label>
                            <input type="email" id="empl_email_<?php echo $employees->empl_id; ?>" name="empl_email" placeholder="Email" autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600"  value="<?php echo htmlspecialchars($employees->empl_email, ENT_QUOTES, 'UTF-8'); ?>">
                            
                        </div>


				

                        <div class="sm:col-span-4">
                            <label for="blanch_id_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*Branch Name:</label>
                            <select id="blanch_id_<?php echo $employees->empl_id; ?>" name="blanch_id" 
                                    data-hs-select='{
									"hasSearch": true,
                                        "placeholder": "Select branch",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600",
                                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-50 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-gray-800 dark:border-gray-700",
                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:focus:bg-gray-700",
                                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                      }'>
                             
                             

								
								<option value="">Select Branch</option>
								<?php foreach ($blanch as $blanchs): ?>
        <option value="<?= $blanchs->blanch_id; ?>"
            <?= ($blanchs->blanch_id == $employees->blanch_id) ? 'selected' : ''; ?>>
            <?= htmlspecialchars($blanchs->blanch_name, ENT_QUOTES, 'UTF-8'); ?>
        </option>
    <?php endforeach; ?>
							
                            </select>
                            
                        </div>

						<div class="sm:col-span-4">
                            <label for="position_id_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*Position:</label>
                            <select id="position_id_<?php echo $employees->empl_id; ?>" name="position_id" 
                                    data-hs-select='{
									"hasSearch": true,
                                        "placeholder": "Select Position",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600",
                                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-50 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-gray-800 dark:border-gray-700",
                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:focus:bg-gray-700",
                                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                      }'>
                                
                                <option value="">Select Position</option>
								<?php foreach ($position as $positions): ?>
        <option value="<?= $positions->position_id; ?>"
                <?= ($positions->position_id == $employees->position_id) ? 'selected' : ''; ?>>
            <?= htmlspecialchars($positions->position, ENT_QUOTES, 'UTF-8'); ?>
        </option>
    <?php endforeach; ?>
                            </select>
                            <?php echo form_error("position_id", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="username_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*System Username:</label>
                            <input type="text" id="username_<?php echo $employees->empl_id; ?>" name="username" placeholder="System Username" autocomplete="off" 
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo htmlspecialchars($employees->username, ENT_QUOTES, 'UTF-8'); ?>">
                           
                        </div>

						

<input type="hidden" id="branch_manager_id" value="<?= $branch_manager_id ?>">


						<div class="sm:col-span-4">
                            <label for="account_no_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*Bank Account:</label>
                            <select id="account_no_<?php echo $employees->empl_id; ?>" name="bank_account"
                                    data-hs-select='{
									"hasSearch": true,
                                        "placeholder": "Select Bank Name",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-gray-600",
                                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-50 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-gray-800 dark:border-gray-700",
                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200 dark:focus:bg-gray-700",
                                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                      }'>

									  
                               
							

								 <option value="CASH" <?php echo ($employees->bank_account == 'CASH') ? 'selected' : ''; ?>>CASH</option>
                                <option value="NMB" <?php echo ($employees->bank_account  == 'NMB') ? 'selected' : ''; ?>>NMB</option>
								<option value="CRDB" <?php echo ($employees->bank_account  == 'CRDB') ? 'selected' : ''; ?>>CRDB</option>
                            </select>
                            <?php echo form_error("account_no", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

						<div class="sm:col-span-4">
                            <label for="salary_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*Salary:</label>
                            <input type="number" id="salary_<?php echo $employees->empl_id; ?>" name="salary" placeholder="System salary" autocomplete="off" 
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo htmlspecialchars($employees->salary, ENT_QUOTES, 'UTF-8'); ?>">
                            
                        </div>


						<div class="sm:col-span-4">
                            <label for="account_no_<?php echo $employees->empl_id; ?>" class="block text-sm font-medium mb-2 dark:text-gray-300">*Bank Account No:</label>
                            <input type="number" id="account_no_<?php echo $employees->empl_id; ?>" name="account_no" placeholder="System account_no" autocomplete="off" 
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" value="<?php echo htmlspecialchars($employees->account_no, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo form_error("account_no", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
                        </div>

                    </div>






                                <div class="mt-6 flex justify-end items-center gap-x-2 py-3">
                                    <button type="button" class="py-2 px-3 btn-secondary-sm" data-hs-overlay="#hs-edit-shareholder-modal-<?php echo $employees->empl_id; ?>">Close</button>
                                    <button type="submit" class="py-2 px-3 btn-primary-sm bg-cyan-600 hover:bg-cyan-700 text-white">Update</button>
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
document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('passconf');
    const message = document.getElementById('password-match-msg');

    // Message for min length
    const minLengthMsg = document.createElement('p');
    minLengthMsg.classList.add('text-xs', 'mt-2');
    passwordInput.parentNode.appendChild(minLengthMsg);

    function validatePasswords() {
        if (confirmInput.value.length === 0) {
            message.textContent = '';
            return;
        }

        if (passwordInput.value === confirmInput.value) {
            message.textContent = 'Password zimefanana ✅';
            message.classList.remove('text-red-600');
            message.classList.add('text-green-600');
        } else {
            message.textContent = 'Password hazijafanana ❌';
            message.classList.remove('text-green-600');
            message.classList.add('text-red-600');
        }
    }

    passwordInput.addEventListener('input', function () {
        const length = passwordInput.value.length;

        if (length > 0 && length < 6) {
            minLengthMsg.textContent = 'Password lazima iwe na angalau kwanzia herufi 6 kuendelea ❌';
            minLengthMsg.classList.remove('text-green-600');
            minLengthMsg.classList.add('text-red-600');
        } else if (length >= 6) {
            minLengthMsg.textContent = 'Urefu wa password umekubalika ✅';
            minLengthMsg.classList.remove('text-red-600');
            minLengthMsg.classList.add('text-green-600');
        } else {
            minLengthMsg.textContent = '';
        }
    });

    passwordInput.addEventListener('input', validatePasswords);
    confirmInput.addEventListener('input', validatePasswords);
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
function toggleCheckboxes(button) {
    const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
    const allChecked = [...checkboxes].every(cb => cb.checked);

    checkboxes.forEach(cb => cb.checked = !allChecked);

    button.textContent = allChecked ? 'Chagua Zote' : 'Ondoa Zote';
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fullNameInput = document.getElementById('share_name');
    const usernameInput = document.getElementById('username');

    // Flag kuonyesha kama username bado inahifadhiwa ki-automatic
    let isUsernameEdited = false;

    // Kama mtumiaji anabadilisha username, tunaweka flag ili isiwe auto-updated tena
    usernameInput.addEventListener('input', function() {
        isUsernameEdited = true;
    });

    // Kila wakati mtumiaji anaandika full name, kama username haijahaririwa, update username
    fullNameInput.addEventListener('input', function () {
        if (!isUsernameEdited) {
            usernameInput.value = fullNameInput.value;
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const positionSelect = document.getElementById('position_id');
    const managementAccessDiv = document.getElementById('management-access');

    // Hii itakuja kutoka controller yako - id ya "management"
    const managementId = '<?php echo $management_id; ?>';

    function toggleManagementAccess() {
        if (positionSelect.value === managementId) {
            managementAccessDiv.style.display = 'block';  // Onyesha
        } else {
            managementAccessDiv.style.display = 'none';   // Ficha
        }
    }

    // Pima mara moja page inapopakia (in case kuna value tayari)
    toggleManagementAccess();

    // Sikiliza mabadiliko kwenye dropdown
    positionSelect.addEventListener('change', toggleManagementAccess);
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const positionSelect = document.getElementById('position_id');
    const loanOfficerDiv = document.getElementById('loan-officer-privilege');
    const loanOfficerId = "<?= $loan_officer_id ?>";

    function toggleLoanOfficerPrivilege() {
        loanOfficerDiv.style.display = (positionSelect.value === loanOfficerId) ? 'block' : 'none';
    }

    toggleLoanOfficerPrivilege();
    positionSelect.addEventListener('change', toggleLoanOfficerPrivilege);
});

    </script>

 <script>
document.addEventListener('DOMContentLoaded', function () {
    const positionSelect = document.getElementById('position_id');
    const branchManagerId = document.getElementById('branch_manager_id')?.value;
    const privilegeDiv = document.getElementById('branch-manager-privilege');

    function toggleBranchManagerPrivileges() {
        if (positionSelect.value === branchManagerId) {
            privilegeDiv.style.display = 'block';
        } else {
            privilegeDiv.style.display = 'none';
        }
    }

    // Listen for changes
    positionSelect.addEventListener('change', toggleBranchManagerPrivileges);

    // Run once on page load
    toggleBranchManagerPrivileges();
});
</script>


