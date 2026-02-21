<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $compdata->comp_name ?> | Yesterday's Defaulters</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 15px; }
        .header h2 { margin: 2px 0; }
        .header p { margin: 2px 0; font-size: 12px; }

        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background-color: #00bcd4; color: #fff; font-size: 12px; }
        td { font-size: 11px; }
        .total-row { font-weight: bold; background-color: #f2f2f2; }
    </style>
</head>
<body>

<div class="header">
    <h2><?= $compdata->comp_name ?></h2>
    <h4>Branch: <?= $blanch_data->blanch_name ?></h4>
    <p><strong>Report:</strong> Yesterday's Defaulters</p>
    <p><strong>Date:</strong> <?= date("d-m-Y", strtotime('-1 day')) ?></p>
</div>

<table>
    <thead>
        <tr>
            <th>S/No.</th>
            <th>JINA LA MTEJA</th>
            <th>NAMBA YA SIMU</th>
            <th>KIASI CHA MKOPO</th>
            <th>REJESHO</th>
            <th>MUDA</th>
            <th>LIPWA</th>
            <th>BAKI</th>
            <th>SIKU ZA KUKOSA</th>
            <th>TAREHE YA KUANZA</th>
            <th>TAREHE YA KUISHIA</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total_loan = 0;
        $total_restoration = 0;
        $total_paid = 0;
        $total_remain = 0;
        ?>

        <?php if (!empty($outstand)): ?>
            <?php $no = 1; foreach ($outstand as $loan): ?>
                <?php
                    $remain = $loan->loan_int - $loan->total_deposit;
                    $total_loan += $loan->loan_int;
                    $total_restoration += $loan->restration;
                    $total_paid += $loan->total_deposit;
                    $total_remain += $remain;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= strtoupper($loan->f_name . ' ' . $loan->m_name . ' ' . $loan->l_name) ?></td>
                    <td><?= $loan->phone_no ?></td>
                    <td><?= number_format($loan->loan_int) ?></td>
                    <td><?= number_format($loan->restration) ?></td>
                    <td>
                        <?php
                            if ($loan->day == 1) $dur = "Daily";
                            elseif ($loan->day == 7) $dur = "Weekly";
                            elseif (in_array($loan->day, [28,29,30,31])) $dur = "Monthly";
                            else $dur = "-";
                            echo $dur . " (" . $loan->session . ")";
                        ?>
                    </td>
                    <td><?= number_format($loan->total_deposit) ?></td>
                    <td><?= number_format($remain) ?></td>
                    <td><?= $loan->loan_int == $loan->total_deposit ? 0 : $loan->overdue_days ?></td>
                    <td><?= substr($loan->loan_stat_date, 0, 10) ?></td>
                    <td><?= substr($loan->loan_end_date, 0, 10) ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Totals Row -->
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Totals:</td>
                <td><?= number_format($total_loan) ?></td>
                <td><?= number_format($total_restoration) ?></td>
                <td></td>
                <td><?= number_format($total_paid) ?></td>
                <td><?= number_format($total_remain) ?></td>
                <td colspan="3"></td>
            </tr>

        <?php else: ?>
            <tr>
                <td colspan="11" style="text-align:center;">No defaulters found yesterday.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>