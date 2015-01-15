</div><!-- / .container -->

<footer class="footer">
    <div class="container">
        <?php wp_nav_menu('theme_location=secondary&menu_class=footer-nav'); ?>
    </div>
</footer>

<script type="text/javascript">
    head.load(
        [
            {jquery: "<?php bloginfo('template_url'); ?>/js/lib/jquery.js"},
            {fancybox: "<?php bloginfo('template_url'); ?>/js/lib/jquery.fancybox/jquery.fancybox.pack.js"},
            {functs: "<?php bloginfo('template_url'); ?>/js/functions.min.js"}
        ],
        function () {
            // callback
            $(".open_ajax").fancybox({type: 'ajax'});
        }
    );
</script>
<style type="text/css">
    .Page .Projects-body .Projects-col {
        margin-bottom: 30px
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .Projects-col:nth-child(3n+1) {
            clear: left;
        }
    }

    @media (min-width: 992px) {
        .Projects-col:nth-child(4n+1) {
            clear: left;
        }
    }

    .Page-body-row > .head-title {
        margin-top: 0;
        margin-bottom: 20px;
    }

    .Page-body-row-images:empty {
        display: none
    }

    .Page-body-row-images {
        overflow: hidden;
        margin-bottom: 45px
    }

    .Page-body-row-images > figure {
        float: left;
        display: block;
        padding: 0 10px;
        text-align: center;
        line-height: 70px;
        height: 70px;
        margin-bottom: 15px;
    }

    @media (max-width: 767px) {
        .Page-body-row-images > figure {
            width: 50%;
        }

        .Page-body-row-images > figure:nth-child(2n+1) {
            clear: left;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
    //@screen-md-max .Page-body-row-images > figure {
        width: 33%;
    }

        .Page-body-row-images > figure:nth-child(3n+1) {
            clear: left;
        }
    }

    @media (min-width: 992px) {
        .Page-body-row-images > figure {
            width: 25%;
        }

        .Page-body-row-images > figure:nth-child(4n+1) {
            clear: left;
        }
    }

    .Page-body-row-images > figure img {
        display: inline-block;
        max-width: 100%;
        height: auto;
    }


</style>
</body>
</html>
