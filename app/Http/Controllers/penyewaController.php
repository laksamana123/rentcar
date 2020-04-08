<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\penyewa;
use Auth;
use Illuminate\Support\Facades\Validator;


class penyewaController extends Controller
{
    public function show()
    {
        if(Auth::user()->level == 'admin'){
            $dt_jc=penyewa::get();
            return Response()->json($dt_jc);
        }else{
            return Response()->json('Anda Bukan admin');
        }
    }

    public function insert(Request $req){
        if(Auth::user()->level == 'admin'){
        
        $validator = Validator::make($req->all(),
        [
            'nama_penyewa'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'foto_ktp'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = penyewa::create([
            'nama_pelanggan'=>$req->nama_pelanggan,
            'alamat_pelanggan'=>$req->alamat_pelanggan,
            'telp'=>$req->telp,
            'no_ktp'=>$req->no_ktp,
            'foto'=>$req->foto
        ]);
        if($simpan){
            return Response()->json('Data Pelanggan berhasil ditambahkan');
        }else{
            return Response()->json('Data Pelanggan gagal ditambahkan');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }

    public function update($id,Request $req){
        if(Auth::user()->level == 'admin'){

        $validator = Validator::make($req->all(),
        [
            'nama_penyewa'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'foto_ktp'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah = penyewa::where('id', $id)->update([
            'nama_penyewa'=>$req->nama_penyewa,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'foto_ktp'=>$req->foto_ktp
            
            
        ]);
        if($ubah){
            return Response()->json('Data Pelanggan berhasil diubah');
        }else{
            return Response()->json('Data Pelanggan gagal diubah');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }

    public function destroy($id){
        if(Auth::user()->level == 'admin'){

        $hapus = penyewa::where('id', $id)->delete();
        if($hapus){
            return Response()->json('Data Pelanggan berhasil dihapus');
        }else{
            return Response()->json('Data Pelanggan gagal dihapus');
        }
    }else{
        return Response()->json('Anda Bukan admin');
    }
    }
}