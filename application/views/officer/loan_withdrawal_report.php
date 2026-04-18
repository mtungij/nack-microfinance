<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($comp_data->comp_name) ?> - Cash Transaction</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #00bcd4;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total-row {
            background-color: #ddd;
            font-weight: bold;
        }
        .company-header {
            text-align: center;
            margin-top: 20px;
        }
        .company-header img {
            max-height: 80px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php 
$company_name = "CDC MICROFINANCE LIMITED";
$company_address = "Anglicana Street, TARIME, Tanzania";
$company_email = "cdcmicrofinance@gmail.com";
$company_phone = "+255 763 727 272";
$logo_path = FCPATH . 'assets/img/cdclogo.png';
$logo_url = 'file://' . $logo_path;


?>
    <!-- Company Header -->
    <div class="company-header">
    <div style="text-align: center;">
    <img src="<?= $logo_url ?>" alt="Company Logo" style="max-height: 100px; width: auto;" />
</div>

        <h2><?= htmlspecialchars($company_name) ?></h2>
        <p><?= htmlspecialchars($company_address) ?></p>
        <p>Email: <?= htmlspecialchars($company_email) ?> | Phone: <?= htmlspecialchars($company_phone) ?></p>
    </div>

    <!-- Report Title -->
    <h3 style="text-align: center; margin-top: 30px;">MIKOPO REPORT-<?= $blanch->blanch_name; ?></h3>

    <!-- Table -->
    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr style="background-color: #f0f0f0;">
            <th>S/no</th>
            <th>JINA LA MTEJA</th>
          
            <th>KIASI CHA MKOPO</th>
            <th>MAREJESHO YA</th>
            <th>REJESHO</th>
            <th>Tarehe Ya Kuchukua</th>
            <th>Tarehe Ya Kumaliza</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sno = 1; 
        $grand_total_withdrawal = 0;
        ?>

        <?php foreach($disburse_grouped as $empl_name => $loans): ?>
            <!-- Employee Header -->
            <tr class="employee-header" style="background-color: #d9eaf7; font-weight: bold;">
                <td colspan="8"><b><?= htmlspecialchars(strtoupper($empl_name)); ?></b></td>
            </tr>

            <?php $total_withdrawal = 0; ?>
            <?php foreach($loans as $loan): ?>
                <?php $total_withdrawal += $loan->with_amount; ?>
                <tr>
                    <td><?= $sno++; ?></td>
                    <td><?= htmlspecialchars(strtoupper($loan->f_name . " " . $loan->m_name . " " . $loan->l_name)); ?></td>
                   
                    <td style="text-align: right;"><?= number_format($loan->with_amount); ?></td>
                    <td>
                        <?php
                            if ($loan->day == 1) $frequency = "Siku";
                            elseif ($loan->day == 7) $frequency = "Week";
                            elseif (in_array($loan->day, [28,29,30,31])) $frequency = "Mwezi";
                            else $frequency = "Other";
                            echo htmlspecialchars($frequency . " (" . $loan->session . ")");
                        ?>
                    </td>
                    <td style="text-align: right;"><?= number_format($loan->restration); ?></td>
                    <td><?= htmlspecialchars(date('Y-m-d', strtotime($loan->loan_stat_date))); ?></td>
                    <td><?= htmlspecialchars(substr($loan->loan_end_date, 0, 10)); ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Subtotal -->
            <tr class="subtotal" style="font-weight: bold; background-color: #eef5fc;">
                <td colspan="2" style="text-align:right;"><b>JUMLA YA</b> <b><?= htmlspecialchars(strtoupper($empl_name)); ?></b>:</td>
                <td style="text-align: right;"><b><?= number_format($total_withdrawal); ?></b></td>
                <td colspan="4"></td>
            </tr>

            <?php $grand_total_withdrawal += $total_withdrawal; ?>
        <?php endforeach; ?>
    </tbody>

    <tfoot>
        <tr class="general-total" style="font-weight: bold; background-color: #c7d8f9;">
            <td colspan="2" style="text-align:right;"><b>GENERAL TOTAL:</b></td>
            <td style="text-align: right;"><b><?= number_format($grand_total_withdrawal); ?></b></td>
            <td colspan="4"></td>
        </tr>
    </tfoot>
</table>


    
</body>
</html>




 <!-- #region 
  -->


  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Loan Withdrawal Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #007BFF; color: white; }
        .employee-header { background: #ddd; font-weight: bold; }
        .subtotal { background: #f0f0f0; font-weight: bold; }
        .general-total { background: #007BFF; color: white; font-weight: bold; }
    </style>
</head>
<body>

<h2>Loan Withdrawal Report</h2>

<table>
    <thead>
        <tr>
            <th>S/no</th>
            <th>Customer Name</th>
            <th>Afisa</th>
            <th>Loan Withdrawal</th>
            <th>Duration Type</th>
            <th>Restoration</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sno = 1; 
        $grand_total_withdrawal = 0;
        ?>

        <?php foreach($disburse_grouped as $empl_name => $loans): ?>
            <!-- Employee Header -->
            <tr class="employee-header">
                <td colspan="8"><?php echo strtoupper($empl_name); ?></td>
            </tr>

            <?php $total_withdrawal = 0; ?>
            <?php foreach($loans as $loan): ?>
                <?php $total_withdrawal += $loan->with_amount; ?>
                <tr>
                    <td><?= $sno++; ?></td>
                    <td><?= strtoupper($loan->f_name . " " . $loan->m_name . " " . $loan->l_name); ?></td>
                    <td><?= $loan->empl_name; ?></td>
                    <td><?= number_format($loan->with_amount); ?></td>
                    <td>
                        <?php
                            if ($loan->day == 1) $frequency = "Daily";
                            elseif ($loan->day == 7) $frequency = "Weekly";
                            elseif (in_array($loan->day, [28,29,30,31])) $frequency = "Monthly";
                            else $frequency = "Other";
                            echo $frequency . " (" . $loan->session . ")";
                        ?>
                    </td>
                    <td><?= number_format($loan->restration); ?></td>
                    <td><?= $loan->loan_stat_date; ?></td>
                    <td><?= substr($loan->loan_end_date, 0, 10); ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Subtotal -->
            <tr class="subtotal">
                <td colspan="3" style="text-align:right;">TOTAL for <?= strtoupper($empl_name); ?>:</td>
                <td><?= number_format($total_withdrawal); ?></td>
                <td colspan="4"></td>
            </tr>

            <?php $grand_total_withdrawal += $total_withdrawal; ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr class="general-total">
            <td colspan="3" style="text-align:right;">GENERAL TOTAL:</td>
            <td><?= number_format($grand_total_withdrawal); ?></td>
            <td colspan="4"></td>
        </tr>
    </tfoot>
</table>

</body>
</html>
