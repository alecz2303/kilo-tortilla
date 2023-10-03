<?php

namespace App\Http\Controllers;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class ClientesController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function show(Request $request, $id)
    {
        $hashId =Hashids::encode($id);
        $x = Hashids::encode(1);
        echo $hashId;
        echo "<br>".$x;
    }
}
