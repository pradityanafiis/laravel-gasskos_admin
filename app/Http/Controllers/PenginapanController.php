<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Auth;
use Session;

class PenginapanController extends Controller
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
            $request = $this->client->get('http://localhost/penginapan-api/api/penginapan', [
                'query' => ['id_users' => Auth::id()]
            ]);

            $result = json_decode($request->getBody()->getContents(), true);
            return view('penginapan.penginapan', ['penginapan' => $result['data']]);
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return view('penginapan.penginapan', ['penginapan' => null]);
        }
    }

    public function showTambah()
    {
        return view('penginapan.tambah_penginapan');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:35',
            'alamat' => 'required',
            'telepon' => 'required|numeric'
        ]);

        $data = array(
            'id_users' => Auth::id(),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'telepon' => $request->telepon
        );

        try {
            $request = $this->client->post('http://localhost/penginapan-api/api/penginapan', [
                'form_params' => $data
            ]);
            Session::flash('success','Penginapan telah ditambahkan.');
            return redirect('/penginapan/lihat');
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Session::flash('failed','Terjadi kesalahan, penginapan belum ditambahkan.');
            return redirect('/penginapan/lihat');
        }
    }

    public function delete($id_penginapan)
    {
        try {
            $request = $this->client->delete('http://localhost/penginapan-api/api/penginapan', [
                'form_params' => [
                    'id_penginapan' => $id_penginapan
                ]
            ]);
            Session::flash('success','Penginapan telah dihapus.');
            return redirect('/penginapan/lihat');
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Session::flash('failed','Terjadi kesalahan, penginapan belum dihapus.');
            return redirect('/penginapan/lihat');
        }
    }

    public function showUbah($id_penginapan)
    {
        try {
            $request = $this->client->get('http://localhost/penginapan-api/api/penginapan', [
                'query' => ['id_penginapan' => $id_penginapan]
            ]);

            $result = json_decode($request->getBody()->getContents(), true);
            return view('penginapan.ubah_penginapan', ['penginapan' => $result['data'][0]]);
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return redirect('/penginapan/lihat');
        }
    }

    public function update($id_penginapan, Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:35',
            'alamat' => 'required',
            'telepon' => 'required|numeric'
        ]);

        $data = array(
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'telepon' => $request->telepon,
            'id_penginapan' => $id_penginapan
        );

        try {
            $request = $this->client->put('http://localhost/penginapan-api/api/penginapan', [
                'form_params' => $data
            ]);
            Session::flash('success','Penginapan telah diubah.');
            return redirect('/penginapan/lihat');
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Session::flash('failed','Terjadi kesalahan, penginapan belum diubah.');
            return redirect('/penginapan/lihat');
        }
    }
}
