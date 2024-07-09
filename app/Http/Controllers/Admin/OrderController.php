<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    private $DB_Order;

    public function __construct()
    {
        $this->DB_Order = "orders";
    }
}
