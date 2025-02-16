@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tambah Data Mahasiswa</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admissions.index') }}">Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admissions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama (sesuai ijazah terakhir)*</strong>
                    <input type="text" name="nama_mhs" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Tempat Lahir *</strong>
                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Tanggal Lahir *</strong>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Jenis Kelamin *</strong>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nomor Telepon *</strong>
                    <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Alamat Email *</strong>
                    <input type="email" name="email" class="form-control" placeholder="Alamat Email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Golongan Darah</strong>
                    <input type="text" name="golongan_darah" class="form-control" placeholder="Golongan Darah">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Status Pernikahan *</strong>
                    <input type="text" name="status_pernikahan" class="form-control" placeholder="Status Pernikahan">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Kewarganegaraan</strong>
                    <input type="text" name="kewarganegaraan" class="form-control" placeholder="Kewarganegaraan">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Agama *</strong>
                    <input type="text" name="agama" class="form-control" placeholder="Agama">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Alamat Rumah *</strong>
                    <input type="text" name="alamat_rumah" class="form-control" placeholder="Alamat Rumah">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Unggah E-KTP *</strong>
                    <input type="file" name="ektp" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Unggah Pas Foto Berwarna *</strong>
                    <input type="file" name="foto" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nama instansi/perusahaan *</strong>
                    <input type="text" name="nama_instansi" class="form-control" placeholder="Nama instansi/perusahaan">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Alamat kantor *</strong>
                    <input type="text" name="alamat_kantor" class="form-control" placeholder="Alamat kantor">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Program Studi *</strong>
                    <select name="id_prodi" class="form-control @error('id_prodi') is-invalid @enderror" required>
                        <option value="">Pilih Program Studi</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}" {{ old('id_prodi') == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>ID Kelas *</strong>
                    <input type="text" name="id_kelas" class="form-control" placeholder="ID Kelas">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Status Pendaftaran *</strong>
                    <input type="text" name="status_pendaftaran" class="form-control"
                        placeholder="Status Pendaftaran">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Asal Sekolah *</strong>
                    <input type="text" name="asal_sekolah" class="form-control" placeholder="Asal Sekolah">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nama Sekolah *</strong>
                    <input type="text" name="nama_sekolah" class="form-control" placeholder="Nama Sekolah">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Jurusan Sekolah *</strong>
                    <input type="text" name="jurusan_sekolah" class="form-control" placeholder="Jurusan Sekolah">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Tahun Lulus *</strong>
                    <input type="text" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nomor Ijazah *</strong>
                    <input type="text" name="nomor_ijazah" class="form-control" placeholder="Nomor Ijazah">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Unggah Ijazah *</strong>
                    <input type="file" name="unggah_ijazah" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Unggah NEM *</strong>
                    <input type="file" name="unggah_nem" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nama Perguruan Tinggi Asal *</strong>
                    <input type="text" name="nama_perguruan_asal" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Fakultas *</strong>
                    <input type="text" name="fakultas_asal" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Jurusan / Program Study *</strong>
                    <input type="text" name="jurusan_asal" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nomor Induk Mahasiswa</strong>
                    <input type="text" name="nim_asal_perkuliahan" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Unggah Ijazah</strong>
                    <input type="file" name="ijazah_asal" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Unggah Transkrip Nilai</strong>
                    <input type="file" name="transkrip_asal" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nama Ayah *</strong>
                    <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nama Ibu *</strong>
                    <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Alamat Orang Tua *</strong>
                    <input type="text" name="alamat_ortu" class="form-control" placeholder="Alamat Orang Tua">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Nomor Telpon Orang Tua *</strong>
                    <input type="text" name="telpon_ortu" class="form-control" placeholder="Nomor Telpon Orang Tua">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Pekerjaan Orang Tua</strong>
                    <input type="text" name="pekerjaan_ortu" class="form-control" placeholder="Pekerjaan Orang Tua">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Pendapatan Orang Tua *</strong>
                    <input type="text" name="pendapatan_ortu" class="form-control"
                        placeholder="Pendapatan Orang Tua">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Penanggung Biaya Kuliah *</strong>
                    <input type="text" name="penanggung_biaya" class="form-control"
                        placeholder="Penanggung Biaya Kuliah">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Form Pernyataan *</strong>
                    <input type="file" name="form_pernyataan" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Tanggal Pernyataan *</strong>
                    <input type="date" name="tgl_pernyataan" class="form-control">
                </div>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
