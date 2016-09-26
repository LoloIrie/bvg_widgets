<?php
//if( !empty( $instance['title'] ) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
?>


<div class="siteorigin-widget-tinymce textwidget">
    <div class="bvg_block" id="<?php echo $id ?>" >

        <h1><?php echo $title; ?></h1>

        <?php echo $bvg_allteams_calendar; ?>

        <div class="nuliga_link">Informationen von <a href="https://hbv-badminton.liga.nu" target="_blank">Liga.nu</a></div>
    </div>
</div>

<script>
    jQuery( '#spielplan_prec' ).on( 'click' , function(){
        if( jQuery( this ).next().css( 'display') ===  'none' ){
            jQuery( this ).next().slideDown();
            jQuery( '#spielplan_prec' ).html( 'Spielbetrieb Rückschau ausblenden...' );
        }else{
            jQuery( this ).next().fadeOut();
            jQuery( '#spielplan_prec' ).html( 'Spielbetrieb Rückschau anzeigen...' );
        }

    });
</script>
