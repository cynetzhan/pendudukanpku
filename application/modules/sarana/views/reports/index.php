<?php

$num_columns	= 6;
$can_delete	= $this->auth->has_permission('Sarana.Reports.Delete');
$can_edit		= $this->auth->has_permission('Sarana.Reports.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('sarana_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('sarana_field_id_kecamatan'); ?></th>
					<th><?php echo lang('sarana_field_krit1_sarana'); ?></th>
					<th><?php echo lang('sarana_field_krit2_sarana'); ?></th>
					<th><?php echo lang('sarana_field_krit3_sarana'); ?></th>
					<th><?php echo lang('sarana_field_krit4_sarana'); ?></th>
					<th><?php echo lang('sarana_field_krit5_sarana'); ?></th>
     <th>Hasil</th>
     <th>Keterangan</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('sarana_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
     $data = array(hitungBobot($record->krit1_sarana,1),
             hitungBobot($record->krit2_sarana,2),
             hitungBobot($record->krit3_sarana,3),
             hitungBobot($record->krit4_sarana,4),
             hitungBobot($record->krit5_sarana,5)
     );
     $hasilBobot = hitungHasil($data);
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id_sarana; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/reports/sarana/edit/' . $record->id_sarana, '<span class="icon-pencil"></span> ' .  $record->nama_kecamatan); ?></td>
				<?php else : ?>
					<td><?php e($record->nama_kecamatan); ?></td>
				<?php endif; ?>
					<td><?php e($record->krit1_sarana); ?>% <br>
     <?= "Bobot : <strong>".hitungBobot($record->krit1_sarana,1) ."</strong>" ?>
     </td>
					<td><?php e($record->krit2_sarana); ?>% <br>
     <?= "Bobot : <strong>".hitungBobot($record->krit2_sarana,2) ."</strong>" ?></td>
					<td><?php e($record->krit3_sarana); ?>% <br>
     <?= "Bobot : <strong>".hitungBobot($record->krit3_sarana,3) ."</strong>" ?></td>
					<td><?php e($record->krit4_sarana); ?>% <br>
     <?= "Bobot : <strong>".hitungBobot($record->krit4_sarana,4) ."</strong>" ?></td>
					<td><?php e($record->krit5_sarana); ?>% <br>
     <?= "Bobot : <strong>".hitungBobot($record->krit5_sarana,5) ."</strong>" ?></td>
      <td><?= $hasilBobot['hasil'] ?></td>
      <td><?= ketHasil($hasilBobot['hasil']) ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('sarana_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>