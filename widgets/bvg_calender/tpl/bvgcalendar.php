<?php if( !empty( $instance['title'] ) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];

$calendar_colors = array( '8C500B' , '8C500B' , '853104' , 'B1440E' , '711616' , '691426' , '125A12' ,
                          '8C500B' , 'AB8B00' , '182C57' , '875509' , 'B1440E' , '5F6B02' , '5229A3' ,
                          '0F4B38' , 'AF8B40' , '5229A3' , '182C57' );

$calendars = array(
	'',
	'9gkrvvl0735cgabbigfl83upfs%40group.calendar.google.com',
	'vuiv5dv73i7cikk8mksodn5aqk%40group.calendar.google.com',
	'2ue58cou3alig7s671imdbup4o%40group.calendar.google.com',
	'mvd9opsvhko7rr9df4om3u9p98%40group.calendar.google.com',
	'dh9tkhfn6e4u13a1pp3and1s3o%40group.calendar.google.com',
	'sb00tamhpeemujjq0tnnbgsruo%40group.calendar.google.com',
	'4kver4d7v1kflqj4a9k28h8e44%40group.calendar.google.com',
	's50c6h2uslcm2h3ccutuae08d0%40group.calendar.google.com',
	'sslr9bpauidb0vel55m2uthtvc%40group.calendar.google.com',
	'q45bsrrhnabig7c7510pijjsh8%40group.calendar.google.com',
	'8njh0aka6cts172o9qmgua2kgc%40group.calendar.google.com',
	'cavafir827lg1kn9ka7c0ps1ag%40group.calendar.google.com',
	'aflpjtoacvd3vptp4cfafqmlto%40group.calendar.google.com',

	't54clsrqlrjth96t8p11suosmk%40group.calendar.google.com',
	'ktcrr05s54vskipl6119338aog%40group.calendar.google.com',
	'288d0r2ao8cut92cnhobodehr0%40group.calendar.google.com',

	'60pc1i9pnugpvlk2br5jc24et0%40group.calendar.google.com'

);

/*
echo 'Cal1:'.$calendar1.'
<br />
Cal2:'.$calendar2;
*/

$calendar_html = '<iframe src="https://calendar.google.com/calendar/embed?';
$calendar_html .= 'showTitle=0&amp;';
$calendar_html .= 'showCalendars=0&amp;';
$calendar_html .= 'showPrint=0&amp;';
$calendar_html .= 'showTabs=0&amp;';
$calendar_html .= 'showTz=0&amp;';
$calendar_html .= 'mode='.$layout.'&amp;';
$calendar_html .= 'height='.$width.'&amp;';
$calendar_html .= 'wkst=2&amp;';
$calendar_html .= 'bgcolor=%23FFFFFF&amp;';
foreach( $calendars as $k => $v ){
    $var_name = 'calendar'.$k;
	if( isset( $$var_name ) && $$var_name == 1 ){
		$calendar_html .= 'src='.$v.'&amp;';
		$calendar_html .= 'color=%23'.$calendar_colors[ $k ].'&amp;';
	}
}
$calendar_html .= 'ctz=Europe%2FBerlin" ';
$calendar_html .= 'style="border-width:0;" ';
$calendar_html .= 'width="'.$width.'" ';
$calendar_html .= 'height="'.$height.'" ';
$calendar_html .= 'frameborder="0" ';
$calendar_html .= 'scrolling="no"';
$calendar_html .= '>';
$calendar_html .= '</iframe>';

        

?>


<div class="siteorigin-widget-tinymce textwidget">
	<div class="bvg_block bvg_calendar" id="<?php echo $id ?>">

		<h1><?php echo $title ?></h1>

		<h3><?php echo $subtitle ?></h3>

		<?php echo $calendar_html ?>

		<?php
		if( trim( $text ) !== '' ){
			echo '<br /><br />'.$text;
		}
		?>
	</div>
</div>
