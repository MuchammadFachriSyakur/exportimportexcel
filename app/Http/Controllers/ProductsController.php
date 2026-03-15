<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function import()
    {
        $validate = request()->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
        
        $data = Excel::toArray(new ProductsImport, request()->file('file'));
        
        $expectHeader = ['ID', 'Nama Mahasiswa', 'NIM', 'Instansi', 'Alamat', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Dosen Pembimbing', 'Izin Cetak Surat'];
        $rows = $data[0];
        $header = $rows[0];

        if($header !== $expectHeader) {
            return redirect()->back()->with('error', 'File yang diupload tidak sesuai dengan template yang disediakan');
        }else{
            return redirect()->back()->with([
                'success' => 'File berhasil diupload',
                'data' => $rows
            ]);
        }
    }
}