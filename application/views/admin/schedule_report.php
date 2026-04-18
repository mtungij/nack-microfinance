
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $compdata->comp_name; ?> | Loan Schedle Report</title>
</head>
<body>

<div id="container">
  <style>
    .display{
      display: flex;
      
    }
  </style>
     <style>
             .c {
               text-transform: uppercase;
               }
                
                </style>

<table  style="border: none">
<tr style="border: none">
<td style="border: none">


<div style="width: 20%;">
<img src="<?php echo base_url().'assets/img/'.$compdata->comp_logo ?>" style="width: 100px;height: 80px;">
</div> 

</td>
<td style="border: none">
<div class="pull">
<p style="font-size:14px;" class="c"><b> <?php echo $compdata->comp_name; ?></b><br>
<b><?php echo $compdata->adress; ?></b> <br>
<?php $day = date("d-m-Y"); ?>
</p>
<p style="font-size:12px;text-align:center;" class="c"><?php //echo $blanch->blanch_name ?>
Loan Schedule / LOAN ACCOUNT NO  <?php echo $loan->loan_code; ?></p>

</div>
</td>
</tr>
</table>

 <hr>    
 
  <div id="body">
  <style> 
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
  background-color: ;
}

</style>
</head>
<body>



<table>
  <tr>
    <th style="font-size:12px;border: none;">S/No.</th>
    <th style="font-size:12px;border: none;">Date</th>
    <th style="font-size:12px;border: none;">Collection</th>
    <th style="font-size:12px;border: none;">Status</th>
  </tr>
  <?php $no = 1; ?>
  <?php foreach ($data_loan as $data_loan): ?>
 <tr>
  
    <td style="font-size:12px;border: none;" class="c"><?php echo $no++; ?></td>
    <td style="font-size:12px;border: none;" class="c">
      <?php echo $data_loan->date; ?>
      </td>
    <td style="font-size:12px;border: none;" class="c">
      <?php echo number_format($data_loan->restration); ?>
      </td>
    <td style="font-size:12px;border: none;" class="c"><?php echo $data_loan->date_status; ?></td>
  </tr>
 <?php endforeach; ?>

</table>
  </div>

</div>

</body>
</html>




