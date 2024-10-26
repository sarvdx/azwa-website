<!-- contact markey js -->

<?php

if(!$_POST) exit;

// Email address verification
function isEmail($email) {
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

// Ganti ini sesuai dengan data yang Anda inginkan
$name     = 'Azwa Luwu';
$email    = 'azwaluwu472@gmail.com';
$comments = 'Saya Ingin Bekerja Sama Dengan Anda / Mengajak Anda Ke Perusahaan Saya';

// Validasi input
if(trim($name) == '') {
    echo '<div class="error_message">You must enter your name.</div>';
    exit();
} else if(trim($email) == '') {
    echo '<div class="error_message">Please enter a valid email address.</div>';
    exit();
} else if(!isEmail($email)) {
    echo '<div class="error_message">You have entered an invalid e-mail address. Please try again.</div>';
    exit();
}

if(trim($comments) == '') {
    echo '<div class="error_message">Please enter your message.</div>';
    exit();
}

// Menghapus karakter escape jika magic quotes diaktifkan
if(get_magic_quotes_gpc()) {
    $comments = stripslashes($comments);
}

// Alamat email tujuan
$address = "tujuan@example.com"; // Ganti dengan alamat email yang sesuai

// Subjek email
$e_subject = 'You have been contacted by ' . $name . '.';

// Membuat isi email
$e_body = "You have been contacted by $name. Their additional message is as follows:" . PHP_EOL . PHP_EOL;
$e_content = "\"$comments\"" . PHP_EOL . PHP_EOL;
$e_reply = "You can contact $name via email, $email";

// Mengatur pesan dan membungkusnya agar tidak terlalu panjang
$msg = wordwrap($e_body . $e_content . $e_reply, 70);

// Menyiapkan header email
$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

// Mengirim email
if(mail($address, $e_subject, $msg, $headers)) {
    // Email terkirim dengan sukses
    echo "<fieldset>";
    echo "<div id='success_page'>";
    echo "<h3>Email Sent Successfully.</h3>";
    echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>";
    echo "</div>";
    echo "</fieldset>";
} else {
    // Email gagal terkirim
    echo "<div class='error_message'>ERROR! Email could not be sent.</div>";
}

?>
