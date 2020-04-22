<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $kategori = Kategori::all();

        return $kategori;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'        => 'required',
            'deskripsi'   => 'required',
            'warna'       => 'required',
            'status'      => 'required',
        ]);

        $req = $request->all();
        
        $data = Kategori::create($req);

        if ( $data) {
            $return = [
                "message" => "Successfully saved data with id : ".$data->id,
                "code"    => 201,
            ];
        } else {
            $return = [
                "message" => "Vailed saved data.",
                "code"   => 404,
            ];
        }

        return $return;
    }


}
