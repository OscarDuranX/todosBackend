<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request  as BaseController;

class CsstablesController extends BaseController
{
    //
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        return view('csstables',$data);
    }

}
