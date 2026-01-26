<?php
include_once APPPATH . "views/partials/header.php";
?>

<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

        <!-- Section 1: Page Title / Subheader -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-200">
                    Admin Dashboard
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
           

               <?php echo !empty($this->session->userdata('comp_name')) ? htmlspecialchars($this->session->userdata('comp_name')) : 'Loan Management System'; ?>

                </p>
            </div>
            <div>
                <?php // Optional action button, e.g., for the "Branches" dropdown
                // We will integrate the "Branches" dropdown within the "Quick Stats & Actions" card as per your old layout.
                ?>
            </div>
        </div>
   

<!-- ====================== -->
<!-- Dashboard Main Cards -->
<!-- ====================== -->
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">

  <!-- 1️⃣ Due Today (Within Agreement) -->
<a href="<?= base_url('admin/today_recevable_loan'); ?>" class="block">
  <div class="flex flex-col bg-gradient-to-br from-cyan-400 via-cyan-500 to-cyan-600 text-white border border-transparent rounded-2xl shadow-xl p-5 transition-transform transform hover:scale-[1.02] hover:shadow-2xl mb-4">
      <div class="flex items-center justify-between">
        <p class="text-sm font-semibold uppercase tracking-wide flex items-center gap-2">
          👥 Today Expected Collection
        </p>
        <div class="relative group cursor-pointer">
          <svg class="size-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
            <path d="M12 17h.01" />
          </svg>
          <div class="absolute z-10 mt-2 right-0 w-56 text-xs text-white bg-black/80 rounded-lg shadow-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity">
            Malipo yanayotarajiwa leo kutoka kwa wateja wenye mikopo hai ndani ya muda wa makubaliano (sio yaliyochelewa).
          </div>
        </div>
      </div>
      <div class="mt-6 flex items-center justify-between">
        <h3 class="text-3xl font-bold"><?= number_format($receivable_total->total_rejesho); ?></h3>
        <span class="flex items-center gap-1 text-green-100 font-medium text-sm">⬆ 1.7%</span>
      </div>
  </div>
</a>


  <!-- 2️⃣ Overdue (Out of Agreement) -->
 <a href="<?= base_url('admin/get_outstand_loan'); ?>" class="block">
  <div class="flex flex-col bg-gradient-to-br from-cyan-400 via-cyan-500 to-cyan-600 text-white border border-transparent rounded-2xl shadow-xl p-5 transition-transform transform hover:scale-[1.02] hover:shadow-2xl mb-4">
      <div class="flex items-center justify-between">
        <p class="text-sm font-semibold uppercase tracking-wide flex items-center gap-2">
          ⏰ Overdue Loans
        </p>
        <div class="relative group cursor-pointer">
          <svg class="size-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
            <path d="M12 17h.01" />
          </svg>
          <div class="absolute z-10 mt-2 right-0 w-56 text-xs text-white bg-black/80 rounded-lg shadow-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity">
            Malipo yaliyochelewa kutoka kwa wateja ambao wako nje ya muda wa makubaliano ya mikopo.
          </div>
        </div>
      </div>
      <div class="mt-6 flex items-center justify-between">
        <h3 class="text-3xl font-bold"><?= number_format($total_overdue->total_out); ?></h3>
        <span class="flex items-center gap-1 text-red-100 font-medium text-sm">⬇ -2.3%</span>
      </div>
  </div>
</a>


  <!-- 3️⃣ Expiring Today -->
  <a href="<?= base_url('admin/today_expiring_loans') ?>" class="block">
  <div class="flex flex-col bg-gradient-to-br from-cyan-400 via-cyan-500 to-cyan-600 text-white border border-transparent rounded-2xl shadow-xl p-5 transition-transform transform hover:scale-[1.02] hover:shadow-2xl mb-4">
    <div class="flex items-center justify-between">
      <p class="text-sm font-semibold uppercase tracking-wide flex items-center gap-2">📅 Upcoming Loan Deadlines</p>
      <div class="relative group cursor-pointer">
        <svg class="size-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
        <div class="absolute z-10 mt-2 right-0 w-56 text-xs text-white bg-black/80 rounded-lg shadow-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity">
          Malipo yanayotarajiwa leo kutoka kwa wateja ambao makubaliano yao ya mikopo yanamalizika wiki hii ndani ya siku 7.
        </div>
      </div>
    </div>
    <div class="mt-6 flex items-center justify-between">
      <h3 class="text-3xl font-bold"><?= number_format($today_enddate_collection) ?></h3>
      <span class="flex items-center gap-1 text-yellow-100 font-medium text-sm">⬆ 0.9%</span>
    </div>
  </div>
</a>


  <!-- 4️⃣ Expired Agreements -->


</div>

<!-- ====================== -->
<!-- Paid Cards Section -->
<!-- ====================== -->
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-6">

  <!-- 1️⃣ Paid Today (Within Agreement) -->
  <a href="<?= base_url('admin/today_receved_loan') ?>" class="block">
  <div class="flex flex-col bg-gradient-to-br from-cyan-400 via-cyan-500 to-cyan-600 text-white border border-transparent rounded-2xl shadow-xl p-5 transition-transform transform hover:scale-[1.02] hover:shadow-2xl mb-4">
    
    <div class="flex items-center justify-between">
      <p class="text-sm font-semibold uppercase tracking-wide flex items-center gap-2">💰 Paid Today</p>
      
      <div class="relative group cursor-pointer">
        <svg class="size-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
        <div class="absolute z-10 mt-2 right-0 w-56 text-xs text-white bg-black/80 rounded-lg shadow-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity">
          Jumla ya malipo yaliyofanywa leo kutoka kwa wateja waliolipa mikopo yao.
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <h3 class="text-3xl font-bold"><?php echo number_format($total_receved->total_depost); ?></h3>
      <span class="flex items-center gap-1 text-green-700 font-medium text-sm">✅</span>
    </div>
  </div>
</a>


  <!-- 2️⃣ Paid Overdue -->
 <a href="<?= base_url('admin/disburse_loan') ?>" class="block">
  <div class="flex flex-col bg-gradient-to-br from-cyan-400 via-cyan-500 to-cyan-600 
              text-white border border-transparent rounded-2xl shadow-xl p-5 
              transition-transform transform hover:scale-[1.02] hover:shadow-2xl mb-4">

    <div class="flex items-center justify-between">
      <p class="text-sm font-semibold uppercase tracking-wide flex items-center gap-2">
        💸 Today Loan Approved
      </p>

      <!-- Tooltip Info Icon -->
      <div class="relative group cursor-pointer">
        <svg class="size-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg" 
             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
        <div class="absolute z-10 mt-2 right-0 w-56 text-xs text-white bg-black/80 
                    rounded-lg shadow-lg px-3 py-2 opacity-0 group-hover:opacity-100 
                    transition-opacity">
          Jumla ya mikopo iliyopitishwa leo kwa wateja waliokopeshwa.inatakiwa kuwa 0 ikiwa mikopo
          yote waliwithdraw
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <h3 class="text-3xl font-bold"><?= number_format($total_loanDis) ?></h3>
      <span class="flex items-center gap-1 text-red-700 font-medium text-sm">✅</span>
    </div>
  </div>
</a>



  <!-- 3️⃣ Paid Expiring Today -->
<a href="<?= base_url('admin/loan_withdrawal') ?>" class="block">
  <div class="flex flex-col bg-gradient-to-br from-cyan-400 via-cyan-500 to-cyan-600 text-white border border-transparent rounded-2xl shadow-xl p-5 transition-transform transform hover:scale-[1.02] hover:shadow-2xl mb-4">
    
    <div class="flex items-center justify-between">
      <p class="text-sm font-semibold uppercase tracking-wide flex items-center gap-2">📅 Today Loan Withdraw</p>
      
      <!-- Tooltip -->
      <div class="relative group cursor-pointer">
        <svg class="size-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
        <div class="absolute z-10 mt-2 right-0 w-56 text-xs text-white bg-black/80 rounded-lg shadow-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity">
          Jumla ya mikopo iliyotolewa leo kwa wateja waliochukua mikopo mipya.
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <h3 class="text-3xl font-bold"><?= number_format($total_loanWithdrawal->total_todayloan) ?></h3>
      <span class="flex items-center gap-1 text-yellow-700 font-medium text-sm">✅</span>
    </div>
  </div>
</a>

</div>

<div class="grid grid-cols-2 gap-4">
    <!-- 3️⃣ Paid Expiring Today -->
<a href="<?= base_url('admin/income_dashboard') ?>" class="block">
  <div class="flex flex-col bg-gradient-to-br from-blue-400 via-blue-500 to-cyan-600 text-white border border-transparent rounded-2xl shadow-xl p-5 transition-transform transform hover:scale-[1.02] hover:shadow-2xl mb-4">
    
    <div class="flex items-center justify-between">
      <p class="text-sm font-semibold uppercase tracking-wide flex items-center gap-2">📅 Today Penalt Paid</p>
      
      <!-- Tooltip -->
      <div class="relative group cursor-pointer">
        <svg class="size-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
        <div class="absolute z-10 mt-2 right-0 w-56 text-xs text-white bg-black/80 rounded-lg shadow-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity">
          Jumla ya faini zilizolipwa leo kutoka kwa wateja wenye mikopo iliyochelewa.
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <h3 class="text-3xl font-bold"><?= number_format(	$total_penalt->total_receved) ?></h3>
      <span class="flex items-center gap-1 text-yellow-700 font-medium text-sm">✅</span>
    </div>
  </div>
</a>


  <!-- 3️⃣ Paid Expiring Today -->
<a href="<?= base_url('admin/loan_withdrawal') ?>" class="block">
  <div class="flex flex-col bg-gradient-to-br from-blue-400 via-blue-500 to-green-600 text-white border border-transparent rounded-2xl shadow-xl p-5 transition-transform transform hover:scale-[1.02] hover:shadow-2xl mb-4">
    
    <div class="flex items-center justify-between">
      <p class="text-sm font-semibold uppercase tracking-wide flex items-center gap-2">📅 Today Processing fee Paid</p>
      
      <!-- Tooltip -->
      <div class="relative group cursor-pointer">
        <svg class="size-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
        <div class="absolute z-10 mt-2 right-0 w-56 text-xs text-white bg-black/80 rounded-lg shadow-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity">
          Jumla ya gharama za fomu zilizolipwa leo kutoka kwa wateja waliopewa mikopo .
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <h3 class="text-3xl font-bold"><?= number_format($total_loanWithdrawal->total_todayloan) ?></h3>
      <span class="flex items-center gap-1 text-yellow-700 font-medium text-sm">✅</span>
    </div>
  </div>
</a>
</div>



<!-- 🚀 Top 5 Depositors Bar Chart -->
<div class="mt-10 bg-white rounded-2xl shadow-xl p-6">
  <h2 class="text-xl font-bold text-gray-700 mb-4">🏆 Top 5 Employees by Deposit</h2>
  <canvas id="topDepositorsChart" height="120"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('topDepositorsChart').getContext('2d');
  const topDepositorsChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        <?php foreach($top_depositors as $row){ echo "'".$row->empl_name."',"; } ?>
      ],
      datasets: [{
        label: 'Total Deposit (TZS)',
        data: [
          <?php foreach($top_depositors as $row){ echo $row->total_deposit.","; } ?>
        ],
        backgroundColor: [
          '#0ea5e9','#06b6d4','#3b82f6','#10b981','#f59e0b'
        ],
        borderRadius: 8
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.parsed.y.toLocaleString() + " TZS";
            }
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return value.toLocaleString();
            }
          }
        }
      }
    }
  });
</script>




 



  <!-- Card 2: MALIPO YA LEO -->
  <!-- </?php
  $total_deposit_daily = $total_deposit_daily ?? 0;
  $total_deposit_weekly = $total_deposit_weekly ?? 0;
  $total_deposit_monthly = $total_deposit_monthly ?? 0;
  $total_all = $total_deposit_daily + $total_deposit_weekly + $total_deposit_monthly;
?> -->

<!-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
  <div class="bg-cyan-800 px-4 py-2 border-b">
    <h2 class="text-lg font-semibold text-white">MALIPO YA LEO</h2>
  </div>
  <div class="p-4">
    <table class="w-full text-sm">
      <tbody class="text-gray-700">
        <tr class="border-b">
          <td class="py-2">KILA SIKU</td>
          <td class="text-right">
            <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded">
              </?php echo number_format($total_deposit_daily); ?>
            </span>
          </td>
        </tr>
        <tr class="border-b">
          <td class="py-2">WIKI</td>
          <td class="text-right">
            <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded">
              <?php echo number_format($total_deposit_weekly); ?>
            </span>
          </td>
        </tr>
        <tr class="border-b">
          <td class="py-2">MWEZI</td>
          <td class="text-right">
            <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded">
              <?php echo number_format($total_deposit_monthly); ?>
            </span>
          </td>
        </tr>
        <tr>
          <td class="py-2 font-bold">JUMLA</td>
          <td class="text-right font-bold">
            <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded">
              <?php echo number_format($total_all); ?>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div> -->

<!-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
  <div class="bg-cyan-800 px-4 py-2 border-b">
    <h2 class="text-lg font-semibold text-white">MIKOPO YA LEO</h2>
  </div>
  <div class="p-4">
    <table class="w-full text-sm">
      <tbody class="text-gray-700">
        <tr class="border-b">
          <td class="py-2">KILA SIKU</td>
          <td class="text-right">
            <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded">
              <?php echo number_format($total_withdrawal_daily->loan_aproved ?? 0); ?>
            </span>
          </td>
        </tr>
        <tr class="border-b">
          <td class="py-2">WIKI</td>
          <td class="text-right">
            <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded">
              </?php echo number_format($total_withdrawal_weekly->loan_aproved ?? 0); ?>
            </span>
          </td>
        </tr>
        <tr class="border-b">
          <td class="py-2">MWEZI</td>
          <td class="text-right">
            <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded">
              </?php echo number_format($total_withdrawal_monthly->loan_aproved ?? 0); ?>
            </span>
          </td>
        </tr>
        <tr>
          <td class="py-2 font-bold">JUMLA</td>
          <td class="text-right font-bold">
            <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded">
              </?php
                $daily = $total_withdrawal_daily->loan_aproved ?? 0;
                $weekly = $total_withdrawal_weekly->loan_aproved ?? 0;
                $monthly = $total_withdrawal_monthly->loan_aproved ?? 0;
                $total = $daily + $weekly + $monthly;
                echo number_format($total);
              ?>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div> -->
</div>


        <!-- Account Balance Banner (Full Width) -->
        <!-- <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm rounded-xl overflow-hidden">
            <div class="bg-cover bg-center p-6 sm:p-10 text-center" style="background-image: url('</?php echo base_url('assets/img/pi.png'); // Keep your background image path ?>');">
                <h3 class="text-sm font-medium text-gray-100 dark:text-gray-300 uppercase mb-2">Main Account Balance</h3>
                <p class="text-4xl sm:text-5xl font-bold text-white dark:text-gray-100">
                    </?php echo number_format($sum_comp_capital->total_comp_balance); ?>
                </p>
                </?php // Optional: Add a small sub-text or trend indicator if desired for the main balance ?>
                <!-- <p class="mt-1 text-xs text-gray-200 dark:text-gray-400">+2.5% since last month</p> -->
            <!-- </div>
        </div>  -->
        <!-- End Account Balance Banner -->

        

        <!-- Grid for other KPIs -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6"> <?php // Added mt-6 for spacing after the banner ?>
            
            <!-- Disbursed Loans Card -->
            <!-- <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Disbursed Loans</h3>
                 </?php if(isset($principal_loan->change_percentage) && $principal_loan->change_percentage >= 0): ?>
                <span class="inline-flex items-center text-green-600 dark:text-green-400 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                  +</?php echo $principal_loan->change_percentage; ?>%
                </span>
                 </?php elseif(isset($principal_loan->change_percentage)): ?>
                 <span class="inline-flex items-center text-<div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4 py-6">
   -->
  <!-- Card 1: WATEJA & WAFANYAKAZI -->


  <!-- You can add a 3rd card here if needed -->

<!-- </div>

                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                  </?php echo $principal_loan->change_percentage; ?>%
                </span>
                </?php endif; ?>
              </div>
              <div class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-1"></?php echo number_format($principal_loan->loan_aproved); ?></div>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                </?php echo isset($principal_loan->change_period) ? 'vs ' . htmlspecialchars($principal_loan->change_period, ENT_QUOTES, 'UTF-8') : 'Total amount disbursed'; ?>
              </p>
            </div> -->

            <!-- Loan Expectation Receivable Card -->
            <!-- <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Loan Expectation Receivable</h3>
                 </?php if(isset($total_expect->change_percentage) && $total_expect->change_percentage >= 0): ?>
                <span class="inline-flex items-center text-green-600 dark:text-green-400 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                  +</?php echo $total_expect->change_percentage; ?>%
                </span>
                 </?php elseif(isset($total_expect->change_percentage)): ?>
                 <span class="inline-flex items-center text-red-600 dark:text-red-400 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                  </?php echo $total_expect->change_percentage; ?>%
                </span>
                </?php endif; ?>
              </div> -->
              <!-- <div class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-1"></?php echo number_format($total_expect->loan_interest); ?></div>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                  </?php echo isset($total_expect->change_period) ? 'vs ' . htmlspecialchars($total_expect->change_period, ENT_QUOTES, 'UTF-8') : 'Total interest expected'; ?>
              </p>
            </div> -->

            <!-- Total Branch Accounts Card -->
            <!-- <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Branch Accounts</h3>
                </?php if(isset($blanch_capital_circle->change_percentage) && $blanch_capital_circle->change_percentage >= 0): ?>
                <span class="inline-flex items-center text-green-600 dark:text-green-400 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                  +</?php echo $blanch_capital_circle->change_percentage; ?>%
                </span>
                </?php elseif(isset($blanch_capital_circle->change_percentage)): ?>
                 <span class="inline-flex items-center text-red-600 dark:text-red-400 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                  </?php echo $blanch_capital_circle->change_percentage; ?>%
                </span>
                </?php endif; ?>
              </div> -->
              <!-- <div class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-1"></?php echo number_format($blanch_capital_circle->total_balanch_amount); ?></div>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                  </?php echo isset($blanch_capital_circle->change_period) ? 'vs ' . htmlspecialchars($blanch_capital_circle->change_period, ENT_QUOTES, 'UTF-8') : 'Combined branch capital'; ?>
              </p>
            </div> -->
            
            <!-- Total Income Card -->
            <!-- <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Income</h3>
              </div>
              <div class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-1"></?php echo number_format($total_income_val); ?></div>
              <p class="text-xs text-gray-500 dark:text-gray-400">Overall income generated</p>
            </div> -->

            <!-- Total Expenses Card -->
            <!-- <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Expenses</h3>
              </div>
              <div class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-1"><?php echo number_format($total_expenses_val); ?></div>
              <p class="text-xs text-gray-500 dark:text-gray-400">Overall expenses incurred</p>
            </div> -->
            
            <!-- Total Loan Outstanding Card -->
            <!-- <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300">
              <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Loan Outstanding</h3>
              </div>
              <div class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-1"><?php echo number_format($total_outstanding_val); ?></div>
              <p class="text-xs text-gray-500 dark:text-gray-400">Remaining loan amounts</p>
            </div> -->

        </div>
        
        <!-- End Grid for other KPIs -->
        <!-- End Top KPIs -->

        <!-- Section 3: Chart Area -->
        <!-- <div class="bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 p-4 md:p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Loan Overview Chart</h3>
            <div id="dashboard-main-chart" class="min-h-[300px] sm:min-h-[350px]"></div>
            <p class="text-xs text-gray-500 mt-2 dark:text-gray-400">Chart data needs to be implemented from controller.</p>
        </div> -->
        <!-- End Chart Area -->
<br> <br><br>

        <!-- Section 4: Quick Stats & Actions (Using your new card template) -->
        <div class="bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Quick Overview
                </h3>
                <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                    <button id="branches-dropdown-btn" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                        <!-- Branches -->
                        <svg class="hs-dropdown-open:rotate-180 size-2.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 z-20 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-gray-800 dark:border dark:border-gray-700" aria-labelledby="branches-dropdown-btn">
                        <div class="py-2 first:pt-0 last:pb-0">
                            <span class="block py-2 px-3 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">Branches List</span>
                            <?php if (isset($blanch) && is_array($blanch)): ?>
                                <?php foreach ($blanch as $blanchs): ?>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-cyan-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                  

                                   href="<?php echo base_url(
    'admin/view_blanchPanel/' . ($blanchs->blanch_id ?? '')
); ?>"

                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v13A1.5 1.5 0 0 0 3.5 18h13a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 16.5 2h-13ZM12.25 8.25a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5h-1.5ZM12.25 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5h-1.5ZM6.25 6.75a.75.75 0 0 0-.75.75v5.5a.75.75 0 0 0 1.5 0v-5.5a.75.75 0 0 0-.75-.75ZM8.25 5a.75.75 0 0 0-.75.75v8.5a.75.75 0 0 0 1.5 0v-8.5A.75.75 0 0 0 8.25 5Z" /></svg>
                                    <?php
echo htmlspecialchars($blanchs->blanch_name ?? '', ENT_QUOTES, 'UTF-8');
?>

                                </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 md:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    // --- DUMMY DATA for quick stats - REMOVE and use controller data ---
                    // TODO: !! IMPORTANT, COMMENTED THESE BECAUSE OF TABLE MISSING ERROR, SHOULD BE UNCOMMENTED
                    $comp_id = $_SESSION['comp_id'] ?? null;
                    // Simulating data fetching - this should be in your controller
                   $employee_count = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_employee WHERE comp_id = ?", [$comp_id])->row()->count ?? 0) : 0;
                    // $customer_total = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_customer WHERE comp_id = ?", [$comp_id])->row()->count ?? 0) : 0;
                    // $customer_active = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_customer WHERE comp_id = ? AND customer_status = 'open'", [$comp_id])->row()->count ?? 0) : 0;
                    // $customer_pending = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_customer WHERE comp_id = ? AND customer_status = 'pending'", [$comp_id])->row()->count ?? 0) : 0;
                    // $customer_closed = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_customer WHERE comp_id = ? AND customer_status = 'close'", [$comp_id])->row()->count ?? 0) : 0;
                    // $new_loan_count = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_loans WHERE comp_id = ? AND loan_status = 'open'", [$comp_id])->row()->count ?? 0) : 0;
                    // $approved_loans_count = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_loans WHERE comp_id = ? AND loan_status = 'aproved'", [$comp_id])->row()->count ?? 0) : 0;
                    // $today_loan_pending_count = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_pending_total WHERE comp_id = ? AND total_pend IS NOT FALSE", [$comp_id])->row()->count ?? 0) : 0;
                    // $receivable_total_amount = $comp_id ? ($this->db->query("SELECT SUM(total_rejesho) as total_rejesho FROM tbl_loan_pay WHERE comp_id = ? AND pay_status = 'pending' AND deadline_date = CURDATE()", [$comp_id])->row()->total_rejesho ?? 0) : 0;
                    // $total_received_amount = $comp_id ? ($this->db->query("SELECT SUM(depost_amount) as total_depost FROM tbl_loan_pay WHERE comp_id = ? AND pay_status = 'payall' AND collection_date = CURDATE()", [$comp_id])->row()->total_depost ?? 0) : 0;
                    // $exp_req_count = $comp_id ? ($this->db->query("SELECT COUNT(*) as count FROM tbl_request_exp WHERE comp_id = ? AND req_date = CURDATE() AND req_status = 'recomended'", [$comp_id])->row()->count ?? 0) : 0;
                    // --- END DUMMY DATA ---
                    ?>
                    <!-- Stat Card: Employees -->
                    <a href="<?php echo base_url("admin/all_employee"); ?>" class="bg-white dark:bg-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-x-3 mb-3">
                            <!-- <img src="</?php echo base_url('assets/img/users.png'); ?>" class="size-10" alt="Employees"> -->
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Employees</h2>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200"><?php echo $employee_count; ?></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Total registered employees</p>
                    </a>

                    <!-- Stat Card: Customers -->
                    <a href="<?php echo base_url("admin/all_customer"); ?>" class="bg-white dark:bg-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-x-3 mb-3">
                        <?php $customer = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id'");
							$male = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id' AND gender = 'male'");
							$female = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id' AND gender = 'female'");
							$active = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id' AND customer_status = 'open'");
							$pendin = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id' AND customer_status = 'pending'");
							$closed = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id' AND customer_status = 'close'");
							 ?>
                             <!-- <img src="</?php echo base_url('assets/img/users.png'); ?>" class="size-10" alt="Customers"> -->
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Customers</h2>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-1"><?php echo $all_customer_count ?? 0; ?> <span class="text-sm font-normal">Total</span></p>
                        <div class="text-xs space-x-2"> 
                            <span class="text-green-600 dark:text-green-400">Active: <?php echo $active->num_rows(); ?></span>
                            <span class="text-orange-500 dark:text-orange-400">Pending: <?php echo $pendin->num_rows(); ?></span>
                            <span class="text-red-600 dark:text-red-400">Closed: <?php echo $closed->num_rows(); ?></span>
                        </div>
                    </a>
                    
                    <!-- Stat Card: Loan Requests -->
                    <a href="<?php echo base_url("admin/loan_pending"); ?>" class="bg-white dark:bg-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-x-3 mb-3">
                             <!-- <img src="<//?php echo base_url('assets/img/hukumu.png'); ?>" class="size-10" alt="Loan Requests"> -->
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Loan Requests</h2>
                        </div>
                        <?php $new_loan = $this->db->query("SELECT * FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'open'"); ?>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400"><?php echo ($new_loan->num_rows());  ?></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">New loan applications</p>
                    </a>

         


                    <!-- Stat Card: Today Loan Pending -->
                     <a href="<?php echo base_url("admin/loan_pending_time"); ?>" class="bg-white dark:bg-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-x-3 mb-3">
                            <!-- <img src="</?php echo base_url('assets/img/penart.png'); ?>" class="size-10" alt="Today Pending"> -->
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Today Loan Pending</h2>
                        </div>
                        <?php $laza = $this->db->query("SELECT * FROM tbl_pending_total WHERE comp_id = '$comp_id' AND total_pend IS NOT FALSE");
               
							 ?>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200"><?php echo $laza->num_rows(); ?></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Loan payments due yesterday</p>
                    </a>

                    <!-- Stat Card: Today Receivable -->
                    <a href="<?php echo base_url("admin/today_recevable_loan"); ?>" class="bg-white dark:bg-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-x-3 mb-3">
                            <!-- <img src="</?php echo base_url('assets/img/money.png'); ?>" class="size-10" alt="Today Receivable"> -->
                             <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Today Receivable</h2>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200"><?php echo number_format($receivable_total->total_rejesho) ; ?></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Expected amount today</p>
                    </a>

                    <!-- Stat Card: Today Received -->
                    <a href="<?php echo base_url("admin/today_receved_loan"); ?>" class="bg-white dark:bg-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-x-3 mb-3">
                            <!-- <img src="</?php echo base_url('assets/img/money.png'); ?>" class="size-10" alt="Today Received"> -->
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Today Collected</h2>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200"><?php echo number_format($total_receved->total_depost); ?></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Amount collected today</p>
                    </a>
                    
                    <!-- Stat Card: Recommended Expenses -->
                    <!-- <a href="</?php echo base_url("admin/get_recomended_request"); ?>" class="bg-white dark:bg-gray-700 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-x-3 mb-3">
                             <img src="</?php echo base_url('assets/img/expences.png'); ?>" class="size-10" alt="Recommended Expenses">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Recommended Expenses</h2>
                        </div>
                       <p class="text-2xl font-bold text-red-600 dark:text-red-400"></?php echo $exp_req_count ?? 0; ?></p>
                       <p class="text-xs text-gray-500 dark:text-gray-400">Pending expense requests</p>
                    </a> -->

                </div>
            </div>
        </div>
        <!-- End Quick Stats/Link Boxes -->

    </div>
</div>
<!-- ========== END MAIN CONTENT BODY ========== -->

<?php
include_once APPPATH . "views/partials/footer.php";
?>

<?php // JavaScript for the dashboard chart (ApexCharts) - Same as previous version ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const options = {
      series: [{
          name: 'Loan Amount', // Replace with your series name
          data: [31000, 40000, 28000, 51000, 42000, 109000, 100000] // Replace with your actual data
      }, {
          name: 'Interest Expected', // Replace with your series name
          data: [1100, 3200, 4500, 3200, 3400, 5200, 4100] // Replace with your actual data
      }],
      chart: {
        height: 350, // Adjust as needed
        type: 'area', // or 'line', 'bar'
        toolbar: { show: false },
        parentHeightOffset: 0, // Important for fitting in card
        background: 'transparent'
      },
      dataLabels: { enabled: false },
      stroke: { curve: 'smooth', width: 2 },
      xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00.000Z", "2018-09-20T00:00:00.000Z", "2018-09-21T00:00:00.000Z", "2018-09-22T00:00:00.000Z", "2018-09-23T00:00:00.000Z", "2018-09-24T00:00:00.000Z", "2018-09-25T00:00:00.000Z"], // Replace
        labels: { style: { colors: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#6b7280', fontSize: '12px' } },
        axisBorder: { show: false },
        axisTicks: { show: false }
      },
      yaxis: {
         labels: {
            formatter: function (value) { return value >= 1000 ? `${value / 1000}k` : value; },
            style: { colors: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#6b7280', fontSize: '12px' },
            offsetX: -10
        }
      },
      tooltip: {
        x: { format: 'dd MMM yyyy' },
        theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
      },
      colors: ['#06b6d4', '#818cf8'], // Tailwind: cyan-500, indigo-400
      legend: {
          show: true,
          position: 'top',
          horizontalAlign: 'right',
          labels: { colors: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151' }
      },
      grid: {
        show: true,
        borderColor: document.documentElement.classList.contains('dark') ? '#4b5563' : '#e5e7eb', // gray-600 or gray-200
        strokeDashArray: 4,
        padding: { top: -10, right: 0, bottom: 0, left: 10 }
      },
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.4,
          opacityTo: 0.1,
          stops: [0, 90, 100]
        }
      }
    };

    const chartElement = document.querySelector("#dashboard-main-chart");
    if (chartElement) {
        const chart = new ApexCharts(chartElement, options);
        chart.render();
        // Listener for theme changes to update chart theme
        const observer = new MutationObserver((mutationsList) => {
            for (let mutation of mutationsList) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    chart.updateOptions({
                        tooltip: { theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light' },
                        legend: { labels: { colors: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151' } },
                        grid: { borderColor: document.documentElement.classList.contains('dark') ? '#4b5563' : '#e5e7eb' },
                        xaxis: { labels: { style: { colors: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#6b7280' } } },
                        yaxis: { labels: { style: { colors: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#6b7280' } } }
                    });
                }
            }
        });
        observer.observe(document.documentElement, { attributes: true });
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const pieCtx = document.getElementById('depositorsPieChart').getContext('2d');

  const depositorsPieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: <?= json_encode(array_map(fn($e) => $e->empl_name, $top_depositors)) ?>,
      datasets: [{
        data: <?= json_encode(array_map(fn($e) => $e->total_deposit, $top_depositors)) ?>,
        backgroundColor: [
          '#14b8a6', '#0ea5e9', '#8b5cf6', '#f59e0b', '#ef4444',
          '#10b981', '#3b82f6', '#eab308', '#6366f1', '#ec4899'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            color: '#374151',
            font: {
              size: 12
            }
          }
        }
      }
    }
  });
</script>
