<?php

namespace App\Repositories\Interfaces;

interface HttpClientRepositoryInterface
{
    public function get_xml($url, $zip);

}