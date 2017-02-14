<?php
//if( !empty( $instance['title'] ) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
?>


<div class="siteorigin-widget-tinymce textwidget">
    <div class="bvg_block" id="<?php echo $id ?>" >

        <h1><?php echo $title; ?></h1>

        <?php echo $bvg_allteams_calendar; ?>

    </div>
</div>

<script>
    jQuery( '#spielplan_prec' ).on( 'click' , function(){
        if( jQuery( this ).next().css( 'display') ===  'none' ){
            jQuery( '#spielplan_next' ).fadeOut( function(){
                jQuery( '#spielplan_prec' ).next().slideDown( function(){
                    jQuery( '#spielplan_next2' ).fadeIn( function(){
                        jQuery( '#spielplan_prec' ).html( 'Spielbetrieb Rückschau ausblenden...' );
                    });
                });
            });
        }else{
            jQuery( this ).next().fadeOut();
            jQuery( '#spielplan_next' ).fadeIn();
            jQuery( '#spielplan_next2' ).fadeOut();
            jQuery( '#spielplan_prec' ).html( 'Spielbetrieb Rückschau anzeigen...' );
        }

    });
</script>
