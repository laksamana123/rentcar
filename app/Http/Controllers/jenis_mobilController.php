<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jenis_mobil;
use Auth;
use Illuminate\Support\Facades\Validator;


class jenis_mobilController extends Controller
{
    public function show()
    {
        if(Auth::user()->level == 'admin'){
            $dt_jc=jenis_mobil::get();
            return Response()->json($dt_jc);
        }else{
            return Response()->json('Anda Bukan admin');
        }
    }

    public function insert(Request $req){
        if(Auth::user()->level == 'admin'){
        
        $validator = Validator::make($req->all(),
        [
            'jenis_mobil'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = jenis_mobil::create([
            'jenis_mobil'=>$req->jenis_mobil
        ]);
        if($simpan){
            return Response()->json('Data Jenis Mobil berhasil ditambahkan');
        }else{
            return Response()->json('Data Jenis Mobil gagal ditambahkan');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }

    public function update($id,Request $req){
        if(Auth::user()->level == 'admin'){

        $validator = Validator::make($req->all(),
        [
            'jenis_mobil'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah = jenis_mobil::where('id', $id)->update([
            'jenis_mobil'=>$req->jenis_mobil
            
            
        ]);
        if($ubah){
            return Response()->json('Data Jenis Mobil berhasil diubah');
        }else{
            return Response()->json('Data Jenis Mobil gagal diubah');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }

    public function destroy($id){
        if(Auth::user()->level == 'admin'){

        $hapus = jenis_mobil::where('id', $id)->delete();
        if($hapus){
            return Response()->json('Data Jenis Mobil berhasil dihapus');
        }else{
            return Response()->json('Data Jenis Mobil gagal dihapus');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }
}