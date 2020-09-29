<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <base href="<?php echo base_url() . index_page(); if (index_page() !== '') { echo '/'; } if ($this->config->item('skylight_url_prefix') != "") { echo $this->config->item('skylight_url_prefix'); echo '/'; } ?>">

    <title><?php echo $page_title; ?></title>

    <link rel="pingback" href="<?php echo base_url() . index_page(); if (index_page() !== '') { echo '/'; } echo 'pingback'; ?>" />

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
    Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>St Cecilia's Hall - Collections</title>

    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>theme/<?php echo $this->config->item('skylight_theme'); ?>/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>theme/<?php echo $this->config->item('skylight_theme'); ?>/images/apple-touch-icon.png">

    <!-- CSS: implied media="all" -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/flowplayer-7.0.4/skin/skin.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/<?php echo $this->config->item('skylight_theme'); ?>/css/style.css?v=2">
    <link href="https://fonts.googleapis.com/css?family=Hind" rel="stylesheet">

    <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
    <script src="<?php echo base_url()?>assets/modernizr/modernizr-1.7.min.js"></script>
    <script src="<?php echo base_url()?>assets/jquery-1.11.0/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url()?>assets/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js"></script>
    <script src="<?php echo base_url()?>assets/jquery-1.11.0/jcarousel/jquery.jcarousel.min.js"></script>
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/masonry/masonry.pkgd.min.js"></script>
    <script src="<?php echo base_url()?>assets/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url()?>assets/isotope/isotope.pkgd.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>-->
    <!---<script src="https://cdn.rawgit.com/mejackreed/Leaflet-IIIF/master/leaflet-iiif.js"></script>-->
    <script src="<?php echo base_url()?>assets/openseadragon/openseadragon.min.js"></script>
    <!-- Enable media queries for old IE -->
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    [endif]-->
    <script>
		$(".toggle_container").hide();
    
    $("p.trigger").click(function(){
        $(this).toggleClass("active").next().slideToggle("normal");
    });
    </script>

    <?php if ($ga_code != '') {?>
        <script src="<?php echo base_url()?>assets/google-analytics/analytics.js"></script>

        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','<?php echo base_url()?>assets/google-analytics/analytics.js','ga');

            ga('create', '<?php echo $ga_code ?>', 'auto');
            ga('send', 'pageview');

        </script>
        <!-- End Google Analytics -->

        <script src="<?php echo base_url(); ?>assets/flowplayer-7.0.4/flowplayer.min.js"></script>

        <!-- global options -->
        <script>
            flowplayer.conf = {
                analytics: "<?php echo $ga_code ?>"
            };
        </script>
		

    <?php } ?>

    <?php if (isset($solr)) { ?><link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
        <link rel="schema.DCTERMS" href="http://purl.org/dc/terms/" />

        <?php

        foreach($metafields as $label => $element) {
            $field = "";
            if(isset($recorddisplay[$label])) {
                $field = $recorddisplay[$label];
                if(isset($solr[$field])) {
                    $values = $solr[$field];
                    foreach($values as $value) {
                        ?>  <meta name="<?php echo $element; ?>" content="<?php echo $value; ?>"> <?php
                    }
                }
            }
        }
    } ?>
</head>

<body class="record">
    <nav class="navbar navbar-default navbar-fixed-top">

        <div class="col-lg-8 col-md-8 col-sm-9 hidden-xs">
            <div class="nav-logo">
                    <!-- WILL NEED CHANGED WHEN SWITCH TO LIVE -->
                    <a class="nav-logo-link" href="https://test.stcecilias.ed.ac.uk">
                        <img class="nav-logo-img" src="<?php echo base_url()?>theme/stcecilia/images/StCsNavLogo.png">
                    </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!--<a href="./" class="home-icon"><i class="fa fa-home fa-lg"></i></a>-->
            <form class="navbar-form navbar-left" role="search" action="./redirect/" method="post">
                <div class="input-group search-box">
                    <input id="uoe-search" type="text" class="form-control" placeholder="Search the museum collections" name="q" value="<?php if (isset($searchbox_query)) echo urldecode($searchbox_query); ?>" id="q" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" name="submit_search" value="Search" id="submit_search">
                            <i class="glyphicon glyphicon-search"></i>&nbsp;Search
                        </button>
                    </span>
                </div>
            </form>
            <div class="navbar-right sch-link" id="full-visit">
                <!-- NEEDS TO BE ADJUSTED WHEN SWITCHING TO LIVE SERVER -->
                <a href="http://www.test.stcecilias.ed.ac.uk/visit/" title="Visit St Cecilia's Hall" target="_blank">Visit St Cecilia's Hall</a>
                <!-- NEEDS TO BE ADJUSTED WHEN SWITCHING TO LIVE SERVER -->
            </div>
            <div class="navbar-right sch-link" id="smol-visit">
                <!-- NEEDS TO BE ADJUSTED WHEN SWITCHING TO LIVE SERVER -->
                <a href="http://www.test.stcecilias.ed.ac.uk/visit/" title="Visit St Cecilia's Hall" target="_blank">Visit Us</a>
                <!-- NEEDS TO BE ADJUSTED WHEN SWITCHING TO LIVE SERVER -->
            </div>
        </div>
        <div class="hidden-lg hidden-md hidden-sm col-xs-7">
            <div class="nav-logo">
                    <!-- WILL NEED CHANGED WHEN SWITCH TO LIVE -->
                    <a class="nav-logo-link" href="https://test.stcecilias.ed.ac.uk">
                        <img class="nav-logo-img" src="<?php echo base_url()?>theme/stcecilia/images/StCsNavLogo.png">
                    </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- <a href="./" class="home-icon"><i class="fa fa-home fa-lg"></i></a> -->
            <form class="navbar-form navbar-left" role="search" action="./redirect/" method="post">
                <div class="input-group search-box">
                    <input id="uoe-search-sm" type="text" class="form-control" placeholder="Search" name="q" value="<?php if (isset($searchbox_query)) echo urldecode($searchbox_query); ?>" id="q" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" name="submit_search" value="Search" id="submit_search">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <div class="navbar-right sch-link" id="full-visit">
                <!-- NEEDS TO BE ADJUSTED WHEN SWITCHING TO LIVE SERVER -->
                <a href="http://www.test.stcecilias.ed.ac.uk/visit/" title="Visit St Cecilia's Hall" target="_blank">Visit St Cecilia's Hall</a>
                <a id="smol-visit" href="http://www.test.stcecilias.ed.ac.uk/visit/" title="Visit St Cecilia's Hall" target="_blank">Visit</a>
                <!-- NEEDS TO BE ADJUSTED WHEN SWITCHING TO LIVE SERVER -->
            </div>
            <div class="navbar-right sch-link" id="smol-visit">
                <!-- NEEDS TO BE ADJUSTED WHEN SWITCHING TO LIVE SERVER -->
                <a href="http://www.test.stcecilias.ed.ac.uk/visit/" title="Visit St Cecilia's Hall" target="_blank">Visit</a>
                <!-- NEEDS TO BE ADJUSTED WHEN SWITCHING TO LIVE SERVER -->
            </div>
        </div>
        
    </nav><!-- end of header container -->



