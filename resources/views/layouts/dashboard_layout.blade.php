<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Resong Hotel Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('assets/img/web-icon.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('assets/img/web-icon.png') }}" rel="apple-touch-icon" sizes="16x16">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/waitMe/waitMe.min.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">

    {{-- Vendor --}}
    {{-- <link href="{{asset('assets/template/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{-- <link href="{{asset('assets/css/main.css')}}" rel="stylesheet"> --}}
    <style>
        .mt-2 {
            color: red;
        }
    </style>
</head>

<body id="page-top">
    @include('sweetalert::alert')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav nav-bg sidebar sidebar-dark accordion" id="accordionSidebar" >

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img width="70" src="{{ asset('assets/img/web-icon.png') }}" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">
                    <img width="100" src="{{ asset('assets/img/resong-text.png') }}" alt="">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
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
                        <a class="collapse-item" href="{{ route('checkin.normal') }}">Normal</a>
                        <a class="collapse-item" href="{{ route('checkin.speedy') }}">Speedy</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('checkout.list') }}">
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
                        <a class="collapse-item" href="{{ route('booking') }}">Booking</a>
                        <a class="collapse-item" href="{{ route('reservation.list') }}">Reservation List</a>
                        <a class="collapse-item" href="{{ route('booking.canceled') }}">Cancel Reservation</a>
                        <a class="collapse-item" href="{{ route('booking.no_showed') }}">No Show Reserve</a>
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
                        <a class="collapse-item" href="{{ route('inhouse.list') }}">In-house Guest</a>
                        <a class="collapse-item" href="{{ route('checked_out.list') }}">Checkout History</a>
                        <a class="collapse-item" href="{{ route('guest_database') }}">Guest Database</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cleaningroom.list') }}">
                    <i class="fas fa-fw fa-broom"></i>
                    <span>House Keeping</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport"
                    aria-expanded="true" aria-controls="collapseGuest">
                    <i class="fas fa-user"></i>
                    <span>Report</span>
                </a>
                <div id="collapseReport" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('bill.report') }}">Bill Report</a>
                        <a class="collapse-item" href="{{ route('guest_database') }}">Channel Report</a>
                        <a class="collapse-item" href="{{ route('guest_database') }}">Room Report</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                INVENTORY KITCHEN
            </div>

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                BACK OFFICE
            </div> -->

            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list.supplier') }}">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Supplier</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('list.barang') }}">
                    <i class="fas fa-fw fa-cubes"></i> <!-- Menggunakan ikon "cubes" -->
                    <span>Barang</span>
                </a>
            </li>

            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list.kategori') }}">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Manage Kategori Barang</span></a>
            </li>

            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list.trans') }}">
                    <i class="fas fa-fw fa-exchange-alt"></i>
                    <span>Transaksi Barang</span></a>
            </li>

            {{-- Inventaris barang --}}
            <!-- Heading -->
            <div class="sidebar-heading mt-3">
                INVENTORY ASSETS
            </div>
            {{-- Inventaris barang --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventoryAssets"
                    aria-expanded="true" aria-controls="collapseGuest">
                    <i class="fas fa-box"></i>
                    <span>Inventory Assets</span>
                </a>
                <div id="inventoryAssets" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('inventory-assets.supplier.show') }}">Supplier</a>
                        <a class="collapse-item" href="{{ route('inventory-assets.kategori.show') }}">Kategori
                            Assets</a>
                        <a class="collapse-item" href="{{ route('inventory-assets.asset.show') }}">Assets</a>
                        <a class="collapse-item" href="{{ route('inventory-assets.trans.show') }}">Transaksi
                            Assets</a>
                    </div>
                </div>
            </li>
            {{-- end Inventaris barang --}}

            {{-- end Inventaris barang --}}

            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Laundry
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('laundry') }}">
                    <i class="fas fa-fw fa-tshirt"></i>
                    <span>Laundry</span></a>
            </li>
            <hr class="sidebar-divider">


            {{-- <!-- Nav Item - Check-out -->
             <li class="nav-item">
                <a class="nav-link" href="{{route('list.barang.masuk')}}">
                <i class="fas fa-fw fa-broom"></i>
                    <span>Barang Masuk</span></a>
            </li>

             <!-- Nav Item - Check-out -->
             <li class="nav-item">
                <a class="nav-link" href="{{route('cleaningroom.list')}}">
                <i class="fas fa-fw fa-broom"></i>
                    <span>Barang Keluar</span></a>
            </li> --}}

            <!-- Heading -->
            <div class="sidebar-heading">
                Resto
            </div>

            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kategori.menu') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Manage Kategori Menu</span></a>
            </li>

            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list.menu') }}">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Manage Menu List</span></a>
            </li>

            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('daily.menu') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Manage Menu Daily</span></a>
            </li>



            <!-- Nav Item - Check-out -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('resto.menu') }}">
                    <i class="fas fa-fw fa-utensils"></i>
                    <span>Resto</span></a>
            </li>
            <br>


            <!-- Heading -->
            <div class="sidebar-heading">
                Kepegawaian
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{route('daftar.hadir')}}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Absensi Kehadiran</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKaryawan"
                    aria-expanded="true" aria-controls="collapseGuest">
                    <i class="fas fa-user"></i>
                    <span>Pegawai</span>
                </a>
                <div id="collapseKaryawan" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('daftar.karyawan') }}">Data Karyawan</a>
                        <a class="collapse-item" href="{{ route('daftar.divisi') }}">Data Divisi</a>
                        <a class="collapse-item" href="{{ route('daftar.shift') }}">Data Shift</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayroll"
                    aria-expanded="true" aria-controls="collapseGuest">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Payroll</span>
                </a>
                <div id="collapsePayroll" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('data.gaji')}}">Gaji</a>
                        <a class="collapse-item" href="{{route('proses.gaji')}}">Proses</a>
                        <a class="collapse-item" href="{{route('bill.gaji')}}">Bill</a>
                    </div>
                </div>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

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
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('template/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <!-- Script for table -->
    <script>
        $(document).ready(function() {
            $('#checkInTable').DataTable();
            $('#speedyCheckInTable').DataTable();
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
            $('#houseKeepingTable').DataTable();
            $('#cleaningHistoryTable').DataTable();
            $('#billReporTable').DataTable();
            $('#supplierTable').DataTable();
            $('#barangTable').DataTable();
            $('#barangMasukTable').DataTable();
            $('#manageMenuTable').DataTable();
            $('#daftarMenuTable').DataTable();
            $('#layananRestoTable').DataTable();
            $('#detailLayananRestoTable').DataTable();
            $('#dataKaryawanTable').DataTable();
            $('#dataDivisiTable').DataTable();
            $('#dataShiftTable').DataTable();
            $('#dataAbsensiTable').DataTable();
        });
    </script>


    {{-- show menu image --}}
    <script>
        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
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
        $(document).on('input', '.quantity-input', function() {
            calculateTotal($(this));
        });

        // Event listener untuk menghitung total saat tombol "Select" diklik
        $(document).on('click', '.calculate-btn', function() {
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
        $(document).ready(function() {
            $(".add-button").on("click", function() {
                var itemName = $(this).data("item");
                var qty = 1;
                var unitPriceString = $("#listServiceGuestFood tbody tr:contains('" + itemName +
                    "') td:eq(2)").text().replace('Rp', '').replace(',', '');

                // Gunakan parseFloat untuk mengkonversi string ke angka
                var unitPrice = parseFloat(unitPriceString) ||
                    0; // Jika tidak dapat dikonversi, beri nilai default 0



                // Tambahkan baris ke tabel pesanan
                $("#listServiceOrder tbody").append(
                    "<tr>" +
                    "<td>" + 'INV-0000121' + "</td>" +
                    "<td>" + itemName + "</td>" +
                    "<td><input style='width: 50px;' type='number' class='quantity-input' value='" +
                    qty + "'></td>" +
                    "<td class='unit-price'>Rp" + unitPrice + "</td>" +
                    "<td class='total'>Rp" + (qty * unitPrice) + "</td>" +
                    // untuk bagian pesanan ke ini agak bingung gimana nentuin iterasinya bang
                    "<td>" + 1 + "</td>" +
                    "<td><button class='btn btn-danger delete-button'>Delete</button></td>" +
                    "</tr>"
                );

                // Mengaktifkan event change pada input quantity
                $(".quantity-input").on("change", function() {
                    var newQty = $(this).val();
                    var newTotal = newQty * unitPrice;

                    // Update nilai total pada kolom total
                    $(this).closest('tr').find('.total').text("Rp" + newTotal);
                });

                // Menambahkan event click pada tombol delete
                $(".delete-button").on("click", function() {
                    $(this).closest('tr').remove();
                });
            });
        });
    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    {{-- <!-- Page level plugins -->
    <script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{asset('template/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('template/js/demo/chart-pie-demo.js')}}"></script>
        <!-- Page level plugins --> --}}
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script src="{{ asset('template/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('assets/waitMe/waitMe.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Vendor JS Files -->
    {{-- <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script> --}}

    <!-- Template Main JS File -->
    {{-- <script src="{{asset('assets/js/impact.js')}}"></script>
     --}}
    <script src="{{ asset('plugins') }}/select2/js/select2.min.js"></script>
    <script src="{{ asset('assets') }}/js/global.js"></script>

    {{-- <-- SweetAlert2 --> --}}
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @yield('jsSection');
</body>

</html>
