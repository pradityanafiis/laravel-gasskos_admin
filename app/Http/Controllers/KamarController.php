<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Auth;
use Session;

class KamarController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client();
    }
    
    public function index()
    {
        try {
            $request = $this->client->get('http://localhost/penginapan-api/api/kamar', [
                'query' => ['id_users' => Auth::id()]
            ]);

            $result = json_decode($request->getBody()->getContents(), true);
            return view('kamar.kamar', ['kamar' => $result['data']]);

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return view('kamar.kamar', ['kamar' => null]);
        }
    }

    public function showTambah()
    {
        try {
            $request = $this->client->get('http://localhost/penginapan-api/api/penginapan', [
                'query' => ['id_users' => Auth::id()]
            ]);

            $result = json_decode($request->getBody()->getContents(), true);
            return view('kamar.tambah_kamar', ['penginapan' => $result['data']]);
                        
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return view('kamar.tambah_kamar', ['penginapan' => null]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'penginapan' => 'required',
            'tipe' => 'required',
            'harga' => 'required|numeric',
            'fasilitas' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        $data = array(
            'id_penginapan' => $request->penginapan,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'fasilitas' => $request->fasilitas,
            'kapasitas' => $request->kapasitas
        );

        try {
            $request = $this->client->post('http://localhost/penginapan-api/api/kamar', [
                'form_params' => $data
            ]);
            Session::flash('success','Kamar telah ditambahkan.');
            return redirect('/kamar/lihat');
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Session::flash('failed','Terjadi kesalahan, kamar belum ditambahkan.');
            return redirect('/kamar/lihat');
        }
    }

    public function delete($id_kamar)
    {
        try {
            $request = $this->client->delete('http://localhost/penginapan-api/api/kamar', [
                'form_params' => [
                    'id_kamar' => $id_kamar
                ]
            ]);
            Session::flash('success','Kamar telah dihapus.');
            return redirect('/kamar/lihat');
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Session::flash('failed','Terjadi kesalahan, kamar belum dihapus.');
            return redirect('/kamar/lihat');
        }
    }

    public function showUbah($id_kamar)
    {
        try {
            $request1 = $this->client->get('http://localhost/penginapan-api/api/kamar', [
                'query' => ['id_kamar' => $id_kamar]
            ]);
            $result1 = json_decode($request1->getBody()->getContents(), true);

            $request2 = $this->client->get('http://localhost/penginapan-api/api/penginapan', [
                'query' => ['id_users' => Auth::id()]
            ]);
            $result2 = json_decode($request2->getBody()->getContents(), true);

            return view('kamar.ubah_kamar', ['kamar' => $result1['data'][0], 'penginapan' => $result2['data']]);
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return redirect('/kamar/lihat');
        }
    }

    public function update($id_kamar, Request $request)
    {
        $this->validate($request, [
            'penginapan' => 'required',
            'tipe' => 'required',
            'harga' => 'required|numeric',
            'fasilitas' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        $data = array(
            'id_penginapan' => $request->penginapan,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'fasilitas' => $request->fasilitas,
            'kapasitas' => $request->kapasitas,
            'id_kamar' => $id_kamar
        );

        try {
            $request = $this->client->put('http://localhost/penginapan-api/api/kamar', [
                'form_params' => $data
            ]);
            Session::flash('success','Kamar telah diubah.');
            return redirect('/kamar/lihat');
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Session::flash('failed','Terjadi kesalahan, kamar belum diubah.');
            return redirect('/kamar/lihat');
        }
    }
}
