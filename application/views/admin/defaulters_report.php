<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $compdata->comp_name; ?> | DEFAULTERS REPORT</title>
</head>
<body>

<div id="container">
  <style>
    .display{
      display: flex;
    }
    .c {
      text-transform: uppercase;
    }
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 5px;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .total-row {
      background-color: #4CAF50;
      color: white;
      font-weight: bold;
    }
  </style>

  <table style="border: none">
    <tr style="border: none">
      <td style="border: none">
        <div style="width: 20%;">
          <img src="<?php echo base_url().'assets/img/'.$compdata->comp_logo ?>" style="width: 100px;height: 80px;">
        </div> 
      </td>
      <td style="border: none">
        <div class="pull">
          <p style="font-size:14px;" class="c">
            <b><?php echo $compdata->comp_name; ?></b><br>
            <b><?php echo $compdata->adress; ?></b> <br>
          </p>
          <p style="font-size:12px;text-align:center;" class="c">
            DEFAULTERS/OUTSTANDING LOANS REPORT<br>
            Date: <?php echo date("d-m-Y"); ?>
          </p>
          
          <?php if ($blanch_data): ?>
            <p style="font-size:11px;text-align:center;">
              <b>Branch:</b> <?php echo $blanch_data->blanch_name; ?>
            </p>
          <?php endif; ?>
          
          <?php if ($empl_data): ?>
            <p style="font-size:11px;text-align:center;">
              <b>Employee:</b> <?php echo $empl_data->empl_name; ?>
            </p>
          <?php endif; ?>
          
          <?php if ($from && $to): ?>
            <p style="font-size:11px;text-align:center;">
              <b>Period:</b> <?php echo date('d-m-Y', strtotime($from)); ?> to <?php echo date('d-m-Y', strtotime($to)); ?>
            </p>
          <?php endif; ?>
          
          <?php if (!empty($overdue_days)): ?>
            <p style="font-size:11px;text-align:center;">
              <b>Overdue Days:</b> <?php echo $overdue_days; ?>+ days
            </p>
          <?php endif; ?>
        </div>
      </td>
    </tr>
  </table>

  <div id="body">
    <hr>

    <table>
      <thead>
        <tr>
          <th style="font-size:12px;">S/No.</th>
          <th style="font-size:12px;">Branch Name</th>
          <th style="font-size:12px;">Customer Name</th>
          <th style="font-size:12px;">Phone Number</th>
          <th style="font-size:12px;">Loan Amount</th>
          <th style="font-size:12px;">Restoration</th>
          <th style="font-size:12px;">Duration</th>
          <th style="font-size:12px;">Paid Amount</th>
          <th style="font-size:12px;">Remain Amount</th>
          <th style="font-size:12px;">Overdue Days</th>
          <th style="font-size:12px;">Start Date</th>
          <th style="font-size:12px;">End Date</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        <?php if (!empty($outstand)): ?>
          <?php foreach ($outstand as $outstands): ?>
            <tr>
              <td style="font-size:11px;" class="c"><?php echo $no++; ?>.</td>
              <td style="font-size:11px;" class="c"><?php echo $outstands->blanch_name; ?></td>
              <td style="font-size:11px;" class="c">
                <?php echo $outstands->f_name . ' ' . $outstands->m_name . ' ' . $outstands->l_name; ?>
              </td>
              <td style="font-size:11px;"><?php echo $outstands->phone_no; ?></td>
              <td style="font-size:11px;"><?php echo number_format($outstands->loan_int); ?></td>
              <td style="font-size:11px;"><?php echo number_format($outstands->restration); ?></td>
              <td style="font-size:11px;">
                <?php 
                  if ($outstands->day == 1) $duration = "Daily";
                  elseif ($outstands->day == 7) $duration = "Weekly";
                  elseif (in_array($outstands->day, [28, 29, 30, 31])) $duration = "Monthly";
                  else $duration = "-";
                  echo $duration . ' (' . number_format($outstands->session) . ')';
                ?>
              </td>
              <td style="font-size:11px;"><?php echo number_format($outstands->total_deposit); ?></td>
              <td style="font-size:11px;"><?php echo number_format($outstands->loan_int - $outstands->total_deposit); ?></td>
              <td style="font-size:11px;"><b><?php echo $outstands->overdue_days; ?></b></td>
              <td style="font-size:11px;"><?php echo substr($outstands->loan_stat_date, 0, 10); ?></td>
              <td style="font-size:11px;"><?php echo substr($outstands->loan_end_date, 0, 10); ?></td>
            </tr>
          <?php endforeach; ?>
          
          <!-- Total Row -->
          <tr class="total-row">
            <td colspan="8" style="font-size:12px;text-align:right;"><b>TOTAL OUTSTANDING:</b></td>
            <td colspan="4" style="font-size:12px;"><b><?php echo number_format($total_remain->total_remain ?? 0); ?></b></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="12" style="text-align:center;padding:20px;">No defaulters found for the selected criteria.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <br><br>
    <p><b>Authorised Name: .......................................</b> &nbsp;&nbsp;&nbsp;&nbsp; 
       <b>Position: .......................................</b> &nbsp;&nbsp;&nbsp;&nbsp; 
       <b>Signature: .......................................</b>
    </p>
    <p><b>Authorised Name: .......................................</b> &nbsp;&nbsp;&nbsp;&nbsp; 
       <b>Position: .......................................</b> &nbsp;&nbsp;&nbsp;&nbsp; 
       <b>Signature: .......................................</b>
    </p>
  </div>

</div>

</body>
</html>
