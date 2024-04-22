@extends('layouts.dashboard_layout')

@section('content')

<section id="speedy-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Edit Clean Room</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

            <div class="row">
                <div class="col-sm-4">
                    <h2>Room Number: {{ $room->room_no }}</h2>
                </div>

            </div>

                <form action="{{ route('cleaningroom.history') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">

                         <div class="mb-3 row">
                                <!-- Tanggal Pembersihan -->

                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Tanggal</label>
                                <input name="tanggal_cleaning" value="" type="date" class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)" readonly>
                            </div>
                        </div>

                            
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                        @php
                            $showJam = date("H:i");
                        @endphp
                            <!-- Jam -->
                            <div class="mb-3">
                                <label for="jam" class="form-label">Jam</label>
                                <input name="jam_cleaning" value="{{ $showJam }}" type="text" class="form-control" id="jam" readonly>
                            </div>
                            
                        </div>

                        <input type="text" value="{{ $room->id }}" name="room_id" id="" hidden>
                        <input type="text" value="{{ $room->room_type }}" name="room_type" id="" hidden>
                        <input type="text" value="{{ $room->room_no }}" name="room_no" id="" hidden>


                         <!-- PIC -->
                         <div class="mb-3">
                                <label for="nama" class="form-label">PIC(House Keeping)</label>
                                <input name="pic_cleaning" value="" type="text" class="form-control" id="nama" >
                                <x-input-error :messages="$errors->get('pic_cleaning')" class="mt-2" />
                                    
                            </div>

                            <div class="mb-3">
                                <label for="Channel" class="form-label">Status</label>
                                <select style="background-color: rgb(81, 196, 81)" name="status" class="form-control" id="channel">
                                    {{-- <option style="color: red;" value="VACANT DIRTY">Waiting</option> --}}
                                    <option style="color: black" value="VACANT READY">Make it Done</option>
                                </select>
                            </div>

                        <div class="mt-4 mb-3 d-flex justify-content-start ">
                            <div class="">
                                <button type="submit" class="btn submit-btn mr-5">
                                    Simpan
                                </button>
                            </div>
                        </div>

                    </div>

                   <!-- Scripnya ada di view dashboard_layout.blade.php -->
                    <div class="alert alert-success mt-3" role="alert" id="successAlert" style="display:none;">
                        "Nama" at Room "Nomor room" Checked in Succesfully
                    </div>

                    <div class="alert alert-danger mt-3" role="alert" id="errorAlert" style="display:none;">
                        Failed To Sumbit
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</section>


<script>
    // Fungsi untuk mengatur nilai input menjadi tanggal dan waktu saat ini
    function setNowDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var formattedDate = year + '-' + month + '-' + day;

        return formattedDate;
    }

    // Mendapatkan elemen input
    var checkinTimeInput = document.getElementById('checkinTime');

    // Mengatur nilai input menjadi waktu saat ini saat halaman dimuat
    checkinTimeInput.value = setNowDateTime();
</script>




@endsection