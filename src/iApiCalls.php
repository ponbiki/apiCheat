<?php

namespace ponbiki\apiCheat;

interface iApiCalls
{
    const BASEURL = 'https://api.nsone.net/v1/';
    public function keyValidate($key);
}
