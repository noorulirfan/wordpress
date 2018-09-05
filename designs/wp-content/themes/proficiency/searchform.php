<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<input  type="text" class="form-control" name="s" id="s" required >
		<label><?php esc_attr_e( "Type to search", 'proficiency' ); ?></label>
	</div>
	<button type="submit" class="btn btn-theme"><?php esc_attr_e( "Search", 'proficiency' ); ?></button>
</form>
