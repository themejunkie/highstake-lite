<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field field" placeholder="<?php echo esc_attr_x( 'Type keyword &hellip;', 'placeholder', 'highstake' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'highstake' ) ?>" />
</form>
