<?php

$num_columns	= 4;
$can_delete	= $this->auth->has_permission('Artikel.Content.Delete');
$can_edit		= $this->auth->has_permission('Artikel.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('artikel_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('artikel_field_judul_artikel'); ?></th>
					<th><?php echo lang('artikel_field_tgl_terbit_artikel'); ?></th>
					<th><?php echo lang('artikel_field_isi_artikel'); ?></th>
					<th><?php echo lang('artikel_field_kategori_artikel'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('artikel_delete_confirm'))); ?>')" />
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
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id_artikel; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/content/artikel/edit/' . $record->id_artikel, '<span class="icon-pencil"></span> ' .  $record->judul_artikel); ?></td>
				<?php else : ?>
					<td><?php e($record->judul_artikel); ?></td>
				<?php endif; ?>
					<td><?php e($record->tgl_terbit_artikel); ?></td>
					<td><?php e($record->isi_artikel); ?></td>
					<td><?php e($record->kategori_artikel); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('artikel_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    ?>
</div>