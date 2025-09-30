<?php
include_once APPPATH . "views/partials/header.php";
?>
<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6"></div>

<!-- Table Section -->
<div class="w-full">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-gray-900 dark:border-gray-700">
          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                Sales
              </h2>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-red-500 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-800 dark:focus:bg-gray-800" href="#">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                  Delete (2)
                </a>

                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700" href="#">
                  View all
                </a>

                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Create
                </a>
              </div>
            </div>
          </div>
          <!-- End Header -->

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
              <tr>
             

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
					  Officer Name
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
					S/No
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                      Customer Name
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                      Phone Number
                    </span>
                  </div>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                      Duration
                    </span>
                  </div>
                </th>

				<th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                      Receivable
                    </span>
                  </div>
                </th>

				<th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                      Received
                    </span>
                  </div>
                </th>

				<th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                      Account
                    </span>
                  </div>
                </th>

				<th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                      Withdrawal
                    </span>
                  </div>
                </th>

				<th scope="col" class="px-6 py-3 text-start">
                  <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">
                      Account
                    </span>
                  </div>
                </th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

			<?php $no = 1; ?>
								<?php foreach ($empl_oficer as $oficer_datas): ?>
									 <tr>
				  					<td  class="text-sm text-gray-200 dark:text-gray-200">
				  						<b><?php echo $oficer_datas->empl_name; ?></b>	

              <tr>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <div class="flex items-center gap-x-2">
                    
                      <div class="grow">
                        <span class="text-sm text-gray-600 dark:text-gray-200"></span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200"></span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200"></span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200">
                      
                    </span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>
				</td>
              </tr>

			  <tr>
			 <?php $empl_loan = $this->queries->get_loan_empl_data($oficer_datas->empl_id);
                               // echo "<pre>";
                               // print_r($empl_loan);
                               //       exit();
                                ?>
                                <?php $no = 1; ?>
                                <?php foreach ($empl_loan as $empl_loans): ?>
				 <td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"><?php echo $no++; ?>.</span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-200 dark:text-gray-200"> <?php echo $empl_loans->f_name; ?> <?php echo $empl_loans->m_name; ?> <?php echo $empl_loans->l_name; ?></span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"><?php echo $empl_loans->phone_no; ?></span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200">
					<?php if($empl_loans->day == '1'){ ?>
				  							<?php echo "Daily"; ?>
				  						<?php }elseif ($empl_loans->day == '7'){
				  							echo "Weekly";
				  						 ?>
				  						 <?php }elseif ($empl_loans->day == '30' || $empl_loans->day == '31' || $empl_loans->day == '28' || $empl_loans->day == '29') {
				  						 	echo "Monthly";
				  						  ?>
				  						  <?php } ?>
					</span>
				  </div>
				</td>
				

				  						

				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"><?php echo number_format($empl_loans->restration); ?> </span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"><?php echo number_format($empl_loans->total_received); ?></span>
				  </div>
				</td>

				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"><?php echo $empl_loans->depost_account; ?></span>
				  </div>
				</td>

				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"><?php echo number_format($empl_loans->total_withdrawal); ?></span>
				  </div>
				</td>

				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"><?php echo $empl_loans->with_account; ?></span>
				  </div>
				</td>

			  </tr>
			  <?php endforeach; ?>

			
              
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <div class="flex items-center gap-x-2">
                      <div class="grow">
                        <span class="text-sm text-gray-600 dark:text-gray-200"></span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200"></span>
                  </div>
                </td>
				
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200"><b>TOTAL</b></span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200">
                    </span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>
				</td>
				<td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>
				</td>		
				
              </tr>
			  <?php endforeach; ?>

              <tr>
               
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <div class="flex items-center gap-x-2">
                     
                      <div class="grow">
                        <span class="text-sm text-gray-600 dark:text-gray-200">Apple</span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200">Wednesday 06:45 pm</span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200">In 3 days</span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200">
                      jackob@site.com
                    </span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2 flex gap-x-1">
                   
                  </div>
                </td>
              </tr>
			  <tr>
                              
                                  


			  <tr>
                <td class="size-px whitespace-nowrap">
                  <div class="px-6 py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-200">
                    
                    </span>
                  </div>
                </td>
                <td class="size-px whitespace-nowrap">
				  <div class="px-6 py-2">
					<span class="text-sm text-gray-600 dark:text-gray-200"></span>
				  </div>

				
				
              </tr>

         
            </tbody>
          </table>
          <!-- End Table -->

          <!-- Footer -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-gray-700">
            <div class="inline-flex items-center gap-x-2">
              <p class="text-sm text-gray-600 dark:text-gray-200">
                Showing:
              </p>
              <div class="max-w-sm space-y-3">
                <select class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option selected>9</option>
                  <option>20</option>
                </select>
              </div>
              <p class="text-sm text-gray-600 dark:text-gray-200">
                of 20
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                  Prev
                </button>

                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                  Next
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>
              </div>
            </div>
          </div>
          <!-- End Footer -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
</div>
<!-- End Table Section -->

<?php
include_once APPPATH . "views/partials/footer.php";
?>