<div id="bfb_wrap" class="optimize">

	<h1 class="bfb_h1">A/Bテストのパターン作成</h1>

	<div id="bfb_main" class="bfb_pro">

		<h2>メインボタン設定</h2>

		<div class="menuLink">

			<form action="" method="post" class="action_back">
				<input type="submit" value="戻る"  class="">
				<input type="hidden" name="page" value="blog-floating-button-optimize">
				<input type="hidden" name="optimize_id" value="<?php echo esc_attr($this->optimize_id); ?>">
				<input type="hidden" name="optimize_step" value="opt_mainBtn">
				<input type="hidden" name="action" value="back">
			</form>

			<a href="?page=blog-floating-button-optimize" class="bfb_edit_finish">編集を終了</a>

		</div>

		<form id="bfb_form_opt" method="POST" action="?page=blog-floating-button-optimize" device="<?php echo esc_attr($this->device); ?>" btnDesign="<?php echo esc_attr($this->mainBtnDesign); ?>">

			<div class="bfb_inner_wrap">

				<table class="form-table">
					<tr>
						<th>テストID<span class="bfb_popup_help" data-message="自動付与されるIDです。変更はできません。">?</span></th>
						<td><input type="text" class="regular-text" name="optimize_id" value="<?php echo esc_attr($this->optimize_id); ?>" readonly><small class="bfb_small">自動付与されるため変更できません。</small></td>
					</tr>
				</table>

			<?php include( dirname(__FILE__) . '/../setting-'.$this->device.'/setting-'.$this->device.'-'.$this->mainBtnDesign.'.php' ); ?>

			</div>

			<input type="submit" value="保存して次へ"  class="button button-primary bfb_saveBtn">
			<input type="hidden" name="page" value="blog-floating-button-optimize">
			<input type="hidden" name="optimize_id" value="<?php echo esc_attr($this->optimize_id); ?>">
			<input type="hidden" name="optimize_step" value="opt_mainBtn">
		
		</form>
	</div>

	<div id="bfb_sub" class="bfb_pro">

		<?php include_once( dirname(__FILE__) . '/../live_preview.php' ); ?>

		<div class="preview_wrap bfb_sticky">
			<div class="bfb_preview_pc">
				<div class="preview_area">
				</div>
			</div>
			<div class="bfb_preview_sp">
				<div class="preview_area">
				</div>
			</div>
		</div>

	</div>

</div><!--bfb_wrap-->