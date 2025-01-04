@extends('layouts.dashboard_layout')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


<section class="mt-5">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="font-weight-bold text-dark">Daftar Presensi Divisi : {{ $Divisions['d_nama'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Filter Divisi -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="divisi" class="form-label">Divisi</label>
                                    <input type="text" class="form-control" placeholder="Nama Divisi" readonly value="{{ $Divisions->d_nama }}">
                                </div>
                            </div>

                            <!-- Filter Shift -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="shift" class="form-label">Shift</label>
                                    <select name="shift_select2" class="form-control" id="shift_select2" >

                                    </select>
                                </div>
                            </div>

                            <!-- Filter Tanggal -->
                            {{-- <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Date</label>
                                    <input name="tanggal_absen" type="date" class="form-control" id="tanggal">
                                </div>
                            </div> --}}

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Pilih Tanggal</label>
                                    <input type="date" class="form-control" name="daterange" value="{{ request('date', date('Y-m-d')) }}" id="daterange">
                                    <x-input-error :messages="$errors->get('tanggal_absen')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="dataAbsensiTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Shift</th>
                                        <th>Schedule In</th>
                                        <th>Punch In</th>
                                        <th>Schedule Out</th>
                                        <th>Punch Out</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($KaryawanData as $Karyawan)
                                    @php
                                        $selectedShift = $Karyawan['shift_id'] ?? $Karyawan['real_shift_id'];
                                    @endphp
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $Karyawan['k_nama'] }}</td>
                                            <td>
                                                <select name="shift_id[]" class="shift_id" data-date="{{ $date }}" data-id="{{ $Karyawan['karyawan_id'] }}">
                                                    @foreach ($dataShift as $shift)
                                                        <option value="{{ $shift['id'] }}"
                                                            {{ $selectedShift == $shift['id'] ? 'selected' : '' }}>
                                                            {{ $shift['s_nama'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>{{ $Karyawan['s_clock_in'] }}</td>
                                            <td>{{ date('H:i:s', strtotime($Karyawan['kh_clock_in'])) }}</td>
                                            <td>{{ $Karyawan['s_clock_out'] }}</td>
                                            <td>{{ date('H:i:s', strtotime($Karyawan['kh_clock_out'])) }}</td>

                                            <td>
                                                @if($Karyawan['kh_status']=='LATE')
                                                    <i class="badge badge-danger">{{ $Karyawan['kh_status'] }}</i>
                                                @else
                                                    <i class="badge badge-success">{{ $Karyawan['kh_status'] }}</i>
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- Modal -->
<div class="modal fade" id="modalSettings" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Pengaturan Point Keterlambatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('latepoint.update') }}" method="post" id="frmUpdate">
            <div class="row">
                <h6 class="font-weight-bold text-dark">Checkpoint I</h6>
                <div class="form-group col-lg-6">
                    <label for="">Keterlambatan (Menit)</label>
                    <input type="number" value="{{ $latePointSetting['first_late'] ?? ""}}" name="first_late" id="first_late" class="form-control" placeholder="Masukan lama keterlambatan dalam menit" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Point Keterlambatan</label>
                    <input type="number" value="{{ $latePointSetting['first_latepoint'] ?? "" }}" name="first_latepoint" id="first_latepoint" class="form-control" placeholder="Masukan jumlah keterlambatan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
            </div>
            <div class="row">
                <h6 class="font-weight-bold text-dark">Checkpoint II</h6>
                <div class="form-group col-lg-6">
                    <label for="">Keterlambatan (Menit)</label>
                    <input type="number" name="second_late" value="{{ $latePointSetting['second_late'] ?? "" }}" id="second_late" class="form-control" placeholder="Masukan lama keterlambatan dalam menit" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Point Keterlambatan</label>
                    <input type="number" name="second_latepoint" value="{{ $latePointSetting['second_latepoint'] ?? "" }}" id="second_latepoint" class="form-control" placeholder="Masukan jumlah keterlambatan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
            </div>
            <div class="row">
                <h6 class="font-weight-bold text-dark">Checkpoint III</h6>
                <div class="form-group col-lg-6">
                    <label for="">Keterlambatan (Menit)</label>
                    <input type="number" name="third_late" value="{{ $latePointSetting['third_late'] ?? "" }}" id="third_late" class="form-control" placeholder="Masukan lama keterlambatan dalam menit" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Point Keterlambatan</label>
                    <input type="number" name="third_latepoint" value="{{ $latePointSetting['third_latepoint'] ?? "" }}" id="third_latepoint" class="form-control" placeholder="Masukan jumlah keterlambatan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
            </div>
            <div class="row">
                <h6 class="font-weight-bold text-dark">Potongan Gaji Keterlambatan</h6>
                <div class="form-group col-lg-6">
                    <label for="">Besar Potongan (Rp)</label>
                    <input value="{{ $latePointSetting['besar_potongan'] ?? "" }}" type="number" name="besar_potongan" id="besar_potongan" class="form-control" placeholder="Masukan besar potongan keterlambatan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Per Point Keterlambatan</label>
                    <input value="{{ $latePointSetting['besar_point'] ?? "" }}" type="number" name="besar_point" id="besar_point" class="form-control" placeholder="Masukan jumlah point perpotongan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-submit">Save changes</button>
        </div>
        @csrf
    </form>
      </div>
    </div>
  </div>
<!-- Tambahkan ini di bagian <head> atau tepat sebelum </body> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('jsSection')
    @include('team_management.presensi.team_presensi_js')
@endsection
