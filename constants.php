<?php


const METHOD = 'AES-128-ECB';
const KEY = 'secret';

function openssl_enc($data): bool|string
{
    return openssl_encrypt($data, METHOD, KEY);
}

function openssl_dec($data): bool|string
{
    return openssl_decrypt($data, METHOD, KEY);
}