<?php

namespace App\Http\Controllers;

use Auth;
use App\Aksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AksiController extends Controller
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
        $data = Aksi::all();

        return $data;
    }

    public function show($id)
    {
        $data = Aksi::find($id);

        return $data;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tipe'          => 'required',
            'judul'         => 'required',
            'deskripsi'     => 'required',
            'tanggal'       => 'required',
            'kategori_id'   => 'required',
            'log_lat'       => 'required',
            'alamat'        => 'required',
            'status'        => 'required',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $req = $request->all();

        if ($request->hasFile('foto')) {
            $ext = $request->foto->getClientOriginalExtension();
            $filename = Str::slug( $req['judul'] , "-").'-'.time().'.'.$ext;
            $file = $request->foto->move(base_path('public/images/foto/'), $filename);
            $req['foto'] = $filename;
        }
        $req['user_id'] = Auth::user()->id;
        
        $data = Aksi::create($req);

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
            'tipe'          => 'required',
            'judul'         => 'required',
            'deskripsi'     => 'required',
            'tanggal'       => 'required',
            'kategori_id'   => 'required',
            'log_lat'       => 'required',
            'alamat'        => 'required',
            'status'        => 'required',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $req = $request->all();

        $dataUpdate = Aksi::find($id);

        if ($request->hasFile('foto')) {
            $ext = $request->foto->getClientOriginalExtension();
            $filename = Str::slug( $req['judul'] , "-").'-'.time().'.'.$ext;
            $file = $request->foto->move(base_path('public/images/foto/'), $filename);

            if ( ! empty($dataUpdate->foto) ) {
                if (file_exists(base_path('public/images/foto/').$dataUpdate->foto)){
                    unlink(base_path('public/images/foto/').$dataUpdate->foto);
                }
            }

            $req['foto'] = $filename;
        }

        
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
        $data = Aksi::find($id);
        if ( ! empty($data->foto) ) {
            if (file_exists(base_path('public/images/foto/').$data->foto)){
                unlink(base_path('public/images/foto/').$data->foto);
            }
        }
        
        if ( Aksi::destroy($id) ) {
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
