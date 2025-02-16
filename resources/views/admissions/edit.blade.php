@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Mahasiswa</h2>
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
    <form action="{{ route('admissions.update', $admission->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nama_mhs">Nama (sesuai ijazah terakhir)</label>
                    <input type="text" name="nama_mhs" id="nama_mhs" value="{{ $admission->nama_mhs }}"
                        class="form-control" placeholder="Nama Lengkap" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ $admission->tempat_lahir }}"
                        class="form-control" placeholder="Tempat Lahir" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ $admission->tanggal_lahir }}"
                        class="form-control" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                        <option value="Laki-laki" {{ $admission->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="Perempuan" {{ $admission->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="number" name="nomor_telepon" id="nomor_telepon" value="{{ $admission->nomor_telepon }}"
                        class="form-control" placeholder="Nomor Telepon" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ $admission->email }}" class="form-control"
                        placeholder="Alamat Email" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="golongan_darah">Golongan Darah</label>
                    <input type="text" name="golongan_darah" id="golongan_darah"
                        value="{{ $admission->golongan_darah }}" class="form-control" placeholder="Golongan Darah">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="status_pernikahan">Status Pernikahan</label>
                    <select name="status_pernikahan" id="status_pernikahan" class="form-control" required>
                        <option value="Belum Menikah"
                            {{ $admission->status_pernikahan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="Menikah" {{ $admission->status_pernikahan == 'Menikah' ? 'selected' : '' }}>Menikah
                        </option>
                        <option value="Duda/Janda" {{ $admission->status_pernikahan == 'Duda/Janda' ? 'selected' : '' }}>
                            Duda/Janda</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="kewarganegaraan">Kewarganegaraan</label>
                    <select name="kewarganegaraan" id="kewarganegaraan" class="form-control" required>
                        <option value="WNI" {{ $admission->kewarganegaraan == 'WNI' ? 'selected' : '' }}>WNI</option>
                        <option value="WNA" {{ $admission->kewarganegaraan == 'WNA' ? 'selected' : '' }}>WNA</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <input type="text" name="agama" id="agama" value="{{ $admission->agama }}"
                        class="form-control" placeholder="Agama">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="alamat_rumah">Alamat Rumah</label>
                    <input type="text" name="alamat_rumah" id="alamat_rumah" value="{{ $admission->alamat_rumah }}"
                        class="form-control" placeholder="Alamat Rumah" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="ektp">Unggah E-KTP</label>
                    @if ($admission->ektp)
                        <div>
                            <img src="{{ asset('storage/' . $admission->ektp) }}" alt="E-KTP"
                                style="max-width: 200px; height: auto;">
                        </div>
                        <a href="{{ asset('storage/' . $admission->ektp) }}" target="_blank">Lihat E-KTP</a>
                    @endif
                    <input type="file" name="ektp" id="ektp" class="form-control-file">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="foto">Unggah Pas Photo Berwarna</label>
                    @if ($admission->foto)
                        <div>
                            <img src="{{ asset('storage/' . $admission->foto) }}" alt="Pas Photo"
                                style="max-width: 200px; height: auto;">
                        </div>
                        <a href="{{ asset('storage/' . $admission->foto) }}" target="_blank">Lihat Pas Photo</a>
                    @endif
                    <input type="file" name="foto" id="foto" class="form-control-file">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nama_instansi">Nama Instansi/Perusahaan</label>
                    <input type="text" name="nama_instansi" id="nama_instansi"
                        value="{{ $admission->nama_instansi }}" class="form-control"
                        placeholder="Nama Instansi/Perusahaan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="alamat_kantor">Alamat Kantor</label>
                    <input type="text" name="alamat_kantor" id="alamat_kantor"
                        value="{{ $admission->alamat_kantor }}" class="form-control" placeholder="Alamat Kantor">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="id_prodi">Program Studi yang Dipilih</label>
                    <input type="text" name="id_prodi" id="id_prodi" value="{{ $admission->id_prodi }}"
                        class="form-control" placeholder="Program Studi" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="id_kelas">Kelas</label>
                    <input type="text" name="id_kelas" id="id_kelas" value="{{ $admission->id_kelas }}"
                        class="form-control" placeholder="Kelas" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="status_pendaftaran">Status Pendaftaran</label>
                    <input type="text" name="status_pendaftaran" id="status_pendaftaran"
                        value="{{ $admission->status_pendaftaran }}" class="form-control"
                        placeholder="Status Pendaftaran" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="asal_sekolah">Asal Sekolah *</label>
                    <input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ $admission->asal_sekolah }}"
                        class="form-control" placeholder="Asal Sekolah" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nama_sekolah">Nama Asal Sekolah *</label>
                    <input type="text" name="nama_sekolah" id="nama_sekolah" value="{{ $admission->nama_sekolah }}"
                        class="form-control" placeholder="Nama Asal Sekolah" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="jurusan_sekolah">Jurusan *</label>
                    <input type="text" name="jurusan_sekolah" id="jurusan_sekolah"
                        value="{{ $admission->jurusan_sekolah }}" class="form-control" placeholder="Jurusan" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="tahun_lulus">Tahun Lulus *</label>
                    <input type="number" name="tahun_lulus" id="tahun_lulus" value="{{ $admission->tahun_lulus }}"
                        class="form-control" placeholder="Tahun Lulus" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nomor_ijazah">Nomor Ijazah *</label>
                    <input type="text" name="nomor_ijazah" id="nomor_ijazah" value="{{ $admission->nomor_ijazah }}"
                        class="form-control" placeholder="Nomor Ijazah" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="unggah_ijazah">Unggah Ijazah *</label>
                    @if ($admission->unggah_ijazah)
                        <a href="{{ asset('storage/' . $admission->unggah_ijazah) }}" target="_blank">Lihat Ijazah</a>
                    @endif
                    <input type="file" name="unggah_ijazah" id="unggah_ijazah" class="form-control-file" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="unggah_nem">Unggah NEM *</label>
                    @if ($admission->unggah_nem)
                        <a href="{{ asset('storage/' . $admission->unggah_nem) }}" target="_blank">Lihat NEM</a>
                    @endif
                    <input type="file" name="unggah_nem" id="unggah_nem" class="form-control-file" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nama_perguruan_asal">Nama Perguruan Tinggi Asal</label>
                    <input type="text" name="nama_perguruan_asal" id="nama_perguruan_asal"
                        value="{{ $admission->nama_perguruan_asal }}" class="form-control"
                        placeholder="Nama Perguruan Tinggi Asal">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="fakultas_asal">Fakultas</label>
                    <input type="text" name="fakultas_asal" id="fakultas_asal"
                        value="{{ $admission->fakultas_asal }}" class="form-control" placeholder="Fakultas">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="jurusan_asal">Jurusan / Program Study</label>
                    <input type="text" name="jurusan_asal" id="jurusan_asal" value="{{ $admission->jurusan_asal }}"
                        class="form-control" placeholder="Jurusan / Program Study">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nim_asal_perkuliahan">Nomor Induk Mahasiswa Asal Perkuliahan</label>
                    <input type="text" name="nim_asal_perkuliahan" id="nim_asal_perkuliahan"
                        value="{{ $admission->nim_asal_perkuliahan }}" class="form-control"
                        placeholder="Nomor Induk Mahasiswa Asal Perkuliahan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="ijazah_asal">Unggah Ijazah Asal</label>
                    @if ($admission->ijazah_asal)
                        <a href="{{ asset('storage/' . $admission->ijazah_asal) }}" target="_blank">Lihat Ijazah Asal</a>
                    @endif
                    <input type="file" name="ijazah_asal" id="ijazah_asal" class="form-control-file">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="transkrip_asal">Unggah Transkrip Nilai</label>
                    @if ($admission->transkrip_asal)
                        <a href="{{ asset('storage/' . $admission->transkrip_asal) }}" target="_blank">Lihat Transkrip
                            Nilai</a>
                    @endif
                    <input type="file" name="transkrip_asal" id="transkrip_asal" class="form-control-file">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nama_ayah">Nama Ayah Kandung/Wali *</label>
                    <input type="text" name="nama_ayah" id="nama_ayah" value="{{ $admission->nama_ayah }}"
                        class="form-control" placeholder="Nama Ayah Kandung/Wali" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nama_ibu">Nama Ibu Kandung *</label>
                    <input type="text" name="nama_ibu" id="nama_ibu" value="{{ $admission->nama_ibu }}"
                        class="form-control" placeholder="Nama Ibu Kandung" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="alamat_ortu">Alamat Orang Tua *</label>
                    <input type="text" name="alamat_ortu" id="alamat_ortu" value="{{ $admission->alamat_ortu }}"
                        class="form-control" placeholder="Alamat Orang Tua" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="telpon_ortu">Nomor Telpon Orang Tua</label>
                    <input type="number" name="telpon_ortu" id="telpon_ortu" value="{{ $admission->telpon_ortu }}"
                        class="form-control" placeholder="Nomor Telpon Orang Tua">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                    <input type="text" name="pekerjaan_ortu" id="pekerjaan_ortu"
                        value="{{ $admission->pekerjaan_ortu }}" class="form-control" placeholder="Pekerjaan Orang Tua">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="pendapatan_ortu">Pendapatan Orang Tua</label>
                    <input type="number" name="pendapatan_ortu" id="pendapatan_ortu"
                        value="{{ $admission->pendapatan_ortu }}" class="form-control"
                        placeholder="Pendapatan Orang Tua">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="penanggung_biaya">Penanggung Biaya Kuliah</label>
                    <input type="text" name="penanggung_biaya" id="penanggung_biaya"
                        value="{{ $admission->penanggung_biaya }}" class="form-control"
                        placeholder="Penanggung Biaya Kuliah">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="form_pernyataan">Form Pernyataan</label>
                    @if ($admission->form_pernyataan)
                        <a href="{{ asset('storage/' . $admission->form_pernyataan) }}" target="_blank">Lihat Form
                            Pernyataan</a>
                    @endif
                    <input type="file" name="form_pernyataan" id="form_pernyataan" class="form-control-file">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="tgl_pernyataan">Tanggal Pernyataan</label>
                    <input type="date" name="tgl_pernyataan" id="tgl_pernyataan"
                        value="{{ $admission->tgl_pernyataan }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
