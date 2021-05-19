<?php
//slack
$url = 'https://slack.com/api/chat.postMessage';
 
$data = array(
    "channel"=>"C01RVUSJ2G1",
    "text"=>"data1"
);
 
$options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode( $data ),
    'header'=>  "Content-Type: application/json\r\n" .
                "Authorization: Bearer xoxb-1852589012599-1891261069184-jTNa3a0dYf8198aioMo2XlyT\r\n"//.
                //"Accept: application/json\r\n"
    )
);
 
$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );
$result = json_decode($result);
 
var_dump($result);
?>