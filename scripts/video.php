<?php

$result = db_query("SELECT field_embedded_vid_value from {content_type_mf_movie}");
while ($vid = db_fetch_object($result)) {
    //print_r($vid);
    $vimeo_id = $vid->field_embedded_vid_value;
    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo_id.php"));
    print_r($hash); 
}

?>