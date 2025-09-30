<?php
include_once APPPATH . "views/partials/header.php";
?>

<!-- Parent div with Alpine.js data -->
<div class="w-full lg:ps-64 p-4 sm:p-6" x-data="{ openEditId: null, openDeleteId: null, showDeleteModal: false, selectedId: null }">

  <!-- Page Title -->
  <div class="mb-6">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-200">
      Manage Notifications
    </h2>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
      Register, edit, and view notification recipients.
    </p>
  </div>

  <!-- Flash Messages -->
  <?php if ($msg = $this->session->flashdata('massage')): ?>
    <div class="bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
      <div class="flex">
        <div class="flex-shrink-0">
          <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-500">✅</span>
        </div>
        <div class="ms-3">
          <h3 class="text-gray-800 font-semibold dark:text-white">Success</h3>
          <p class="mt-2 text-sm text-gray-700 dark:text-gray-400"><?php echo $msg;?></p>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- Register Notification Form -->
  <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
    <div class="p-4 md:p-6">
      <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Register Notification Recipient</h3>
      <?php echo form_open("admin/create_notifications", ['novalidate' => true]); ?>
        <div class="grid sm:grid-cols-12 gap-4 sm:gap-6">

          <!-- Name -->
          <div class="sm:col-span-4">
            <label for="name" class="block text-sm font-medium mb-2 dark:text-gray-300">* Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Full name" required
                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                   value="<?php echo set_value('name'); ?>">
            <?php echo form_error("name", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
          </div>

          <!-- Phone -->
          <div class="sm:col-span-4">
            <label for="phone_number" class="block text-sm font-medium mb-2 dark:text-gray-300">* Phone Number:</label>
            <input type="number" id="phone_number" name="phone_number" placeholder="255XXXXXXXXX" required
                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                   value="<?php echo set_value('phone_number'); ?>">
            <?php echo form_error("phone_number", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
          </div>

          <!-- Position -->
          <div class="sm:col-span-4">
            <label for="position" class="block text-sm font-medium mb-2 dark:text-gray-300">* Position:</label>
            <select id="position" name="position" required
                    class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
              <option value="">Select Position</option>
              <option value="admin" <?php echo set_select('position','admin'); ?>>Admin</option>
              <option value="loan_officer" <?php echo set_select('position','loan_officer'); ?>>Loan Officer</option>
              <option value="branch_manager" <?php echo set_select('position','branch_manager'); ?>>Branch Manager</option>
            </select>
            <?php echo form_error("position", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
          </div>

        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
          <div class="flex justify-center gap-x-2">
            <button type="submit" class="py-2 px-4 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg">Save</button>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>

  <!-- Notification Recipients Table -->
  <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 overflow-x-auto mt-8">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Notification Recipients</h2>

    <div class="bg-white dark:bg-gray-800 border shadow-sm rounded-xl overflow-x-auto">
      <table id="notificationsTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-100 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">S/No</th>
            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Name</th>
            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Phone</th>
            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Position</th>
            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Status</th>
            <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
          <?php $no=1; foreach($numbers as $n): ?>
          <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?= $no++; ?></td>
            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?= htmlspecialchars($n->name); ?></td>
            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?= htmlspecialchars($n->phone_number); ?></td>
            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?= ucfirst($n->position); ?></td>
            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?= $n->status ? 'Active' : 'Inactive'; ?></td>
            <td class="px-6 py-4 ">


       <a href="<?= site_url('admin/delete/'.$n->id) ?>" 
   class="flex items-center px-3 py-1 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
    </svg>
    Delete
</a>




            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php include_once APPPATH . "views/partials/footer.php"; ?>

<!-- Alpine.js CDN -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- DataTables initialization -->
<script>
$(document).ready(function() {
    $('#notificationsTable').DataTable({
        pageLength: 10,
        lengthChange: false,
        searching: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        }
    });
});
</script>
