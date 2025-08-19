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
                                <h3 class="font-weight-bold text-dark">System Settings </h3>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('latepoint.update') }}" method="post" id="frmUpdate">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Bank Account Settings</h3>
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="">Bank Name</label>
                                            <input type="text" value="{{ $latePointSetting['bank_name'] ?? ""}}" name="bank_name" id="bank_name" class="form-control" placeholder="Masukan nama bank" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="">Account Number</label>
                                            <input type="text" value="{{ $latePointSetting['bank_account_number'] ?? ""}}" name="account_number" id="account_number" class="form-control" placeholder="Masukan nomor rekening" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="">Account Name</label>
                                            <input type="text" value="{{ $latePointSetting['bank_account_name'] ?? ""}}" name="account_name" id="account_name" class="form-control" placeholder="Masukan nama pemilik rekening" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Extrabed Price Settings</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="">Harga Extrabed</label>
                                                <input type="number" value="{{ $latePointSetting['extrabed_price'] ?? ""}}" name="extrabed_price" id="extrabed_price" class="form-control" placeholder="Masukan harga extrabed" aria-describedby="helpId">
                                                <i class="showerror"></i>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="">Pajak (%)</label>
                                                <input type="number" value="{{ $latePointSetting['pajak_checkin'] ?? ""}}" name="pajak_checkin" id="pajak_checkin" class="form-control" placeholder="Masukan pajak" aria-describedby="helpId">
                                                <i class="showerror"></i>
                                            </div>
                                        </div>
                                    <h3>Late Point Settings</h3>
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
                                    <h3>Payroll Period</h3>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="">Masukan Setting Periode Penggajian</label>
                                            <select name="payroll_period" id="payroll_period" class="form-control">
                                                <option value="">Pilih Periode</option>
                                                <option value="akhir_bulan" {{ $latePointSetting['payroll_period'] === 'akhir_bulan' ? 'selected' : '' }}>Akhir Bulan</option>
                                                @php
                                                    for ($i = 1; $i < 29; $i++) {
                                                @endphp
                                                    <option value='{{ $i }}' {{ $latePointSetting['payroll_period'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @php
                                                    }
                                                @endphp
                                            </select>

                                            {{-- <input value="{{ $latePointSetting['payroll_period'] ?? "" }}" type="text" name="payroll_period" id="payroll_period" class="form-control" placeholder="Masukan periode payroll setiap bulan" aria-describedby="helpId"> --}}
                                            <i class="showerror"></i>
                                        </div>
                                    </div>
                                    <h3>Pembayaran Lembur</h3>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="">Masukan Biaya Lembur / Jam</label>
                                            <input value="{{ $latePointSetting['ot_price'] ?? "" }}" type="text" name="ot_price" id="ot_price" class="form-control" placeholder="Masukan besar pembayaran lembur / jam" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div>
                                        {{-- <div class="form-group col-lg-6">
                                            <label for="">Masukan Maksimal Lembur Sebulan dalam Jam</label>
                                            <input value="{{ $latePointSetting['ot_max'] ?? "" }}" type="text" name="ot_max" id="ot_max" class="form-control" placeholder="Masukan Maksimal jam lembur sebulan" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- Modal -->
<!-- Tambahkan ini di bagian <head> atau tepat sebelum </body> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('jsSection')
    @include('system_settings.system_setttings_js')
@endsection
