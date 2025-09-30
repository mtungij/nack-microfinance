<?php
// application/views/partials/navbar.php
?>
<!-- ========== HEADER ========== -->
<header class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-30 w-full bg-white border-b border-gray-200 text-sm py-2.5 sm:py-4 lg:ps-64 dark:bg-gray-800 dark:border-gray-700">
  <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6" aria-label="Global">
    <div class="me-5 lg:me-0 lg:hidden">
      <!-- Logo for mobile (can be same as desktop) -->
      <a class="flex-none text-xl font-semibold dark:text-white" href="<?php echo base_url("admin/index"); // Link to dashboard/home ?>" aria-label="Brand">
        <img class="h-8 sm:h-10" src="<?php echo base_url('assets/img/logo.png'); // Adjust path and style as needed ?>" alt="Logo">
      </a>
    </div>

    <div class="w-full flex items-center justify-end ms-auto sm:justify-between sm:gap-x-3 sm:order-3">
      <div class="sm:hidden">
        <button type="button" class="p-2 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-700 dark:text-white dark:hover:bg-white/10">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
        </button>
      </div>

      <div class="hidden sm:block">
        <?php // Optional: Search bar - can be added here if needed
        /*
        <label for="icon" class="sr-only">Search</label>
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
            <svg class="shrink-0 size-4 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
          </div>
          <input type="text" id="icon" name="icon" class="py-2 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Search">
        </div>
        */
        ?>
      </div>

      <div class="flex flex-row items-center justify-end gap-2">
        <?php // Optional: Notification Bell
        /*
        <button type="button" class="p-2 inline-flex justify-center items-center gap-x-2 rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-300 dark:hover:bg-gray-700">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
          <span class="sr-only">View notifications</span>
        </button>
        */
        ?>

        <?php // Theme switcher button (Dark/Light mode) - Preline has examples for this.
              // This logic is already in your new partials/header.php's <script> section.
              // We just need a button to toggle it.
        ?>
        <button type="button" id="hs-theme-switcher" class="hs-dark-mode-active:hidden block hs-dark-mode group p-2 inline-flex justify-center items-center gap-x-2 rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-300 dark:hover:bg-gray-700" data-hs-theme-click-value="dark">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
        </button>
        <button type="button" id="hs-theme-switcher-light" class="hs-dark-mode-active:block hidden hs-dark-mode group p-2 inline-flex justify-center items-center gap-x-2 rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-300 dark:hover:bg-gray-700" data-hs-theme-click-value="light">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
        </button>


        <!-- Profile Dropdown -->
        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
          <button id="hs-dropdown-with-header" type="button" class="hs-dropdown-toggle p-1 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
            <img class="inline-block size-8 rounded-full ring-2 ring-white dark:ring-gray-800" src="<?php echo base_url('assets/img/user.png'); // Default user image ?>" alt="User image">
            <span class="hidden md:block text-gray-600 dark:text-gray-400 text-xs font-medium ms-1 me-2">
              <?php echo htmlspecialchars($_SESSION['comp_name'] ?? 'User', ENT_QUOTES, 'UTF-8'); ?>
            </span>
            <svg class="hidden md:block hs-dropdown-open:rotate-180 size-2.5 text-gray-500 dark:text-gray-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>

          <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700" aria-labelledby="hs-dropdown-with-header">
            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg dark:bg-gray-700">
              <p class="text-sm text-gray-500 dark:text-gray-400">Signed in as</p>
              <p class="text-sm font-medium text-gray-800 dark:text-gray-300">
                <?php echo htmlspecialchars($_SESSION['comp_name'] ?? 'user@example.com', ENT_QUOTES, 'UTF-8'); // Display email or name ?>
              </p>
            </div>
            <div class="mt-2 py-2 first:pt-0 last:pb-0">
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-cyan-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="<?php echo base_url("admin/company_profile"); ?>">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                My Profile
                <span class="ms-auto text-xs text-gray-500 dark:text-gray-500">Account settings</span>
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-cyan-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="<?php echo base_url("admin/sms_history"); ?>">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                SMS
                 <span class="ms-auto text-xs text-gray-500 dark:text-gray-500">SMS History</span>
              </a>
              <?php // Add other dropdown items here if needed ?>
              <hr class="my-2 border-gray-200 dark:border-gray-700">
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-gray-100 focus:ring-2 focus:ring-cyan-500 dark:text-red-500 dark:hover:bg-gray-700" href="<?php echo base_url("welcome/logout"); ?>">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                Sign out
              </a>
            </div>
          </div>
        </div>
        <!-- End Profile Dropdown -->
      </div>
    </div>
  </nav>
</header>
<!-- ========== END HEADER ========== -->