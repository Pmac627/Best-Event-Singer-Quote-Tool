<?php /* calculate.php */
    require('gump.class.php');
    session_start();

    class gumpVal extends GUMP {
        /**
        * Determine if the provided value is greater than value 1 and less than value 2
        *
        * Usage: '<index>' => 'val_between, n1 n2'
        *
        * @access public
        * @param  string $field
        * @param  array $input
        * @return mixed
        */
        public function validate_val_between($field, $input, $param = NULL){
            if(!isset($input[$field]) || empty($input[$field])) {
               return;
            }
            
            $param = explode(chr(32), $param);
            
            if($input[$field] > $param[0] && $input[$field] < $param[1]) {
                return;
            }

            if(!is_numeric($input[$field])) {
               return array(
                   'field' => $field,
                   'value' => $input[$field],
                   'rule'	=> __FUNCTION__,
                   'param' => $param
               );
            }
        }
    }
    
    function calculate($hours, $group) {
        $h = $hours - 1; //We have a flat fee set, so only need to calc addl hours
        switch($group) {
            case 1:
                // Pianist & Singer
                // Rate: Hourly
                // First: $300 ($150/piece)
                // Addl: $250 ($125/piece)
                $est = (300 + (250 * (int)$h));
                break;
            case 2:
                // Pianist, Singer & Sax
                // Rate: Hourly
                // First: $450 ($150/piece)
                // Addl: $375 ($125/piece)
                $est = (450 + (375 * (int)$h));
                break;
            case 3:
                // 9 Piece Band
                // Rate: Hourly
                // First: $1350 ($150/piece)
                // Addl: $1125 ($125/piece)
                $est = (1350 + (1125 * (int)$h));
                break;
            case 4:
                // Telegram
                // Rate: Flat
                // First: $125
                $est = 125;
                break;
            case 5:
                // DJ
                // Rate: Hourly
                // First: $150
                // Addl: $125/hr
                $est = (150 + (125 * (int)$h));
                break;
            case 6:
                // Karaoke
                // Rate: Hourly
                // First: $150
                // Addl: $125/hr
                $est = (150 + (125 * (int)$h));
                break;
            default:
                $est = 0;
                break;
        }
        setlocale(LC_MONETARY, 'en_US');
        return money_format('%(#4n', $est);
    }

    function transType($type, $otherType) {
        switch($type) {
            case 1:
                return "Wedding Cocktail Hour";
                break;
            case 2:
                return "Wedding Ceremony";
                break;
            case 3:
                return "Wedding Reception";
                break;
            case 4:
                return "Entire Wedding";
                break;
            case 5:
                return "Restaurant/Lounge";
                break;
            case 6:
                return "Private Party";
                break;
            case 7:
                return "Other: " . $otherType;
                break;
            default:
                return "N/A";
                break;
        }
    }
    
    function transLocation($location) {
        switch($location) {
            case 1:
                return "Local - Up to 50 miles";
                break;
            case 2:
                return "Destination";
                break;
            default:
                return "N/A";
                break;
        }
    }
    
    function transGroup($group) {
        switch($group) {
            case 1:
                return "Pianist &amp; Singer";
                break;
            case 2:
                return "Pianist, Singer &amp; Sax";
                break;
            case 3:
                return "9 Piece Band";
                break;
            case 4:
                return "Telegram";
                break;
            case 5:
                return "DJ";
                break;
            case 6:
                return "Karaoke";
                break;
            default:
                return "N/A";
                break;
        }
    }

    function emailHTML($fields) {
        $fields['estimate'] = calculate($fields['hours'], $fields['group']);
        $fields['type'] = transType($fields['type'], $fields['otherType']);
        $fields['location'] = transLocation($fields['location']);
        $fields['group'] = transGroup($fields['group']);
        $body = "<html lang='en'>
<head>
	<meta charset='utf-8' />
	<title></title>
</head>
<body>
	<table style='font-family:Trebuchet MS;width:400px;font-size:14px;border:1px solid#ccc;border-collapse:collapse;'>
		<thead>
			<tr>
				<td style='text-align:center;padding:0;'>
					<img src='besteventsingerlogo.png' alt='Best Event Singer Logo' title='Susan Leslie - Event Singer' />
				</td>
			</tr>
			<tr>
				<td style='padding:5px;'>
					New submission from Best Event Singer!
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Name
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['firstname'] . " " . $fields['lastname'] . "
				</td>
			</tr>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Email
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['email'] . "
				</td>
			</tr>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Phone
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['phone'] . "
				</td>
			</tr>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Event Date
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['date'] . "
				</td>
			</tr>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Event Type
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['type'] . "
				</td>
			</tr>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Event Location
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['location'] . "
				</td>
			</tr>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Event Duration
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['hours'] . " Hours
				</td>
			</tr>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Additional Info/Message
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['message'] . "
				</td>
			</tr>
			<tr>
				<th style='background-color:#e19ce0;text-align:left;padding:5px;'>
					Your Estimated Quote
				</th>
			</tr>
			<tr>
				<td style='padding:5px 5px 5px 20px;'>
					" . $fields['estimate'] . "
				</td>
			</tr>
		</tbody>
	</table>
</body>";

        return $body;
    }
    
    $gump = new gumpVal();
    $fields = $gump->sanitize($_POST);

    $validation_rules = array(
        'firstname' => 'required|alpha|max_len,40',
        'lastname' => 'required|alpha|max_len,40',
        'email' => 'required|valid_email|max_len,75',
        'phone' => 'required|max_len,14',
        'type' => 'required|integer|val_between,0 8',
        'otherType' => 'alpha|max_len,50',
        'date' => 'required|max_len,10',
        'location' => 'required|integer|max_len,1|val_between,0 3',
        'hours' => 'required|integer|max_len,1|val_between,1 7',
        'group' => 'required|integer|max_len,1|val_between,0 7',
        'message' => 'required|max_len,500'
    );

    $validated_data = $gump->validate($fields, $validation_rules);

    if($validated_data !== TRUE) {
        // Failed Validation
        $_SESSION['ErrArray'] = $validated_data;
        $_SESSION['OrigArray'] = $fields;
        //header("location: http://besquote.macmannis.com/failed.php");
        header("location: http://besquote.macmannis.com/index.php");
    } else {
        $_SESSION['ErrArray'] = '';
        $_SESSION['OrigArray'] = '';
        $estimate = calculate($fields['hours'], $fields['group']);
        $to = $fields['email'];
        $subject = "BES Quote Tool";
        $body = emailHTML($fields);
		$headers = "From: besquote.macmannis.com <noreply@besquote.macmannis.com>\r\nMIME-Version: 1.0" . "\r\nContent-type:text/html;charset=UTF-8" . "\r\n";
		$params = "-f noreply@besquote.macmannis.com";
        mail($to, $subject, $body, $headers, $params);
        header("location: http://besquote.macmannis.com/success.php");
    }
?>