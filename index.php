<?php /* index.php */
    session_start();
    $ary = array();
    $err = array();
    if($_SESSION['ErrArray']) {
        $ary['firstname'] = ' value="' . $_SESSION['OrigArray']['firstname'] . '"';
        $ary['lastname'] = ' value="' . $_SESSION['OrigArray']['lastname'] . '"';
        $ary['email'] = ' value="' . $_SESSION['OrigArray']['email'] . '"';
        $ary['phone'] = ' value="' . $_SESSION['OrigArray']['phone'] . '"';
        switch($_SESSION['OrigArray']['type']) {
            case '1':
                $ary['type1'] = ' selected="selected"';
                break;
            case '2':
                $ary['type2'] = ' selected="selected"';
                break;
            case '3':
                $ary['type3'] = ' selected="selected"';
                break;
            case '4':
                $ary['type4'] = ' selected="selected"';
                break;
            case '5':
                $ary['type5'] = ' selected="selected"';
                break;
            case '6':
                $ary['type6'] = ' selected="selected"';
                break;
            case '7':
                $ary['type7'] = ' selected="selected"';
                break;
            default:
                $ary['type0'] = ' selected="selected"';
                break;
        }
        $ary['otherType'] = ' value="' . $_SESSION['OrigArray']['otherType'] . '"';
        $ary['date'] = ' value="' . $_SESSION['OrigArray']['date'] . '"';
        switch($_SESSION['OrigArray']['location']) {
            case '1':
                $ary['location1'] = ' selected="selected"';
                break;
            case '2':
                $ary['location2'] = ' selected="selected"';
                break;
            default:
                $ary['location0'] = ' selected="selected"';
                break;
        }
        $ary['hours'] = ' value="' . $_SESSION['OrigArray']['hours'] . '"';
        switch($_SESSION['OrigArray']['group']) {
            case '1':
                $ary['group1'] = ' selected="selected"';
                break;
            case '2':
                $ary['group2'] = ' selected="selected"';
                break;
            case '3':
                $ary['group3'] = ' selected="selected"';
                break;
            case '4':
                $ary['group4'] = ' selected="selected"';
                break;
            case '5':
                $ary['group5'] = ' selected="selected"';
                break;
            case '6':
                $ary['group6'] = ' selected="selected"';
                break;
            default:
                $ary['group0'] = ' selected="selected"';
                break;
        }
        $ary['message'] = $_SESSION['OrigArray']['message'];
        $err = array();
        $c = 0;
        $br = '';
        foreach($_SESSION['ErrArray'] as $e) {
            $field = ucwords(str_replace(array('_','-'), chr(32), $e['field']));
            $param = $e['param'];
            
            switch($e['rule']) {
                case 'validate_required':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field is required.$br";
                    break;
                case 'validate_valid_email':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must contain a valid email address.$br";
                    break;
                case 'validate_max_len':
                    if($param == 1) {
                        $err[$c]['id'] = $e['field'];
                        $err[$c]['message'] = "The $field field must be at least $param character in length.$br";
                    } else {
                        $err[$c]['id'] = $e['field'];
                        $err[$c]['message'] = "The $field field must be at least $param characters in length.$br";
                    }
                    break;
                case 'validate_min_len':
                    if($param == 1) {
                        $err[$c]['id'] = $e['field'];
                        $err[$c]['message'] = "The $field field must not exceed $param character in length.$br";
                    } else {
                        $err[$c]['id'] = $e['field'];
                        $err[$c]['message'] = "The $field field must not exceed $param characters in length.$br";
                    }
                    break;
                case 'validate_exact_len':
                    if($param == 1) {
                        $err[$c]['id'] = $e['field'];
                        $err[$c]['message'] = "The $field field must be exactly $param character in length.$br";
                    } else {
                        $err[$c]['id'] = $e['field'];
                        $err[$c]['message'] = "The $field field must be exactly $param characters in length.$br";
                    }
                    break;
                case 'validate_alpha':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must only contain alphabetical characters.$br";
                    break;
                case 'validate_alpha_numeric':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must only contain alpha-numeric characters.$br";
                    break;
                case 'validate_alpha_dash':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must only contain alpha-numeric characters, underscores, and dashes.$br";
                    break;
                case 'validate_numeric':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must only contain alpha-numeric characters, underscores, and dashes.$br";
                    break;
                case 'validate_integer':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must contain an integer.$br";
                    break;
                case 'validate_float':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must contain a decimal number.$br";
                    break;
                case 'validate_date':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field format must be MM-DD-YYYY.$br";
                    break;
                case 'validate_min_numeric':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must contain a number greater than $param.$br";
                    break;
                case 'validate_max_numeric':
                    $err[$c]['id'] = $e['field'];
                    $err[$c]['message'] = "The $field field must contain a number less than $param.$br";
                    break;
            }
            if($c > 0) {
                $br = '<br>';
            }
            $c++;
        }
        if (!empty($err)) {
            $errAry = json_encode($err);
        }
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="css/pikaday.css" />
    <link rel="stylesheet" href="css/tool.css" />
    <script type="text/javascript" src="js/validate-min.js"></script>
    <script type="text/javascript" src="js/slideToggle.js"></script>
    <script type="text/javascript" src="js/moment-min.js"></script>
    <script type="text/javascript" src="js/pikaday.js"></script>
</head>
<body>
    <form name="musicQuote" action="src/calculate.php" method="post" id="musicQuoteForm">
        <div id="errorMsg"></div>
        <table class="form-table">
            <tbody>
                <tr>
                    <td class="form-table-col-left" id="firstnameErr">
                        <label for="firstname" class="form-label">First Name</label>
                    </td>
                    <td class="form-table-col-right">
                        <input type="text" name="firstname" id="firstname" class="form-input" placeholder="e.g. John"<?php echo $ary['firstname']; ?> />
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="lastnameErr">
                        <label for="lastname" class="form-label">Last Name</label>
                    </td>
                    <td class="form-table-col-right">
                        <input type="text" name="lastname" id="lastname" class="form-input" placeholder="e.g. Doe"<?php echo $ary['lastname']; ?> />
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="emailErr">
                        <label for="email" class="form-label">E-mail Address</label>
                    </td>
                    <td class="form-table-col-right">
                        <input type="text" name="email" id="email" class="form-input" placeholder="e.g. johndoe@email.co"<?php echo $ary['email']; ?> />
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="phoneErr">
                        <label for="phone" class="form-label">Phone number</label>
                    </td>
                    <td class="form-table-col-right">
                        <input type="text" name="phone" id="phone" class="form-input" placeholder="e.g. 724-555-4321"<?php echo $ary['phone']; ?> />
                        <br />
                        <small>(Format: XXX-XXX-XXXX or 1-XXX-XXX-XXXX)</small>
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="typeErr">
                        <label for="type" class="form-label">Event Type</label>
                        <div id="otherTypeErr">
                            <label for="otherType" class="form-label">Other Event Type</label>
                        </div>
                    </td>
                    <td class="form-table-col-right">
                        <select name="type" id="type" class="form-dropdown" onchange="otherTypeBox(this.form.type)">
                            <option value=""<?php echo $ary['type0']; ?>> - - </option>
                            <option value="1"<?php echo $ary['type1']; ?>>Wedding Cocktail Hour</option>
                            <option value="2"<?php echo $ary['type2']; ?>>Wedding Ceremony</option>
                            <option value="3"<?php echo $ary['type3']; ?>>Wedding Reception</option>
                            <option value="4"<?php echo $ary['type4']; ?>>Entire Wedding</option>
                            <option value="5"<?php echo $ary['type5']; ?>>Restaurant/Lounge</option>
                            <option value="6"<?php echo $ary['type6']; ?>>Private Party</option>
                            <option value="7"<?php echo $ary['type7']; ?>>Other</option>
                        </select>
                        <div id="otherBox">
                            <input type="text" name="otherType" id="otherType" class="form-input"<?php echo $ary['otherType']; ?> />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="dateErr">
                        <label for="date" class="form-label">Date of Event</label>
                    </td>
                    <td class="form-table-col-right">
                        <input type="text" name="date" id="date" class="form-input" placeholder="e.g. 11-10-2014"<?php echo $ary['date']; ?> />
                        <br />
                        <small>(Format: MM-DD-YYYY)</small>
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="locationErr">
                        <label for="location" class="form-label">Event Location</label>
                    </td>
                    <td class="form-table-col-right">
                        <select name="location" id="location" class="form-dropdown">
                            <option value=""<?php echo $ary['location0']; ?>> - - </option>
                            <option value="1"<?php echo $ary['location1']; ?>>Local - Up to 50 miles</option>
                            <option value="2"<?php echo $ary['location2']; ?>>Destination</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="hoursErr">
                        <label for="hours" class="form-label">Hours</label>
                    </td>
                    <td class="form-table-col-right">
                        <input type="number" name="hours" id="hours" class="form-input" min="2" max="6" placeholder="e.g. 2-6"<?php echo $ary['hours']; ?> />
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="groupErr">
                        <label for="group" class="form-label">Entertainment Needed</label>
                    </td>
                    <td class="form-table-col-right">
                        <select name="group" id="group" class="form-dropdown">
                            <option value=""<?php echo $ary['group0']; ?>> - - </option>
                            <option value="1"<?php echo $ary['group1']; ?>>Pianist &amp; Singer</option>
                            <option value="2"<?php echo $ary['group2']; ?>>Pianist, Singer &amp; Sax</option>
                            <option value="3"<?php echo $ary['group3']; ?>>9 Piece Band</option>
                            <option value="4"<?php echo $ary['group4']; ?>>Singing Telegram</option>
                            <option value="5"<?php echo $ary['group5']; ?>>DJ</option>
                            <option value="6"<?php echo $ary['group6']; ?>>Karaoke</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-left" id="messageErr">
                        <label for="message" class="form-label">Message</label>
                    </td>
                    <td class="form-table-col-right">
                        <textarea name="message" id="message" class="form-textbox" placeholder="Enter further details here..."><?php echo $ary['message']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-both" colspan="2">
                        All fields required. Please complete form and submit.
                    </td>
                </tr>
                <tr>
                    <td class="form-table-col-both" colspan="2">
                        <button name="send_quote" type="submit" value="send_quote">Send me a quote!</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <script type="text/javascript">
        function findId(id) {
            return document.getElementById(id);
        }
        
        function otherTypeBox(s) {
            var o = s.options[s.selectedIndex].value;
            var t = findId('otherBox');
            var s = new SlideToggle('otherBox');
            var sl = new SlideToggle('otherTypeErr');
            if (o === '7') {
                if(t.style.display === 'none' || t.style.display === '') {
                    s.slideToggle();
                    sl.slideToggle();
                }
            } else {
                if(t.style.display === 'block') {
                    s.slideToggle();
                    sl.slideToggle();
                }
            }
        }
        
        function errClose() {
            var s = new SlideToggle('errorMsg');
            s.slideToggle();
        }
        
        function filter(a, f) {
            var ret = [];
            for (var i = 0; i < a.length; ++i) {
                if (f(a[i])) {
                    ret.push(a[i]);
                }
            }
            return ret;
        }
            
        function resetErr() {
            var elements = document.getElementsByTagName("*");
            var logEl = filter(elements, function(el) {
                return /Err/.test(el.id);
            });

            for (var i = 0; i < logEl.length; ++i) {
                logEl[i].style.color = '#000';
            }
            return logEl;
        }
        
        function formValReq(f) {
            return (f !== null && f !== '');
        }
        
        function checkErrors(e) {
            if(e) {
                var eMsg = new SlideToggle('errorMsg');
                var errorMsg = findId('errorMsg');
                if(errorMsg.style.display === 'block') {
                    errorMsg.style.display = 'none';
                }
                errorMsg.innerHTML = '<span id="errorClose" onclick="errClose()">close</span>';
                for (var i = 0, errorLength = e.length; i < errorLength; i++) {
                    var el = findId(e[i].id + 'Err');
                    var br = '';
                    if (i !== parseInt(e.length - 1)) {
                        br = '<br>';
                    }
                    el.style.color = '#ff0000';
                    errorMsg.innerHTML += e[i].message + br;
                }
                eMsg.slideToggle();
            }
        }

        var postBackErrors = checkErrors(<?php echo $errAry; ?>);

        var picker = new Pikaday({
            field: findId('date'),
            format: 'MM-DD-YYYY',
            firstDay: 1,
            minDate: new Date('01-01-2000'),
            maxDate: new Date('12-31-2020'),
            yearRange: [2000,2020]
        });

        var validator = new FormValidator('musicQuote', [{
                name: 'firstname',
                display: 'Firstname',
                rules: 'required|alpha|max_length[40]'
            }, {
                name: 'lastname',
                display: 'Lastname',
                rules: 'required|alpha|max_length[40]'
            }, {
                name: 'email',
                display: 'Email',
                rules: 'required|valid_email|max_length[75]'
            }, {
                name: 'phone',
                display: 'Phone',
                rules: 'required|max_length[14]|callback_PhoneRegEx'
            }, {
                name: 'type',
                display: 'Type',
                rules: 'required|numeric|less_than[8]|greater_than[0]|exact_length[1]'
            }, {
                name: 'otherType',
                display: 'Othertype',
                rules: '!callback_OtherTypeValidation|max_length[50]'
            }, {
                name: 'date',
                display: 'Date',
                rules: 'required|max_length[10]|callback_DateRegEx'
            }, {
                name: 'location',
                display: 'Location',
                rules: 'required|numeric|less_than[3]|greater_than[0]|exact_length[1]'
            }, {
                name: 'hours',
                display: 'Hours',
                rules: 'required|numeric|less_than[7]|greater_than[1]|exact_length[1]'
            }, {
                name: 'group',
                display: 'Group',
                rules: 'required|numeric|less_than[7]|greater_than[0]|exact_length[1]'
            }, {
                name: 'message',
                display: 'Message',
                rules: 'required|max_length[500]'
            }], function(errors, evt) {
                evt.preventDefault();
                resetErr();
                if (errors.length > 0) {
                    checkErrors(errors);
                } else {
                    var form = findId('musicQuoteForm');
                    form.submit();
                }
            }
        );

        validator.registerCallback('PhoneRegEx', function(v) {
            var RegEx = /^[0-9]{3,3}-[0-9]{3,3}-[0-9]{4,4}|[0-9]{1,1}-[0-9]{3,3}-[0-9]{3,3}-[0-9]{4,4}$/;
            return RegEx.test(v);
        }).setMessage('PhoneRegEx', 'The %s format must be XXX-XXX-XXXX or 1-XXX-XXX-XXXX.');
        
        validator.registerCallback('DateRegEx', function(v) {
            var RegEx = /^[0-9]{2,2}-[0-9]{2,2}-[0-9]{4,4}$/;
            return RegEx.test(v);
        }).setMessage('DateRegEx', 'The %s format must be MM-DD-YYYY.');

        validator.registerCallback('OtherTypeValidation', function(v) {
            var t = findId('type');
            var o = String(t.options[t.selectedIndex].value);
            if (o === '7') {
                if(formValReq(v)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }).setMessage('OtherTypeValidation', "The Other Event Type is required when 'Other' is selected.");

        var p = findId('phone');
        p.maxLength = 14;
        p.onkeyup = function(e) {
            e = e || window.event;
            if (e.keyCode >= 65 && e.keyCode <= 90) {
                this.value = this.value.substr(0, this.value.length - 1);
                return false;
            } else if (e.keyCode >= 37 && e.keyCode <= 40) {
                return true;
            }
            var v = (this.value.replace(/[^\d]/g, ''));
            if (v.length === 10) {
                this.value = (v.substring(0, 3) + "-" + v.substring(3, 6) + "-" + v.substring(6, 10));
            } else if (v.length === 11) {
                this.value = (v.substring(0, 1) + "-" + v.substring(1, 4) + "-" + v.substring(4, 7) + "-" + v.substring(7, 11));
            };
        }
        

        var d = findId('date');
        d.maxLength = 10;
        p.onpaste = d.onkeyup = function(e) {
            e = e || window.event;
            if (e.keyCode >= 65 && e.keyCode <= 90) {
                this.value = this.value.substr(0, this.value.length - 1);
                return false;
            } else if (e.keyCode >= 37 && e.keyCode <= 40) {
                return true;
            }
            var v = (this.value.replace(/[^\d]/g, ''));
            if (v.length === 8) {
                this.value = (v.substring(0, 2) + "-" + v.substring(2, 4) + "-" + v.substring(4, 8));
            };
        }
    </script>
</body>