<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resong Hotel Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('assets/img/web-icon.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('assets/img/web-icon.png') }}" rel="apple-touch-icon" sizes="16x16">

    <!-- Custom styles for this template-->
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('assets/waitMe/waitMe.min.css')}}" rel="stylesheet">
    <link href="{{asset('style.css')}}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        .mt-2{
            color: red;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav nav-bg sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
                <div class="sidebar-brand-icon">
                    <img width="70" src="{{asset('assets/img/web-icon.png')}}" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">
                    <img width="100" src="{{asset('assets/img/resong-text.png')}}" alt="">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i  class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                FRONT OFFICE
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Check-In</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('checkin.normal')}}">Normal</a>
                        <a class="collapse-item" href="{{route('checkin.speedy')}}">Speedy</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Check-out -->
             <li class="nav-item">
                <a class="nav-link" href="{{route('checkout.list')}}">
                <i class="fas fa-fw fa-door-open"></i>
                    <span>Check-Out</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-desktop"></i>
                    <span>Reservation</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('booking')}}">Booking</a>
                        <a class="collapse-item" href="{{route('reservation.list')}}">Reservation List</a>
                        <a class="collapse-item" href="{{route('cancel_reservation_list')}}">Cancel Reservation</a>
                        <a class="collapse-item" href="{{route('noshow_reservation_list')}}">No Show Reserve</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Utilities Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGuest"
                    aria-expanded="true" aria-controls="collapseGuest">
                    <i class="fas fa-user"></i>
                    <span>Guest</span>
                </a>
                <div id="collapseGuest" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('inhouse.list')}}">In-house Guest</a>
                        <a class="collapse-item" href="{{route('guest_database')}}">Guest Database</a>
                    </div>
                </div>
            </li>

             <!-- Divider -->
             <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                BACK OFFICE
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <!-- <hr class="sidebar-divider d-none d-md-block"> -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('template/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

         

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <!-- Script for table -->
<script>
    $(document).ready(function () {
        $('#checkInTable'). DataTable();
        $('#speedyCheckInTable'). DataTable();
        $('#checkOutTable').DataTable();
        $('#countryTable').DataTable();
        $('#ProvinceTable').DataTable();
        $('#cityTable').DataTable();
        // $('#reservationListTable').DataTable();
        $('#cancelReservationListTable').DataTable();
        $('#inhouseGuest').DataTable();
        $('#guestDatabase').DataTable();
        $('#listServiceGuestFood').DataTable();
        $('#listServiceGuestDrinks').DataTable();
        $('#listServiceGuestLaundry').DataTable();
        $('#listServiceGuestOther').DataTable();
        $('#listServiceOrder').DataTable();
        $('#GuestDatabaseTable').DataTable();
        $('#historyGuestTable').DataTable();
    });
</script>

<!-- Alert Form -->

<script>
    $(document).ready(function(){
        // $('form').submit(function(e){
        //     e.preventDefault();  // Mencegah formulir untuk melakukan submit sebenarnya
            
        //     // Simpan URL formulir
        //     var formAction = $(this).attr('action');
            
        //     // Kirim formulir menggunakan AJAX
        //     $.ajax({
        //         type: "POST",
        //         url: formAction,
        //         data: $(this).serialize(),
        //         success: function(response) {
        //             // Tangani respons sukses
        //             $('#successAlert').show();
        //             $('#errorAlert').hide();
        //             // Tambahan: Tambahkan logika lain yang perlu dilakukan setelah submit berhasil
        //         },
        //         error: function(error) {
        //             // Tangani respons gagal
        //             $('#errorAlert').show();
        //             $('#successAlert').hide();
        //             // Tambahan: Tambahkan logika lain yang perlu dilakukan setelah submit gagal
        //         }
        //     });
        // });
    });
</script>

<!-- Script for date field -->
<script>
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
</script>


<!-- Script to qty and price service -->

<script>
    // Event listener untuk menghitung total saat nilai input berubah
    $(document).on('input', '.quantity-input', function () {
        calculateTotal($(this));
    });

    // Event listener untuk menghitung total saat tombol "Select" diklik
    $(document).on('click', '.calculate-btn', function () {
        calculateTotal($(this).closest('tr').find('.quantity-input'));
    });

    // Fungsi untuk menghitung total
    function calculateTotal(input) {
        // Ambil nilai quantity
        const quantity = input.val();

        // Ambil nilai unit price dari elemen terkait
        const unitPriceText = input.closest('tr').find('.unit-price').text();
        const unitPrice = parseFloat(unitPriceText.replace('Rp', '').replace(',', ''));

        // Hitung total
        const total = quantity * unitPrice;

        // Tampilkan total di kolom Total
        input.closest('tr').find('.total').text('Rp' + total.toLocaleString());
    }
</script>


<!-- Scrip to add menu to order table -->
<script>
     $(document).ready(function () {
        $(".add-button").on("click", function () {
            var itemName = $(this).data("item");
            var qty = 1; 
            var unitPriceString = $("#listServiceGuestFood tbody tr:contains('" + itemName + "') td:eq(2)").text().replace('Rp', '').replace(',', '');
            
            // Gunakan parseFloat untuk mengkonversi string ke angka
            var unitPrice = parseFloat(unitPriceString) || 0; // Jika tidak dapat dikonversi, beri nilai default 0



            // Tambahkan baris ke tabel pesanan
            $("#listServiceOrder tbody").append(
                "<tr>" +
                "<td>" + 'INV-0000121' + "</td>" +   
                "<td>" + itemName + "</td>" +
                "<td><input style='width: 50px;' type='number' class='quantity-input' value='" + qty + "'></td>" +
                "<td class='unit-price'>Rp" + unitPrice + "</td>" +
                "<td class='total'>Rp" + (qty * unitPrice) + "</td>" +
                // untuk bagian pesanan ke ini agak bingung gimana nentuin iterasinya bang
                "<td>" + 1 + "</td>" +
                "<td><button class='btn btn-danger delete-button'>Delete</button></td>" +
                "</tr>"
            );

            // Mengaktifkan event change pada input quantity
            $(".quantity-input").on("change", function () {
                var newQty = $(this).val();
                var newTotal = newQty * unitPrice;
                
                // Update nilai total pada kolom total
                $(this).closest('tr').find('.total').text("Rp" + newTotal);
            });

            // Menambahkan event click pada tombol delete
            $(".delete-button").on("click", function () {
                $(this).closest('tr').remove();
            });
        });
    });
</script>






    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('template/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('template/js/demo/chart-pie-demo.js')}}"></script>
        <!-- Page level plugins -->
    <script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script src="{{asset('template/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('assets/waitMe/waitMe.min.js')}}"></script>
    <script src="{{asset('assets/js/isotope.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    
{{-- <-- SweetAlert2 --> --}}
<script src="{{ asset('/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @yield('jsSection');
</body>

</html>