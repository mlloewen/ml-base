<?php /** * The template for displaying the footer. * * Contains the closing of the #content div and all content after. * * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials * * @package ml-base */ ?>

</div>
<!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ml-base' ) ); ?>">
            <?php printf( esc_html__( 'Proudly powered by %s', 'ml-base' ), 'WordPress' ); ?>
        </a>
        <span class="sep"> | </span>
        <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'ml-base' ), 'ml-base', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
    </div>
    <!-- .site-info -->
</footer>
<!-- #colophon -->
</div>
<!-- #page -->

<?php wp_footer(); ?>

<!--menu maker config-->
<!--<script type="text/javascript">
    $("#cssmenu").menumaker({
        title: "Menu",
        format: "multitoggle",
        breakpoint: 768
    });
</script>-->

</body>

</html>
