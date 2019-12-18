
<?php

// Set up some variables to easily refer to particular fields you've configured
// in $config['skylight_searchresult_display']

$title_field = $this->skylight_utilities->getField('Title');
$author_field = $this->skylight_utilities->getField('Creator');
$date_field = $this->skylight_utilities->getField('Date');
$type_field = $this->skylight_utilities->getField('Type');
$abstract_field = $this->skylight_utilities->getField('Agents');
$subject_field = $this->skylight_utilities->getField('Subject');
$image_uri_field = $this->skylight_utilities->getField("ImageUri");

$base_parameters = preg_replace("/[?&]sort_by=[_a-zA-Z+%20. ]+/","",$base_parameters);
if($base_parameters == "") {
    $sort = '?sort_by=';
}
else {
    $sort = '&sort_by=';
}
?>

<div class="col-md-9 col-sm-9 col-xs-12">
    <div id="collection-search">
        <form action="./redirect/" method="post" class="navbar-form">
           <div class="input-group search-box">
                <input type="text" class="form-control" placeholder="Search" name="q" value="<?php if (isset($searchbox_query)) echo urldecode($searchbox_query); ?>" id="q" />
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" name="submit_search" value="Search" id="submit_search"><i class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </form>
    </div>
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
    <div class="row search-row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 results-num">
            <h5 class="text-muted">Showing <?php echo $rows ?> results </h5>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 results-num sort">
            <h5 class="text-muted">Sort By:
                <?php foreach($sort_options as $label => $field) {
                    if($label == 'Relevancy')
                    {
                        ?>
                        <em><a href="<?php echo $base_search.$base_parameters.$sort.$field.'+desc'?>"><?php echo $label ?></a></em>
                        <?php
                    }
                    else {
                        ?>

                        <em><?php echo $label ?></em>
                        <?php if($label != "Date") { ?>
                            <a href="<?php echo $base_search.$base_parameters.$sort.$field.'+asc' ?>">A-Z</a> |
                            <a href="<?php echo $base_search.$base_parameters.$sort.$field.'+desc' ?>">Z-A</a>
                        <?php } else { ?>
                            <a href="<?php echo $base_search.$base_parameters.$sort.$field.'+desc' ?>">newest</a> |
                            <a href="<?php echo $base_search.$base_parameters.$sort.$field.'+asc' ?>">oldest</a>
                        <?php } } } ?>
            </h5>
        </div>

    </div>
    <?php
    foreach ($docs as $index => $doc) {
        ?>
        <div class="row search-row">
            <div class="text">
            <h3><a href="./record/<?php echo $doc['id']?>/<?php //echo $doc['types'][0]?>"><?php echo strip_tags($doc[$title_field][0]); ?></a></h3>

            <?php
            if (isset($doc["component_id"])) {
                $component_id = $doc["component_id"];
                echo'<div class="component_id">' . $component_id . '</div>';
            } ?>

            <?php if(array_key_exists($author_field,$doc)) { ?>
                <?php

                $num_authors = 0;
                foreach ($doc[$author_field] as $author) {
                    $orig_filter = urlencode($author);

                   // echo '<a class="agent" href="./search/*:*/Agent:%22'.$orig_filter.'%22">'.$author.'</a>';
                    $num_authors++;
                    if($num_authors < sizeof($doc[$author_field])) {
                        echo ' ';
                    }
                }
                ?>
            <?php } ?>

            <?php if(array_key_exists($subject_field,$doc)) { ?>
                <div class="tags">
                    <?php

                    $num_subject = 0;
                    foreach ($doc[$subject_field] as $subject) {

                        $orig_filter = urlencode($subject);
                      //  echo '<a class="subject" href="./search/*:*/Subject:%22'.$orig_filter.'%22">'.$subject.'</a>';
                        $num_subject++;
                        if($num_subject < sizeof($doc[$subject_field])) {
                            echo ' ';
                        }
                    }

                    ?>
                </div>
            <?php } ?>
            </div>
            <div class = "thumbnail-image">

                <?php
                $numThumbnails = 0;
                $imageset = false;
                $thumbnailLink = array();
                if (isset($doc[$image_uri_field]))
                {
                    foreach ($doc[$image_uri_field] as $imageUri)
                    {
                        if (strpos($imageUri, "|") > 0) {
                            $image_uri = explode("|", $imageUri);
                            $imageUri = $image_uri[0];
                            $image_title = $image_uri[1];
                        }
                        list($fullwidth, $fullheight) = getimagesize($imageUri);
                        //echo 'WIDTH'.$width.'HEIGHT'.$height
                        if ($fullwidth > $fullheight) {
                            $dims ='width = "40"';
                            $parms = '40,';

                        } else {
                            $dims ='height = "40"';
                            $parms = ',40';
                        }

                        if (strpos($imageUri, 'iiif') > 0)
                        {

                            //change to stop LUNA erroring on redirect
                            $imageUri = str_replace('http://', 'https://', $imageUri);
                            $iiifurlsmall = str_replace('/full/0/', '/'.$parms.'/0/', $imageUri);
                            echo $iiifurlsmall;
                            $thumbnailLink[$numThumbnails]  = '<a title = "' . $doc[$title_field][0] . '" href="./record/'.$doc['id'].'"> ';
                            $thumbnailLink[$numThumbnails] .= '<img src = "' . $iiifurlsmall . '" class="record-thumbnail-search" title="' . $doc[$title_field][0] . '" /></a>';
                            $numThumbnails++;
                            $imageset = true;
                        }
                        else
                        {
                            $thumbnailLink[$numThumbnails]  = '<a title = "' . $doc[$title_field][0] . '" href="./record/'.$doc['id'].'"> ';
                            $thumbnailLink[$numThumbnails] .= '<img src = "' . $imageUri . '" '.$dims.' class="record-thumbnail-search" title="' . $doc[$title_field][0] . '" /></a>';
                            $numThumbnails++;
                            $imageset = true;
                        }
                    }
                    if ($imageset == true) {
                        echo $thumbnailLink[0];
                    }
                }
                ?>
                <!--</div>-->

            </div><!-- close row-->
        </div>


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
</div> <!-- close col 9 -->