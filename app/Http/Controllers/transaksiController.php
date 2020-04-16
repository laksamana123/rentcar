<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;

class transaksiController extends Controller
{
    public function show(Request $req){
        if(Auth::user()->level == "petugas"){
            $transaksi = DB::table('transaksi')->join('penyewa','penyewa.id','=','transaksi.id_penyewa')
            ->where('transaksi.tgl_trans','>=',$req->tgl_trans)
            ->where('transaksi.tgl_selesai','<=',$req->tgl_selesai)
            ->get();
            
            if($transaksi->count() > 0){

            $data_transaksi = array();
            foreach ($transaksi as $tr){
                
                $grand = DB::table('detail_trans')->where('id_trans','=',$tr->id)
                ->groupBy('id_trans')
                ->select(DB::raw('sum(subtotal) as grandtotal'))
                ->first();
                
                $detail = DB::table('detail_trans')->join('jenis_mobil','detail_trans.id_mobil','=','jenis_mobil.id')
                ->where('id_trans','=',$tr->id)
                ->get();
                

                $data [] = array(
                    'tgl_trans' => $tr->tgl_trans,
                    'nama penyewa' => $tr->nama_penyewa,
                    'alamat' => $tr->alamat,
                    'telp' => $tr->telp,
                    'tgl_selesai' => $tr->tgl_selesai,
                    'grand total' => $grand, 
                    'detail' => $detail
                
                );
                
            }
            return response()->json(compact('data'));
        
    }else{
            $status = 'tidak ada transaksi antara tanggal '.$req->tgl_trans.' sampai dengan tanggal '.$req->tgl_selesai;
            return response()->json(compact('status'));
    }
        }else{
            return Response()->json('Anda Bukan Petugas');
        }
        
}

    public function insert(Request $req){
        if(Auth::user()->level == 'petugas'){
        
        $validator = Validator::make($req->all(),
        [
            'id_penyewa'=>'required',
            'id_petugas'=>'required',
            'tgl_trans'=>'required',
            'tgl_selesai'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = transaksi::create([
            'id_penyewa'=>$req->id_penyewa,
            'id_petugas'=>$req->id_petugas,
            'tgl_trans'=>$req->tgl_trans,
            'tgl_selesai'=>$req->tgl_selesai
            
        ]);
        if($simpan){
            return Response()->json('Data Transaksi berhasil ditambahkan');
        }else{
            return Response()->json('Data Transaksi gagal ditambahkan');
        }
    }else{
        return Response()->json('Anda Bukan Petugas');
    }
    }

    public function update($id,Request $req){
        if(Auth::user()->level == 'petugas'){

        $validator = Validator::make($req->all(),
        [
            'id_penyewa'=>'required',
            'id_petugas'=>'required',
            'tgl_trans'=>'required',
            'tgl_selesai'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah = transaksi::where('id', $id)->update([
            'id_penyewa'=>$req->id_penyewa,
            'id_petugas'=>$req->id_petugas,
            'tgl_trans'=>$req->tgl_trans,
            'tgl_selesai'=>$req->tgl_selesai
        ]);
        if($ubah){
            return Response()->json('Data Transaksi berhasil diubah');
        }else{
            return Response()->json('Data Transaksi gagal diubah');
        }
    }else{
        return Response()->json('Anda Bukan Petugas');
    }
    }

    public function destroy($id){
        if(Auth::user()->level == 'admin'){

        $hapus = transaksi::where('id', $id)->delete();
        if($hapus){
            return Response()->json('Data Transaksi berhasil dihapus');
        }else{
            return Response()->json('Data Transaksi gagal dihapus');
        }
    }else{
        return Response()->json('Anda Bukan Admin');
    }
    }

    
}