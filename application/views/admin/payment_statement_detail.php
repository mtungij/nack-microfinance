<?php
include_once APPPATH . "views/partials/header.php";

$schedule  = !empty($schedule)  ? $schedule  : [];
$loan      = !empty($loan)      ? $loan      : null;
$customer  = !empty($customer)  ? $customer  : null;
$compdata  = !empty($compdata)  ? $compdata  : null;

$lang_line = function ($key, $fallback) {
    $value = $this->lang->line($key);
    return !empty($value) ? $value : $fallback;
};

// Totals
$total_expected = 0;
$total_paid     = 0;
$total_penalty  = 0;
foreach ($schedule as $row) {
    $total_expected += (float) $row['expected'];
    $total_paid     += (float) $row['paid'];
    $total_penalty  += (float) $row['penalty'];
}
$total_deficit = max(0, $total_expected - $total_paid);

$loan_status_colors = [
    'withdrawal' => 'bg-blue-100 text-blue-700',
    'done'       => 'bg-green-100 text-green-700',
    'out'        => 'bg-red-100 text-red-700',
    'open'       => 'bg-yellow-100 text-yellow-700',
];
$loan_sc = $loan_status_colors[$loan->loan_status ?? ''] ?? 'bg-gray-100 text-gray-700';

$loan_status_value = strtolower((string)($loan->loan_status ?? ''));
$loan_status_label_map = [
  'out'        => 'nje ya mkataba',
  'active'     => 'ndani ya mkataba',
  'withdrawal' => 'ndani ya mkataba',
  'done'       => 'umelipwa wote',
];
$loan_status_label = $loan_status_label_map[$loan_status_value] ?? ($loan->loan_status ?? '—');

$default_passport = base_url('assets/img/user.png');
$passport_src = $default_passport;
if (!empty($customer) && !empty($customer->passport)) {
  $passport_value = trim((string) $customer->passport);
  if (preg_match('#^(https?://|data:image/)#i', $passport_value)) {
    $passport_src = $passport_value;
  } else {
    $candidates = [$passport_value];
    if (strpos($passport_value, 'assets/') !== 0) {
      $candidates[] = 'assets/img/' . $passport_value;
      $candidates[] = 'assets/passport/' . $passport_value;
    }

    foreach ($candidates as $candidate) {
      $relative = ltrim($candidate, '/');
      if (file_exists(FCPATH . $relative)) {
        $passport_src = base_url($relative);
        break;
      }
    }
  }
}
?>

<div class="w-full lg:ps-64 min-h-screen">
  <div class="p-4 sm:p-6 lg:p-8 space-y-6">

    <!-- BACK BUTTON -->
    <div class="flex items-center justify-between gap-3 flex-wrap">
      <a href="<?php echo base_url('admin/payment_statement_search'); ?>"
         class="inline-flex items-center gap-1 text-sm text-cyan-600 hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        <?php echo $lang_line('ps_search_customer', 'Rudi Kutafuta'); ?>
      </a>
    </div>

    <!-- HEADER CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <!-- Customer info -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">
          <?php echo $lang_line('customer_profile', 'Taarifa ya Mteja'); ?>
        </h3>
        <?php if ($customer): ?>
        <div class="mb-4">
          <img class="w-24 h-24 mx-auto rounded-full object-cover border-4 border-green-400" src="<?php echo $passport_src; ?>" alt="Customer Passport">
        </div>
        <p class="text-lg font-bold text-gray-800 dark:text-white">
          <?php echo htmlspecialchars(trim($customer->f_name . ' ' . $customer->m_name . ' ' . $customer->l_name)); ?>
        </p>
        <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($customer->phone_no ?? ''); ?></p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?php echo htmlspecialchars($customer->blanch_name ?? ''); ?></p>
        <?php endif; ?>
      </div>

      <!-- Loan info -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">
          <?php echo $lang_line('ps_loan_info', 'Taarifa ya Mkopo'); ?>
        </h3>
        <?php if ($loan): ?>
        <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm">
          <span class="text-gray-500 dark:text-gray-400"><?php echo $lang_line('ps_loan_code', 'Namba ya Mkopo'); ?>:</span>
          <span class="font-medium text-gray-800 dark:text-white"><?php echo htmlspecialchars($loan->loan_code ?? '—'); ?></span>

          <span class="text-gray-500 dark:text-gray-400"><?php echo $lang_line('ps_loan_amount', 'Kiasi'); ?>:</span>
          <span class="font-medium text-gray-800 dark:text-white">Tsh <?php echo number_format($loan->loan_aprove); ?></span>

          <span class="text-gray-500 dark:text-gray-400"><?php echo $lang_line('ps_loan_interest', 'Jumla + Riba'); ?>:</span>
          <span class="font-medium text-gray-800 dark:text-white">Tsh <?php echo number_format($loan->loan_int); ?></span>

          <span class="text-gray-500 dark:text-gray-400"><?php echo $lang_line('ps_installment', 'Rejesho'); ?>:</span>
          <span class="font-medium text-gray-800 dark:text-white">Tsh <?php echo number_format($loan->restration); ?></span>

          <span class="text-gray-500 dark:text-gray-400"><?php echo $lang_line('ps_branch', 'Tawi'); ?>:</span>
          <span class="font-medium text-gray-800 dark:text-white"><?php echo htmlspecialchars($loan->blanch_name ?? '—'); ?></span>

          <span class="text-gray-500 dark:text-gray-400"><?php echo $lang_line('ps_loan_status', 'Hali'); ?>:</span>
          <span class="px-2 py-0.5 text-xs font-semibold rounded-full <?php echo $loan_sc; ?>">
            <?php echo htmlspecialchars($loan_status_label); ?>
          </span>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- SUMMARY TOTALS -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1"><?php echo $lang_line('ps_total_expected', 'Jumla Inayotarajiwa'); ?></p>
        <p class="text-lg font-bold text-gray-800 dark:text-white">Tsh <?php echo number_format($total_expected); ?></p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1"><?php echo $lang_line('ps_total_paid', 'Jumla Imelipwa'); ?></p>
        <p class="text-lg font-bold text-green-600">Tsh <?php echo number_format($total_paid); ?></p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1"><?php echo $lang_line('ps_total_penalty', 'Jumla ya Faini'); ?></p>
        <p class="text-lg font-bold text-orange-600">Tsh <?php echo number_format($total_penalty); ?></p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-center">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1"><?php echo $lang_line('ps_total_deficit', 'Upungufu'); ?></p>
        <p class="text-lg font-bold text-red-600">Tsh <?php echo number_format($total_deficit); ?></p>
      </div>
    </div>

    <!-- STATEMENT TABLE -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
      <?php if (!empty($loan->loan_id)): ?>
      <div class="p-4 pb-0 flex justify-end">
        <a href="<?php echo base_url('admin/payment_statement_pdf/' . (int)$loan->loan_id); ?>"
           target="_blank"
           class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white bg-cyan-700 hover:bg-cyan-800 rounded-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-8m0 8-3-3m3 3 3-3M5 20h14"/>
          </svg>
          <?php echo $lang_line('download_pdf', 'Download PDF'); ?>
        </a>
      </div>
      <?php endif; ?>
      <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <h2 class="text-base font-semibold text-gray-800 dark:text-white">
          <?php echo $lang_line('payment_penalty_statement', 'Taarifa ya Malipo &amp; Faini'); ?>
        </h2>
        <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo count($schedule); ?> rows</span>
      </div>

      <?php if (empty($schedule)): ?>
        <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">
          <?php echo $lang_line('ps_no_schedule', 'Hakuna data ya ratiba kwa mkopo huu.'); ?>
        </div>
      <?php else: ?>
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
          <thead class="text-xs font-semibold uppercase bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 border-b border-gray-200 dark:border-gray-600">
            <tr>
              <th class="px-4 py-3 w-8">#</th>
              <th class="px-4 py-3"><?php echo $lang_line('ps_date', 'Tarehe'); ?></th>
              <th class="px-4 py-3 text-right"><?php echo $lang_line('ps_expected', 'Inayotarajiwa'); ?></th>
              <th class="px-4 py-3 text-right"><?php echo $lang_line('ps_paid', 'Imelipwa'); ?></th>
              <th class="px-4 py-3 text-right"><?php echo $lang_line('ps_penalty', 'Faini'); ?></th>
              <th class="px-4 py-3 text-center"><?php echo $lang_line('ps_status', 'Hali'); ?></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            <?php $i = 1; foreach ($schedule as $row):
                switch ($row['status']) {
                    case 'paid':
                        $row_class    = 'hover:bg-green-50 dark:hover:bg-green-900/10';
                        $badge_class  = 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400';
                        $paid_class   = 'font-semibold text-green-700 dark:text-green-400';
                        break;
                    case 'partial':
                        $row_class    = 'hover:bg-yellow-50 dark:hover:bg-yellow-900/10';
                        $badge_class  = 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400';
                        $paid_class   = 'font-semibold text-yellow-700 dark:text-yellow-400';
                        break;
                    default:
                        $row_class    = 'hover:bg-red-50 dark:hover:bg-red-900/10';
                        $badge_class  = 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400';
                        $paid_class   = 'text-gray-400 dark:text-gray-500';
                }
            ?>
            <tr class="<?php echo $row_class; ?>">
              <td class="px-4 py-3 text-gray-400 text-xs"><?php echo $i++; ?></td>
              <td class="px-4 py-3 font-medium"><?php echo htmlspecialchars($row['date']); ?></td>
              <td class="px-4 py-3 text-right text-gray-600 dark:text-gray-400">
                <?php echo $row['expected'] > 0 ? number_format($row['expected']) : '—'; ?>
              </td>
              <td class="px-4 py-3 text-right <?php echo $paid_class; ?>">
                <?php echo $row['paid'] > 0 ? number_format($row['paid']) : '—'; ?>
              </td>
              <td class="px-4 py-3 text-right">
                <?php if ($row['penalty'] > 0): ?>
                  <span class="font-semibold text-orange-600 dark:text-orange-400">
                    <?php echo number_format($row['penalty']); ?>
                  </span>
                <?php else: ?>
                  <span class="text-gray-300 dark:text-gray-600">—</span>
                <?php endif; ?>
              </td>
              <td class="px-4 py-3 text-center">
                <span class="px-2 py-0.5 text-xs font-medium rounded-full <?php echo $badge_class; ?>">
                  <?php echo htmlspecialchars($row['status_label']); ?>
                </span>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot class="bg-gray-50 dark:bg-gray-700 font-semibold text-gray-700 dark:text-white border-t-2 border-gray-300 dark:border-gray-600">
            <tr>
              <td class="px-4 py-3" colspan="2"><?php echo $lang_line('total', 'Jumla'); ?></td>
              <td class="px-4 py-3 text-right">Tsh <?php echo number_format($total_expected); ?></td>
              <td class="px-4 py-3 text-right text-green-700 dark:text-green-400">Tsh <?php echo number_format($total_paid); ?></td>
              <td class="px-4 py-3 text-right text-orange-600 dark:text-orange-400">Tsh <?php echo number_format($total_penalty); ?></td>
              <td class="px-4 py-3 text-center text-red-600 dark:text-red-400">
                -Tsh <?php echo number_format($total_deficit); ?>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <?php endif; ?>
    </div>

  </div>
</div>

<?php include_once APPPATH . "views/partials/footer.php"; ?>
