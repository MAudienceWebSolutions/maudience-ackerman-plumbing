<?php
if ( is_search() ) {
	$prevtext = '« Previous Page ';
	$nexttext = ' Next Page »';
} elseif ( is_home() || is_category() ) {
	$prevtext = '« Previous Posts ';
	$nexttext = ' Next Posts »';
} elseif ( is_single( 'post' ) ) {
	$prevtext = '« Previous Post »';
	$nexttext = ' Next Post ';
} else {
	$prevtext = '« Previous ';
	$nexttext = ' Next »';
}
carbon_pagination( 'posts', array(
	'prev_html' => '<a class="paging-prev" href="{URL}">' . $prevtext . '</a>',
	'next_html' => '<a class="paging-next" href="{URL}">' . $nexttext . '</a>',
)); 
