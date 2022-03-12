<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function vnDate($date){
    return \Carbon\Carbon::make($date)->format('d/m/Y');
}