<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>   
</head>
<body>

   <div class="row">
    {{-- <div class="col-sm-6">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width:150px; height:auto;" />
    </div> --}}
    
    <div class="col-sm-6">
        <h2>Invoice Id: {{ $data['checkin_info']['no_invoice'] }} </h2>
    </div>
    <div class="col-sm-6">
        {{-- <img src="{{ asset('img/login-logo.png') }}" /> --}}
    </div>
   </div>
    <div class="container-fluid">
        <hr style="border-color: black; margin-left:-10px" class="col-12 mt-3 mb-2 border-bottom border-3">
    </div>
    <div class="margin-top">
        <table style="width:100%" class="w-full">
            <tr>
                <td style="width: 50%" class="w-half">
                    <div style="padding-bottom:8px">To:</div>
                    <div style="padding-bottom:5px;padding-left: 10px; font-weight:bold"> {{ $data['checkin_info']['name_guest'] }}</div>
                    <div style="padding-bottom:5px;padding-left: 10px"> {{ $data['checkin_info']['guest_contact'] }}</div>  
                    <div style="padding-bottom:5px;padding-left: 10px"> {{ $data['checkin_info']['guest_email'] }} </div> 
                    
                    <br>
                </td>
                <td style="width: 50%" class="w-half">
                    <div style="padding-bottom:8px">From:</div>
                    <div>Resong Residence</div>
                    <div></div>
                    <br>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <table style=" font-size: 0.875rem; width: 100%;">
            <tr style=" background-color: #d3c54a;">
                <th style="color: #ffffff; padding: 0.5rem;">Product Service</th>
                <th style="color: #ffffff; padding: 0.5rem;">Qty</th>
                <th style="color: #ffffff; padding: 0.5rem;">Price</th>
                <th style="color: #ffffff; padding: 0.5rem;">Total</th>
            </tr>       
            @php
                $det = $data['detail_vacant'];
                $TotalVacant = 0;
                foreach ($det as $key) {
                    $total = $key['item_qty']*$key['item_price'];
                    $showTotal = formatCurrency($total);
                    $showPrice = formatCurrency($key['item_price']);  
                        @endphp
                            <tr>
                                <td style="font-size:15px;font-weight:bold;padding-left:20px" colspan="4">Vacant</td>
                            </tr> 
                            <tr >
                                <td style="padding-left:30px;">{{ $key['item_name'] }}</td>
                                <td style="padding-left:20px;">{{ $key['item_qty'] }}</td>  
                                <td align="right" style="padding-left:20px;">{{ $showPrice }}</td>  
                                <td align="right" style="padding-left:20px;">{{ $showTotal }}</td>  
                            </tr>
                        @php
                        $TotalVacant =  $TotalVacant + $total;
                }     
                $det = $data['detail_resto'];
                $TotalResto = 0;
                if(count($det)>0){
                    echo '
                    <tr>
                        <td style="font-size:15px;font-weight:bold;padding-left:20px" colspan="4">Resto</td>
                    </tr> ';
                }
                foreach ($det as $key) {
                    $total = $key['item_qty']*$key['item_price'];
                    $showTotal = formatCurrency($total);
                    $showPrice = formatCurrency($key['item_price']);  
                        @endphp
                           
                            <tr >
                                <td style="padding-left:30px;">{{ $key['item_name'] }}</td>
                                <td style="padding-left:20px;">{{ $key['item_qty'] }}</td>  
                                <td align="right" style="padding-left:20px;">{{ $showPrice }}</td>  
                                <td align="right" style="padding-left:20px;">{{ $showTotal }}</td>  
                            </tr>
                        @php
                        $TotalResto = $TotalResto + $total;
                }               
                $det = $data['detail_laundry'];
                $TotalLaundry = 0;
                if(count($det)>0){
                echo    '<tr>
                            <td style="font-size:15px;font-weight:bold;padding-left:20px" colspan="4">Laundry</td>
                        </tr> ';
                }
                foreach ($det as $key) {
                    $total = $key['item_qty']*$key['item_price'];
                    $showTotal = formatCurrency($total);
                    $showPrice = formatCurrency($key['item_price']);  
                        @endphp
                            <tr >
                                <td style="padding-left:30px;">{{ $key['item_name'] }}</td>
                                <td style="padding-left:20px;">{{ $key['item_qty'] }}</td>  
                                <td align="right" style="padding-left:20px;">{{ $showPrice }}</td>  
                                <td align="right" style="padding-left:20px;">{{ $showTotal }}</td>  
                            </tr>
                        @php
                        $TotalLaundry = $TotalLaundry + $total;
                }               
                $det = $data['detail_extrabed'];
                $TotalExtrabed = 0;
                if(count($det)>0){
                echo    '<tr>
                            <td style="font-size:15px;font-weight:bold;padding-left:20px" colspan="4">Extrabed</td>
                        </tr> ';
                }
                foreach ($det as $key) {
                    $total = $key['item_qty']*$key['item_price'];
                    $showTotal = formatCurrency($total);
                    $showPrice = formatCurrency($key['item_price']);  
                        @endphp
                            <tr >
                                <td style="padding-left:30px;">{{ $key['item_name'] }}</td>
                                <td style="padding-left:20px;">{{ $key['item_qty'] }}</td>  
                                <td align="right" style="padding-left:20px;">{{ $showPrice }}</td>  
                                <td align="right" style="padding-left:20px;">{{ $showTotal }}</td>  
                            </tr>
                        @php
                        $TotalExtrabed = $TotalExtrabed + $total;
                }               
            @endphp
            
        </table>
        @php
            $deposit = $data['checkin_info']['deposit'];
            $discount = $data['detail_checkout']['discount'];
            $grandTotal = $TotalVacant + $TotalResto + $TotalLaundry;
            $show_total = formatCurrency($grandTotal);
            $show_deposit = formatCurrency($data['checkin_info']['deposit']);
            $potonganDiscount = ($grandTotal * $discount) / 100;
            $TotalPotongan = $potonganDiscount + $deposit;
            $ShowTotalSemua = formatCurrency($grandTotal - $TotalPotongan);
            
        @endphp
        <table style=" font-size: 0.875rem; width: 100%;">
            <tr style="background-color: #d3c54a;" >
                <td style="text-align: right">{{ $show_total }}</td>
            </tr>
        </table>
    </div>

  <div class="container">
    <div class="row">
        <div class="col-sm-12 ">
            <div style=" text-align: left">
              
                Deposit : {{ $show_deposit }}
            </div>
            <br>
            <div style=" text-align: left">
                Discount : {{ formatCurrency($potonganDiscount) }} <small> ({{ $data['detail_checkout']['discount'] }}%)</small> 
            </div>
            <br>
           </div>
    </div>
  </div>

    <div class="container-fluid">
        <hr style="border-color: black; margin-left:-10px" class="col-12 mt-3 mb-2 border-bottom border-3">
    </div>
    <div style=" text-align: right; font-weight:bold;">
        Grand Total: {{ $ShowTotalSemua }}
    </div>
    <div class="container-fluid">
        <hr style="border-color: black; margin-left:-10px" class="col-12 mt-3 mb-2 border-bottom border-3">
    </div>
</body>
</html>