<?php
$access_token = 'Cq8fODVKKPJVth6IKySkccyKS4W1JSJpMnOEYzUr9oSSYUznmnz835mW9u3uWr8+wMGgRc8P6MTFUvaagI+2Sv9fj7e0hp5Wd7BGwmRpGceO4EY0oElanTcIf6ARnZ0CW6L8iVyz7cZqe1W8SrRIlAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			/*$messages = [
				'type' => 'text',
				'text' => $text
			];*/

			//$ret_text = strpos($text,"สวัสดี");

			// Build message to reply back
			
			if (strpos($text,'สวัสดี') !== false or 
				strpos($text,'หวัดดี') !== false or 
				strpos(strtoupper($text),'HELLO') !== false or 
				strpos(strtoupper($text),'HI') !== false) {
				$messages = [
					'type' => 'text',
					'text' => 'สวัสดีครับ'
				];
			} elseif (strpos(strtoupper($text),'CAROUSEL ') !== false)) {
				$messages = [
				  'type'=> 'template',
				  'altText'=> 'this is a carousel template',
				  'template'=> {
				      'type'=> 'carousel',
				      'columns'=> [
				          {
				            'thumbnailImageUrl'=> 'https=>//example.com/bot/images/item1.jpg',
				            'title'=> 'this is menu',
				            'text'=> 'description',
				            'actions'=> [
				                {
				                    'type'=> 'postback',
				                    'label'=> 'Buy',
				                    'data'=> 'action=buy&itemid=111'
				                },
				                {
				                    'type'=> 'postback',
				                    'label'=> 'Add to cart',
				                    'data'=> 'action=add&itemid=111'
				                },
				                {
				                    'type'=> 'uri',
				                    'label'=> 'View detail',
				                    'uri'=> 'http=>//example.com/page/111'
				                }
				            ]
				          },
				          {
				            'thumbnailImageUrl'=> 'https=>//example.com/bot/images/item2.jpg',
				            'title'=> 'this is menu',
				            'text'=> 'description',
				            'actions'=> [
				                {
				                    'type'=> 'postback',
				                    'label'=> 'Buy',
				                    'data'=> 'action=buy&itemid=222'
				                },
				                {
				                    'type'=> 'postback',
				                    'label'=> 'Add to cart',
				                    'data'=> 'action=add&itemid=222'
				                },
				                {
				                    'type'=> 'uri',
				                    'label'=> 'View detail',
				                    'uri'=> 'http=>//example.com/page/222'
				                }
				            ]
				          }
				      ]
				  }
				]

			} else {
				$messages = [
					'type' => 'text',
					'text' => $text
				];

			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
