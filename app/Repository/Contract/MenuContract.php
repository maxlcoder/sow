<?php

namespace App\Repository\Contract;

interface MenuContract
{
    public function isNameExist(string $name) :bool;
}
