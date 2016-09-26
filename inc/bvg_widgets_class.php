<?php

require_once plugin_dir_path(__FILE__) . '../nuliga_constants.php';

/* Function Widget Init */
function bvg_widget_init(){
    
    register_widget( 'bvg_widget_clt' ); // Rang
    register_widget( 'bvg_widget_cal' ); // Google Calendar
    register_widget( 'bvg_widget_block' ); // Block
    register_widget( 'bvg_widget_nuliga_club_calendar' ); // NuLiga Calendar
    register_widget( 'bvg_widget_nuliga_team_table' ); // Team table
    register_widget( 'bvg_widget_nuliga_team_calendar' ); // Team Calendar
    return true;
}


/* WIDGET TO DISPLAY A HTML/TEXT BLOCK */
class bvg_widget_block extends WP_widget{
    
    /* Constructor */
    function __construct(){
        
        $widget_ops = array(
            'classname' => 'bvg-widget-block',
            'description' => __('BVG Block','bvg_widget_block')
            );
        $control = array(
            //'width' => 1080
            );
		parent::__construct('bvg_widget_block', __('BVG Widget Block','bvg_widget_block'), $widget_ops, $control);
        
    }
    
    /* Display Widget */
    function widget( $args, $instance ){
        extract( $args );
        
        $def = array();
        
        $instance = wp_parse_args( $instance , $def );
        
        echo $before_widget;
        
        echo $before_title;
        if( isset( $instance[ 'anchor' ] ) && trim( $instance[ 'anchor' ] ) !== '' ){
            echo '<a name="' . $instance[ 'anchor' ] . '"></a>';
        }
        echo '<h1>' . $instance[ 'title' ] . '</h1>';
        echo $after_title;
        
        if( isset( $instance[ 'subtitle' ] ) && trim( $instance[ 'subtitle' ] ) !== '' ){
            echo '<h3>' . $instance[ 'subtitle' ] . '</h3>';
        }
        
        $html = $instance[ 'content' ];
        echo $html;
                
        echo $after_widget;
    }
    
    
    /* Widget  admin configuration form */
    function form( $instance ){
        
        $def = array(
            'title' => 'Titel',
            'anchor' => '',
            'subtitle' => 'Untertitel',
            'content' => ''
        );
        $instance = wp_parse_args( $instance , $def );
        //var_dump( $instance );

        ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ) ?>">Titel:</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo $instance[ 'title' ]; ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'anchor' ) ?>">Anchor:</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'anchor' ) ?>" name="<?php echo $this->get_field_name( 'anchor' ) ?>" type="text" value="<?php echo $instance[ 'anchor' ]; ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'subtitle' ) ?>">Untertitel:</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ) ?>" name="<?php echo $this->get_field_name( 'subtitle' ) ?>" type="text" value="<?php echo $instance[ 'subtitle' ]; ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'content' ) ?>">Inhalt:</label>
    		<?php
                $settings = array( 
                    'media_buttons' => true,
                    'tinymce' => array(
                        'theme_advanced_buttons1' => 'bold,italic,underline',
                        'theme_advanced_buttons2' => '',
                        'theme_advanced_buttons3' => ''
                    ),
                    'textarea_name' => $this->get_field_name( 'description' ),
                    'quicktags' => false
                );
                bvg_editor( $instance['content'], $this->get_field_id( 'content' ), $settings );
            ?>
        </p>
        
        <?php
        
    }
    
    /* Update when admin configuration form is submited */
    function update( $new , $old ){
        
        return $new;
    }
    
}


/* WIDGET TO DISPLAY GOOGLE CALENDAR */
class bvg_widget_cal extends WP_widget{
    
    /* Constructor */
    function __construct(){
        $widget_ops = array(
            'classname' => 'bvg-widget-cal',
            'description' => __('BVG Kalender','bvg_widget_cal')
            );
        $control = array(
            //'width' => 1080
            );
		parent::__construct('bvg_widget_cal', __('BVG Widget Kalendar','bvg_widget_cal'), $widget_ops, $control);
    }
    
    /* Display Widget */
    function widget( $args, $instance ){
        extract( $args );
        
        $def = array(
            'title' => 'Unsere Termine',
            'width' => '240',
            'height' => '450',
            'calendar' => array( 1 => '9gkrvvl0735cgabbigfl83upfs%40group.calendar.google.com' ),
            'calendar_mode' => 'MONTH'
        );
        $calendar_colors = array( '8C500B' , '8C500B' , '853104' , 'B1440E' , '711616' , '691426' , '125A12' ,
                                  '8C500B' , 'AB8B00' , '182C57' , '875509' , 'B1440E' , '5F6B02' , '5229A3' ,
                                  '0F4B38' , 'AF8B40' , '5229A3' , '182C57' );
        $instance = wp_parse_args( $instance , $def );
        
        $calendar_html = '<div class="bvg_block">';
        $calendar_html .= '<iframe src="https://calendar.google.com/calendar/embed?';
        $calendar_html .= 'showTitle=0&amp;';
        $calendar_html .= 'showCalendars=0&amp;';
        $calendar_html .= 'showPrint=0&amp;';
        $calendar_html .= 'showTabs=0&amp;';
        $calendar_html .= 'showTz=0&amp;';
        $calendar_html .= 'mode='.$instance['calendar_mode'].'&amp;';
        $calendar_html .= 'height='.$instance['width'].'&amp;';
        $calendar_html .= 'wkst=2&amp;';
        $calendar_html .= 'bgcolor=%23FFFFFF&amp;';
        foreach( $instance['calendar'] as $k => $v ){
            $calendar_html .= 'src='.$v.'&amp;';
            $calendar_html .= 'color=%23'.$calendar_colors[ $k ].'&amp;';
        }
        $calendar_html .= 'ctz=Europe%2FBerlin" ';
        $calendar_html .= 'style="border-width:0;" ';
        $calendar_html .= 'width="'.$instance['width'].'" ';
        $calendar_html .= 'height="'.$instance['height'].'" ';
        $calendar_html .= 'frameborder="0" ';
        $calendar_html .= 'scrolling="no"';
        $calendar_html .= '>';
        $calendar_html .= '</iframe>';
        $calendar_html .= '</div>';
        
        //echo '<h3>'.$instance[ 'title' ].'</h3>';
        echo $before_widget;
        
        echo $before_title;
        echo $instance[ 'title' ];
        echo $after_title;
        
        echo $calendar_html;
        
        echo $after_widget;
    }

    
    /* Widget  admin configuration form */
    function form( $instance ){
        
        $def = array(
            'title' => 'Unsere Termine',
            'width' => '250',
            'height' => '450',
            'calendar' => array(),
            'calendar_mode' => 'MONTH'
        );
        $instance = wp_parse_args( $instance , $def );
        //var_dump( $instance );

        
        ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ) ?>">Titel:</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo $instance[ 'title' ]; ?>">
        </p>
        
        <p>
            <label>Kalendar:</label>
    		<h5>Mannschaften</h5>
            <input class="checkbox_margin" id="<?php echo $this->get_field_id( 'calendar' ) ?>" name="<?php echo $this->get_field_name( 'calendar' ) ?>[1]" type="checkbox" value="9gkrvvl0735cgabbigfl83upfs%40group.calendar.google.com" <?php if( in_array( '9gkrvvl0735cgabbigfl83upfs%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />1.Mannschaft
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[2]" type="checkbox" value="vuiv5dv73i7cikk8mksodn5aqk%40group.calendar.google.com" <?php if( in_array( 'vuiv5dv73i7cikk8mksodn5aqk%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />2.Mannschaft
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[3]" type="checkbox" value="2ue58cou3alig7s671imdbup4o%40group.calendar.google.com" <?php if( in_array( '2ue58cou3alig7s671imdbup4o%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />3.Mannschaft
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[4]" type="checkbox" value="mvd9opsvhko7rr9df4om3u9p98%40group.calendar.google.com" <?php if( in_array( 'mvd9opsvhko7rr9df4om3u9p98%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />4.Mannschaft
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[5]" type="checkbox" value="dh9tkhfn6e4u13a1pp3and1s3o%40group.calendar.google.com" <?php if( in_array( 'dh9tkhfn6e4u13a1pp3and1s3o%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />5.Mannschaft
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[6]" type="checkbox" value="sb00tamhpeemujjq0tnnbgsruo%40group.calendar.google.com" <?php if( in_array( 'sb00tamhpeemujjq0tnnbgsruo%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Jugend 1
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[7]" type="checkbox" value="4kver4d7v1kflqj4a9k28h8e44%40group.calendar.google.com" <?php if( in_array( '4kver4d7v1kflqj4a9k28h8e44%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Jugend 2
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[8]" type="checkbox" value="s50c6h2uslcm2h3ccutuae08d0%40group.calendar.google.com" <?php if( in_array( 's50c6h2uslcm2h3ccutuae08d0%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />schüler 1
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[9]" type="checkbox" value="sslr9bpauidb0vel55m2uthtvc%40group.calendar.google.com" <?php if( in_array( 'sslr9bpauidb0vel55m2uthtvc%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Schüler 2
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[10]" type="checkbox" value="q45bsrrhnabig7c7510pijjsh8%40group.calendar.google.com" <?php if( in_array( 'q45bsrrhnabig7c7510pijjsh8%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Mini 1 U13
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[11]" type="checkbox" value="8njh0aka6cts172o9qmgua2kgc%40group.calendar.google.com" <?php if( in_array( '8njh0aka6cts172o9qmgua2kgc%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Mini 2 U13
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[12]" type="checkbox" value="cavafir827lg1kn9ka7c0ps1ag%40group.calendar.google.com" <?php if( in_array( 'cavafir827lg1kn9ka7c0ps1ag%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Mini 3 U11
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[13]" type="checkbox" value="aflpjtoacvd3vptp4cfafqmlto%40group.calendar.google.com" <?php if( in_array( 'aflpjtoacvd3vptp4cfafqmlto%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Mini 4 U11
            <h5>Training</h5>
            <input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[14]" type="checkbox" value="t54clsrqlrjth96t8p11suosmk%40group.calendar.google.com" <?php if( in_array( 't54clsrqlrjth96t8p11suosmk%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Goldbach Halle
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[15]" type="checkbox" value="ktcrr05s54vskipl6119338aog%40group.calendar.google.com" <?php if( in_array( 'ktcrr05s54vskipl6119338aog%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Laufach Halle
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[16]" type="checkbox" value="288d0r2ao8cut92cnhobodehr0%40group.calendar.google.com" <?php if( in_array( '288d0r2ao8cut92cnhobodehr0%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Schulsport
            <h5>Andere Kalendar</h5>
            <input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar' ) ?>[17]" type="checkbox" value="60pc1i9pnugpvlk2br5jc24et0%40group.calendar.google.com" <?php if( in_array( '60pc1i9pnugpvlk2br5jc24et0%40group.calendar.google.com' , $instance['calendar'] ) ){ echo 'checked="checked"';} ?> />Turniere
        </p>
        
        <p>
            <label>Layout:</label>
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar_mode' ) ?>" type="radio" value="WEEK" <?php if( $instance['calendar_mode'] === 'WEEK' ){ echo 'checked="checked"';} ?> />Woche
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar_mode' ) ?>" type="radio" value="MONTH" <?php if( $instance['calendar_mode'] === 'MONTH' ){ echo 'checked="checked"';} ?> />Monat
            <br /><input class="checkbox_margin" name="<?php echo $this->get_field_name( 'calendar_mode' ) ?>" type="radio" value="AGENDA" <?php if( $instance['calendar_mode'] === 'AGENDA' ){ echo 'checked="checked"';} ?> />Agenda
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'width' ) ?>">Breite:</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'width' ) ?>" name="<?php echo $this->get_field_name( 'width' ) ?>" type="text" value="<?php echo $instance[ 'width' ]; ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'height' ) ?>">Höhe:</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'height' ) ?>" name="<?php echo $this->get_field_name( 'height' ) ?>" type="text" value="<?php echo $instance[ 'height' ]; ?>">
        </p>
        
        <?php
    }
    
    /* Update when admin configuration form is submited */
    function update( $new , $old ){
        
        return $new;
    }
    
    
}


/* WIDGET TO DISPLAY NULIGA CALENDAR */
class bvg_widget_nuliga_club_calendar extends WP_widget{
    
    /* Constructor */
    function __construct(){
        $widget_ops = array(
            'classname' => 'bvg-widget-nuliga-club-calendar',
            'description' => __('NuLiga Calendar','bvg_widget_nuliga_club_calendar')
            );
        $control = array(
            //'width' => 1080
            );
		parent::__construct('bvg_widget_nuliga_club_calendar', __('BVG Widget NuLiga Calendar','bvg_widget_nuliga_club_calendar'), $widget_ops, $control);
    }
    
    /* Display Widget */
    function widget( $args, $instance ){
        extract( $args );


        $def = array(
            'title' => 'Spielbetrieb Vorschau',
            'url' => 'http://hbv-badminton.liga.nu/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/clubInfoDisplay?club=15434'
        );
        $instance = wp_parse_args( $instance , $def );
        
        // Get nuLiga Infos
        $nuliga_info_cached = get_transient( 'nuliga_info_cached' );

        $last_update_txt = '';
        if( false === $nuliga_info_cached ) {

            $url = $NULIGA_TEAMS_TABLE_URL[ $instance['team'] ];

            $last_update_txt = 'Aktualisiert am ' . date( 'd m Y' );
            if( defined( 'WP_PROXY_HOST' ) ){
                $aContext = array(
                    'http' => array(
                        'proxy' => 'tcp://'.WP_PROXY_HOST.':'.WP_PROXY_PORT,
                        'request_fulluri' => true,
                    ),
                );
                $cxContext = stream_context_create($aContext);
                
                $html_brut = file_get_contents( $instance['url'], false, $cxContext );
            }else{
                $html_brut = file_get_contents( $instance['url'] );
            }
            
            $html_start = '<h2>Spielbetrieb Vorschau</h2>';
            $html_end = '</table>';
            
            $html_parts = explode( $html_start , $html_brut );
            $html_brut = $html_parts[1];
            $html_parts = explode( $html_end , $html_brut );
            $html = $html_parts[0].$html_end;
            $html = str_replace( 'href="', 'target="_blank" href="http://hbv-badminton.liga.nu/', $html );
            
            $heads_toRemove = array( 5 );
            $cols_toRemove = array( 8 );

            $html = remove_columns( $html, $heads_toRemove, $cols_toRemove );
            
            $html .= $last_update_txt;
            
            set_transient( 'nuliga_info_cached', $html, 60*60*24 );
        }else{
            $html = $nuliga_info_cached;
            $html .= '<span style="display:none;"> from CACHE...</span>';
            //delete_transient( 'nuliga_info_cached' );
            
            /*
            var_dump( $instance );
            if( $instance['yop'] ){
                echo 'YOP';
            }
            */
        }
        
        
        
        //echo '<h3>'.$instance[ 'title' ].'</h3>';
        echo $before_widget;
        
        echo $before_title;
        echo $instance[ 'title' ];
        echo $after_title;
        
        echo $html;
        
        echo $after_widget;
    }
    
    /* Widget  admin configuration form */
    function form( $instance ){
        $def = array(
            'title' => 'Spielbetrieb Vorschau',
            'url' => 'http://hbv-badminton.liga.nu/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/clubInfoDisplay?club=15434'
        );
        $instance = wp_parse_args( $instance , $def );
        
        ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ) ?>">Titel:</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo $instance[ 'title' ]; ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'url' ) ?>">URL:</label>
    		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ) ?>" name="<?php echo $this->get_field_name( 'url' ) ?>" type="text" value="<?php echo $instance[ 'url' ]; ?>">
        </p>
        
        <?php
    }
    
    /* Update when admin configuration form is submited */
    function update( $new , $old ){
        
        return $new;
    }
}


/* WIDGET TO DISPLAY NULIGA TEAM TABLE */
class bvg_widget_nuliga_team_table extends WP_widget{

    /* Constructor */
    function __construct(){
        $widget_ops = array(
            'classname' => 'bvg-widget-nuliga-team-table',
            'description' => __('NuLiga Team Table','bvg_widget_nuliga_team_table')
        );
        $control = array(
            //'width' => 1080
        );
        parent::__construct('bvg_widget_nuliga_team_table', __('BVG Widget NuLiga table for a specific team','bvg_widget_nuliga_team_table'), $widget_ops, $control);
    }

    /* Display Widget */
    function widget( $args, $instance ){
        extract( $args );


        $def = array(
            'title' => 'Tabelle und Spielplan',
            'team' => 'A5'/*,
            'url' => 'http://hbv-badminton.liga.nu/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22203'*/
        );
        $instance = wp_parse_args( $instance , $def );

        // Get nuLiga Infos
        $nuliga_info_cached = get_transient( 'nuliga_info_cached' );

        $last_update_txt = '';
        if( false === $nuliga_info_cached ) {

            $url = $NULIGA_TEAMS_TABLE_URL[ $instance['team'] ];

            $last_update_txt = 'Aktualisiert am ' . date( 'd m Y' );
            if( defined( 'WP_PROXY_HOST' ) ){
                $aContext = array(
                    'http' => array(
                        'proxy' => 'tcp://'.WP_PROXY_HOST.':'.WP_PROXY_PORT,
                        'request_fulluri' => true,
                    ),
                );
                $cxContext = stream_context_create($aContext);

                $html_brut = file_get_contents( $url, false, $cxContext );
            }else{
                $html_brut = file_get_contents( $url );
            }

            $html_start = '<h2>Tabelle</h2>';
            $html_end = '</table>';

            $html_parts = explode( $html_start , $html_brut );
            $html_brut = $html_parts[1];
            $html_parts = explode( $html_end , $html_brut );
            $html = $html_parts[0].$html_end;
            $html = str_replace( 'href="', 'target="_blank" href="'.NULIGA_DOMAIN.'/', $html );

            $heads_toRemove = array( );
            $cols_toRemove = array( );

            $html = remove_columns( $html, $heads_toRemove, $cols_toRemove );

            $html .= $last_update_txt;

            set_transient( 'nuliga_info_cached', $html, 60*60*24 );
        }else{
            $html = $nuliga_info_cached;
            $html .= '<span style="display:none;"> from CACHE...</span>';
            //delete_transient( 'nuliga_info_cached' );

            /*
            var_dump( $instance );
            if( $instance['yop'] ){
                echo 'YOP';
            }
            */
        }



        //echo '<h3>'.$instance[ 'title' ].'</h3>';
        echo $before_widget;

        echo $before_title;
        echo $instance[ 'title' ];
        echo $after_title;

        echo $html;

        echo $after_widget;
    }

    /* Widget  admin configuration form */
    function form( $instance ){
        $def = array(
            'title' => 'Tabelle',
            'team' => 'A5'/*,
            'url' => 'http://hbv-badminton.liga.nu/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22203'
*/
        );
        $instance = wp_parse_args( $instance , $def );

        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ) ?>">Titel:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo $instance[ 'title' ]; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'team' ) ?>">Team:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'team' ) ?>" name="<?php echo $this->get_field_name( 'team' ) ?>" type="text" value="<?php echo $instance[ 'team' ]; ?>">
            <select class="widefat" id="<?php echo $this->get_field_id( 'team' ) ?>" name="<?php echo $this->get_field_name( 'team' ) ?>" >
                <option value="A1" <?php if( $instance[ 'team' ] === 'A1' ){ echo ' selected="selected"'; } ?>>1. Mannschaft</option>
                <option value="A2" <?php if( $instance[ 'team' ] === 'A2' ){ echo ' selected="selected"'; } ?>>2. Mannschaft</option>
                <option value="A3" <?php if( $instance[ 'team' ] === 'A3' ){ echo ' selected="selected"'; } ?>>3. Mannschaft</option>
                <option value="A4" <?php if( $instance[ 'team' ] === 'A4' ){ echo ' selected="selected"'; } ?>>4. Mannschaft</option>
                <option value="A5" <?php if( $instance[ 'team' ] === 'A5' ){ echo ' selected="selected"'; } ?>>5. Mannschaft</option>
                <option value="J1" <?php if( $instance[ 'team' ] === 'J1' ){ echo ' selected="selected"'; } ?>>Jugend 1</option>
                <option value="S1" <?php if( $instance[ 'team' ] === 'S1' ){ echo ' selected="selected"'; } ?>>Schüler 1</option>
                <option value="S2" <?php if( $instance[ 'team' ] === 'S2' ){ echo ' selected="selected"'; } ?>>Schüler 2</option>
                <option value="U13_1" <?php if( $instance[ 'team' ] === 'U13_1' ){ echo ' selected="selected"'; } ?>>U13</option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'url' ) ?>">URL:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'url' ) ?>" name="<?php echo $this->get_field_name( 'url' ) ?>" type="text" value="<?php echo $instance[ 'url' ]; ?>">
        </p>

        <?php
    }

    /* Update when admin configuration form is submited */
    function update( $new , $old ){

        return $new;
    }
}


/* WIDGET TO DISPLAY NULIGA TEAM CALENDAR */
class bvg_widget_nuliga_team_calendar extends WP_widget{

    /* Constructor */
    function __construct(){
        $widget_ops = array(
            'classname' => 'bvg-widget-nuliga-team-calendar',
            'description' => __('NuLiga Team Calendar','bvg_widget_nuliga_team_calendar')
        );
        $control = array(
            //'width' => 1080
        );
        parent::__construct('bvg_widget_nuliga_team_calendar', __('BVG Widget NuLiga Team Calendar','bvg_widget_nuliga_team_calendar'), $widget_ops, $control);
    }

    /* Display Widget */
    function widget( $args, $instance ){
        extract( $args );


        $def = array(
            'title' => 'Spielbetrieb Vorschau',
            'url' => 'http://hbv-badminton.liga.nu/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/clubInfoDisplay?club=15434'
        );
        $instance = wp_parse_args( $instance , $def );

        // Get nuLiga Infos
        $nuliga_info_cached = get_transient( 'nuliga_info_cached' );

        $last_update_txt = '';
        if( false === $nuliga_info_cached ) {
            $last_update_txt = 'Aktualisiert am ' . date( 'd m Y' );
            if( defined( 'WP_PROXY_HOST' ) ){
                $aContext = array(
                    'http' => array(
                        'proxy' => 'tcp://'.WP_PROXY_HOST.':'.WP_PROXY_PORT,
                        'request_fulluri' => true,
                    ),
                );
                $cxContext = stream_context_create($aContext);

                $html_brut = file_get_contents( $instance['url'], false, $cxContext );
            }else{
                $html_brut = file_get_contents( $instance['url'] );
            }

            $html_start = '<h2>Spielbetrieb Vorschau</h2>';
            $html_end = '</table>';

            $html_parts = explode( $html_start , $html_brut );
            $html_brut = $html_parts[1];
            $html_parts = explode( $html_end , $html_brut );
            $html = $html_parts[0].$html_end;
            $html = str_replace( 'href="', 'target="_blank" href="http://hbv-badminton.liga.nu/', $html );

            $heads_toRemove = array( 5 );
            $cols_toRemove = array( 8 );
            var_dump( $instance );
            if( $instance['yop'] ){
                echo 'YOP';
            }
            $html = remove_columns( $html, $heads_toRemove, $cols_toRemove );

            $html .= $last_update_txt;

            set_transient( 'nuliga_info_cached', $html, 60*60*24 );
        }else{
            $html = $nuliga_info_cached;
            $html .= '<span style="display:none;"> from CACHE...</span>';
            //delete_transient( 'nuliga_info_cached' );

            /*
            var_dump( $instance );
            if( $instance['yop'] ){
                echo 'YOP';
            }
            */
        }



        //echo '<h3>'.$instance[ 'title' ].'</h3>';
        echo $before_widget;

        echo $before_title;
        echo $instance[ 'title' ];
        echo $after_title;

        echo $html;

        echo $after_widget;
    }

    /* Widget  admin configuration form */
    function form( $instance ){
        $def = array(
            'title' => 'Spielbetrieb Vorschau',
            'url' => 'http://hbv-badminton.liga.nu/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/clubInfoDisplay?club=15434'
        );
        $instance = wp_parse_args( $instance , $def );

        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ) ?>">Titel:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo $instance[ 'title' ]; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ) ?>">URL:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'url' ) ?>" name="<?php echo $this->get_field_name( 'url' ) ?>" type="text" value="<?php echo $instance[ 'url' ]; ?>">
        </p>

        <?php
    }

    /* Update when admin configuration form is submited */
    function update( $new , $old ){

        return $new;
    }
}


/* WIDGET TO DISPLAY ALL TEAMS CLASSEMENT */
class bvg_widget_clt extends WP_widget{

    /* Constructor */
    function __construct(){
        $widget_ops = array(
            'classname' => 'bvg-widget-clt',
            'description' => __('Mannschaften Tabelle Position','bvg_widget_clt')
        );
        $control = array(
            //'width' => 1080
        );
        parent::__construct('bvg_widget_clt', __('BVG Widget Mannschaften Tabelle','bvg_widget_clt'), $widget_ops, $control);
    }

    /* Display Widget */
    function widget( $args, $instance ){
        extract( $args );

        $def = array(
            'title' => 'Unsere Mannschaften in Hessen Ligen',
            'saison' => '2016/2017'
        );
        $instance = wp_parse_args( $instance , $def );

        //echo '<h3>'.$instance[ 'title' ].'</h3>';
        echo $before_widget;

        echo $before_title;
        echo $instance[ 'title' ] . ' ' . $instance[ 'saison' ];
        echo $after_title;



        /* Get teams posts for this saison */


        $args = array(
            's' => $instance[ 'saison' ],
            'post_type' => 'page'
        );
        $query = new WP_Query( $args );

        /*
        echo '<pre>';
        print_r( $query );
        */

        if ( $query->have_posts() ){
            echo '<table class="mannschaft_platz">';
            echo '<thead>';
            echo '<tr>';
            echo '<td class="team_name">';
            echo 'Mannschaft';
            echo '</td>';
            echo '<td class="clt">';
            echo 'Aktueller Platz';
            echo '</td>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ( $query->have_posts() ){
                $query->the_post();

                $content = get_the_content();

                $team = get_the_title();
                $team = str_replace( ' '.$instance[ 'saison' ] , '' , $team );

                $regex = '/standingsrank\"\>(\d)\<\/td\>\<td\>\<a.*BV G\.\-Goldbach/';



                if( preg_match( $regex , $content, $matches) ){
                    echo '<tr>';
                    echo '<td class="team_name">';
                    echo '<a href="';
                    the_permalink();
                    echo '">';
                    echo $team;
                    echo '</a>';
                    echo '</td>';
                    echo '<td class="clt">';
                    echo $matches[1];
                    echo '</td>';
                    echo '</tr>';

                }

            }
            echo '</tbody>';
            echo '</table>';

            wp_reset_postdata();

        }else{
            echo 'Noch kein Ergebnis für diese Saison...';
        }


        echo $after_widget;
    }

    /* Widget  admin configuration form */
    function form( $instance ){
        $def = array(
            'title' => 'Unsere Mannschaften in Hessen Ligen',
            'saison' => '2016/2017'
        );
        $instance = wp_parse_args( $instance , $def );

        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ) ?>">Titel:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo $instance[ 'title' ]; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'saison' ) ?>">Saison:</label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'saison' ) ?>" name="<?php echo $this->get_field_name( 'saison' ) ?>" >
                <option value="2016/2017" <?php if( $instance[ 'saison' ] === '2016/2017' ){ echo ' selected="selected"'; } ?>>2016/2017</option>
                <option value="2017/2018" <?php if( $instance[ 'saison' ] === '2017/2018' ){ echo ' selected="selected"'; } ?>>2017/2018</option>
                <option value="2018/2019" <?php if( $instance[ 'saison' ] === '2018/2019' ){ echo ' selected="selected"'; } ?>>2018/2019</option>
                <option value="2019/2020" <?php if( $instance[ 'saison' ] === '2019/2020' ){ echo ' selected="selected"'; } ?>>2019/2020</option>
                <option value="2020/2021" <?php if( $instance[ 'saison' ] === '2020/2021' ){ echo ' selected="selected"'; } ?>>2020/2021</option>
                <option value="2021/2022" <?php if( $instance[ 'saison' ] === '2021/2022' ){ echo ' selected="selected"'; } ?>>2021/2022</option>
            </select>
        </p>

        <?php
    }

    /* Update when admin configuration form is submited */
    function update( $new , $old ){

        return $new;
    }
}



/* Required functions */
if( !function_exists( 'bvg_editor' ) ){
    function bvg_editor($str = '', $id)
    {
        wp_editor($str, $id);
    }
}

if( !function_exists( 'remove_columns' ) ){
    function remove_columns( $html='', $heads_toRemove = array(), $cols_toRemove = array() ){

    $html_return = '';

    //$html = str_replace( '&', '&amp;', $html );
    // $html = str_replace( 'th>', 'td>', $html);
    // $html = str_replace( '<th', '<td', $html);
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");

    // a new dom object
    $dom = new domDocument;

    // load the html into the object
    $dom->loadHTML( $html );

    // discard white space
    $dom->preserveWhiteSpace = false;

    // Get all rows
    $trList = $dom->getElementsByTagName('tr');

    $tr_head = 1;
    foreach ($trList as $tr) {
        
        // Header
        if( $tr_head === 1 && !empty( $heads_toRemove ) ){
            $tdList = $tr->getElementsByTagName('th');
            foreach( $heads_toRemove as $column_nb ){
                $tr->removeChild( $tdList->item( $column_nb ) );
            }
            $tr_head++;
        }else if( $tr_head > 1 && !empty( $cols_toRemove ) ){
            $tdList = $tr->getElementsByTagName('td');
            // Content rows
            foreach( $cols_toRemove as $column_nb ){
                /*
                echo $column_nb.': ';
                $xml = $tr->ownerDocument->saveXML($tr);
                echo $xml;
                echo '<br />';
                */
                $tr->removeChild( $tdList->item( $column_nb ) );
            }

        }

    }

    $html = $dom->saveHTML();

    $html_return = $html;

    $html_return = str_replace( '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">' , '' , $html_return );
    $html_return = str_replace( '<html><body>' , '' , $html_return );
    $html_return = str_replace( '</body></html>' , '' , $html_return );

    return $html_return;

    }
}
?>