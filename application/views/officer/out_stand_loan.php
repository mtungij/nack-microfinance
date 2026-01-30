
<?php
include_once APPPATH . "views/partials/officerheader.php";

?>


           



	<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

		<?php
		  $start_date_value = isset($start_date) ? $start_date : '';
		  $end_date_value = isset($end_date) ? $end_date : '';
		  $download_query = http_build_query([
		    'start_date' => $start_date_value,
		    'end_date' => $end_date_value,
		  ]);
		?>
		<div class="mb-4 flex w-full flex-col items-center gap-4 lg:flex-row lg:justify-center">
			<form method="get" action="<?php echo base_url('oficer/get_outstand_loan'); ?>" class="flex w-full flex-col items-end gap-3 sm:flex-row sm:items-end sm:justify-center">
				<div class="w-full sm:w-auto">
					<label class="block text-xs font-medium text-gray-600 mb-1">Start date</label>
					<input type="date" name="start_date" value="<?php echo htmlspecialchars($start_date_value, ENT_QUOTES, 'UTF-8'); ?>" class="h-9 w-full rounded-lg border border-gray-200 px-3 text-sm text-gray-700 focus:border-cyan-500 focus:ring-cyan-500" />
				</div>
				<div class="w-full sm:w-auto">
					<label class="block text-xs font-medium text-gray-600 mb-1">End date</label>
					<input type="date" name="end_date" value="<?php echo htmlspecialchars($end_date_value, ENT_QUOTES, 'UTF-8'); ?>" class="h-9 w-full rounded-lg border border-gray-200 px-3 text-sm text-gray-700 focus:border-cyan-500 focus:ring-cyan-500" />
				</div>
				<button type="submit" class="h-9 w-full rounded-lg bg-cyan-600 px-4 text-sm font-medium text-white hover:bg-cyan-700 sm:w-auto">Filter</button>
			</form>

			<div class="flex w-full flex-col items-end gap-3 sm:flex-row sm:items-end sm:justify-center">
				<div class="w-full sm:w-auto">
					<label class="block text-xs font-medium text-gray-600 mb-1">Search</label>
					<input type="text" id="outstand-search" placeholder="Search..." class="h-9 w-full rounded-lg border border-gray-200 px-3 text-sm text-gray-700 focus:border-cyan-500 focus:ring-cyan-500" />
				</div>
				<a href="<?php echo base_url('oficer/download_outstand_loan') . ($download_query ? '?' . $download_query : ''); ?>" class="h-9 w-full inline-flex items-center justify-center rounded-lg border border-cyan-200 bg-cyan-50 px-4 text-sm font-medium text-cyan-700 hover:bg-cyan-100 sm:w-auto">Export PDF</a>
			</div>
		</div>
		<!--begin: Datatable -->
		<div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
		<table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700 dark:divide-gray-700 dark:text-gray-300" id="kt_table_1">
							     <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-800 dark:text-gray-400">
							          <tr>
							    		    <th class="px-4 py-3 text-left font-semibold">S/No.</th>
							    		    <th class="px-4 py-3 text-left font-semibold">Branch Name</th>
										<th class="px-4 py-3 text-left font-semibold">Customer Name</th>
										<th class="px-4 py-3 text-left font-semibold">Phone Number</th>
										<th class="px-4 py-3 text-left font-semibold">Loan Amount</th>
										<th class="px-4 py-3 text-left font-semibold">Restoration</th>
										<th class="px-4 py-3 text-left font-semibold">Duration Type</th>
										<th class="px-4 py-3 text-left font-semibold">Number of Repayment</th>
										<th class="px-4 py-3 text-left font-semibold">Remain Amount</th>
										<th class="px-4 py-3 text-left font-semibold">pending Day</th>
										<th class="px-4 py-3 text-left font-semibold">Satart date</th>
										<th class="px-4 py-3 text-left font-semibold">End date</th>
								           </tr>
			                  </thead>
			
								    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                          <?php $no = 1; ?>
									<?php foreach ($outstand as $outstands): ?>
									          <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
							  			<td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100 c"><?php echo $no++; ?> </td>
							  			<td class="px-4 py-2 text-gray-700 dark:text-gray-300 c">
				  					   <?php echo $outstands->blanch_name; ?>
				  					</td>
							  			<td class="px-4 py-2 text-gray-700 dark:text-gray-300 c">
				  						<?php echo $outstands->f_name; ?> <?php echo $outstands->m_name; ?> <?php echo $outstands->l_name; ?>
				  					</td>
							  			<td class="px-4 py-2 text-gray-700 dark:text-gray-300"><?php echo $outstands->phone_no; ?></td>
							  			<td class="px-4 py-2 text-gray-700 dark:text-gray-300"><?php echo number_format($outstands->loan_int); ?></td> 
							  			<td class="px-4 py-2 text-gray-700 dark:text-gray-300"><?php echo number_format($outstands->restration); ?></td> 
							  			<td class="px-4 py-2 text-gray-700 dark:text-gray-300">
				  						
				  						<?php if($outstands->day == '1'){ ?>
				  							<?php echo "Daily"; ?>
				  						
				  						<?php }elseif ($outstands->day == '7'){
				  							echo "Weekly";
				  						 ?>
				  						 <?php }elseif ($outstands->day == '30') {
				  						 	echo "Monthly";
				  						  ?>
				  						  <?php } ?>	
						  				</td> 
				  			 
			
					<td class="px-4 py-2 text-gray-700 dark:text-gray-300"><?php echo $outstands->session; ?></td> 
					<td class="px-4 py-2 text-gray-700 dark:text-gray-300"><?php echo number_format($outstands->remain_amount); ?></td> 
					<td class="px-4 py-2 text-red-600 dark:text-red-400">
					  <?php
					    $endDateStr = substr($outstands->loan_end_date, 0, 10);
					    $endDate = DateTime::createFromFormat('Y-m-d', $endDateStr);
					    $today = new DateTime();
					    if ($endDate instanceof DateTime) {
					      $diff = $endDate->diff($today);
					      $pendingDays = $diff->invert ? 0 : $diff->days;
					      echo $pendingDays;
					    } else {
					      echo '-';
					    }
					  ?>
					</td> 
					<td class="px-4 py-2 text-gray-700 dark:text-gray-300"><?php echo $outstands->loan_stat_date; ?></td> 
					<td class="px-4 py-2 text-gray-700 dark:text-gray-300"><?php echo substr($outstands->loan_end_date, 0,10); ?></td> 
				  			
				  								  											  							
                                   </tr>
                      <?php endforeach; ?>
									
	                </tbody>
	                <tfoot class="bg-gray-50 text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                     <tr>
                    <th class="px-4 py-3 text-left font-semibold">TOTAL</th>
					<th class="px-4 py-3"></th>
					<th class="px-4 py-3"><?php //echo number_format($sum_depost->cash_depost); ?></th>
					<th class="px-4 py-3"><?php //echo number_format($sum_withdrawls->cash_withdrowal); ?></th>
					<th class="px-4 py-3"></th>
					<th class="px-4 py-3"></th>
					<th class="px-4 py-3"><?php //echo number_format($pend->total_pending); ?></th>
					<th class="px-4 py-3"><?php //echo number_format($pend->total_pending); ?></th>
					<th class="px-4 py-3 font-semibold"><?php echo number_format($total_remain->total_out); ?></th>
					<th class="px-4 py-3"><?php //echo number_format($pend->total_pending); ?></th>
					<th class="px-4 py-3"><?php //echo number_format($pend->total_pending); ?></th>
					<th class="px-4 py-3"><?php //echo number_format($pend->total_pending); ?></th>
					
                    </tr> 
                   </tfoot>
                   </table>
			</div>
		<!--end: Datatable -->
	</div>
</div>
			

<script>
	(function () {
		var searchInput = document.getElementById('outstand-search');
		var table = document.getElementById('kt_table_1');
		if (!searchInput || !table) return;

		searchInput.addEventListener('input', function () {
			var query = searchInput.value.toLowerCase().trim();
			var rows = table.querySelectorAll('tbody tr');
			rows.forEach(function (row) {
				var text = row.textContent.toLowerCase();
				row.style.display = text.indexOf(query) !== -1 ? '' : 'none';
			});
		});
	})();
</script>
				
<?php
include_once APPPATH . "views/partials/footer.php";
?>