<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'VnS9+90qx7yFVR1Gy5JJIe+aTTmmmsLja9gZ2ITNLcf+u/PWAW24GBAbpbK55/stiF99X0Ons7VKxLmjKvz3NIzdLcOwwYQ/XwXxD14ApL5OvX2ANVvAFl6p83848Qh3ajeVGnA46V/pNjPxuyUXHQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '2e294a8da83cf4d1ed9450096a1cc18c';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

$jsonFlex = [
    {
  "type": "template",
  "altText": "Project DNP",
  "template": {
    "type": "buttons",
    "actions": [
      {
        "type": "message",
        "label": "เปิดไฟดวงที่1",
        "text": "เปิด1"
      },
      {
        "type": "message",
        "label": "เปิดไฟดวงที่2",
        "text": "เปิด2"
      },
      {
        "type": "message",
        "label": "เปิดไฟดวงที่3",
        "text": "เปิด3"
      },
      {
        "type": "message",
        "label": "เปิดไฟทั้งหมด",
        "text": "เปิดทั้งหมด"
      }
    ],
    "thumbnailImageUrl": "https://yt3.ggpht.com/a-/AAuE7mDIwl8UZy1HlNWiFo0kFOh9HVeubcKKepEDtQ=s900-mo-c-c0xffffffff-rj-k-no",
    "title": "IOT By DNP (สำหรับเปิด)",
    "text": "สำหรับเปิด (ต้องการปิดให้พิมพ์ \"ปิดไฟ\")"
  }
}
  ];



if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
        error_log(json_encode($event));
        $reply_message = '';
        $reply_token = $event['replyToken'];


        $data = [
            'replyToken' => $reply_token,
            'messages' => [$jsonFlex]
        ];

        print_r($data);

        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
