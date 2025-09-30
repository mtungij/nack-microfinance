<?php
include_once APPPATH . "views/partials/header.php";
?>

<?php
$principal = isset($loan_form->how_loan) ? (float)$loan_form->how_loan : 0;
$interest_rate = isset($loan_form->interest_rate) ? (float)$loan_form->interest_rate : 0; // kwa %
$sessions = isset($loan_form->session) ? (int)$loan_form->session : 0;
$day_interval = isset($loan_form->day) ? (int)$loan_form->day : 30; // siku za kila kipindi

// jumla ya riba
$total_interest = ($principal * $interest_rate / 100) * $sessions;

// jumla inayolipwa
$total_payable = $principal + $total_interest;

// tarehe ya mwisho (leo + idadi ya vipindi * siku za kila kipindi)
$start_date = date('Y-m-d');
$end_date = date('Y-m-d', strtotime("+".($sessions * $day_interval)." days"));
?>


<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

        <?php if ($das = $this->session->flashdata('massage')): ?>
        <div class="bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
            <div class="flex">
                <div class="flex-shrink-0"><span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-500"><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg></span></div>
                <div class="ms-3"><h3 class="text-gray-800 font-semibold dark:text-white">Success</h3><p class="mt-2 text-sm text-gray-700 dark:text-gray-400"><?php echo $das;?></p></div>
                <div class="ps-3 ms-auto"><button type="button" class="inline-flex bg-teal-50 rounded-lg p-1.5 text-teal-500 hover:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-teal-50 focus:ring-teal-600 dark:bg-transparent dark:hover:bg-teal-800/50 dark:text-teal-600" data-hs-remove-element="[role=alert]"><span class="sr-only">Dismiss</span><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg></button></div>
            </div>
        </div>
        <?php endif; ?>

        <div class="bg-gray-100">
    <div class="w-full bg-cyan-600 text-white">
        <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:flex-row md:justify-between md:px-6 lg:px-8">
            <div class="p-4 flex flex-row items-center justify-between">
                <a href="#" class="text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
                    Loan Application Form
                </a>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col md:flex-row gap-6 items-stretch">
    <!-- Left: Customer Info -->
    <div class="w-full md:w-3/12">
        <div class="bg-white shadow rounded-lg p-4 border-t-4 border-green-500 h-full">
            <?php foreach ($customer_data as $customer_profiles): ?>
                <div class="text-center">
                   
                         <?php if (!empty($customer_profiles->passport)): ?>
  <img class="w-32 h-32 mx-auto rounded-full object-cover mb-4 border-2 border-green-400"
       src="<?= base_url($customer_profiles->passport) ?>" alt="Customer Passport">
<?php else: ?>
  <img class="w-32 h-32 mx-auto rounded-full object-cover mb-4 border-2 border-green-400"
       src="<?= base_url('assets/img/customer21.png') ?>" alt="Default Image">
<?php endif; ?>


                    <h1 class="text-xl font-bold text-green-600 uppercase">
                        <?= strtoupper($customer_profiles->f_name) . " " . strtoupper(substr($customer_profiles->m_name, 0, 1)) . " " . strtoupper($customer_profiles->l_name) ?>
                    </h1>

                    <p class="text-sm text-gray-600"><?= $customer_profiles->phone_no; ?></p>
                </div>

                <ul class="mt-4 text-sm text-gray-700 divide-y divide-gray-200">
                    <li class="py-2 flex justify-between">
                        <span>Status</span>
                        <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">
                            <?= (count($customer_data) === 1) ? 'New Customer' : 'Existing Customer'; ?>
                        </span>
                    </li>
                    <li class="py-2 flex justify-between">
                        <span>Member Since</span>
                        <span><?= date('Y-m-d', strtotime($customer_profiles->customer_day)); ?></span>
                    </li>
                </ul>

                <!-- Documents -->
                <div class="mt-4">
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">📎 Customer Documents:</h3>
                    <div class="flex flex-col gap-2 text-sm">
                        <a href="<?= base_url('assets/documents/barua_' . $customer_profiles->customer_id . '.pdf') ?>"
                           target="_blank"
                           class="text-cyan-600 hover:underline hover:text-cyan-800 transition-all">
                            📄 Barua ya Utambulisho
                        </a>
                        <a href="<?= base_url('assets/documents/kitambulisho_' . $customer_profiles->customer_id . '.pdf') ?>"
                           target="_blank"
                           class="text-cyan-600 hover:underline hover:text-cyan-800 transition-all">
                            📄 Kitambulisho
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Optional Middle Column -->
    <div class="w-full md:w-6/12">
        <!-- You can leave this empty or insert approval form etc. -->
    </div>

    <!-- Right: Sponsor Info -->
<div class="w-full md:w-3/12">
    
        <div class="bg-white shadow rounded-lg p-4 border-t-4 border-orange-500 h-full">
        <?php foreach ($sponser_detail as $sponser): ?>
            <div class="text-center">
                
              <?php if (!empty($sponser->passport_path)): ?>
  <img class="w-32 h-32 mx-auto rounded-full object-cover mb-4 border-2 border-green-400"
       src="<?= base_url($sponser->passport_path) ?>" alt="Sponsor Passport">
<?php else: ?>
  <img class="w-32 h-32 mx-auto rounded-full object-cover mb-4 border-2 border-green-400"
       src="<?= base_url('assets/img/customer21.png') ?>" alt="Default Image">
<?php endif; ?>

                <h1 class="text-xl font-bold text-indigo-600 uppercase">
                    <?= strtoupper($sponser->sp_name . ' ' . $sponser->sp_mname . ' ' . $sponser->sp_lname); ?>
                </h1>

                <p class="text-sm text-gray-600"><?= $sponser->sp_phone_no; ?></p>
            </div>

            <ul class="mt-4 text-sm text-gray-700 divide-y divide-gray-200">
                <li class="py-2 flex justify-between">
                    <span>Uhusiano</span>
                    <span class="font-medium"><?= ucfirst($sponser->sp_relation); ?></span>
                </li>
                <li class="py-2 flex justify-between">
                    <span>Kazi / Biashara</span>
                    <span><?= ucfirst($sponser->nature); ?></span>
                </li>
            </ul>

            <!-- Sponsor Documents -->
            <div class="mt-6">
                <h3 class="text-sm font-semibold text-gray-800 mb-2">📎 Sponsor Documents:</h3>
                <div class="flex flex-col gap-2 text-sm">
                    <?php if (!empty($sponser->barua_path)): ?>
                        <a href="<?= base_url('assets/sponser_documents/' . basename($sponser->barua_path)); ?>" 
                           target="_blank"
                           class="text-cyan-600 hover:underline hover:text-cyan-800 transition-all">
                            📄 Barua ya Utambulisho
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($sponser->kitambulisho_path)): ?>
                        <a href="<?= base_url('assets/sponser_documents/' . basename($sponser->kitambulisho_path)); ?>" 
                           target="_blank"
                           class="text-cyan-600 hover:underline hover:text-cyan-800 transition-all">
                            📄 Kitambulisho
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



</div>


</div>





<!-- <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
			<div class="bg-gray-100">
    <div class="w-full bg-cyan-600 text-white">
        <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:flex-row md:justify-between md:px-6 lg:px-8">
            <div class="p-2 flex flex-row items-center justify-between">
                <a href="#" class="text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
				Taarifa Za Mdhamini Wa Mkopo
                </a>
            </div>
        </div>
    </div>
</div>

            <div class="p-4">
              
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" >
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">S/No.</span></div></th>
                                        <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Jina La Mdhamini</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Namba Ya Simu</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-start"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Uhusiano Na Mkopaji</span><svg class="size-3.5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path class="hs-datatable-ordering-desc:text-cyan-600 dark:hs-datatable-ordering-desc:text-cyan-500" d="m7 15 5 5 5-5"></path><path class="hs-datatable-ordering-asc:text-cyan-600 dark:hs-datatable-ordering-asc:text-cyan-500" d="m7 9 5-5 5 5"></path></svg></div></th>
                                        <th scope="col" class="py-3 px-6 text-start --exclude-from-ordering"><div class="inline-flex items-center gap-x-2"><span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Biashara/Kazi Ya Mdhamini</span></div></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
								
								     <?php $no = 1; ?>
                                    <?php if (isset($sponser_detail) && is_array($sponser_detail) && !empty($sponser_detail)): ?>
                                        <?php foreach ($sponser_detail as $sponser_details): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><?php echo $no++; ?>.</td>
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($sponser_details->sp_name, ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($sponser_details->sp_mname, ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($sponser_details->sp_lname, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($sponser_details->sp_phone_no, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($sponser_details->sp_relation, ENT_QUOTES, 'UTF-8'); ?></td>
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><?php echo ucfirst(htmlspecialchars($sponser_details->nature, ENT_QUOTES, 'UTF-8')); ?></td>

                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

				
            </div>
			
        </div> -->
		<div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
		<div class="w-full bg-cyan-600 text-white">
        <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:flex-row md:justify-between md:px-6 lg:px-8">
            <div class="p-2 flex flex-row items-center justify-between">
                <a href="#" class="text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
				Taarifa Za Dhamana Za Mkopo
                </a>
            </div>
        </div>
    </div>
			

            <div class="p-4">
              
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="border rounded-lg overflow-hidden dark:border-gray-700">
     
<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
            <th class="py-3 px-6 text-start">S/No.</th>
            <th class="py-3 px-6 text-start">Jina La Dhamana</th>
            <th class="py-3 px-6 text-start">Hali ya Dhamana</th>
            <th class="py-3 px-6 text-start">Thamani ya Dhamana</th>
            <th class="py-3 px-6 text-start">Angalia Dhamana</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        <?php if (!empty($collateral) && is_array($collateral)): ?>
            <?php 
                $no = 1; 
                $total_value = 0;
            ?>
            <?php foreach ($collateral as $item): ?>
                <?php $total_value += $item->value; ?>
                <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200"><?= $no++; ?>.</td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200"><?= htmlspecialchars($item->description); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200"><?= htmlspecialchars($item->co_condition); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200"><?= number_format($item->value, 2); ?></td>
                    <td class="px-6 py-4">
                        <?php if (!empty($item->file_name)): ?>
                            <button 
                                type="button"
                                data-modal-target="default-modal"
                                data-modal-toggle="default-modal"
                                data-file="<?= base_url('assets/dhamana/' . $item->file_name); ?>"
                                onclick="loadDhamana(this)"
                                class="text-blue-600 hover:text-blue-800 focus:outline-none"
                                title="Tazama Dhamana"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        <?php else: ?>
                            <span class="text-gray-400">Hakuna dhamana</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                    Taarifa za dhamana hazijajazwa.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
    <?php if (!empty($collateral) && is_array($collateral)): ?>
    <tfoot class="bg-gray-50 dark:bg-gray-800">
        <tr>
            <td colspan="3" class="px-6 py-4 text-sm font-semibold text-right text-gray-700 dark:text-gray-200">Jumla:</td>
            <td class="px-6 py-4 text-sm font-bold text-gray-800 dark:text-white"><?= number_format($total_value, 2); ?></td>
            <td></td>
        </tr>
    </tfoot>
    <?php endif; ?>
</table>

<!-- Modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true"
     class="hidden fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" style="width: 1200px; height: 500px;">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Tazama Dhamana</h3>
            <button type="button" data-modal-hide="default-modal"
                class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <!-- Body -->
        

        <div class="h-[700px] overflow-auto modal-body-content p-0 flex items-center justify-center bg-gray-100">
            <!-- Content will be injected here -->
        </div>

        <!-- Footer -->
        <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button data-modal-hide="default-modal" type="button"
                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg">Funga</button>
        </div>
    </div>
</div>

                  </div>
                    </div>
                </div>

				
            </div>
			
        </div>

        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
		<div class="w-full bg-cyan-600 text-white">
        <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:flex-row md:justify-between md:px-6 lg:px-8">
            <div class="p-2 flex flex-row items-center justify-between">
                <a href="#" class="text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
				Maombi ya mkopo Ulioombwa
                </a>
            </div>
        </div>
    </div>
			

    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 md:p-6">
                <!-- <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Register New Customer
                </h4> -->
                <?php echo form_open("admin/aprove_loan/{$loan_form->loan_id}", ['novalidate' => true]); ?>
                    <div class="grid sm:grid-cols-12 gap-4 sm:gap-6">

                    
                        <div class="sm:col-span-4">
                            <label for="f_name" class="block text-sm font-medium mb-2 dark:text-gray-300">* Aina Ya Mkopo:</label>                                                                                                                                                                                                           
                            <input type="text" id="f_name" name="" readonly autocomplete="off" 
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600"  
                                   value="<?php echo set_value('loan_name', isset($loan_form->loan_name) ? strtoupper(preg_replace('/[^a-zA-Z]/', '  ', $loan_form->loan_name)) : ''); ?>">

                        </div>

						<div class="sm:col-span-4">
                            <label for="how_loan" class="block text-sm font-medium mb-2 dark:text-gray-300">* Kiasi Kilichoombwa:</label>
                            <input type="text" id="how_loan" name="" readonly autocomplete="off" 
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" 
                                   value="<?php echo set_value('sp_lname', isset($loan_form->how_loan) ? number_format((float)$loan_form->how_loan, 0) : ''); ?>">
                        </div>

                        <div class="sm:col-span-4">
                            <label for="how_loan" class="block text-sm font-medium mb-2 dark:text-gray-300">* Kiasi Kinachopitishwa:</label>
                            <input type="text" id="how_loan" name="loan_aprove" placeholder="Full name" autocomplete="off" 
                                   class="py-2.5 px-4 block w-full border-green-600 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-green-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" 
                                   value="<?php echo set_value('sp_lname', isset($loan_form->how_loan) ? $loan_form->how_loan : ''); ?>"
                       required>
                        </div>

                        <input type="hidden" name="penat_status" value="YES">
                        

                        <div class="sm:col-span-4">
    <label for="l_name" class="block text-sm font-medium mb-2 dark:text-gray-300">* Marejesho Ya:</label>
    <input type="text" id="l_name" name="" readonly autocomplete="off" 
        class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" 
        value="<?php
            if (isset($loan_form->day)) {
                if ($loan_form->day == 1) {
                    echo 'Siku';
                } elseif ($loan_form->day == 7) {
                    echo 'Week';
                } elseif (in_array($loan_form->day, [28, 29, 30, 31])) {
                    echo 'Mwezi';
                }
            }
        ?>">
</div>




                        <div class="sm:col-span-4">
                            <label for="phone_no" class="block text-sm font-medium mb-2 dark:text-gray-300">* Idadi Jumla Ya Marejesho:</label>
                            <input type="number" id="phone_no" name="" readonly autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" 
                                   value="<?php echo set_value('session', isset($loan_form->session) ? $loan_form->session : ''); ?>">
                           
                        </div>

                        <div class="sm:col-span-4">
                            <label for="reason" class="block text-sm font-medium mb-2 dark:text-gray-300">* Biashara Ya Mkopaji:</label>
                            <input type="text" id="reason" name="" readonly autocomplete="off" required
                                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600" 
                                   value="<?php echo set_value('reason', isset($loan_form->reason) ? $loan_form->reason : ''); ?>">
                           
                        </div>
                        
						
<div class="sm:col-span-4">
    <label for="age" class="block text-sm font-medium mb-2 dark:text-gray-300">* Tarehe Ya Maombi Ya Mkopo:</label>
    <input type="text" readonly id="age" name="" autocomplete="off"
           class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600"
            value="<?php echo set_value('customer_day', isset($loan_form->loan_day) ? $loan_form->loan_day : ''); ?>">
</div>

<div class="sm:col-span-4">
    <label for="age" class="block text-sm font-medium mb-2 dark:text-gray-300">* Afisa Aliyeomba Mkopo:</label>
    <input type="text" readonly id="age" name="" autocomplete="off"
           class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:ring-gray-600"
            value="<?php echo set_value('customer_day', isset($loan_form->creator_name) ? $loan_form->creator_name : ''); ?>">
</div>


                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center gap-x-2">
                            <button type="submit" class="py-2 px-4 btn-primary-sm bg-cyan-800 hover:bg-cyan-700 text-white">Idhinisha Mkopo</button>
                            <a href="<?php echo base_url("admin/reject_loan/{$loan_form->loan_id}") ?>" class="py-2 px-4 btn-primary-sm dark:bg-red-800 hover:bg-cyan-700 text-white">Kataa</a>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
			
        </div>
</div>
</div>
<!-- ========== END MAIN CONTENT BODY ========== -->

<?php
include_once APPPATH . "views/partials/footer.php";
?>








<script>
    function loadDhamana(button) {
        const fileUrl = button.getAttribute('data-file');
        const modalBody = document.querySelector('#default-modal .modal-body-content');

        // Check file type and decide how to render it
        if (/\.(jpg|jpeg|png|gif|webp)$/i.test(fileUrl)) {
            modalBody.innerHTML = `
                <img src="${fileUrl}" alt="Dhamana" class="w-full h-full object-contain rounded" />
            `;
        } else {
            modalBody.innerHTML = `
                <iframe src="${fileUrl}" width="100%" height="100%" frameborder="0" class="rounded"></iframe>
            `;
        }
    }
</script>

