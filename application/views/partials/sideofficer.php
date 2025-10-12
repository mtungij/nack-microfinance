
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

$dashboard_active = is_active_link('oficer/index'); // Example: assuming oficer/index is dashboard
$branch_active = is_active_link('oficer/blanch');
$groups_active = is_active_link('oficer/group');

$setting_submenu_active = is_submenu_active(['loan_category', 'loan_fee', 'penart_setting', 'formular_setting', 'transaction_account']);
$capital_submenu_active = is_submenu_active(['shareHolder', 'capital', 'transfar_amount']);
$expenses_income_submenu_active = is_submenu_active(['expenses', 'expnses_requisition_form', 'get_recomended_request', 'income_detail', 'income_dashboard', 'deducted_income', 'deducted_income_sumary', 'deduction_branch_company', 'income_balance']);
$employee_submenu_active = is_submenu_active(['employee', 'all_employee', 'view_blanchEmployee', 'leave', 'salary_sheet', 'employee_allowance', 'employee_deduction']);
$customer_submenu_active = is_submenu_active(['customer', 'all_customer']);
$loan_submenu_active = is_submenu_active(['loan_application', 'loan_pending', 'get_loan_aproved', 'disburse_loan', 'loan_withdrawal', 'all_loan_lejected', 'loanpending_groups', 'parsonal_pending_loan']);
$group_loan_submenu_active = is_submenu_active(['loanpending_groups', 'general_operation', 'group_list']); // Note: 'loanpending_groups' is repeated, which is fine if intended
$teller_dashboard_active = is_active_link('oficer/teller_dashboard');
$report_submenu_active = is_submenu_active(['cash_transaction', 'blanchiwise_report', 'loan_pending_time', 'repaymant_data', 'get_outstand_loan', 'loan_collection', 'search_customer_loan_report', 'customer_account_statement', 'today_recevable_loan', 'today_receved_loan', 'teller_oficer', 'teller_trasior', 'daily_report', 'loan_oficer_expectation', 'next_expectation']);
$accounting_report_submenu_active = is_submenu_active(['loss_profit', 'cash_flow', 'saving_deposit']);
$cash_book_active = is_active_link('oficer/get_cashInHand_Data');
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
  bg-white dark:bg-gray-800 dark:border-gray-700">

  <div class="px-6 pt-4 pb-2 border-b border-gray-200 dark:border-gray-700">
    <!-- Logo -->
    <a class="flex-none text-xl font-semibold dark:text-white focus:outline-none focus:ring-1 focus:ring-gray-600" href="<?php echo base_url("oficer/index"); ?>" aria-label="Brand">
      <!-- <img class="h-10 sm:h-12 mx-auto" src="</?php echo base_url('assets/img/logo.png'); // Adjust path and style as needed ?>" alt="Logo"> -->
    </a>
    <!-- End Logo -->
  </div>


  <!-- <pre></?php print_r($this->session->userdata('permissions')); ?></pre> -->








  <div class="flex flex-col h-full overflow-y-auto">
  <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
    <ul class="space-y-1.5">
      <li>
      
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $dashboard_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("oficer/index"); ?>">
          <!-- SVG: Home/Dashboard Icon (Heroicons: home) -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" /></svg>
          Dashboard
        </a>
      
      </li>


       <li>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $cash_book_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("oficer/loan_calculator"); ?>">
          <!-- SVG: BookOpenIcon -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2 4.75A2.75 2.75 0 0 1 4.75 2h10.5A2.75 2.75 0 0 1 18 4.75v10.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25V4.75Zm8-1.5V17a.75.75 0 0 1-1.5 0V3.25a.75.75 0 0 1 1.5 0Z" clip-rule="evenodd" /></svg>
          Loan Calculator
        </a>
      </li>
      



      <!-- Settings Accordion -->
      <li class="hs-accordion <?php echo $setting_submenu_active ? 'active' : ''; ?>" id="settings-accordion">
        <button type="button"
                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $setting_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
          <!-- SVG: Settings Icon (Heroicons: cog-6-tooth) -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 0 1-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 0 1 .947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 0 1 2.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 0 1 2.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 0 1-.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 0 1-.947-2.287c.836-1.372-.734-2.942-2.106-2.106A1.532 1.532 0 0 1 11.49 3.17ZM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
         Expenses
          <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4 <?php echo $setting_submenu_active ? 'text-gray-600 dark:text-gray-400' : 'text-gray-600 group-hover:text-gray-500 dark:text-gray-400'; ?>"
               xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6"/>
          </svg>
        </button>

        <div id="settings-accordion-child"
             class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $setting_submenu_active ? '' : 'hidden'; ?>">
          <ul class="pt-2 ps-2">
        
            <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/expnses_requisition_form') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
                 href="<?php echo base_url("oficer/expnses_requisition_form"); ?>">
                Request Expenses
              </a>
            </li>
          
          </ul>
        </div>
      </li>



           <li class="hs-accordion <?php echo $setting_submenu_active ? 'active' : ''; ?>" id="settings-accordion">
        <button type="button"
                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $setting_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
          <!-- SVG: Settings Icon (Heroicons: cog-6-tooth) -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 0 1-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 0 1 .947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 0 1 2.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 0 1 2.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 0 1-.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 0 1-.947-2.287c.836-1.372-.734-2.942-2.106-2.106A1.532 1.532 0 0 1 11.49 3.17ZM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
         Income 
          <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4 <?php echo $setting_submenu_active ? 'text-gray-600 dark:text-gray-400' : 'text-gray-600 group-hover:text-gray-500 dark:text-gray-400'; ?>"
               xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6"/>
          </svg>
        </button>

        <div id="settings-accordion-child"
             class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $setting_submenu_active ? '' : 'hidden'; ?>">
          <ul class="pt-2 ps-2">
        
            <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/expnses_requisition_form') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
                 href="<?php echo base_url("oficer/income_dashboard"); ?>">
                Record Penalty
              </a>
            </li>

              <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/expnses_requisition_form') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
                 href="<?php echo base_url("oficer/deducted_income"); ?>">
                Processing Fees
              </a>
            </li>
          
          </ul>
        </div>
      </li>
      <!-- End Settings Accordion -->

      <li>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg
                  <?php echo $cash_book_active ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>"
           href="<?php echo base_url("oficer/teller_dashboard"); ?>">
          <!-- SVG: BookOpenIcon -->
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2 4.75A2.75 2.75 0 0 1 4.75 2h10.5A2.75 2.75 0 0 1 18 4.75v10.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25V4.75Zm8-1.5V17a.75.75 0 0 1-1.5 0V3.25a.75.75 0 0 1 1.5 0Z" clip-rule="evenodd" /></svg>
          Teller Dashboard
        </a>
      </li>
     
      <!-- Capital Accordion -->
      <li class="hs-accordion <?php echo $capital_submenu_active ? 'active' : ''; ?>" id="capital-accordion">
        <button type="button"
                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $capital_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
          <!-- SVG: Layer/Capital Icon (Heroicons: bank-notes or CircleStackIcon) -->
           <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 10.028a2.5 2.5 0 1 0-1.5 0A2.5 2.5 0 0 0 10.75 10.028ZM2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Z" /><path d="M11 2.255a.75.75 0 0 1 1.5 0v2.58a12.07 12.07 0 0 0-1.5-.168V2.255Z" /><path d="M9 2.255v2.412a12.07 12.07 0 0 0-1.5.168V2.255a.75.75 0 0 1 1.5 0Z" /><path d="M15.168 4.832a.75.75 0 0 1 .108 1.056l-2.25 3.499a.75.75 0 0 1-1.165 0l-2.25-3.499a.75.75 0 1 1 1.166-.752L12.1 6.67l1.323-2.053a.75.75 0 0 1 1.056-.108.75.75 0 0 1 .108 1.056L12.1 9.33l1.323 2.053a.75.75 0 1 1-1.166.752l-2.25-3.499a.75.75 0 0 1 1.165 0l2.25 3.499a.75.75 0 0 1-.108 1.056.75.75 0 0 1-1.056-.108L10.85 10.934l-1.323 2.053a.75.75 0 1 1-1.166-.752l2.25-3.499a.75.75 0 0 1 0-1.165l-2.25-3.499a.75.75 0 0 1 1.166-.752l1.323 2.053L13.944 4.724a.75.75 0 0 1 1.056.108Z" /><path d="M4.832 15.168a.75.75 0 0 1 1.056-.108l3.499-2.25a.75.75 0 0 1 0-1.165l-3.499-2.25a.75.75 0 1 1 .752-1.166L9.33 10.9l-2.053 1.323a.75.75 0 0 1-1.056.108.75.75 0 0 1-.108-1.056l2.053-1.323L6.67 7.9a.75.75 0 1 1 .752 1.166l-3.499 2.25a.75.75 0 0 1-1.165 0l-3.499-2.25a.75.75 0 0 1 .108-1.056.75.75 0 0 1 1.056.108L4.066 9.15l2.053-1.323a.75.75 0 1 1 .752 1.166l-3.499 2.25a.75.75 0 0 1 0 1.165l3.499 2.25a.75.75 0 0 1-.752 1.166L2.276 13.323a.75.75 0 0 1-.108-1.056.75.75 0 0 1 1.056-.108Z" /></svg>
        Customer
          <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4 <?php echo $capital_submenu_active ? 'text-gray-600 dark:text-gray-400' : 'text-gray-600 group-hover:text-gray-500 dark:text-gray-400'; ?>"
               xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6"/>
          </svg>
        </button>
        <div id="capital-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $capital_submenu_active ? '' : 'hidden'; ?>">
            <ul class="pt-2 ps-2">
            
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/customer') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/customer"); ?>">Register Customer</a></li>
             
               
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/all_customer') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/all_customer"); ?>">All Customer</a></li>
              
              
            </ul>
        </div>
      </li>
      <!-- End Capital Accordion -->



      <!-- Employee Accordion -->

      <!-- End Employee Accordion -->

   
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
             
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/loan_application') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/loan_application"); ?>">Loan application</a></li>

                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/loan_pending') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/loan_pending"); ?>">Loan Pending</a></li>


                  <!-- <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/get_loan_aproved') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/get_loan_aproved"); ?>">Mikopo Iliyopitishwa</a></li> -->
                 
                  
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/disburse_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/disburse_loan"); ?>">Disbursed Loan</a></li>

                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/all_loan_lejected') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/all_loan_lejected"); ?>">Rejected Loan</a></li>
                
             

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
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg </?php echo is_active_link('admin/loanpending_groups') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/loanpending_groups"); ?>">Loan Group</a></li>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg </?php echo is_active_link('admin/general_operation') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/general_operation"); ?>">General Operation Report</a></li>
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg </?php echo is_active_link('admin/group_list') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/group_list"); ?>">Group Collection Sheet</a></li>
              </ul>
          </div>
      </li>  -->
      <!-- End Group Loan Accordion -->
  
      <!-- Report Accordion -->
      <li class="hs-accordion <?php echo $report_submenu_active ? 'active' : ''; ?>" id="report-accordion">
          <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo $report_submenu_active ? 'bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>">
             <!-- SVG: DocumentChartBarIcon -->
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a.75.75 0 0 1 .75.75v14.5a.75.75 0 0 1-1.5 0V2.75A.75.75 0 0 1 10 2Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M4.75 10a.75.75 0 0 1 .75-.75h8.5a.75.75 0 0 1 0 1.5h-8.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M7 6.75A.75.75 0 0 1 7.75 6h4.5a.75.75 0 0 1 0 1.5h-4.5A.75.75 0 0 1 7 6.75Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M7 13.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M2.5 2A1.5 1.5 0 0 0 1 3.5v13A1.5 1.5 0 0 0 2.5 18h15A1.5 1.5 0 0 0 19 16.5v-13A1.5 1.5 0 0 0 17.5 2h-15Zm0 1h15a.5.5 0 0 1 .5.5v13a.5.5 0 0 1-.5.5h-15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 .5-.5Z" clip-rule="evenodd" /></svg>
              Reports
              <svg class="hs-accordion-active:rotate-180 shrink-0 ms-auto size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div id="report-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?php echo $report_submenu_active ? '' : 'hidden'; ?>">
              <ul class="pt-2 ps-2">
             
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/cash_transaction') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/cash_transaction"); ?>">Cash Transaction</a></li>

                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/today_officer_transaction') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/today_officer_transaction"); ?>">Today Transaction</a></li>

                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/withdraw_transactions') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/withdraw_transactions"); ?>">Mikopo Report</a></li>
                  
                   
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/today_receved_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/today_receved_loan"); ?>">Collection Report</a></li> 
              
                
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/loan_pending_time') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/loan_pending_time"); ?>">Loan pending</a></li> 
               
                 
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/repaymant_data') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/repaymant_data"); ?>">Loan Repayments</a></li> 
                 
                
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/get_outstand_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/get_outstand_loan"); ?>">Outstanding Loan</a></li> 
            
        
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/search_customer_loan_report') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/search_customer_loan_report"); ?>">Customer Loan Report</a></li> 
                 
                 
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/customer_account_statement') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/customer_account_statement"); ?>">Customer Account Statement</a></li> 
              
                
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link('oficer/today_recevable_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("oficer/today_recevable_loan"); ?>">Today Receivable</a></li> 
               
               
                  <!-- <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg </?php echo is_active_link('admin/today_receved_loan') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="</?php echo base_url("admin/today_receved_loan"); ?>">Today Received</a></li>  -->
                
                  <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg <?php echo is_active_link(' oficer/teller_oficer') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url(" oficer/teller_oficer"); ?>">Officer Transactions</a></li> 
                 
                 
           
                  <!-- <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg </?php echo is_active_link('admin/daily_report') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="</?php echo base_url("admin/daily_report"); ?>">Daily Report</a></li>  -->
           

                
                 
                  <!-- <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg </?php echo is_active_link('admin/next_expectation') ? 'text-cyan-600 dark:text-cyan-500' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300'; ?>" href="<?php echo base_url("admin/next_expectation"); ?>">Expected Receivable</a></li>  -->
             
                  </ul>
          </div>
      </li>
      <!-- End Report Accordion -->

      <!-- Accounting Report Accordion -->
   
      <!-- End Accounting Report Accordion -->

     

  
      <!-- End Communication Accordion -->

    </ul>
  </nav>
</div>
</div>
<!-- ========== END SIDEBAR ========== -->