<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Admissions;
use App\Models\Programs;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdmissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $admissions = Admissions::select('*');
            return DataTables::of($admissions)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admissions.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('admissions.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })->addIndexColumn()
                ->make(true);
        }

        return view('admissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Programs::all();
        return view('admissions.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mhs' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:10',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|string|email|max:100|unique:admissions',
            'golongan_darah' => 'required|string|max:5',
            'status_pernikahan' => 'required|string|max:20',
            'kewarganegaraan' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'alamat_rumah' => 'required|string|max:255',
            'ektp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'nama_instansi' => 'nullable|string|max:100',
            'alamat_kantor' => 'nullable|string|max:255',
            'id_prodi' => 'required|exists:programs,id',
            'id_kelas' => 'required',
            'status_pendaftaran' => 'required|string|max:50',
            'asal_sekolah' => 'required|string|max:50',
            'nama_sekolah' => 'required|string|max:100',
            'jurusan_sekolah' => 'required|string|max:100',
            'tahun_lulus' => 'required|integer',
            'nomor_ijazah' => 'required|string|max:20',
            'unggah_ijazah' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'unggah_nem' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'nama_perguruan_asal' => 'nullable|string|max:100',
            'fakultas_asal' => 'nullable|string|max:100',
            'jurusan_asal' => 'nullable|string|max:100',
            'nim_asal_perkuliahan' => 'nullable|string|max:20',
            'ijazah_asal' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'transkrip_asal' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'alamat_ortu' => 'required|string|max:255',
            'telpon_ortu' => 'nullable|string|max:20',
            'pekerjaan_ortu' => 'required|string|max:100',
            'pendapatan_ortu' => 'required|string|max:50',
            'penanggung_biaya' => 'required|string|max:100',
            'form_pernyataan' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'tgl_pernyataan' => 'required|date',
        ]);

        // Handle file uploads
        $data = $request->all();

        // Upload KTP
        if ($request->hasFile('ektp')) {
            $ektpPath = $request->file('ektp')->store('public/ektp');
            $data['ektp'] = str_replace('public/', '', $ektpPath);
        }

        // Upload Foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/foto');
            $data['foto'] = str_replace('public/', '', $fotoPath);
        }

        // Upload Ijazah
        if ($request->hasFile('unggah_ijazah')) {
            $ijazahPath = $request->file('unggah_ijazah')->store('public/ijazah');
            $data['unggah_ijazah'] = str_replace('public/', '', $ijazahPath);
        }

        // Upload NEM
        if ($request->hasFile('unggah_nem')) {
            $nemPath = $request->file('unggah_nem')->store('public/nem');
            $data['unggah_nem'] = str_replace('public/', '', $nemPath);
        }

        // Upload Ijazah Asal (if provided)
        if ($request->hasFile('ijazah_asal')) {
            $ijazahAsalPath = $request->file('ijazah_asal')->store('public/ijazah_asal');
            $data['ijazah_asal'] = str_replace('public/', '', $ijazahAsalPath);
        }

        // Upload Transkrip Asal (if provided)
        if ($request->hasFile('transkrip_asal')) {
            $transkripPath = $request->file('transkrip_asal')->store('public/transkrip');
            $data['transkrip_asal'] = str_replace('public/', '', $transkripPath);
        }

        // Upload Form Pernyataan
        if ($request->hasFile('form_pernyataan')) {
            $pernyataanPath = $request->file('form_pernyataan')->store('public/pernyataan');
            $data['form_pernyataan'] = str_replace('public/', '', $pernyataanPath);
        }

        Admissions::create($data);

        return redirect()->route('admissions.index')
            ->with('success', 'Data pendaftaran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admissions $admission)
    {
        return view('admissions.show', compact('admission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admissions $admission)
    {
        return view('admissions.edit', compact('admission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admissions $admission)
    {
        $request->validate([
            'nama_mhs' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:10',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|string|email|max:100|unique:admissions,email,' . $admission->id,
            'golongan_darah' => 'required|string|max:5',
            'status_pernikahan' => 'required|string|max:20',
            'kewarganegaraan' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'alamat_rumah' => 'required|string|max:255',
            'ektp' => 'required|string|max:20|unique:admissions,ektp,' . $admission->id,
            'foto' => 'required|string|max:255',
            'nama_instansi' => 'nullable|string|max:100',
            'alamat_kantor' => 'nullable|string|max:255',
            'id_prodi' => 'required|exists:programs,id',
            'id_kelas' => 'required|exists:classes,id',
            'status_pendaftaran' => 'required|string|max:50',
            'asal_sekolah' => 'required|string|max:50',
            'nama_sekolah' => 'required|string|max:100',
            'jurusan_sekolah' => 'required|string|max:100',
            'tahun_lulus' => 'required|integer',
            'nomor_ijazah' => 'required|string|max:20',
            'unggah_ijazah' => 'required|string|max:255',
            'unggah_nem' => 'required|string|max:255',
            'nama_perguruan_asal' => 'nullable|string|max:100',
            'fakultas_asal' => 'nullable|string|max:100',
            'jurusan_asal' => 'nullable|string|max:100',
            'nim_asal_perkuliahan' => 'nullable|string|max:20',
            'ijazah_asal' => 'nullable|string|max:255',
            'transkrip_asal' => 'nullable|string|max:255',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'alamat_ortu' => 'required|string|max:255',
            'telpon_ortu' => 'nullable|string|max:20',
            'pekerjaan_ortu' => 'required|string|max:100',
            'pendapatan_ortu' => 'required|string|max:50',
            'penanggung_biaya' => 'required|string|max:100',
            'form_pernyataan' => 'required|string|max:255',
            'tgl_pernyataan' => 'required|date',
        ]);

        $admission->update($request->all());

        return redirect()->route('admissions.index')->with('success', 'Admission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admissions $admission)
    {
        $admission->delete();

        return redirect()->route('admissions.index')->with('success', 'Admission deleted successfully.');
    }
}
