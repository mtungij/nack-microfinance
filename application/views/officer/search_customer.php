
<?php
include_once APPPATH . "views/partials/officerheader.php";
?>

<!-- ========== MAIN CONTENT BODY ========== -->
<div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-6">

     

    <?php if ($das = $this->session->flashdata('massage')): ?>
    <div class="bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-500">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </span>
            </div>
            <div class="ms-3">
                <h3 class="text-gray-800 font-semibold dark:text-white">Success</h3>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-400"><?php echo $das;?></p>
            </div>
            <div class="ps-3 ms-auto">
                <button type="button" class="inline-flex bg-teal-50 rounded-lg p-1.5 text-teal-500 hover:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-teal-50 focus:ring-teal-600 dark:bg-transparent dark:hover:bg-teal-800/50 dark:text-teal-600" data-hs-remove-element="[role=alert]">
                    <span class="sr-only">Dismiss</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (validation_errors()): ?>
    <div class="bg-red-100 border border-red-400 text-sm text-red-700 rounded-lg p-4 mt-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-200 bg-red-300 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-500">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                        <path d="M15 9l-6 6M9 9l6 6"></path>
                    </svg>
                </span>
            </div>
            <div class="ms-3">
                <h3 class="text-red-800 font-semibold dark:text-red-400">Validation Errors</h3>
                <div class="mt-2 text-sm text-red-700 dark:text-red-400">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                </div>
            </div>
            <div class="ps-3 ms-auto">
                <button type="button" class="inline-flex bg-red-50 rounded-lg p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600 dark:bg-transparent dark:hover:bg-red-800/50 dark:text-red-600" data-hs-remove-element="[role=alert]">
                    <span class="sr-only">Dismiss</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>


        <div class="bg-gray-100">
    <div class="w-full bg-cyan-600 text-white">
        <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:flex-row md:justify-between md:px-6 lg:px-8">
            <div class="p-4 flex flex-row items-center justify-between">
                <a href="#" class="text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
                    Customer profile
                </a>
            </div>
        </div>
    </div>
</div>


    <div class="container mx-auto my-3 p-4">
        <div class="md:flex no-wrap md:-mx-2">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <div class="bg-white p-3 border-t-4 border-green-400">
                    <div class="image overflow-hidden">
                    <?php if (!empty($customer->passport)): ?>
    <img class="h-auto w-full mx-auto rounded-full" src="<?= base_url($customer->passport) ?>" alt="Customer Passport">
<?php else: ?>
    <img class="h-auto w-full mx-auto rounded-full" src="<?= base_url('assets/img/customer21.png') ?>" alt="Customer Image">
<?php endif; ?>


                    </div>
                    <h1 class="text-green-500 font-bold text-xl leading-8 my-1 dark:text-neutral-900 text-center">
                        <?= strtoupper($customer->f_name) . " " . strtoupper(substr($customer->m_name, 0, 1)) . " " . strtoupper($customer->l_name) ?>
                    </h1>
                    <h1 class="text-center font-semibold"><?= $customer->phone_no ;?></h1>
                    <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto"><span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Member since</span>
                            <span class="ml-auto"><?= date('Y-m-d', strtotime($customer->customer_day)); ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Side -->
            <div class="w-full md:w-9/12 md:mx-2 mt-4 md:mt-0">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Guarantors</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">#</th>
                                <th class="py-3 px-6 text-left">Full Name</th>
                                <th class="py-3 px-6 text-left">Mobile</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-left">Sex</th>
                                <th class="py-3 px-6 text-left">DOB</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            <?php if (isset($share) && count($share) > 0): ?>
                                <?php foreach ($share as $i => $sh): ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6"><?= $i + 1 ?></td>
                                        <td class="py-3 px-6">jju</td>
                                        <td class="py-3 px-6">jju</td>
                                        <td class="py-3 px-6">jjuuuik</td>
                                        <td class="py-3 px-6">llkk</td>
                                        <td class="py-3 px-6">890000</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">No shareholder data found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 md:p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                  Sajili Taarifa Mdhamini

                </h3>
               


               
               <?php echo form_open_multipart("oficer/create_sponser/{$customer->customer_id}/{$customer->comp_id}"); ?>

<div class="grid sm:grid-cols-12 gap-4 sm:gap-6">
    <!-- First Name -->
    <div class="sm:col-span-4">
        <label for="sp_name" class="block text-sm font-medium mb-2 dark:text-gray-300">* First Name:</label>
        <input type="text" id="sp_name" name="sp_name"
               value="<?= isset($sponser->sp_name) ? htmlspecialchars($sponser->sp_name) : '' ?>"
               placeholder="jina la kwanza la mdhamini" autocomplete="off"
               class="uppercase py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm 
                      focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        <?php echo form_error("sp_name", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
    </div>

    <!-- Middle Name -->
    <div class="sm:col-span-4">
        <label for="sp_mname" class="block text-sm font-medium mb-2 dark:text-gray-300">* Middle Name:</label>
        <input type="text" id="sp_mname" name="sp_mname"
               value="<?= isset($sponser->sp_mname) ? htmlspecialchars($sponser->sp_mname) : '' ?>"
               placeholder="jina la pili la mdhamini" autocomplete="off"
               class="uppercase py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm 
                      focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        <?php echo form_error("sp_mname", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
    </div>

    <!-- Last Name -->
    <div class="sm:col-span-4">
        <label for="sp_lname" class="block text-sm font-medium mb-2 dark:text-gray-300">* Last Name:</label>
        <input type="text" id="sp_lname" name="sp_lname"
               value="<?= isset($sponser->sp_lname) ? htmlspecialchars($sponser->sp_lname) : '' ?>"
               placeholder="jina la mwisho la mdhamini" autocomplete="off"
               class="uppercase py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm 
                      focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        <?php echo form_error("sp_lname", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
    </div>

    <!-- Phone Number -->
    <div class="sm:col-span-4">
        <label for="sp_phone_no" class="block text-sm font-medium mb-2 dark:text-gray-300">* Phone no:</label>
        <input type="text" id="sp_phone_no" name="sp_phone_no"
               value="<?= isset($sponser->sp_phone_no) ? htmlspecialchars($sponser->sp_phone_no) : '' ?>"
               placeholder="Namba ya simu ya mdhamini" autocomplete="off"
               class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm 
                      focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        <?php echo form_error("sp_phone_no", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
    </div>

    <!-- Relationship -->
    <div class="sm:col-span-4">
        <label for="sp_relation" class="block text-sm font-medium mb-2 dark:text-gray-300">* Relationship With Customer:</label>
        <input type="text" id="sp_relation" name="sp_relation"
               value="<?= isset($sponser->sp_relation) ? htmlspecialchars($sponser->sp_relation) : '' ?>"
               placeholder="mdhamini ana uhusiano gani na mkopaji..? mf mume,kaka n.k" autocomplete="off"
               class="uppercase py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm 
                      focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        <?php echo form_error("sp_relation", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
    </div>

    <!-- Business -->
    <div class="sm:col-span-4">
        <label for="nature" class="block text-sm font-medium mb-2 dark:text-gray-300">* Guarantor Business:</label>
        <input type="text" id="nature" name="nature"
               value="<?= isset($sponser->nature) ? htmlspecialchars($sponser->nature) : '' ?>"
               placeholder="Biashara ya Mdhamini" autocomplete="off"
               class="uppercase py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm 
                      focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        <?php echo form_error("nature", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
    </div>

    <!-- Barua ya Utambulisho -->
    <div class="sm:col-span-4">
        <label for="barua_utambulisho" class="block text-sm font-medium mb-2 dark:text-gray-300">
            Barua ya Utambulisho (PDF) <span class="text-gray-400">(optional)</span>:
        </label>
        <input type="file" id="barua_utambulisho" name="barua_utambulisho" accept="application/pdf"
               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-md 
                      file:border-0 file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 
                      dark:file:bg-gray-700 dark:file:text-gray-300">
        <?php echo form_error("barua_utambulisho", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
    </div>

    <!-- Kitambulisho -->
    <div class="sm:col-span-4">
        <label for="kitambulisho" class="block text-sm font-medium mb-2 dark:text-gray-300">* Kitambulisho (PDF):</label>
        <input type="file" id="kitambulisho" name="kitambulisho" accept="application/pdf"
               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-md 
                      file:border-0 file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 
                      dark:file:bg-gray-700 dark:file:text-gray-300">
        <?php echo form_error("kitambulisho", '<p class="text-xs text-red-600 mt-2">', '</p>'); ?>
    </div>

    <!-- Passport Size Photo -->
    <div class="sm:col-span-4">
        <label class="block text-sm font-medium mb-2 dark:text-gray-300">* Passport Size Photo:</label>
        <input type="file" id="passportInput" accept="image/*" 
       capture="environment"
               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-md 
                      file:border-0 file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 
                      dark:file:bg-gray-700 dark:file:text-gray-300">
        <input type="hidden" name="passport_cropped" id="passportCropped">
        <div class="mt-3">
            <img id="previewImage" class="rounded border shadow w-32 h-32 object-cover"
                 src="<?= isset($sponser->passport_path) && !empty($sponser->passport_path) 
                          ? base_url($sponser->passport_path) 
                          : base_url('assets/img/customer21.png') ?>"
                 alt="Preview">
        </div>
    </div>
</div>

<!-- Hidden Inputs -->
<input type="hidden" name="comp_id" value="<?= htmlspecialchars($_SESSION['comp_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
<input type="hidden" name="customer_id" value="<?= htmlspecialchars($customer->customer_id ?? '', ENT_QUOTES, 'UTF-8'); ?>">

<!-- Action Buttons -->
<div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
    <div class="flex justify-center gap-x-2">
        <button type="submit" class="py-2 px-4 bg-cyan-600 hover:bg-cyan-700 text-white rounded text-sm">Save</button>
        <button type="reset" class="py-2 px-4 bg-gray-300 hover:bg-gray-400 text-black rounded text-sm">Cancel</button>
    </div>
</div>

<?php echo form_close(); ?>


            </div>
        </div>

        
   <!-- Cropper Modal -->
<div id="cropperModal" class="hidden fixed z-50 inset-0 bg-black bg-opacity-50 flex items-center justify-center px-2 sm:px-4">
  <div class="bg-white dark:bg-gray-900 flex flex-col p-4 rounded-lg shadow-lg w-full max-w-md sm:max-w-lg md:max-w-xl max-h-[90vh]">

    <!-- Title -->
    <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Crop Passport</h2>

    <!-- Scrollable Image Area -->
    <div class="flex-1 overflow-y-auto">
      <img id="cropperImage" class="max-w-full object-contain max-h-[70vh] rounded border mx-auto" alt="To crop">
    </div>

    <!-- Sticky Action Buttons -->
    <div class="mt-4 flex justify-end gap-3 sticky bottom-0 bg-white dark:bg-gray-900 pt-2">
      <button id="cancelCrop" type="button"
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-4 py-2 rounded transition">
        Cancel
      </button>
      <button id="cropImage" type="button"
        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded transition">
        Crop & Use
      </button>
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
document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('sp_phone_no');

    phoneInput.addEventListener('input', function (e) {
        let value = phoneInput.value.replace(/\D/g, ''); // Remove non-digits

        // Format like: 0712 345 678
        if (value.length > 3 && value.length <= 6) {
            value = value.replace(/(\d{3})(\d+)/, '$1 $2');
        } else if (value.length > 6) {
            value = value.replace(/(\d{3})(\d{3})(\d+)/, '$1 $2 $3');
        }

        phoneInput.value = value;
    });

    // On submit, strip formatting so only digits are sent
    phoneInput.form.addEventListener('submit', function () {
        phoneInput.value = phoneInput.value.replace(/\D/g, '');
    });
});
</script>


<script>
let cropper;
const passportInput = document.getElementById('passportInput');
const cropperModal = document.getElementById('cropperModal');
const cropperImage = document.getElementById('cropperImage');
const previewImage = document.getElementById('previewImage');
const passportCropped = document.getElementById('passportCropped');

passportInput.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (event) {
        cropperImage.src = event.target.result;
        cropperModal.classList.remove('hidden');
        if (cropper) cropper.destroy();
        cropper = new Cropper(cropperImage, {
            aspectRatio: 3 / 4,
            viewMode: 1,
        });
    };
    reader.readAsDataURL(file);
});

document.getElementById('cancelCrop').addEventListener('click', () => {
    cropperModal.classList.add('hidden');
    passportInput.value = ''; // reset input
    if (cropper) cropper.destroy();
});

document.getElementById('cropImage').addEventListener('click', () => {
    const canvas = cropper.getCroppedCanvas({
        width: 300,
        height: 400,
    });

    // Show cropped preview
    previewImage.src = canvas.toDataURL('image/jpeg');

    // Set hidden input for form
    passportCropped.value = canvas.toDataURL('image/jpeg');

    cropperModal.classList.add('hidden');
    if (cropper) cropper.destroy();
});
</script>

