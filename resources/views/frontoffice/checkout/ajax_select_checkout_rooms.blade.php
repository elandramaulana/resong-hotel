@forelse ($Data as $dt)
<style>
    .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: #4b5aea !important;
    }
    a.disabled {
  pointer-events: none;
  cursor: default;
}
</style>
<div class="card shadow mt-4">
    <div class="card-body">
        <div class="standard-single">
            <div class="container d-flex justify-content-center">
                <div style="background-color:#D9D9D9; border:solid; border-radius:10px;" class="col-sm-12 d-flex justify-content-center">
                    <h4 class="text-dark">{{ $dt['room_type'] }} (@ {{ $dt['room_price'] }})</h4>
                </div>
            </div>
            <div class="container d-flex justify-content-center">
                <div class="row mt-4">
                    @foreach ($dt['detail_room'] as $dr)
                    <div class="col-sm-2">
                        <button class="btn btn-primary">
                            <a data-toggle="tooltip" data-placement="top"  title="{{ $dr['room_status'] }}" href="{{route('checkout.detail', $dr['checkin_id'])}}">{{ $dr['room_no'] }}</a>
                        </button>
                    </div>        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@empty
    <p>Tidak ada kamar ditemukan</p>
@endforelse