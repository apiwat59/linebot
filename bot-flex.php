<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'VnS9+90qx7yFVR1Gy5JJIe+aTTmmmsLja9gZ2ITNLcf+u/PWAW24GBAbpbK55/stiF99X0Ons7VKxLmjKvz3NIzdLcOwwYQ/XwXxD14ApL5OvX2ANVvAFl6p83848Qh3ajeVGnA46V/pNjPxuyUXHQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '2e294a8da83cf4d1ed9450096a1cc18c';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

$jsonFlex = [
  {
  "type": "flex",
  "altText": "Flex Message",
  "contents": {
    "type": "bubble",
    "hero": {
      "type": "image",
      "url": "https://previews.123rf.com/images/vanatchanan/vanatchanan1610/vanatchanan161000291/65730524-internet-wireless-technology-wireless-icon-wifi-symbol-vector-illustration-.jpg",
      "size": "full",
      "aspectRatio": "20:13",
      "aspectMode": "cover",
      "action": {
        "type": "uri",
        "label": "Action",
        "uri": "https://linecorp.com"
      }
    },
    "body": {
      "type": "box",
      "layout": "vertical",
      "spacing": "md",
      "action": {
        "type": "uri",
        "label": "Action",
        "uri": "https://linecorp.com"
      },
      "contents": [
        {
          "type": "text",
          "text": "WIFI Helper",
          "size": "xl",
          "weight": "bold"
        },
        {
          "type": "text",
          "text": "จัดทำขึ้นเพื่อเเจ้งปัญหาเเละเเจ้งข้อมูลล่าสุดให้ท่าน",
          "size": "xxs",
          "color": "#AAAAAA",
          "wrap": true
        }
      ]
    },
    "footer": {
      "type": "box",
      "layout": "vertical",
      "contents": [
        {
          "type": "spacer",
          "size": "xxl"
        },
        {
          "type": "button",
          "action": {
            "type": "uri",
            "label": "รายละเอียด",
            "uri": "https://linecorp.com"
          },
          "color": "#5FB6FF",
          "style": "primary"
        },
        {
          "type": "separator",
          "margin": "md",
          "color": "#FFFFFF"
        },
        {
          "type": "button",
          "action": {
            "type": "uri",
            "label": "ดาวน์โหลด",
            "uri": "https://linecorp.com"
          },
          "color": "#1B78C5",
          "style": "primary"
        },
        {
          "type": "separator",
          "margin": "md"
        },
        {
          "type": "button",
          "action": {
            "type": "uri",
            "label": "วิธีใช้งาน",
            "uri": "https://linecorp.com"
          },
          "color": "#5FB6FF",
          "style": "primary"
        },
        {
          "type": "separator",
          "margin": "md"
        },
        {
          "type": "button",
          "action": {
            "type": "message",
            "label": "แจ้งปัญหา",
            "text": "ต้องการเเจ้งปัญหา"
          },
          "color": "#1B78C5",
          "style": "primary"
        },
        {
          "type": "separator",
          "margin": "md"
        },
        {
          "type": "button",
          "action": {
            "type": "uri",
            "label": "เข้าสู่เว็บไซต์",
            "uri": "https://linecorp.com"
          }
        }
      ]
    }
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
