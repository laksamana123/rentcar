<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data_mobil;
use Auth;
use Illuminate\Support\Facades\Validator;


class data_mobilController extends Controller
{
    public function show()
    {
        if(Auth::user()->level == 'admin'){
            $dt_jc=data_mobil::get();
            return Response()->json($dt_jc);
        }else{
            return Response()->json('Anda Bukan admin');
        }
    }

    public function insert(Request $req){
        if(Auth::user()->level == 'admin'){
        
        $validator = Validator::make($req->all(),
        [
            'id_jenis'=>'required',
            'nama_mobil'=>'required',
            'plat_nomor'=>'required',
            'merk'=>'required',
            'keterangan'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = data_mobil::create([
            'id_jenis'=>$req->id_jenis,
            'nama_mobil'=>$req->nama_mobil,
            'plat_nomor'=>$req->plat_nomor,
            'merk'=>$req->merk,
            'keterangan'=>$req->keterangan
        ]);
        if($simpan){
            return Response()->json('Data Mobil berhasil ditambahkan');
        }else{
            return Response()->json('Data Mobil gagal ditambahkan');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }

    public function update($id,Request $req){
        if(Auth::user()->level == 'admin'){

        $validator = Validator::make($req->all(),
        [
            'id_jenis'=>'required',
            'nama_mobil'=>'required',
            'plat_nomor'=>'required',
            'merk'=>'required',
            'keterangan'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah = data_mobil::where('id', $id)->update([
            'id_jenis'=>$req->id_jenis,
            'nama_mobil'=>$req->nama_mobil,
            'plat_nomor'=>$req->plat_nomor,
            'merk'=>$req->merk,
            'keterangan'=>$req->keterangan
            
            
        ]);
        if($ubah){
            return Response()->json('Data Mobil berhasil diubah');
        }else{
            return Response()->json('Data Mobil gagal diubah');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }

    public function destroy($id){
        if(Auth::user()->level == 'admin'){

        $hapus = data_mobil::where('id', $id)->delete();
        if($hapus){
            return Response()->json('Data Mobil berhasil dihapus');
        }else{
            return Response()->json('Data Mobil gagal dihapus');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }
}