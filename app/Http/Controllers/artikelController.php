<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\artikel;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class artikelController extends Controller
{
    public function index(Request $request) {
        try {
            $kategori = $request->query('kategori');
            $dataArtikel = artikel::when($kategori, function ($query, $kategori) {
                return $query->where('kategori', $kategori);
            })->get();
    
            $dataArtikel->transform(function($artikel) { 
                // Format created_at ke format 'Hari, tanggal-nama bulan-yyyy'
                $artikel->formatted_created_at = Carbon::parse($artikel->created_at)->translatedFormat('l, d F Y');
                return $artikel;
            });
    
            return ResponseFormatter::success($dataArtikel, 'Berhasil Mendapatkan Data Artikel!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), "Data gagal diproses. Kesalahan Server", 500);
        }
    }    

    public function viewArtikel(Request $request) {
        if($request->ajax()) {
            try{
                $dataArtikel = artikel::get();

                $dataArtikel->transform(function($artikel) {
                    // Format 'created_at' jika sudah merupakan objek Carbon
                    $artikel->created_at = Carbon::parse($artikel->created_at)->format('l, d F Y');
                    return $artikel;
                });

                return ResponseFormatter::success($dataArtikel, 'Berhasil Mendapatkan Data Artikel!');
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return ResponseFormatter::error($e->getMessage(), "Data gagal diproses. Kesalahan Server", 500);
            }
        }
        return view('admin.artikel');
    }

    protected function parseEncryptedInput($input, $isHex = false) {
        if (!$input) return $input;
        
        // Cek jika format Hex (WAF Bypass)
        if ($isHex || (is_string($input) && ctype_xdigit($input) && (strlen($input) % 2 === 0) && strlen($input) >= 4)) {
            $bin = @hex2bin($input);
            if ($bin !== false) {
                return $bin;
            }
        }
        
        // Cek jika format Base64 (Fallback)
        if (is_string($input) && base64_encode(base64_decode($input, true)) === $input) {
            $b64 = @base64_decode($input, true);
            if ($b64 !== false) {
                return $b64;
            }
        }
        
        return $input;
    }

    protected function getExtractedDeskripsi(Request $request) {
        if ($request->is_chunked == '1' && $request->has('deskripsi_chunks')) {
            $raw = implode('', (array) $request->deskripsi_chunks);
            if ($request->is_hex == '1') {
                $bin = @hex2bin($raw);
                if ($bin !== false) {
                    return $bin;
                }
            }
            return $raw;
        }

        return $this->parseEncryptedInput($request->deskripsi, $request->is_hex == '1');
    }

    public function storeArtikel(Request $request) {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'gambar' => 'required|max:3000|mimes:png,jpg',
            'video' => 'nullable|string|url',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(null,$validator->errors(),422);
        };

        try {
            $deskripsi = $this->getExtractedDeskripsi($request);

            if($request->file('gambar')){
                $nameGambar = time() . '_' . $request->file('gambar')->getClientOriginalName();
                Storage::putFileAs('public/artikel', $request->file('gambar'), $nameGambar);
            }
            
            $data = artikel::create([
                'judul' => $request->judul,
                'kategori' => $request->kategori,
                'deskripsi' => $deskripsi,
                'gambar' => $nameGambar,
                'url_video' => $request->video,
            ]);

            return ResponseFormatter::success($data, "Data Artikel Berhasil Dibuat!");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), "Data gagal disimpan. Kesalahan Server", 500);
        }
    }

    public function updateArtikel(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'judul' => 'string|max:255',
            'kategori' => 'string|max:50',
            'deskripsi' => 'string',
            'gambar' => 'max:3000|mimes:png,jpg',
            'video' => 'nullable|string|url',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(null,$validator->errors(),422);
        };

        try {
            $data = artikel::find($id);
            $deskripsi = $this->getExtractedDeskripsi($request);

            $updateData = [
                'judul' => $request->judul, 
                'kategori' => $request->kategori, 
                'deskripsi' => $deskripsi,
                'url_video' => $request->video
            ];

            if ($request->file('gambar')) {
                // Hapus gambar lama jika ada
                if ($data->gambar) {
                    Storage::delete('public/artikel/' . $data->gambar);
                }
                
                // Simpan gambar baru
                $nameGambar = time() . '_' . $request->file('gambar')->getClientOriginalName();
                $request->file('gambar')->storeAs('public/artikel', $nameGambar);
            
                // Tambahkan nama gambar ke data yang akan diupdate
                $updateData['gambar'] = $nameGambar;
            }
            
            // Update data artikel
            $data->update($updateData);

            return ResponseFormatter::success($data, "Data Artikel Berhasil Diubah!");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), "Data gagal disimpan. Kesalahan Server", 500);
        }
    }

    public function deleteArtikel($id){
        try{
            $data = artikel::find($id);
            if ($data->gambar) {
                Storage::delete('public/artikel/' . $data->gambar);
            }
            $data->delete();
            return ResponseFormatter::success("Data Artikel Berhasil Dihapus!");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), "Data gagal dihapus. Kesalahan Server", 500);
        }
    }
}
