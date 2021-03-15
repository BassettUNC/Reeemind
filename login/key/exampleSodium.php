<?php 
// Generating your encryption key
include("../../../etc/reeemind.com/tax/taxes.php");
// Using your key to encrypt information
$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$ciphertext = sodium_crypto_secretbox('Elijah153', $nonce, $key);


$plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
if ($plaintext === false) {
    throw new Exception("Bad ciphertext");
} else {
	echo $plaintext;
}
?>