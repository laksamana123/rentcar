<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\detail_trans;
use App\jenis_mobil;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;

class detail_transController extends Controller
{
    public function show()
    {
        if(Auth::user()->level == 'petugas'){
            $dt_detail=detail_trans::get();
            return Response()->json($dt_detail);
        }else{
            return Response()->json('Anda Bukan petugas');
        }
    }

    public function insert(Request $req){
        if(Auth::user()->level == 'petugas'){
        
        $validator = Validator::make($req->all(),
        [
            'id_trans'=>'required',
            'id_mobil'=>'required',
            'qty'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $harga = jenis_mobil::where('id',$req->id_mobil)->first();
        $subtotal = $harga->harga_sewa * $req->qty;

        $simpan = detail_trans::create([
            'id_trans'=> $req->id_trans,
            'id_mobil'=> $req->id_mobil,
            'subtotal'=> $subtotal,
            'qty'=> $req->qty
            
        ]);
        if($simpan){
            return Response()->json('Data Detail berhasil ditambahkan');
        }else{
            return Response()->json('Data Detail gagal ditambahkan');
        }
    }else{
        return Response()->json('Anda Bukan petugas');
    }
    }

    public function update($id,Request $req){
        if(Auth::user()->level == 'petugas'){

        $validator = Validator::make($req->all(),
        [
            'id_trans'=>'required',
            'id_mobil'=>'required',
            'qty'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $harga = jenis_mobil::where('id',$req->id_mobil)->first();
        $subtotal = $harga->harga_sewa * $req->qty;

        $ubah = detail_trans::where('id', $id)->update([
            'id_trans'=> $req->id_trans,
            'id_mobil'=> $req->id_mobil,
            'subtotal'=> $subtotal,
            'qty'=> $req->qty
        ]);
        if($ubah){
            return Response()->json('Data Detail Transaksi berhasil diubah');
        }else{
            return Response()->json('Data Detail Transaksi gagal diubah');
        }
    }else{
        return Response()->json('Anda Bukan petugas');
    }
    }

    public function destroy($id){
        if(Auth::user()->level == 'petugas'){

        $hapus = detail_transaksi::where('id', $id)->delete();
        if($hapus){
            return Response()->json('Data Detail Transaksi berhasil dihapus');
        }else{
            return Response()->json('Data Detail Transaksi gagal dihapus');
        }
    }else{
        return Response()->json('Anda Bukan petugas');
    }
    }

}
