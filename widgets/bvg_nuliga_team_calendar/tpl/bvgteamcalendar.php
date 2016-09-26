<?php if( !empty( $instance['title'] ) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];

/* Get teams posts for this saison */
$bvg_team_ranking_html = '';

$args2 = array(
	's' => $saison,
	'post_type' => 'page'
);
$query = new WP_Query( $args2 );

/*
$bvg_team_ranking_html .= '<pre>';
print_r( $query );
*/

if ( $query->have_posts() ){
	$bvg_team_ranking_html .= '<table class="mannschaft_platz">';
	$bvg_team_ranking_html .= '<thead>';
	$bvg_team_ranking_html .= '<tr>';
	$bvg_team_ranking_html .= '<td class="team_name">';
	$bvg_team_ranking_html .= 'Mannschaft';
	$bvg_team_ranking_html .= '</td>';
	$bvg_team_ranking_html .= '<td class="clt">';
	$bvg_team_ranking_html .= 'Aktueller Platz';
	$bvg_team_ranking_html .= '</td>';
	$bvg_team_ranking_html .= '</tr>';
	$bvg_team_ranking_html .= '</thead>';
	$bvg_team_ranking_html .= '<tbody>';
	while ( $query->have_posts() ){
		$query->the_post();

		$content = get_the_content();

		$team = get_the_title();
		$team = str_replace( ' '.$saison , '' , $team );

		$regex = '/standingsrank\"\>(\d)\<\/td\>\<td\>\<a.*BV G\.\-Goldbach/';



		if( preg_match( $regex , $content, $matches) ){
			$bvg_team_ranking_html .= '<tr>';
			$bvg_team_ranking_html .= '<td class="team_name">';
			$bvg_team_ranking_html .= '<a href="';
			ob_start();
			the_permalink();
			$tmp = ob_get_contents();
			ob_end_clean();
			$bvg_team_ranking_html .= $tmp;
			$bvg_team_ranking_html .= '">';
			$bvg_team_ranking_html .= $team;
			$bvg_team_ranking_html .= '</a>';
			$bvg_team_ranking_html .= '</td>';
			$bvg_team_ranking_html .= '<td class="clt">';
			$bvg_team_ranking_html .= $matches[1];
			$bvg_team_ranking_html .= '</td>';
			$bvg_team_ranking_html .= '</tr>';

		}

	}
	$bvg_team_ranking_html .= '</tbody>';
	$bvg_team_ranking_html .= '</table>';

	wp_reset_postdata();

}else{
	$bvg_team_ranking_html .= 'Noch kein Ergebnis für diese Saison...';
}

?>


<div class="siteorigin-widget-tinymce textwidget">
	<div class="bvg_block" id="<?php echo $id ?>" >

		<h1><?php echo $title; ?></h1>

		<h3><?php echo $saison; ?></h3>

		<?php echo $bvg_team_ranking_html; ?>
	</div>
</div>
