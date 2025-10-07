


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
$company_name = "NACK CREDIT LIMITED";
$company_phone = "+255 753 979 112";



?>
    <!-- Company Header -->
    <div class="company-header">
   
        <h2><?= htmlspecialchars($company_name) ?></h2>
       
        <p> Phone: <?= htmlspecialchars($company_phone) ?></p>
    </div>

    <!-- Report Title -->
    <h3 style="text-align: center; margin-top: 30px;">FAINI REPORT</h3>

    <!-- Table -->
  <table>
<tr>
<th >Customer Name</th>
<th >Branch Name</th>
<th >Income Type</th>
<th >Income Amount </th>
<th >User Employee</th>
<th >Date</th>
</tr>

                     <?php foreach ($detail_income as $detail_incomes): ?>
                          <tr>
                        <td ><?php  echo $detail_incomes->f_name; ?> <?php  echo $detail_incomes->m_name; ?> <?php  echo $detail_incomes->l_name; ?></td>
                         <td  class="c"><?php  echo $detail_incomes->blanch_name; ?></td>
                         <td > <?php  echo $detail_incomes->inc_name; ?></td>
                         <td >
                             <?php  echo number_format($detail_incomes->receve_amount); ?>
                         </td>
                         <td >
                        <?php  echo $detail_incomes->empl; ?>
                         </td>
                         <td > <?php  echo $detail_incomes->receve_day; ?></td>
                        </tr>
                  <?php endforeach; ?>
                            </tbody>
          
            <tr>
        <td ><?php //echo substr(@$pay_customers->pay_day, 0,10); ?><b>TOTAL</b></td>
        <td >  </td>
        <td ><b><?php //echo number_format(@$sum_recevable->total_recevable); ?></b></td>
        <td ><b><?php echo number_format($total_receved->total_receved); ?></b></td>
        <td ><b><?php //echo number_format(@$sum_penart->total_penart); ?></b></td>
        <td ><b><?php //echo number_format(@$sum_penart->total_penart); ?></b></td>
        </tr>
        

</table>

<br><br>

<!-- ✅ Depositor Summary Section -->
<?php if (!empty($lazo['details'])): ?>
    <h3>MHUTASARI WA MALIPO</h3>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>S/No</th>
                <th>DEPOSITOR</th>
                <th>Jumla ya Deposit (TSh)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $depositor_summary = [];

                foreach ($lazo['details'] as $item) {
                    $username = $item->depositor_username ?? '';

                    if (!empty($username)) {
                        if (!isset($depositor_summary[$username])) {
                            $depositor_summary[$username] = 0;
                        }
                        $depositor_summary[$username] += $item->depost;
                    }
                }

                if (!empty($depositor_summary)):
                    $sn = 1;
                    foreach ($depositor_summary as $username => $sum_depost):
            ?>
                <tr>
                    <td><b><?= $sn++ ?>.</b></td>
                    <td><b><?= htmlspecialchars(strtoupper($username)) ?></b></td>
                    <td><b><?= number_format($sum_depost) ?></b></td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Hakuna walio deposit leo.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>

    


</body>
</html>


