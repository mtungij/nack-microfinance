<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Outstand Loan Report</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }
    .header { text-align: center; margin-bottom: 10px; }
    .header img { max-height: 80px; margin-bottom: 6px; }
    table { border-collapse: collapse; width: 100%; margin-top: 8px; }
    th, td { border: 1px solid #ddd; padding: 5px 6px; text-align: left; }
    th { background: #00bcd4; color: #fff; }
    .total-row { background: #f2f2f2; font-weight: bold; }
    .muted { color: #666; font-size: 10px; }
  </style>
</head>
<body>
<?php
  $companyName = isset($company_data->comp_name) ? $company_data->comp_name : '';
  $companyAddress = isset($company_data->adress) ? $company_data->adress : '';
  $companyEmail = isset($company_data->email) ? $company_data->email : '';
  $companyPhone = isset($company_data->phone_no) ? $company_data->phone_no : '';
  $branchCode = isset($blanch_data->branch_code) ? $blanch_data->branch_code : '';

  $logo_url = '';
  $companyLogo = isset($company_data->comp_logo) ? $company_data->comp_logo : '';
  if (!empty($companyLogo) && file_exists(FCPATH . 'assets/images/company_logo/' . $companyLogo)) {
    $logo_url = 'file://' . FCPATH . 'assets/images/company_logo/' . $companyLogo;
  } elseif (!empty($companyLogo) && file_exists(FCPATH . 'assets/img/' . $companyLogo)) {
    $logo_url = 'file://' . FCPATH . 'assets/img/' . $companyLogo;
  }

  $today = date('d-m-Y');
  $range = '';
  if (!empty($start_date) || !empty($end_date)) {
    $range = trim(($start_date ?: '') . ' - ' . ($end_date ?: ''));
  }
?>

<div class="header">
  <?php if ($logo_url): ?>
    <img src="<?= $logo_url; ?>" alt="Company Logo" />
  <?php endif; ?>
  <div><strong><?= htmlspecialchars($companyName); ?></strong></div>
  <div><?= htmlspecialchars($companyAddress); ?></div>
  <div><?= htmlspecialchars($companyEmail); ?> <?= !empty($companyPhone) ? ' | ' . htmlspecialchars($companyPhone) : ''; ?></div>
  <div><strong>Outstand Loan Report</strong> - <?= $today; ?></div>
  <?php if (!empty($branchCode)): ?>
    <div class="muted">Branch Code: <?= htmlspecialchars($branchCode); ?></div>
  <?php endif; ?>
  <?php if (!empty($range)): ?>
    <div class="muted">Range: <?= htmlspecialchars($range); ?></div>
  <?php endif; ?>
</div>

<table>
  <thead>
    <tr>
      <th>S/No</th>
      <th>Branch Name</th>
      <th>Customer Name</th>
      <th>Phone Number</th>
      <th>Loan Amount</th>
      <th>Restoration</th>
      <th>Duration Type</th>
      <th>Number of Repayment</th>
      <th>Remain Amount</th>
      <th>Pending Day</th>
      <th>Start date</th>
      <th>End date</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; ?>
    <?php if (!empty($outstand)): ?>
      <?php foreach ($outstand as $item): ?>
        <?php
          $duration = '';
          if ($item->day == '1') {
            $duration = 'Daily';
          } elseif ($item->day == '7') {
            $duration = 'Weekly';
          } elseif ($item->day == '30') {
            $duration = 'Monthly';
          }

          $endDateStr = substr($item->loan_end_date ?? '', 0, 10);
          $endDate = DateTime::createFromFormat('Y-m-d', $endDateStr);
          $todayDate = new DateTime();
          $pendingDays = 0;
          if ($endDate instanceof DateTime) {
            $diff = $endDate->diff($todayDate);
            $pendingDays = $diff->invert ? 0 : $diff->days;
          }
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= htmlspecialchars($item->blanch_name ?? ''); ?></td>
          <td><?= htmlspecialchars(trim(($item->f_name ?? '') . ' ' . ($item->m_name ?? '') . ' ' . ($item->l_name ?? ''))); ?></td>
          <td><?= htmlspecialchars($item->phone_no ?? ''); ?></td>
          <td><?= number_format($item->loan_int ?? 0); ?></td>
          <td><?= number_format($item->restration ?? 0); ?></td>
          <td><?= htmlspecialchars($duration); ?></td>
          <td><?= htmlspecialchars($item->session ?? ''); ?></td>
          <td><?= number_format($item->remain_amount ?? 0); ?></td>
          <td><?= $pendingDays; ?></td>
          <td><?= htmlspecialchars($item->loan_stat_date ?? ''); ?></td>
          <td><?= htmlspecialchars($endDateStr); ?></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
    <tr class="total-row">
      <td>TOTAL</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= number_format($total_remain->total_out ?? 0); ?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>

</body>
</html>
