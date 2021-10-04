<?php

namespace App\Services;

interface TaggingModel
{
    public function getRouteKeyName();

    public function tags();
}
