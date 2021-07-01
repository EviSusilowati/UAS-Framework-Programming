<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hape;
use Codedge\Fpdf\Fpdf\Fpdf;
// use PDF;

class hapeController extends Controller
{
    public function home()
    {
        $hasil = hape::all();
        return view('home', ['data' => $hasil]);
    }
    public function tambah(Request $req)
    {
        $image = $req->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $data = new hape();
        $data->plat = $req->plat;
        $data->merk = $req->merk;
        $data->tipe = $req->tipe;
        $data->profileimage = $imageName;
        $data->save();
        return $this->home();
    }

    public function hapus($req)
    {
        $data = hape::find($req);
        unlink(public_path('images') . '/' . $data->profileimage);
        $data->delete();

        return $this->home();
    }

    public function formUbah($req)
    {
        $hasil = hape::find($req);
        return view('form-ubah-hape', ['data' => $hasil]);
    }
    public function ubah(Request $req)
    {
        $image = $req->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        $data =  hape::find($req->id);
        $data->plat = $req->plat;
        $data->merk = $req->merk;
        $data->tipe = $req->tipe;
        $data->profileimage = $imageName;
        $data->save();
        return $this->home();

        
    }


    public function downloadPDF(Fpdf $pdf)
    {

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->MultiCell(0, 10, 'Report Data surat', 0, 'C');
        $pdf->Ln();
        // header
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(20, 10, 'No', 1, 0, 'C');
        $pdf->Cell(50, 10, 'No. surat', 1, 0, 'C');
        $pdf->Cell(50, 10, 'tanggal', 1, 0, 'C');
        $pdf->Cell(50, 10, 'pengirim', 1, 0, 'C');
        $pdf->Ln();
        // data
        $data = hape::all();

        $i = 1;
        foreach ($data as $d) {

            $pdf->Cell(20, 10, $i++, 1, 0, 'C');
            $pdf->Cell(50, 10, $d['plat'], 1, 0, 'C');
            $pdf->Cell(50, 10, $d['merk'], 1, 0, 'C');
            $pdf->Cell(50, 10, $d['tipe'], 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->Output();
        exit;
    }

    // public function downloadPDF(Request $req){
    //     $hasil = hape::all();
    //     $pdf = PDF::loadView('home', ['data' => $hasil]);
    //     return $pdf->download('report_laporan.pdf');
    // }
}
