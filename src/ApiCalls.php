<?php

namespace ponbiki\apiCheat;

class ApiCalls implements \iApiCalls
{
    public function validate($key)
    {
        $clean_key = \filter_var($key, FILTER_SANITIZE_STRING);
        $ch = \curl_init();
        \curl_setopt($ch, CURLOPT_URL, self::BASEURL ."zones");
        \curl_setopt($ch, CURLOPT_HEADER, 'X-NSONE-Key: '. $clean_key);
        $body = \json_decode(\curl_exec($ch));
        if ($body['message'] === "Unauthorized") {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}