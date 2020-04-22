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

    public function show($id)
    {
        $kategori = Kategori::find($id);

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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'        => 'required',
            'deskripsi'   => 'required',
            'warna'       => 'required',
            'status'      => 'required|boolean',
        ]);

        $req = $request->all();

        $dataUpdate = Kategori::find($id);
        
        if ( $dataUpdate->update($req) ) {
            $return = [
                "message" => "Successfully update data with id : ".$dataUpdate->id,
                "code"    => 201,
            ];
        } else {
            $return = [
                "message" => "Vailed updated data.",
                "code"   => 404,
            ];
        }

        return $return;
    }

    public function destroy($id)
    {
        if ( Kategori::destroy($id) ) {
            $return = [
                "message" => "Data successfully removed",
                "code"    => 201,
            ];
        } else {
            $return = [
                "message" => "Vailed remove data.",
                "code"   => 404,
            ];
        }

        return $return;
    }


}
