
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php
  $lang_line = function ($key, $fallback) {
    $value = $this->lang->line($key);
    return !empty($value) ? $value : $fallback;
  };

  $txt_all_customer_report = $lang_line('pdf_all_customer_report', 'All Customer Report');
  $txt_s_no = $lang_line('s_no', 'S/No.');
  $txt_customer_id = $lang_line('customer_id', 'Customer ID');
  $txt_customer_name = $lang_line('customer_name', 'Customer Name');
  $txt_phone_number = $lang_line('phone_number', 'Phone Number');
  $txt_date_of_birth = $lang_line('date_of_birth', 'Date Of Birth');
  $txt_sex = $lang_line('sex', 'Sex');
  $txt_branch_name = $lang_line('branch_name', 'Branch');
  $txt_region = $lang_line('region', 'Region');
  $txt_district = $lang_line('district', 'District');
  $txt_ward = $lang_line('ward', 'Ward');
  $txt_street = $lang_line('street', 'Street');
  $txt_joining_date = $lang_line('joining_date', 'Joining Date');
  ?>
  <title><?php echo $compdata->comp_name; ?> | <?php echo $txt_all_customer_report; ?> </title>
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
<?php //$day = date("d-m-Y"); ?>
</p>
<p style="font-size:12px;text-align:center;" class="c"><?php echo $blanch->blanch_name; ?> - <?php echo $txt_all_customer_report; ?> <?php //echo $day; ?></p>

</div>
</td>
</tr>
</table>

    
 
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
 <hr>


<table>
  <tr>
    <th style="font-size:12px;border: none;"><?php echo $txt_s_no; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_customer_id; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_customer_name; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_phone_number; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_date_of_birth; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_sex; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_branch_name; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_region; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_district; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_ward; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_street; ?></th>
    <th style="font-size:12px;border: none;"><?php echo $txt_joining_date; ?></th>
  </tr>
   <?php $no = 1; ?>
  <?php foreach ($customer as $customers): ?>
    
 
 <tr>
    <td style="font-size:12px;border: none;" class="c"><?php echo $no++; ?>.</td>
    <td style="font-size:12px;border: none;" class="c"><?php echo $customers->customer_code; ?></td>
    <td style="font-size:12px;border: none;" class="c">
      <?php echo $customers->f_name; ?> <?php echo $customers->m_name; ?> <?php echo $customers->l_name; ?> 
      </td>
    <td style="font-size:12px;border: none;" class="c"><?php echo $customers->phone_no; ?></td>
    <td style="font-size:12px;border: none;"><?php echo $customers->date_birth; ?></td>
    <td style="font-size:12px;border: none;"><?php echo $customers->gender; ?></td>
    <td style="font-size:12px;border: none;"><?php echo $customers->blanch_name; ?></td>
    <td style="font-size:12px;border: none;"><?php echo $customers->region_name; ?></td>
    <td style="font-size:12px;border: none;"><?php echo $customers->district; ?></td>
    <td style="font-size:12px;border: none;"><?php echo $customers->ward; ?></td>
    <td style="font-size:12px;border: none;"><?php echo $customers->street; ?></td>
    <td style="font-size:12px;border: none;"><?php echo substr($customers->customer_day, 0,10); ?></td>
  </tr>
 <?php endforeach; ?>
 

</table>

  </div>

</div>

</body>
</html>




