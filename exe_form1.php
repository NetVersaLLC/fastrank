<?php
include '/usr/local/sendgrid-php/SendGrid_loader.php';
session_start();

$full_name           = $_POST['full_name'];
$email               = $_POST['email'];
$phone               = $_POST['phone'];
$alt_phone           = $_POST['alt_phone'];
$investment          = $_POST['investment'];
$accredited_investor = $_POST['accredited_investor'];
$invalid             = false;

if($full_name=='' || $email=='' || $phone=='' || $investment=='' || $accredited_investor=='')
    $invalid = true;

if (!isset($_SESSION["token"])) {
    header("Location: index.php?spamed&1");
    exit;
}
if ($_POST['token']!=$_SESSION['token']) {
    header("Location: index.php?spamed&2");
    exit;
}
if (isBot()) {
    header("Location: index.php?spamed&3");
    exit;
}
if ($invalid) {
    header("Location: index.php?spamed&4&full_name=$full_name&email=$email&phone=$phone&investment=$investment&accredited_investor=$accredited_investor");
    exit;
}

$fh = fopen('subscriptions.csv', 'a');
fwrite($fh, '"' . $full_name .  '","' . $email . '","' . $phone . '","' . $alt_phone . '","'. $investment . '","' . $accredited_investor . '","' . $_SERVER['REMOTE_ADDR'] . '","' . date('M jS, Y g:ia', time()) . '"' . "\r\n");
fclose($fh);

$to = 'admin@netversa.com';
$from = 'leads@crowdgrip.com';
$bcc = 'seandavidshannon@gmail.com';
$subject = 'FastRank.net (WEB LEAD) ';
$message = "Full Name: " . $full_name . "<br />Email: " . $email . "<br />Phone: " . $phone . "<br />Alternate Phone: " . $alt_phone . "<br />Investment: " . $investment . "<br />Accredited Investor: " . $accredited_investor;
$message = '<html><body>' . $message . '</body></html>';

if(send_mail($to, $from, $subject, $message, $message, 'Administrator', null, $bcc)) {
    $message2 = "Click <a href='http://usenergytoday.com/oil/" . urlencode("Investor Kit Newsletter.pdf") . "'>here</a> to download you free investor guide<br/><br/><b>OR</b><br/><br/>Copy/Paste the link below to your browser<br/><br/>http://usenergytoday.com/oil/" . urlencode("Investor Kit Newsletter.pdf");
    $message2 = '<html><body>' . $message2 . '</body></html>';
    $sent = send_mail($email, $from, "Download Your Free Investor Guide Now", $message2, $message2, 'Administrator', $full_name);
    header("Location: thankyou.php?m=success&notify=" . (($sent===true) ? 'success' : 'failed'));
} else {
    header("Location: thankyou.php?m=failed&notify=failed");
}

function isBot() {
    $botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
    "looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
    "Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
    "crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
    "msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
    "Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
    "Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
    "Butterfly","Twitturls","Me.dium","Twiceler");

    $isBot = false;
    foreach($botlist as $bot) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], $bot) !== false) {
            $isBot = true;
            break;
    	}
    }
    return $isBot;
}

function send_mail($to, $from, $subject, $plain_message, $html_message=null, $from_name=null, $to_name=null, $bcc=array(), $additional_headers = array(), $reply_to=null) {
    if(!$reply_to)  $reply_to = $from;
    if(!$from_name || !is_string($from_name))
        $from_name = '';
    $random_hash = md5(date('r', time()));

    $headers = array();
    if($from_name && $from_name!='')
        $headers[] = "From: {$from_name} <" . strip_tags($from) . ">";
    else
        $headers[] = "From: " . strip_tags($from);
    if($to_name && $to_name!='')
        $headers[] = "To: {$to_name} <" . strip_tags($to) . ">";
    else
        $headers[] = "To: " . strip_tags($to);
    if(is_array($bcc) && sizeof($bcc)>0)
        $headers[] = "Bcc: " . implode(", ", $bcc);
    $headers[] = "Reply-To: " . strip_tags($reply_to);
    if(is_array($additional_headers) && sizeof($additional_headers)>0)
        $headers = array_merge($headers, $additional_headers);
    if($html_message) {
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=iso-8859-1";
    } else {
        $headers[] = "Content-Type: text/plain; charset=iso-8859-1";
    }
    $headers[] = "X-Priority: 1";
    $headers[] = "X-Mailer: PHP/" . phpversion();

    $plain_message = strip_tags(str_ireplace(array('<br/>', '<br>'), '\n', $plain_message));
    $html_message = str_ireplace(array('\r\n', '\n'), '<br>', $html_message);

    $mail_headers = implode("\r\n", $headers);
    $mail_message = ($html_message && $html_message!='') ? $html_message : $plain_message;

    $sendgrid = new SendGrid('jamesdouglas', 'crowdGr1p');
    $mail = new SendGrid\Mail();
    $mail->addTo($to)->
	    setFrom($from)->
	    setSubject($subject)->
	    setText($plain_message)->
	    setHtml($html_message);
    $sendgrid->smtp->send($mail);
    # $mail_sent = @mail($to, $subject, $mail_message, $mail_headers);
    return $mail_sent;
}

?>
