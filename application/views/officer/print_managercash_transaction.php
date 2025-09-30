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

$company_address = "Bundala Street, Dar es Salaam, Tanzania";
$company_email = "dnpmicrofinance@gmail.com";
$company_phone = "+255 758 409 884";
$logo_path = FCPATH . 'assets/img/dnplogo.jpeg';
$logo_url = 'file://' . $logo_path;


?>
    <!-- Company Header -->
    <!-- <div class="company-header">
    <div style="text-align: center;">
    <img src="<?= $logo_url ?>" alt="Company Logo" style="max-height: 100px; width: auto;" />
</div> -->
<div class="company-header">
        <h2><?= $company_name ?></h2>
        <!-- <p><?= htmlspecialchars($company_address) ?></p>
        <p>Email: <?= htmlspecialchars($company_email) ?> | Phone: <?= htmlspecialchars($company_phone) ?></p> -->
    </div>

    <!-- Report Title -->
    <h3 style="text-align: center; margin-top: 30px;">CASH TRANSANCTION REPORT:<?= $blanch_data->blanch_name; ?></h3>

    <!-- Table -->
    <table>
    <thead>
        <tr>
            <th>S/No</th>
            <th>JINA LA MTEJA</th>
            <!-- <th>Loan Officer</th> -->
            <th>Status</th>
            <th>Namba ya Simu</th>
            <th>Mkopo</th>
            <!-- <th>Product</th> -->
            <th>Muda Wa Marejesho</th>
            <th>Rejesho</th>
            <th>Account</th>
            <th>Wakala</th>
            <th>Lipwa</th>
            <th>Lazo</th>
            <th>Dabo</th>
            <th>Afisa</th>
            <th>Tarehe</th>
        </tr>
    </thead>
    <tbody>
  <?php 
$total_restration = 0;
$total_depost = 0;
$total_laza = 0;
$total_zidi = 0;

$status_summary = [];
$account_summary = [];
$no = 1;
?>

<?php foreach ($lazo['details'] as $item): ?>
    <?php
        $laza = 0;
        $zidi = 0;

        if ($item->depost < $item->restration) {
            $laza = $item->restration - $item->depost;
        } elseif ($item->depost > $item->restration) {
            $zidi = $item->depost - $item->restration;
        }

        $total_restration += $item->restration;
        $total_depost += $item->depost;
        $total_laza += $laza;
        $total_zidi += $zidi;

        // Normalize status
        $status = strtolower($item->loan_status);
        switch ($status) {
            case 'withdrawal': $status_label = 'Ndani ya Mkataba'; break;
            case 'out': $status_label = 'Nje ya Mkataba'; break;
            case 'disbursed': $status_label = 'Dabo'; break;
            case 'done': $status_label = 'Kamaliza'; break;
            default: $status_label = $item->loan_status;
        }

        // Add to status summary
        if (!isset($status_summary[$status_label])) {
            $status_summary[$status_label] = ['lipwa' => 0, 'lazo' => 0, 'dabo' => 0];
        }

        $status_summary[$status_label]['lipwa'] += $item->depost;
        $status_summary[$status_label]['lazo'] += $laza;
        $status_summary[$status_label]['dabo'] += $zidi;

        // Add to account summary
        $account = $item->account_name ?? 'Haijatajwa';
        if (!isset($account_summary[$account])) {
            $account_summary[$account] = ['lipwa' => 0, 'lazo' => 0, 'dabo' => 0];
        }

        $account_summary[$account]['lipwa'] += $item->depost;
        $account_summary[$account]['lazo'] += $laza;
        $account_summary[$account]['dabo'] += $zidi;
    ?>           
    <tr>
        <td><?= $no++ ?>.</td>
        <td><?= strtoupper(htmlspecialchars($item->full_name)) ?></td>
        <td><?= $status_label ?></td>
        <td><?= htmlspecialchars((strpos($item->phone_no, '255') === 0) ? '0' . substr($item->phone_no, 3) : $item->phone_no) ?></td>
        <td><?= number_format($item->loan_amount) ?></td>
        <td>
            <?php 
                if ($item->day == '1') {
                    $frequency = "Siku";
                } elseif ($item->day == '7') {
                    $frequency = "Wiki";
                } elseif (in_array($item->day, ['28','29','30','31'])) {
                    $frequency = "Mwezi";
                } else {
                    $frequency = "Other";
                }
                echo $frequency . " (" . htmlspecialchars($item->session) . ")";
            ?>
        </td>
        <td><?= number_format($item->restration) ?></td>
        <td><?= $item->account_name ?></td>
        <td><?= $item->wakala ?></td>
        <td><?= number_format($item->depost) ?></td>
        <td><?= $laza > 0 ? number_format($laza) : 0 ?></td>
        <td><?= $zidi > 0 ? number_format($zidi) : 0 ?></td>
        <td><?= !empty($item->depositor_username) ? htmlspecialchars($item->depositor_username) : '' ?></td>
        <td><?= htmlspecialchars($item->expected_date) ?></td>
    </tr>
<?php endforeach; ?>

<!-- Totals Row -->
<tr class="total-row">
    <td colspan="6"><b>JUMLA</b></td>
    <td><b><?= number_format($total_restration) ?></b></td>
    <td colspan="2"></td>
    <td><b><?= number_format($total_depost) ?></b></td>
    <td><b><?= number_format($total_laza) ?></b></td>
    <td><b><?= number_format($total_zidi) ?></b></td>
    <td colspan="2"></td>
</tr>


    </tbody>
</table>

<br><br>
<h4>Muhtasari wa Malipo kwa Kila Status</h4>
<table>
    <thead>
        <tr>
            <th>Status</th>
            <th>Jumla ya Lipwa</th>
            <th>Jumla ya Lazo</th>
            <th>Jumla ya Dabo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($status_summary as $status => $data): ?>
        <tr>
            <td><?= $status ?></td>
            <td><?= number_format($data['lipwa']) ?></td>
            <td><?= number_format($data['lazo']) ?></td>
            <td><?= number_format($data['dabo']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h1>MALIPO YA FAINI</h1>
<table>
    <thead>
        <tr>
            <th>S/No</th>
            <th>Jina la Mteja</th>
            <th>Namba ya Simu</th>
            <th>Aina ya Mapato</th>
            <th>Kiasi</th>
            <th>Afisa</th>
            <th>Tarehe</th>
        </tr>
    </thead>
    <tbody>
    <?php if(!empty($faini)): ?>
        <?php $sno = 1; $total_receve = 0; ?>
        <?php foreach($faini as $detail): ?>
            <?php $total_receve += $detail->receve_amount ?? 0; ?>
            <tr>
                <td><?= $sno++ ?></td>
                <td><?= htmlspecialchars($detail->f_name ?? '') . ' ' . htmlspecialchars($detail->m_name ?? '') . ' ' . htmlspecialchars($detail->l_name ?? '') ?></td>
                <td><?= htmlspecialchars($detail->phone_no ?? '') ?></td>
                <td><?= htmlspecialchars($detail->inc_name ?? '') ?></td>
                <td><?= number_format($detail->receve_amount ?? 0) ?></td>
                <td><?= htmlspecialchars($detail->empl ?? '') ?></td>
                <td><?= htmlspecialchars($detail->receve_day ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
        <!-- Totals Row -->
        <tr style="font-weight:bold; background-color:#ddd;">
            <td colspan="4" style="text-align:right;"><b>Jumla ya Malipo:</b></td>
            <td><b><?= number_format($total_receve) ?></b></td>
            <td colspan="2"></td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="7" style="text-align:center;">Hakuna taarifa za leo.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>


<h1>GAWA</h1>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>S/No</th>
            <th>Jina la Mteja</th>
            <th>Namba ya Simu</th>
            <!-- <th>Aina ya Mkopo</th> -->
            <th>Kiasi cha Mkopo</th>
            <th>Fomu</th>
            <th>Loan Status</th>
            <th>Status ya Mkopo</th> <!-- ✅ mpya -->
            <th>Tarehe ya Kutolewa</th>
            <th>Aliyepitisha</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($gawa)): ?>
            <?php 
                $sno = 1;
                $total_loan = 0;
                $total_form = 0;
            ?>
            <?php foreach ($gawa as $item): ?>
                <?php
                    // 🔹 Accumulate totals
                    $total_loan += $item->loan_aprove;
                    $total_form += $item->deducted_balance ?: 0;

                    // 🔹 Determine badge / tick
                    $status_badge = '';
                    if ($item->loan_status == 'disbursed' && empty($item->deducted_balance)) {
                        $status_badge = '<span style="color:orange; font-weight:bold;">Mkopo umepitishwa ila hujagawiwa</span>';
                    } elseif ($item->loan_status == 'withdrawal') {
                        $status_badge = '<span style="color:green; font-weight:bold;">&#10004; Mkopo umepitishwa na kugawiwa</span>';
                    } else {
                        $status_badge = htmlspecialchars($item->loan_status);
                    }
                ?>
                <tr>
                    <td><?= $sno++; ?></td>
                    <td><?= htmlspecialchars($item->f_name . ' ' . $item->m_name . ' ' . $item->l_name) ?></td>
                    <td><?= htmlspecialchars($item->phone_no) ?></td>
                    <!-- <td><?= htmlspecialchars($item->loan_name) ?></td> -->
                    <td><?= number_format($item->loan_aprove, 2) ?></td>
                    <td><?= $item->deducted_balance ? number_format($item->deducted_balance, 2) : '0.00' ?></td>
                    <td><?= htmlspecialchars($item->loan_status) ?></td>
                    <td><?= $status_badge ?></td> <!-- ✅ mpya -->
                    <td><?= !empty($item->disburse_day) ? date('d-m-Y', strtotime($item->disburse_day)) : '-' ?></td>
                    <td><?= htmlspecialchars($item->approved_by ?: 'N/A') ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- 🔹 Totals row -->
            <tr style="font-weight:bold; background:#f0f0f0;">
                <td colspan="3" style="text-align:right;"><b>JUMLA</b></td>
                <td><b><?= number_format($total_loan, 2) ?></b></td>
                <td><b><?= number_format($total_form, 2) ?></b></td>
                <td colspan="4"></td>
            </tr>

        <?php else: ?>
            <tr>
                <td colspan="9" style="text-align:center;">Hakuna mikopo iliyotolewa leo.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>




    
</body>
</html>
