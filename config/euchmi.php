<?php

$config['skylight_appname'] = 'euchmi';

$config['skylight_theme'] = 'euchmi';

$config['skylight_fullname'] = 'Musical Instruments Museum at Edinburgh';

$config['skylight_adminemail'] = 'example@example.com';

$config['skylight_oaipmhcollection'] = 'hdl_123456789_4';


// Container ID and the field used in solr index to store this ID. Used for restricting search/browse scope.
$config['skylight_container_id'] = '11';
$config['skylight_container_field'] = 'location.coll';

$config['skylight_fields'] = array('Title' => 'dc.title.en_US',
    'Author' => 'dc.creator.en_US',
    'Country' => 'lido.country.en_US',
    'Subject' => 'dc.subject.en_US',
    'Instrument' => 'dc.type.en_US',
    'Abstract' => 'dc.description.abstract.en_US',
    'Date' => 'dc.date.issued',
    'Bitstream'=> 'dc.format.original',
    'Thumbnail'=> 'dc.format.thumbnail',
    'Place Made' => 'dc.coverage.spatial.en_US',
    'Date Made' => 'dc.date.created',
    'Accession Number' => 'dc.identifier.other',
    'Description' => 'dc.description.en_US',
    'Collection' => 'dc.relation.ispartof.en_US'
);

$config['skylight_date_filters'] = array('Date' => 'dateIssued.year_sort');
//$config['skylight_date_filters'] = array('Date' => 'dc.date.created');
$config['skylight_filters'] = array('Collection'=> 'collection_filter', 'Maker' => 'author_filter', 'Place Made' => 'place_filter', 'Instrument Type' => 'type_filter');
$config['skylight_date_filters'] = array('Date' => 'dateIssued.year');
$config['skylight_filters'] = array('Author' => 'author_filter', 'Country' => 'country_filter', 'Type' => 'type_filter');
  
$config['skylight_filter_delimiter'] = ':';

$config['skylight_meta_fields'] = array('Title' => 'dc.title',
    'Author' => 'dc.creator',
    'Abstract' => 'dc.description.abstract',
    'Subject' => 'dc.subject',
    'Date' => 'dc.date.issued_dt',
    'Type' => 'dc.type',
    'Bitstream'=> 'dc.format.original',
    'Thumbnail'=> 'dc.format.thumbnail');

$config['skylight_recorddisplay'] = array('Title','Author','Subject','Type','Abstract', 'Bitstream', 'Thumbnail','Place Made', 'Date Made', 'Accession Number', 'Description', 'Collection');

$config['skylight_searchresult_display'] = array('Title','Author','Subject','Type','Abstract', 'Bitstream', 'Thumbnail');


$config['skylight_search_fields'] = array('Keywords' => 'text',
    'Country' => 'lido.country',
    'Type' => 'dc.type',
    'Author' => 'dc.creator',
    'Subject' => 'dc.subject',
    'Date' => 'dc.date.issued',
    'Bitstream'=> 'dc.format.original',
    'Thumbnail'=> 'dc.format.thumbnail'
);

$config['skylight_sort_fields'] = array('Title' => 'dc.title',
    'Date' => 'dc.date.issued_dt',
    'Author' => 'dc.creator'
);

$config['skylight_feed_fields'] = array('Title' => 'Title',
    'Author' => 'Author',    
    'Subject' => 'Subject',
    'Country' => 'Country',
    'Description' => 'Abstract',
    'Date' => 'Date');

$config['skylight_results_per_page'] = 10;
$config['skylight_share_buttons'] = false;

// $config['skylight_homepage_recentitems'] = false;

// Set to the number of minutes to cache pages for. Set to false for no caching.
// This overrides the setting in skylight.php so is commented by Demo
$config['skylight_cache'] = false;

// Digital object management
$config['skylight_display_thumbnail'] = true;
$config['skylight_link_bitstream'] = true;

// Display common image formats in "light box" gallery?
$config['skylight_lightbox'] = true;
$config['skylight_lightbox_mimes'] = array('image/jpeg', 'image/gif', 'image/png');

// Language and locale settings
$config['skylight_language_default'] = 'en';
$config['skylight_language_options'] = array('en', 'ko', 'jp');

?>