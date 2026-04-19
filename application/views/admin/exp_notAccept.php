
<?php
include_once APPPATH . "views/partials/header.php";
?>
<div class="w-full min-h-screen bg-gray-50 lg:ps-64">
	<div class="p-4 sm:p-8 max-w-7xl mx-auto">
		<div class="mb-8">
			<h1 class="text-2xl font-bold text-gray-800">Today's Expenses Requests</h1>
			<p class="text-gray-500 mt-1">Below are all expense requests submitted today.</p>
		</div>

		<?php if (!empty($data)): ?>
		<div class="overflow-x-auto bg-white shadow rounded-lg">
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-100">
					<tr>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Branch</th>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Employee</th>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Expense</th>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Amount</th>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Description</th>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Comment</th>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
						<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Action</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-100">
					<?php foreach ($data as $row): ?>
						<?php if ($row->req_status !== 'open') continue; ?>
					<tr>
						<td class="px-4 py-2 whitespace-nowrap"> <?php echo $row->blanch_name; ?> </td>
						<td class="px-4 py-2 whitespace-nowrap"> <?php echo isset($row->empl_name) ? $row->empl_name : '-'; ?> </td>
						<td class="px-4 py-2 whitespace-nowrap"> <?php echo $row->ex_name; ?> </td>
						<td class="px-4 py-2 whitespace-nowrap"> <?php echo number_format($row->req_amount); ?> </td>
						<td class="px-4 py-2">
							<?php
								$desc = $row->req_description;
								$desc_short = mb_strimwidth($desc, 0, 40, '...');
								$desc_id = 'descModal_' . $row->req_id;
							?>
							<span><?php echo htmlspecialchars($desc_short); ?></span>
							<?php if (mb_strlen($desc) > 40): ?>
								<button type="button" class="ml-2 text-blue-600 hover:underline text-xs" onclick="document.getElementById('<?php echo $desc_id; ?>').classList.remove('hidden')">View More</button>
								<!-- Modal for full description -->
								<div id="<?php echo $desc_id; ?>" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-modal="true" role="dialog">
									<div class="flex items-center justify-center min-h-screen px-4">
										<div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6">
											<div class="flex justify-between items-center mb-4">
												<h3 class="text-lg font-semibold text-gray-800">Full Description</h3>
												<button type="button" class="text-gray-500 hover:text-gray-700 text-2xl leading-none" onclick="document.getElementById('<?php echo $desc_id; ?>').classList.add('hidden')">&times;</button>
											</div>
											<div class="text-gray-700 whitespace-pre-line"><?php echo nl2br(htmlspecialchars($desc)); ?></div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</td>
						<td class="px-4 py-2"> <?php echo $row->req_comment; ?> </td>
						<td class="px-4 py-2"> <?php echo $row->req_date; ?> </td>
						<td class="px-4 py-2">
							<?php if($row->req_status == 'open'): ?>
								<span class="inline-block px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded">Not Accepted</span>
							<?php elseif($row->req_status == 'accept'): ?>
								<span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Accepted</span>
							<?php endif; ?>
						</td>
						<td class="px-4 py-2">
							<!-- Example action: Accept/Reject buttons (customize as needed) -->
							<div class="flex gap-2">
								<button type="button" class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition" onclick="document.getElementById('acceptModal_<?php echo $row->req_id; ?>').classList.remove('hidden')">Accept</button>
																<!-- Accept Modal -->
																<div id="acceptModal_<?php echo $row->req_id; ?>" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-modal="true" role="dialog">
																	<div class="flex items-center justify-center min-h-screen px-4">
																		<div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
																			<div class="flex justify-between items-center mb-4">
																				<h3 class="text-lg font-semibold text-gray-800">Accept or Reduce Amount</h3>
																				<button type="button" class="text-gray-500 hover:text-gray-700 text-2xl leading-none" onclick="document.getElementById('acceptModal_<?php echo $row->req_id; ?>').classList.add('hidden')">&times;</button>
																			</div>
																			<?php echo form_open('admin/expenses_request_accept/' . $row->req_id); ?>
																				<div class="mb-4">
																					<label for="accept_amount_<?php echo $row->req_id; ?>" class="block text-sm font-medium mb-2 text-gray-700">Amount to Approve</label>
																					<input id="accept_amount_<?php echo $row->req_id; ?>" name="req_amount" type="number" min="0" max="<?php echo $row->req_amount; ?>" value="<?php echo $row->req_amount; ?>" required class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 bg-white">
																					<p class="text-xs text-gray-500 mt-1">Original request: <span class="font-semibold"><?php echo number_format($row->req_amount); ?></span></p>
																				</div>
																				<!-- Branch Account field removed as requested -->
																				<div class="mb-4">
																					<label for="accept_comment_<?php echo $row->req_id; ?>" class="block text-sm font-medium mb-2 text-gray-700">Comment (optional)</label>
																					<textarea id="accept_comment_<?php echo $row->req_id; ?>" name="req_comment" rows="2" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-cyan-500 focus:ring-cyan-500 bg-white"></textarea>
																				</div>
																				<div class="flex justify-end gap-2">
																					<button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300" onclick="document.getElementById('acceptModal_<?php echo $row->req_id; ?>').classList.add('hidden')">Cancel</button>
																					<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Accept</button>
																				</div>
																			<?php echo form_close(); ?>
																		</div>
																	</div>
																</div>
								<a href="#" class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition">Reject</a>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php else: ?>
		<div class="flex flex-col items-center justify-center py-24">
			<svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v2M9 17v2a4 4 0 0 0 4 4h2a4 4 0 0 0 4-4v-2M9 17H7a4 4 0 0 1-4-4v-2a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v2"></path></svg>
			<p class="text-gray-500 text-lg">No expenses requests found for today.</p>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php include_once APPPATH . "views/partials/footer.php"; ?>

