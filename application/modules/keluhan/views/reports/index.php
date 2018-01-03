<?php

$num_columns	= 3;
$can_delete	= $this->auth->has_permission('Keluhan.Reports.Delete');
$can_edit		= $this->auth->has_permission('Keluhan.Reports.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('keluhan_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th>Pelapor</th>
     <th>Waktu Lapor</th>
					<th>Kecamatan</th>
					<th><?php echo lang('keluhan_field_isi_keluhan'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('keluhan_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id_keluhan; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/reports/keluhan/edit/' . $record->id_keluhan, '<span class="icon-pencil"></span> ' .  $record->display_name." (".$record->username.")"); ?></td>
				<?php else : ?>
					<td><a href="<?= base_url('admin/reports/keluhan/lihat/'.$record->id_keluhan) ?>"><?php e($record->display_name." (".$record->username.")"); ?></a></td>
				<?php endif; ?>
					<td><?php e(tanggal($record->waktu_lapor,true)); ?></td>
     <td><?php e($record->nama_kecamatan); ?></td>
					<td><?= text_preview($record->isi_keluhan, 3); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('keluhan_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>