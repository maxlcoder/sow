<?php

namespace App\Http\Runner;

use Illuminate\Http\Request;

interface Runner
{
    public function run(Request $request);
}