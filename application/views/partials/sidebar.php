



<?php
// application/views/partials/sidebar.php

// Helper function to determine if a link is active (basic example)
// You might have a more sophisticated way to manage this, perhaps passing $active_page from controller
function is_active_link($link_segment) {
    $CI =& get_instance();
    // Compare with the first or second URI segment, adjust as needed
    if ($CI->uri->segment(1) == $link_segment || $CI->uri->segment(2) == $link_segment) {
        return true;
    }
    // Check for specific full paths if needed
    if (current_url() == base_url($link_segment)) {
        return true;
    }
    return false;
}

// Example for checking submenu activity - more complex
function is_submenu_active($submenu_segments = []) {
    $CI =& get_instance();
    foreach ($submenu_segments as $segment) {
        if ($CI->uri->segment(1) == $segment || $CI->uri->segment(2) == $segment) {
            return true;
        }
    }
    return false;
}

$dashboard_active = is_active_link('admin/index'); // Example: assuming admin/index is dashboard
$branch_active = is_active_link('admin/blanch');
$groups_active = is_active_link('admin/group');
$notification_active = is_active_link('admin/create_notifications');
$customer_notifications_active = is_active_link('admin/customer_notifications');
$loan_calculator =is_active_link('admin/loan_calculator');

$setting_submenu_active = is_submenu_active(['loan_category', 'loan_fee', 'penart_setting', 'formular_setting', 'transaction_account']);
$capital_submenu_active = is_submenu_active(['shareHolder', 'capital', 'transfar_amount']);
$expenses_income_submenu_active = is_submenu_active(['expenses', 'expnses_requisition_form', 'get_recomended_request', 'income_detail', 'income_dashboard', 'deducted_income', 'deducted_income_sumary', 'deduction_branch_company', 'income_balance']);
$employee_submenu_active = is_submenu_active(['employee', 'all_employee', 'view_blanchEmployee', 'leave', 'salary_sheet', 'employee_allowance', 'employee_deduction']);
$customer_submenu_active = is_submenu_active(['customer', 'all_customer']);
$loan_submenu_active = is_submenu_active(['loan_application', 'loan_pending', 'get_loan_aproved', 'disburse_loan', 'loan_withdrawal', 'all_loan_lejected', 'loanpending_groups', 'parsonal_pending_loan']);
$group_loan_submenu_active = is_submenu_active(['loanpending_groups', 'general_operation', 'group_list']); // Note: 'loanpending_groups' is repeated, which is fine if intended
$teller_dashboard_active = is_active_link('admin/teller_dashboard');
$report_submenu_active = is_submenu_active(['cash_transaction', 'blanchiwise_report', 'loan_pending_time', 'repaymant_data', 'get_outstand_loan', 'loan_collection', 'search_customer_loan_report', 'customer_account_statement', 'today_recevable_loan', 'today_receved_loan', 'teller_oficer', 'teller_trasior', 'daily_report', 'loan_oficer_expectation', 'next_expectation']);
$accounting_report_submenu_active = is_submenu_active(['loss_profit', 'cash_flow', 'saving_deposit']);
$cash_book_active = is_active_link('admin/get_cashInHand_Data');
$communication_submenu_active = is_submenu_active(['send_email']); // Assuming SMS link might be external or different

?>
<!-- ========== SIDEBAR ========== -->
<div id="hs-application-sidebar" class="hs-overlay [--auto-close:lg]
  hs-overlay-open:translate-x-0
  -translate-x-full transition-all duration-300
  transform w-64 hidden
  fixed inset-y-0 start-0 z-40
  lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
  border-e border-gray-200
  bg-white dark:bg-gray-800 dark:border-gray-700

  overflow-y-auto max-h-screen">

  <div class="px-6 pt-4 pb-2 border-b border-gray-200 dark:border-gray-700">
    <!-- Logo and Company Name -->
    <a class="flex flex-col items-center gap-2 focus:outline-none focus:ring-1 focus:ring-gray-600" href="<?php echo base_url("admin/index"); ?>" aria-label="Brand">
      <?php if (!empty($this->session->userdata('company_logo'))): ?>
        <img class="h-12 w-12 sm:h-16 sm:w-16 rounded-lg object-cover shadow-md" 
             src="<?php echo base_url('assets/images/company_logo/' . $this->session->userdata('company_logo')); ?>" 
             alt="Company Logo">
      <?php else: ?>
        <div class="h-12 w-12 sm:h-16 sm:w-16 rounded-lg bg-cyan-100 dark:bg-cyan-900 flex items-center justify-center">
          <svg class="h-8 w-8 text-cyan-600 dark:text-cyan-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1.49 15.326a.78.78 0 0 1-.358-.442 3 3 0 0 1 4.308-3.516 6.484 6.484 0 0 0-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 0 1-2.07-.655ZM16.44 15.98a4.97 4.97 0 0 0 2.07-.654.78.78 0 0 0 .357-.442 3 3 0 0 0-4.308-3.517 6.484 6.484 0 0 1 1.907 3.96 2.32 2.32 0 0 1-.026.654ZM18 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5.304 16.19a.844.844 0 0 1-.277-.71 5 5 0 0 1 9.947 0 .843.843 0 0 1-.277.71A6.975 6.975 0 0 1 10 18a6.974 6.974 0 0 1-4.696-1.81Z" />
          </svg>
        </div>
      <?php endif; ?>
      
      <span class="text-sm sm:text-base font-semibold text-gray-800 dark:text-white text-center leading-tight">
        <?php echo !empty($this->session->userdata('comp_name')) ? htmlspecialchars($this->session->userdata('comp_name')) : 'Loan Management System'; ?>
      </span>
    </a>
    <!-- End Logo and Company Name -->
  </div>


  <!-- <pre></?php print_r($this->session->userdata('permissions')); ?></pre> -->









  <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
    <ul class="space-y-1.5">
      <li>
      <?php if (has_permission('Dashboard')): ?>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $dashboard_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("admin/index"); ?>">
          <!-- SVG: Home/Dashboard Icon (Heroicons: home) -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" /></svg>
          Dashboard
        </a>
        <?php endif; ?>
      </li>
      
    <li>
      <?php if (has_permission('Sajili Tawi Jipya')): ?>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $notification_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("admin/create_notifications"); ?>">
          <!-- SVG: Megaphone Icon -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13.92 3.845a19.361 19.361 0 0 1-6.3 1.98C6.765 5.942 5.89 6 5 6a4 4 0 0 0-.504 7.969 15.974 15.974 0 0 0 1.271 3.341c.397.77 1.342 1 2.05.59l.867-.5c.726-.42.94-1.321.588-2.021-.166-.33-.315-.666-.448-1.008 1.053.286 2.227.504 3.476.695V17a1 1 0 0 0 1.447.894l1--.5A1 1 0 0 0 16 16.382V4.618a1 1 0 0 0-1.447-.894l-1 .5a1 1 0 0 0-.553 1.012c-.337-.116-.67-.227-1.08-.391Z" />
          </svg>
          Manage Notifications
        </a>
        <?php endif; ?>
      </li>

    <li>
      <?php if (has_permission('Sajili Tawi Jipya')): ?>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $customer_notifications_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("admin/customer_notifications"); ?>">
          <!-- SVG: Bell Notification Icon -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a6 6 0 0 0-6 6v3.586l-.707.707A1 1 0 0 0 4 14h12a1 1 0 0 0 .707-1.707L16 11.586V8a6 6 0 0 0-6-6ZM10 18a3 3 0 0 1-3-3h6a3 3 0 0 1-3 3Z" />
          </svg>
          Customer Notifications
        </a>
        <?php endif; ?>
      </li>

        <li>
     
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $loan_calculator ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("admin/loan_calculator"); ?>">
<svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <title>Calculator</title>
  <rect x="6" y="2" width="12" height="20" rx="2" ry="2" stroke-width="1.5"></rect>
  <rect x="9" y="6" width="6" height="3" rx="0.5" ry="0.5" stroke-width="1.5"></rect>
  <g stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="9.5" cy="13" r="0.7" fill="currentColor"></circle>
    <circle cx="13.5" cy="13" r="0.7" fill="currentColor"></circle>
    <circle cx="9.5" cy="16" r="0.7" fill="currentColor"></circle>
    <circle cx="13.5" cy="16" r="0.7" fill="currentColor"></circle>
    <rect x="9" y="9.5" width="6" height="0.5" fill="currentColor"></rect>
  </g>
</svg>

          Loan Calculator
        </a>
       
      </li>

      <li>
      <?php if (has_permission('Sajili Tawi Jipya')): ?>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $branch_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("admin/blanch"); ?>">
          <!-- SVG: Branch Icon (Heroicons: building-office or similar) -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.25 3.25A1.75 1.75 0 0 0 9.5 5v10H5.75a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5H12.5V5A1.75 1.75 0 0 0 10.75 3.25H9.5Zm-2.5 6.5h.01a.75.75 0 0 0 0 1.5H8.75a.75.75 0 0 0 0-1.5ZM10.5 9.75h.01a.75.75 0 0 0 0 1.5H10.5a.75.75 0 0 0 0-1.5ZM8.75 12.25h.01a.75.75 0 0 0 0 1.5H8.75a.75.75 0 0 0 0-1.5ZM10.5 12.25h.01a.75.75 0 0 0 0 1.5H10.5a.75.75 0 0 0 0-1.5Z" clip-rule="evenodd" /></svg>
          Tawi
        </a>
        <?php endif; ?>
      </li>
      <li>
      <?php if (has_permission('Sajili Jina La Kikundi (mikopo ya Vikundi)')): ?>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $groups_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("admin/group"); ?>">
          <!-- SVG: Groups Icon (Heroicons: users) -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.25 1.25 0 0 0 .421-.953V12.5a4.25 4.25 0 0 1 8.5 0v1.04a1.25 1.25 0 0 0 .421.953l-.002.002a5.75 5.75 0 0 1-9.339 0l-.002-.002ZM13.083 10.933a3.25 3.25 0 0 1-2.916 1.717.75.75 0 0 0-.033.03l-.002-.002a4.75 4.75 0 0 0-8.264 0l-.002.002a.75.75 0 0 0-.033-.03A3.25 3.25 0 0 1 .25 12.5V11.5a.75.75 0 0 1 1.5 0v1a1.75 1.75 0 0 0 3.5 0v-1a.75.75 0 0 1 1.5 0v1a1.75 1.75 0 0 0 3.5 0v-1a.75.75 0 0 1 1.5 0v1a1.75 1.75 0 0 0 2.009 1.665A2.75 2.75 0 0 0 17.5 15.5v-1a.75.75 0 0 1 1.5 0v1a4.25 4.25 0 0 1-4.25 4.25h-1.53a.75.75 0 0 1-.629-.349l-.001-.003a2.25 2.25 0 0 0-4.18 0l-.001.003a.75.75 0 0 1-.629.349H5.75A4.25 4.25 0 0 1 1.5 15.5v-1a.75.75 0 0 1 1.5 0v1a2.75 2.75 0 0 0 2.75 2.75h.04a3.75 3.75 0 0 1 7.42 0h.04a2.75 2.75 0 0 0 2.75-2.75v-1a.75.75 0 0 1 .917-.74A3.25 3.25 0 0 1 13.083 10.933Z" /></svg>
          Register Groups
        </a>
        <?php endif; ?>
      </li>

      <!-- Settings Accordion -->
      <li class="hs-accordion <?php echo $setting_submenu_active ? 'active' : ''; ?>" id="settings-accordion">
        <button type="button"
                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $setting_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
          <!-- SVG: Settings Icon (Heroicons: cog-6-tooth) -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 0 1-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 0 1 .947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 0 1 2.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 0 1 2.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 0 1-.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 0 1-.947-2.287c.836-1.372-.734-2.942-2.106-2.106A1.532 1.532 0 0 1 11.49 3.17ZM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          Setting
          <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4 <?php echo $setting_submenu_active ? 'text-gray-600 dark:text-gray-400' : 'text-gray-600 group-hover:text-gray-500 dark:text-gray-400'; ?>"
               xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6"/>
          </svg>
        </button>

        <div id="settings-accordion-child"
             class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $setting_submenu_active ? '' : 'hidden'; ?>">
          <ul class="pt-2 ps-2">
          <?php if (has_permission('Product Za Mikopo')): ?>
            <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loan_category') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
                 href="<?php echo base_url("admin/loan_category"); ?>">
                Loan Category
              </a>
            </li>
            <?php endif; ?>
            <?php if (has_permission('Ada Za Mikopo')): ?>
            <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loan_fee') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
                 href="<?php echo base_url("admin/loan_fee"); ?>">
                Loan Fee
              </a>
            </li>
            <?php endif; ?>
            <?php if (has_permission('Faini za Mikopo')): ?>
            <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/penart_setting') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
                 href="<?php echo base_url("admin/penart_setting"); ?>">
                Penalty Setting
              </a>
            </li>
            <?php endif; ?>
            <?php if (has_permission('Faini za Mikopo')): ?>
             <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/formular_setting') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
                 href="<?php echo base_url("admin/formular_setting"); ?>">
                Interest Formular Setting
              </a>
            </li>
            <?php endif; ?>
            <?php if (has_permission('Faini za Mikopo')): ?>
             <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/transaction_account') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
                 href="<?php echo base_url("admin/transaction_account"); ?>">
                Transaction Accounts
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </li>
      <!-- End Settings Accordion -->
     
      <!-- Capital Accordion -->
      <li class="hs-accordion <?php echo $capital_submenu_active ? 'active' : ''; ?>" id="capital-accordion">
        <button type="button"
                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $capital_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
          <!-- SVG: Layer/Capital Icon (Heroicons: bank-notes or CircleStackIcon) -->
           <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 10.028a2.5 2.5 0 1 0-1.5 0A2.5 2.5 0 0 0 10.75 10.028ZM2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Z" /><path d="M11 2.255a.75.75 0 0 1 1.5 0v2.58a12.07 12.07 0 0 0-1.5-.168V2.255Z" /><path d="M9 2.255v2.412a12.07 12.07 0 0 0-1.5.168V2.255a.75.75 0 0 1 1.5 0Z" /><path d="M15.168 4.832a.75.75 0 0 1 .108 1.056l-2.25 3.499a.75.75 0 0 1-1.165 0l-2.25-3.499a.75.75 0 1 1 1.166-.752L12.1 6.67l1.323-2.053a.75.75 0 0 1 1.056-.108.75.75 0 0 1 .108 1.056L12.1 9.33l1.323 2.053a.75.75 0 1 1-1.166.752l-2.25-3.499a.75.75 0 0 1 1.165 0l2.25 3.499a.75.75 0 0 1-.108 1.056.75.75 0 0 1-1.056-.108L10.85 10.934l-1.323 2.053a.75.75 0 1 1-1.166-.752l2.25-3.499a.75.75 0 0 1 0-1.165l-2.25-3.499a.75.75 0 0 1 1.166-.752l1.323 2.053L13.944 4.724a.75.75 0 0 1 1.056.108Z" /><path d="M4.832 15.168a.75.75 0 0 1 1.056-.108l3.499-2.25a.75.75 0 0 1 0-1.165l-3.499-2.25a.75.75 0 1 1 .752-1.166L9.33 10.9l-2.053 1.323a.75.75 0 0 1-1.056.108.75.75 0 0 1-.108-1.056l2.053-1.323L6.67 7.9a.75.75 0 1 1 .752 1.166l-3.499 2.25a.75.75 0 0 1-1.165 0l-3.499-2.25a.75.75 0 0 1 .108-1.056.75.75 0 0 1 1.056.108L4.066 9.15l2.053-1.323a.75.75 0 1 1 .752 1.166l-3.499 2.25a.75.75 0 0 1 0 1.165l3.499 2.25a.75.75 0 0 1-.752 1.166L2.276 13.323a.75.75 0 0 1-.108-1.056.75.75 0 0 1 1.056-.108Z" /></svg>
          Capital
          <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4 <?php echo $capital_submenu_active ? 'text-gray-600 dark:text-gray-400' : 'text-gray-600 group-hover:text-gray-500 dark:text-gray-400'; ?>"
               xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6"/>
          </svg>
        </button>
        <div id="capital-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $capital_submenu_active ? '' : 'hidden'; ?>">
            <ul class="pt-2 ps-2">
            <?php if (has_permission('Wanahisa (ShareHolders)')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/shareHolder') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/shareHolder"); ?>">Share Holder</a></li>
                <?php endif; ?>
                <?php if (has_permission('Record mtaji Wa Kampuni')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/capital') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/capital"); ?>">Add Capital</a></li>
                <?php endif; ?>
                <?php if (has_permission('Gawa Float Tawini')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/transfar_amount') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/transfar_amount"); ?>">Float</a></li>
                <?php endif; ?>
            </ul>
        </div>
      </li>
      <!-- End Capital Accordion -->

      <!-- Expenses & Income Accordion (Potentially Nested) -->
      <?php // This one was nested in your old menu. Preline accordions can be nested too. ?>
      <li class="hs-accordion <?php echo $expenses_income_submenu_active ? 'active' : ''; ?>" id="expenses-income-accordion">
        <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $expenses_income_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
          <!-- SVG: ArrowPathIcon or ArrowsRightLeftIcon for Expenses/Income -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v1.512c4.675.044 8.5 3.866 8.5 8.563V15a.75.75 0 0 1-1.5 0v-.937c0-3.941-3.121-7.125-7-7.125H10.5a.75.75 0 0 1-.75-.75V3.75A.75.75 0 0 1 10 3ZM8.75 6.75a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M10 17a.75.75 0 0 1-.75-.75v-1.512c-4.675-.044-8.5-3.866-8.5-8.563V5a.75.75 0 0 1 1.5 0v.937c0 3.941 3.121 7.125 7 7.125H9.5a.75.75 0 0 1 .75.75v1.75a.75.75 0 0 1-.75.75Zm1.25-6.75a.75.75 0 0 1-.75.75h-4.5a.75.75 0 0 1 0-1.5h4.5a.75.75 0 0 1 .75.75Z" clip-rule="evenodd" /></svg>
          Expenses & Income
          <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </button>
        <div id="expenses-income-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $expenses_income_submenu_active ? '' : 'hidden'; ?>">
          <ul class="pt-2 ps-2 space-y-1.5">
            <!-- Expenses Nested Accordion -->
            <li class="hs-accordion <?php echo is_submenu_active(['expenses', 'expnses_requisition_form', 'get_recomended_request']) ? 'active' : ''; ?>" id="expenses-sub-accordion">
              <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_submenu_active(['expenses', 'expnses_requisition_form', 'get_recomended_request']) ? 'text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
                <!-- SVG: MinusCircleIcon for Expenses -->
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z" clip-rule="evenodd" /></svg>
                Expenses
                <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
              </button>
              <div id="expenses-sub-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo is_submenu_active(['expenses', 'expnses_requisition_form', 'get_recomended_request']) ? '' : 'hidden'; ?>">
                <ul class="pt-2 ps-4">
                <?php if (has_permission('Sajili Matumizi Ya Ofisi')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/expenses') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/expenses"); ?>">Register Expenses</a></li>
                  <?php endif; ?>
                  <!-- <?php if (has_permission('Record Matumizi ')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/expnses_requisition_form') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/expnses_requisition_form"); ?>">Expenses</a></li>
                  <?php endif; ?> -->
                  <!-- <?php if (has_permission('Pitisha Matumizi')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/get_expences_notAcceptable') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/get_expences_notAcceptable"); ?>">Expenses Request</a></li>
                  <?php endif; ?> -->
                 
                  <?php if (has_permission('Matumizi yote')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/get_recomended_request') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/get_recomended_request"); ?>">Accepted Expenses</a></li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
            <!-- End Expenses Nested Accordion -->
            <!-- Income Nested Accordion -->
            <li class="hs-accordion <?php echo is_submenu_active(['income_detail', 'income_dashboard', 'deducted_income', 'deducted_income_sumary', 'deduction_branch_company', 'income_balance']) ? 'active' : ''; ?>" id="income-sub-accordion">
              <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_submenu_active(['income_detail', 'income_dashboard', 'deducted_income', 'deducted_income_sumary', 'deduction_branch_company', 'income_balance']) ? 'text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
                <!-- SVG: PlusCircleIcon for Income -->
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z" clip-rule="evenodd" /></svg>
                Income
                <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
              </button>
              <div id="income-sub-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo is_submenu_active(['income_detail', 'income_dashboard', 'deducted_income', 'deducted_income_sumary', 'deduction_branch_company', 'income_balance']) ? '' : 'hidden'; ?>">
                 <ul class="pt-2 ps-4">
                 <?php if (has_permission('Faini za Mikopo')): ?>
                    <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/income_detail') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/income_detail"); ?>">Register Income</a></li>
                    <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/income_dashboard') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/income_dashboard"); ?>">Income Dashboard</a></li>
                    <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/deducted_income') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/deducted_income"); ?>">Deducted Income</a></li>
                    <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/non_deducted_income_placeholder') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/income_dashboard"); ?>">Non- Deducted Income</a></li> <?php // Note: URL was same as income dashboard ?>
                    <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/deducted_income_sumary') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/deducted_income_sumary"); ?>">Transfer Branch To Branch</a></li>
                    <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/deduction_branch_company') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/deduction_branch_company"); ?>">Transfer Branch To company</a></li>
                    <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/income_balance') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/income_balance"); ?>">Income Balance</a></li>
                    <?php endif; ?>
                 </ul>
              </div>
            </li>
            <!-- End Income Nested Accordion -->
          </ul>
        </div>
      </li>
      <!-- End Expenses & Income Accordion -->

      <!-- Employee Accordion -->
      <li class="hs-accordion <?php echo $employee_submenu_active ? 'active' : ''; ?>" id="employee-accordion">
        <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $employee_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
          <!-- SVG: UserGroupIcon for Employee -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.25 1.25 0 0 0 .421-.953V12.5a4.25 4.25 0 0 1 8.5 0v1.04a1.25 1.25 0 0 0 .421.953l-.002.002a5.75 5.75 0 0 1-9.339 0l-.002-.002ZM12.243 20a2.75 2.75 0 0 0 2.063-4.631L11.5 12.665l.081-.087.019-.023a1.75 1.75 0 0 0-2.202-2.53L5.572 12.67a.75.75 0 0 1-1.023-.02L2.05 10.873a.75.75 0 0 0-1.122.96l1.516 3.3a2.75 2.75 0 0 0 4.414 1.666l2.443-1.536a1.25 1.25 0 0 1 1.413 0l2.443 1.536A2.75 2.75 0 0 0 12.243 20Z" /></svg>
          Employee
          <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </button>
        <div id="employee-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $employee_submenu_active ? '' : 'hidden'; ?>">
            <ul class="pt-2 ps-2">
            <?php if (has_permission('Sajili Staff Mpya')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/employee') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/employee"); ?>">Register Employee</a></li>
                <?php endif; ?>
                <?php if (has_permission('block/hamisha Tawi Staff')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/all_employee') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/all_employee"); ?>">All Employee</a></li>
                <?php endif; ?>
                <?php if (has_permission('Ona Staff Wote Matawini')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/view_blanchEmployee') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/view_blanchEmployee"); ?>">All Branch & Employee</a></li>
                <?php endif; ?>
                <!-- <?php if (has_permission('Record Likizo Ya Staff')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/leave') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/leave"); ?>">Employee Leave</a></li>
                <?php endif; ?> -->
                <?php if (has_permission('Sheet Ya Mishahara ya Staff')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/salary_sheet') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/salary_sheet"); ?>">Salary Sheet</a></li>
                <?php endif; ?>
                <!-- <?php if (has_permission('Posho ya Mfanyakazi')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/employee_allowance') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/employee_allowance"); ?>">Employee Allowance</a></li>
                <?php endif; ?> -->
                <?php if (has_permission('Faini za kopo')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/employee_deduction') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/employee_deduction"); ?>">Employee Deduction</a></li>
                <?php endif; ?>
            </ul>
        </div>
      </li>
      <!-- End Employee Accordion -->

       <!-- Customer Accordion -->
      <li class="hs-accordion <?php echo $customer_submenu_active ? 'active' : ''; ?>" id="customer-accordion">
        <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $customer_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
            <!-- SVG: IdentificationIcon -->
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v11A1.5 1.5 0 0 0 2.5 17h15A1.5 1.5 0 0 0 19 15.5v-11A1.5 1.5 0 0 0 17.5 3h-15Zm14.5 1a.5.5 0 0 1 .5.5V6H2V4.5a.5.5 0 0 1 .5-.5h14.5ZM2 7.5h16V15a.5.5 0 0 1-.5.5H12v-2.5a.75.75 0 0 0-.75-.75h-2.5a.75.75 0 0 0-.75.75V15.5H2.5a.5.5 0 0 1-.5-.5v-7Z" /><path d="M11.25 12.75a.75.75 0 0 0-1.5 0v2.5a.75.75 0 0 0 1.5 0v-2.5Z" /><path d="M5 10.75a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1-.75-.75v-3Z" /><path d="M12.75 10a.75.75 0 0 0-.75.75v3a.75.75 0 0 0 .75.75h1.5a.75.75 0 0 0 .75-.75v-3a.75.75 0 0 0-.75-.75h-1.5Z" /></svg>
            Customer
            <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </button>
        <div id="customer-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $customer_submenu_active ? '' : 'hidden'; ?>">
            <ul class="pt-2 ps-2">
            <?php if (has_permission('Sajili Mteja Mpya')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/customer') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/customer"); ?>">Register Customer</a></li>
                <?php endif; ?>
                <?php if (has_permission('Orodha Ya Wateja wote')): ?>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/all_customer') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/all_customer"); ?>">All Customer</a></li>
                <?php endif; ?>
            </ul>
        </div>
      </li>
      <!-- End Customer Accordion -->
    
      <!-- Loan Accordion -->
      <li class="hs-accordion <?php echo $loan_submenu_active ? 'active' : ''; ?>" id="loan-accordion">
          <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $loan_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
              <!-- SVG: CurrencyDollarIcon -->
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.085 7.412c-.021.022-.042.045-.062.069a5.022 5.022 0 0 1 .001-1.415 4.844 4.844 0 0 1 .304-.903.75.75 0 0 1 1.426.461 3.344 3.344 0 0 0-.209.622c-.015.05-.03.098-.044.147A3.522 3.522 0 0 0 9.5 8.5h1A3.5 3.5 0 0 0 14 5a.75.75 0 0 1 1.5 0 5.001 5.001 0 0 1-7.516 3.716l-.001-.002Zm-2.44 1.377a4.844 4.844 0 0 1-.304.903.75.75 0 1 1-1.427-.461 3.344 3.344 0 0 0 .21-.622c.014-.05.029-.098.043-.147a3.522 3.522 0 0 0 .251-1.073H6.5a3.5 3.5 0 0 0-3.5 3.5.75.75 0 0 1-1.5 0A5 5 0 0 1 9.017 6.284l.001.002c.02-.022.042-.045.061-.069a5.022 5.022 0 0 1-.001 1.415Z" clip-rule="evenodd" /></svg>
              Loan
              <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div id="loan-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $loan_submenu_active ? '' : 'hidden'; ?>">
              <ul class="pt-2 ps-2">
              <?php if (has_permission('Ombea Mkopo wa Mteja')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loan_application') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loan_application"); ?>">Loan Application</a></li>
             <?php endif; ?>
             <?php if (has_permission('Pitisha Maombi Ya Mikopo')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loan_pending') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loan_pending"); ?>">Loan Pending Approve</a></li>
                  <?php endif; ?>
                  <?php if (has_permission('Ruhusu Malipo Ya Mkopo')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/get_loan_aproved') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/get_loan_aproved"); ?>">Loan Approved But not Disbursed</a></li>
                  <?php endif; ?>
                  <?php if (has_permission('Ona  Mikopo Iliyoruhusiwa Malipo')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/disburse_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/disburse_loan"); ?>">Loan Disbursed</a></li>
                  <?php endif; ?>
                  <?php if (has_permission('Ona Mikopo Iliyotolewa')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loan_withdrawal') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loan_withdrawal"); ?>">Loan Withdrawal</a></li>
                  <?php endif; ?>
                  <?php if (has_permission('Ona Mikopo Iliyokosa Sifa')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/all_loan_lejected') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/all_loan_lejected"); ?>">Loan Rejected</a></li>
                  <?php endif; ?>
                  <!-- </?php if (has_permission('Ombea Mkopo wa Mteja')): ?> -->
                  <!-- <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loanpending_groups') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loanpending_groups"); ?>">Loan Group</a></li> -->
                  <!-- <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/parsonal_pending_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/parsonal_pending_loan"); ?>">Personal loan</a></li> -->
              </ul>
          </div>
      </li>
      <!-- End Loan Accordion -->

      <!-- Group Loan Accordion -->
       <!-- <li class="hs-accordion <?php echo $group_loan_submenu_active ? 'active' : ''; ?>" id="group-loan-accordion">
          <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $group_loan_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
              <!-- SVG: UserGroupIcon -->
              <!-- <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.25 1.25 0 0 0 .421-.953V12.5a4.25 4.25 0 0 1 8.5 0v1.04a1.25 1.25 0 0 0 .421.953l-.002.002a5.75 5.75 0 0 1-9.339 0l-.002-.002ZM12.243 20a2.75 2.75 0 0 0 2.063-4.631L11.5 12.665l.081-.087.019-.023a1.75 1.75 0 0 0-2.202-2.53L5.572 12.67a.75.75 0 0 1-1.023-.02L2.05 10.873a.75.75 0 0 0-1.122.96l1.516 3.3a2.75 2.75 0 0 0 4.414 1.666l2.443-1.536a1.25 1.25 0 0 1 1.413 0l2.443 1.536A2.75 2.75 0 0 0 12.243 20Z" /></svg>
              Group Loan
              <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div id="group-loan-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $group_loan_submenu_active ? '' : 'hidden'; ?>">
              <ul class="pt-2 ps-2">
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loanpending_groups') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loanpending_groups"); ?>">Loan Group</a></li>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/general_operation') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/general_operation"); ?>">General Operation Report</a></li>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/group_list') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/group_list"); ?>">Group Collection Sheet</a></li>
              </ul>
          </div>
      </li>  -->
      <!-- End Group Loan Accordion -->
      <?php if (has_permission('Lipa/Weka Malipo Ya Mteja')): ?>
      <li>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $teller_dashboard_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("admin/teller_dashboard"); ?>">
          <!-- SVG: WindowIcon -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h13A1.5 1.5 0 0 1 18 3.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 2 16.5v-13Zm1.5-.5a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5h-13Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M2 7.5A1.5 1.5 0 0 1 3.5 6h5A1.5 1.5 0 0 1 10 7.5v9A1.5 1.5 0 0 1 8.5 18h-5A1.5 1.5 0 0 1 2 16.5v-9Zm1.5-.5a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-5Z" clip-rule="evenodd" /></svg>
          Teller Dashboard
        </a>
      </li>
      <?php endif; ?>

      <!-- Report Accordion -->
      <li class="hs-accordion <?php echo $report_submenu_active ? 'active' : ''; ?>" id="report-accordion">
          <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $report_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
             <!-- SVG: DocumentChartBarIcon -->
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a.75.75 0 0 1 .75.75v14.5a.75.75 0 0 1-1.5 0V2.75A.75.75 0 0 1 10 2Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M4.75 10a.75.75 0 0 1 .75-.75h8.5a.75.75 0 0 1 0 1.5h-8.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M7 6.75A.75.75 0 0 1 7.75 6h4.5a.75.75 0 0 1 0 1.5h-4.5A.75.75 0 0 1 7 6.75Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M7 13.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M2.5 2A1.5 1.5 0 0 0 1 3.5v13A1.5 1.5 0 0 0 2.5 18h15A1.5 1.5 0 0 0 19 16.5v-13A1.5 1.5 0 0 0 17.5 2h-15Zm0 1h15a.5.5 0 0 1 .5.5v13a.5.5 0 0 1-.5.5h-15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 .5-.5Z" clip-rule="evenodd" /></svg>
              Report
              <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div id="report-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $report_submenu_active ? '' : 'hidden'; ?>">
              <ul class="pt-2 ps-2">
              <?php if (has_permission('Report ya Malipo Ya Wateja Kampuni nzima')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/cash_transaction') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/cash_transaction"); ?>">Cash Transaction</a></li>
                    <?php endif; ?> 
                    <!-- </?php if (has_permission('Report ya Malipo Ya leo Wateja Kampuni nzima')): ?> -->
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/today_transactions') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/today_transactions"); ?>">Today Transaction</a></li>
                    <!-- </?php endif; ?>  -->

                    <?php if (has_permission('Report ya Malipo Ya kitini')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/cash_transaction') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/kitini"); ?>">Kitini Report</a></li>
                    <?php endif; ?> 
                    <?php if (has_permission('Ripoti ya Mikopo Kila Tawi')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/today_receved_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/today_receved_loan"); ?>">General Collection Report</a></li> 
                  <?php endif; ?>
                  <?php if (has_permission('Report Ya Malazo Ya Wateja')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loan_pending_time') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loan_pending_time"); ?>">Loan pending</a></li> 
                  <?php endif; ?>
                  <?php if (has_permission('Report Ya Mikopo Iliyolipika')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/repaymant_data') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/repaymant_data"); ?>">Loan Repayments</a></li> 
                  <?php endif; ?>
                  <?php if (has_permission('Report Ya Madeni Sugu')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/get_outstand_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/get_outstand_loan"); ?>">Outstanding Loan</a></li> 
                  <?php endif; ?>
                  <!-- </?php if (has_permission('Lipa/Weka Malipo Ya Mteja')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loan_collection') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loan_collection"); ?>">Loan Collections Statement</a></li> 
                  </?php endif; ?> -->
                  <?php if (has_permission('Report Ya Mikopo Kwa Mteja ')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/search_customer_loan_report') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/search_customer_loan_report"); ?>">Customer Loan Report</a></li> 
                  <?php endif; ?>
                  <?php if (has_permission('Statement Report Ya Mteja')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/customer_account_statement') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/customer_account_statement"); ?>">Customer Account Statement</a></li> 
                  <?php endif; ?>
                  <?php if (has_permission('Makusanyo Ya Wateja Leo ')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/today_recevable_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/today_recevable_loan"); ?>">Today Receivable</a></li> 
                  <?php endif; ?>
                  <?php if (has_permission('Malipo Ya Leo')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/today_receved_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/today_receved_loan"); ?>">Today Received</a></li> 
                  <?php endif; ?>
                  <?php if (has_permission('Malipo ya Kila Afisa')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/teller_oficer') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/teller_oficer"); ?>">Teller Officer Cash Transaction</a></li> 
                  <?php endif; ?>
                  <!-- </?php if (has_permission('Lipa/Weka Malipo Ya Mteja')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/teller_trasior') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/teller_trasior"); ?>">Branch officer Transaction</a></li> 
                  </?php endif; ?> -->
                  <?php if (has_permission('Report ya Siku Kimatawi')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/daily_report') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/daily_report"); ?>">Daily Report</a></li> 
                  <?php endif; ?>
                  <!-- </?php if (has_permission('Lipa/Weka Malipo Ya Mteja')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loan_oficer_expectation') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loan_oficer_expectation"); ?>">Loan Officer Expectation</a></li> 
                  </?php endif; ?> -->
                  <?php if (has_permission('Makusanyo tarajiwa Tarehe za Mbele')): ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/next_expectation') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/next_expectation"); ?>">Expected Receivable</a></li> 
                  <?php endif; ?>
                  </ul>
          </div>
      </li>
      <!-- End Report Accordion -->

      <!-- Accounting Report Accordion -->
       <li class="hs-accordion <?php echo $accounting_report_submenu_active ? 'active' : ''; ?>" id="accounting-report-accordion">
          <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $accounting_report_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
             <!-- SVG: CalculatorIcon -->
             <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.5 2A1.5 1.5 0 0 0 4 3.5v13A1.5 1.5 0 0 0 5.5 18h9a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 14.5 2h-9ZM5 4.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5V16a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-11ZM6.75 8a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z" clip-rule="evenodd" /><path d="M8.25 11.25a.75.75 0 0 1 .75-.75h2a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1-.75-.75Z" /></svg>
              Accounting Report
              <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div id="accounting-report-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $accounting_report_submenu_active ? '' : 'hidden'; ?>">
              <ul class="pt-2 ps-2">
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/loss_profit') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loss_profit"); ?>">Profit & Loss Report</a></li>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/cash_flow') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/cash_flow"); ?>">Cash Flow</a></li>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/saving_deposit') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/saving_deposit"); ?>">Saving Deposit</a></li>
              </ul>
          </div>
      </li>
      <!-- End Accounting Report Accordion -->

      <li>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $cash_book_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("admin/get_cashInHand_Data"); ?>">
          <!-- SVG: BookOpenIcon -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2 4.75A2.75 2.75 0 0 1 4.75 2h10.5A2.75 2.75 0 0 1 18 4.75v10.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25V4.75Zm8-1.5V17a.75.75 0 0 1-1.5 0V3.25a.75.75 0 0 1 1.5 0Z" clip-rule="evenodd" /></svg>
          Cash Book
        </a>
      </li>

      <!-- Communication Accordion -->
      <li class="hs-accordion <?php echo $communication_submenu_active ? 'active' : ''; ?>" id="communication-accordion">
          <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $communication_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
              <!-- SVG: ChatBubbleLeftEllipsisIcon -->
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.013 2.513a7.5 7.5 0 0 1 5.475 5.474c.437.99.612 2.07.612 3.135C17.1 14.217 15.023 17 12.32 17H7.88C5.177 17 3 14.217 3 11.122c0-1.064.175-2.144.612-3.135A7.5 7.5 0 0 1 9.087 2.513a.75.75 0 0 1 .926 0ZM7.584 15.5H12.32c1.79 0 3.32-1.935 3.32-4.378 0-.946-.16-1.91-.552-2.821a6 6 0 0 0-4.38-4.38c-.91-.393-1.875-.552-2.822-.552C6.146 3.37 4.5 5.305 4.5 7.748c0 .946.16 1.91.552 2.821a6 6 0 0 0 4.38 4.38c.91.393 1.875.552 2.822.552A6.001 6.001 0 0 0 15.075 12H15a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 1 0-1.5h4.5a.75.75 0 0 0 .75-.75V9a.75.75 0 0 0-1.5 0v.75a6.002 6.002 0 0 0-1.716-2.923.75.75 0 1 0-1.132.988A4.502 4.502 0 0 1 12.32 9H7.584a4.5 4.5 0 0 1-.983-3.05.75.75 0 0 0-1.435.456A6.001 6.001 0 0 0 7.584 15.5Z" clip-rule="evenodd" /></svg>
              Communication
              <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div id="communication-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $communication_submenu_active ? '' : 'hidden'; ?>">
              <ul class="pt-2 ps-2">
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300" href="<?php echo base_url("admin/send_sms"); ?>">Via SMS</a></li> <?php // Original link was commented out ?>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('admin/send_email') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/send_email"); ?>">Via Email</a></li>
              </ul>
          </div>
      </li>
      <!-- End Communication Accordion -->

    </ul>
  </nav>
</div>
<!-- ========== END SIDEBAR ========== -->