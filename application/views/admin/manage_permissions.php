<?php
include_once APPPATH . "views/partials/header.php";

// --- DUMMY DATA - REMOVE AND LOAD FROM YOUR CONTROLLER ---
// Controller should pass $share, an array of shareholder objects.
// Each object should have 'share_id', 'share_name', 'share_mobile', 'share_email', 'share_sex', 'share_dob'.
// if (!isset($share)) {
//     $share = [
//         (object)['share_id' => 1, 'share_name' => 'Alice Wonderland', 'share_mobile' => '0712345001', 'share_email' => 'alice@example.com', 'share_sex' => 'female', 'share_dob' => '1985-06-15'],
//         (object)['share_id' => 2, 'share_name' => 'Bob The Builder', 'share_mobile' => '0712345002', 'share_email' => 'bob@example.com', 'share_sex' => 'male', 'share_dob' => '1978-11-02'],
//     ];
// }
// --- END DUMMY DATA ---header.php
?>


<div class="w-full lg:ps-64">
  <div class="= overflow-x-auto">

  <div id="tab-profile" class="tab-content w-full dark:bg-gray-800 rounded shadow-xl overflow-hidden">
      <div class="h-[140px] bg-gradient-to-r from-cyan-500 to-blue-500"></div>
      <div class="px-5 py-2 flex flex-col gap-3 pb-6">
        <div class="h-[90px] shadow-md w-[90px] rounded-full border-4 overflow-hidden -mt-14 border-white">
          <img class="w-full h-full rounded-full object-center object-cover" src="<?= base_url('assets/img/customer21.png') ?>" alt="Customer Image">
        </div>
        <div>
        <h3 class="uppercase text-xl text-slate-900 font-bold leading-6 dark:text-white">
  <?= htmlspecialchars($employee->empl_name, ENT_QUOTES, 'UTF-8') ?>
</h3>

          <p class="text-sm text-gray-600  dark:text-white">@daddasoft</p>
        </div>

   


      
        
      </div>
    </div>


<!-- <h3>Manage Permissions for Employee ID: </?= $employee_id ?></h3> -->

<!-- <form method="post" action="</?= base_url('admin/update') ?>" > -->
<form class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto" method="post" action="<?php echo base_url('admin/save_permissions/' . $employee_id); ?>">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200  w-full rounded-xl shadow-2xs overflow-hidden dark:bg-gray-800 dark:border-gray-700">

          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
            <div>
              <p class="text-sm text-gray-600 uppercase font-bold dark:text-white">
                Management System Access
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        onclick="toggleCheckboxes(this)">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                       stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                  </svg>
                  Chagua Zote
                </button>
              </div>
            </div>
          </div>
          <!-- End Header -->

          <!-- Hidden employee id -->
          <input type="hidden" name="employee_id" value="<?= htmlspecialchars($employee_id) ?>">

          <!-- Table / Permissions Grid -->


<form method="post" action="<?= base_url('admin/save_permissions/' . $employee_id); ?>">
  <input type="hidden" name="employee_id" value="<?= $employee_id ?>">

  <?php foreach ($grouped_links as $group => $links): ?>
    <h3 class="text-lg font-semibold mt-6 mb-2 text-gray-800 dark:text-gray-200">
      <?= htmlspecialchars($group) ?>
    </h3>

    <div class="grid sm:grid-cols-2 gap-2">
      <?php foreach ($links as $link): ?>
        <?php $isChecked = in_array($link->id, $employee_links) ? 'checked' : ''; ?>
        <label for="link_<?= $link->id ?>" class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 cursor-pointer">
          <input
            type="checkbox"
            id="link_<?= $link->id ?>"
            name="permissions[]"
            value="<?= $link->id ?>"
            class="permission-checkbox shrink-0 mt-0.5 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:checked:bg-blue-500"
            <?= $isChecked ?>
          >
          <span class="ms-3 text-gray-700 dark:text-gray-300"><?= htmlspecialchars($link->link_name) ?></span>
        </label>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>

  <div class="mt-6">
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Update Permissions
    </button>
  </div>
</form>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
</form>

<script>
  // Toggle all checkboxes on or off
  function toggleCheckboxes(button) {
    const checkboxes = document.querySelectorAll('.permission-checkbox');
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    checkboxes.forEach(cb => cb.checked = !allChecked);
    button.textContent = allChecked ? 'Chagua Zote' : 'Ondoa Zote'; // Change button text accordingly
  }
</script>



  <?php
  include_once APPPATH . "views/partials/footer.php";
  ?>

<script>
function toggleCheckboxes(button) {
    const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
    const allChecked = [...checkboxes].every(cb => cb.checked);

    checkboxes.forEach(cb => cb.checked = !allChecked);

    button.textContent = allChecked ? 'Chagua Zote' : 'Ondoa Zote';
}
</script>
