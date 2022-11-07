<?php

namespace App\Http\Runner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

interface Runner
{
    public function run(FormRequest|Request $request);
}
