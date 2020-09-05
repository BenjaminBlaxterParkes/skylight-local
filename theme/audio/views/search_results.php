
    <?php

        // Set up some variables to easily refer to particular fields you've configured
        // in $config['skylight_searchresult_display']

        $title_field = $this->skylight_utilities->getField('Title');
        $author_field = $this->skylight_utilities->getField('Author');
        $date_field = $this->skylight_utilities->getField('Date Made');
        $bitstream_field = $this->skylight_utilities->getField('Bitstream');
        $thumbnail_field = $this->skylight_utilities->getField('Thumbnail');

        // booleans for video/audio
        $videotab = false;
        $audiotab = false;

        $base_parameters = preg_replace("/[?&]sort_by=[_a-zA-Z+%20. ]+/","",$base_parameters);
        if($base_parameters == "") {
            $sort = '?sort_by=';
        }
        else {
            $sort = '&sort_by=';
        }
    ?>

        <!--//todo add sort-->
    <div class="row">
    <div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
    <div class="col-main">
        <div class="row">
            <div class="col-md-9">
                <h5 class="text-muted">Showing <?php echo $rows ?> results </h5>
            </div>
        </div>
            <?php
                foreach ($docs as $index => $doc) {
                    $bitstream_array = array();
                    $thumbnailLink = "";

                    if(isset($doc[$bitstream_field])) {

                            $i = 0;
                            $started = false;

                            // loop through to get min sequence
                            foreach ($doc[$bitstream_field] as $bitstream)
                            {
                                $b_segments = explode("##", $bitstream);
                                $b_filename = $b_segments[1];
                                $b_seq = $b_segments[4];

                                if((strpos($b_filename, ".jpg") > 0) || (strpos($b_filename, ".JPG") > 0)) {

                                    $bitstream_array[$b_seq] = $bitstream;

                                    if ($started) {
                                        if ($b_seq < $min_seq) {
                                            $min_seq = $b_seq;
                                        }
                                    }
                                    else {
                                        $min_seq = $b_seq;
                                        $started = true;
                                    }
                                }
                                else if (((strpos($b_filename, ".mp4") > 0) or (strpos($b_filename, ".MP4") > 0) or (strpos($b_filename, ".webm") > 0) or (strpos($b_filename, ".WEBM") > 0))) {
                                    $videotab = true;
                                }
                                else if ((strpos($b_filename, ".mp3") > 0) or (strpos($b_filename, ".MP3") > 0)) {
                                    $audiotab = true;
                                }
                                $i++;
                            }

                            // if there is a thumbnail and a bitstream
                            if(isset($min_seq) && count($bitstream_array) > 0) {

                                // get all the information
                                $b_segments = explode("##", $bitstream_array[$min_seq]);
                                $b_filename = $b_segments[1];
                                $b_handle = $b_segments[3];
                                $b_seq = $b_segments[4];
                                $b_handle_id = preg_replace('/^.*\//', '',$b_handle);
                                $b_uri = './record/'.$b_handle_id.'/'.$b_seq.'/'.$b_filename;
                                $thumbnailLink = "";

                                if(isset($doc[$thumbnail_field])) {
                                    foreach ($doc[$thumbnail_field] as $thumbnail) {

                                        $t_segments = explode("##", $thumbnail);
                                        $t_filename = $t_segments[1];

                                        if ($t_filename === $b_filename . ".jpg") {

                                            $t_handle = $t_segments[3];
                                            $t_seq = $t_segments[4];
                                            $t_uri = './record/'.$b_handle_id.'/'.$t_seq.'/'.$t_filename;

                                            $thumbnailLink = '<a href="./record/'. $doc['id'].'" title = "' . $doc[$title_field][0] . '"> ';
                                            $thumbnailLink .= '<img class="img-responsive" src = "'.$t_uri.'" title="'. $doc[$title_field][0] .'" /></a>';
                                        }
                                    }
                                }
                                // there isn't a thumbnail so display the bitstream itself
                                else {

                                    $thumbnailLink = '<a href="./record/'. $doc['id'].'" title = "' . $doc[$title_field][0] . '"> ';
                                    $thumbnailLink .= '<img class="img-responsive" src = "'.$b_uri.'" title="'. $doc[$title_field][0] .'" /></a>';
                                }
                            }
                        }
                        else
                        {
                            $thumbnailLink = '<a href="./record/'. $doc['id'].'" title = "' . $doc[$title_field][0] . '"> ';
                            $thumbnailLink .= '<img class="img-responsive" src ="../theme/iconics/images/comingsoon.gif" title="'. $doc[$title_field][0] .'" /></a>';

                        }?>

                            <div>
                            <div class="col-xs-12 result-info">
                            <h4 class="record-title">
                                <a href="./record/<?php echo $doc['id']?>?highlight=<?php echo $query ?>"><?php echo $doc[$title_field][0]; ?></a>

                            <small>
                                <?php if(isset($doc[$date_field][0])) { echo $doc[$date_field][0];} else { echo 'Unknown';}?>
                            </small>
                            </h4>
                                    <?php if(array_key_exists($author_field,$doc)) { ?>
                                <ul class="hidden-xs nav nav-pills tags">
                                        <?php
                                        foreach ($doc[$author_field] as $author) {
                                            $orig_filter = urlencode($author);
                                            $lower_orig_filter = strtolower($author);
                                            $lower_orig_filter = urlencode($lower_orig_filter);

                                            echo '<li class="active"><a href="./search/*:*/Maker:%22'.$lower_orig_filter.'+%7C%7C%7C+'.$orig_filter.'%22">'.$author.'</a></li>';
                                        }
                                        ?>
                                </ul>
                                    <?php } ?>

                            <ul class="nav nav-pills">
                                <li><a href="./record/<?php echo $doc['id']?>/#description" title="Description Link"><i class="fa fa-file-text fa-lg">&nbsp;</i></a></li>
                                <li><a href="./record/<?php echo $doc['id']?>/#maker" title="Format Link"><i class="fa fa-industry fa-lg">&nbsp;</i></a></li>

                                <?php if($audiotab) { ?>
                                    <li><a href="./record/<?php echo $doc['id']?>/#audio" title="Audio link "><i class="fa fa-music fa-lg">&nbsp;</i></a></li>
                                <?php } else { ?>
                                    <li><i class="fa fa-music fa-lg fa-inactive">&nbsp;</i></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <hr>
                <?php
            } // end for each search result
            ?>
        <div class="row">
            <div class="centered text-center">
                <nav>
                    <ul class="pagination pagination-sm pagination-xs">
                        <?php
                        foreach ($paginationlinks as $pagelink)
                        {
                            echo $pagelink;
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>

