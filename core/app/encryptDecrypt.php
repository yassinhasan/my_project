<?php
namespace core\app;
trait encryptDecrypt
{


    public function encrypt($data)
    {   
        $first_key = base64_decode(FIRSTKEY);
        $second_key = base64_decode(SECONDKEY);   
        $method = "aes-256-cbc";   
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);
        
        //data 
        $first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   

        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
           
        $output = base64_encode($iv.$second_encrypted.$first_encrypted);  
        return $output;   
    }

    public function decrypt($input)
    {
        $first_key = base64_decode(FIRSTKEY);
        $second_key = base64_decode(SECONDKEY);  
        $mixdata = base64_decode($input);
        $method = "aes-256-cbc";   
        $iv_length = openssl_cipher_iv_length($method);
        $iv = substr($mixdata,0,$iv_length);
        $first_encrypted = substr($mixdata,$iv_length + 64);
        $second_encrypted = substr($mixdata,$iv_length,64);
        //return data
        $data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
        $second_new_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
        if(hash_equals($second_encrypted,$second_new_encrypted))
        return $data;
        return false;
    }

}