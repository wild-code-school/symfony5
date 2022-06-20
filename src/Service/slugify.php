<?php

namespace App\Service;

class SlugService
{
    public function generate(string $input): string {

        return preg_replace("/\s+/", "", $input);
    }

}
