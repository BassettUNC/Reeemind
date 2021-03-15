<?php 

$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
$text = "$key";
$var_str = var_export($text, true);
$var = "<?php\n\n\$key = $var_str;\n\n?>";
file_put_contents('taxes.php', $var);
?>