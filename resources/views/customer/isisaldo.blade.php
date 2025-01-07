<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customer Dashboard | wecan.do</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('wecando.ico') }}">
    <!-- Custom styles for this teplate-->
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{URL('customer')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">WE CAN DO</sup></div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Layanan
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('customer')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('customer/isisaldo')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Saldo</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('customer/turnitin')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Cek Plagiarisme</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('customer/pulsa')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Top Up E-Wallet</span>
                </a>
            </li>
            
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{asset('template/img/undraw_profile.svg')}}" alt="User Avatar">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <!-- Logout -->
                                <form method="POST" action="{{route('logout')}}">
                                    @csrf
                                    <button class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Keluar
                                    </button>
                                </form>
                                
                            </div>
                        </li>
                        

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Isi Saldo</h1>
                        <!-- Button trigger modal -->
                        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
                    </div>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Untuk isi saldo minimal <strong>Rp. 3.000!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                    {{-- tabel --}}

                    <div class="card shadow mb-4">
                        <form action="{{route('customer.isisaldo')}}" method="POST">
                            @csrf
                            {{-- <label for="amount">Jumlah Saldo:</label>
                            {{-- <input type="number" name="amount" id="amount" min="1000" required> --}}
                            <style>
                                .uhuy {
                                    margin-left: 12px;
                                    margin-right: 12px;
                                    margin-top: 15px;
                                }
                            </style>
                            <div class="form-group uhuy">
                                <label for="amount">Jumlah Saldo :</label>
                                <input type="number" name="amount" min="3000" class="form-control" id="amount" required>
                            </div>
                            <div class="form-group uhuy">
                                <label for="payment_method">Metode Pembayaran:</label>
                                {{-- <select name="payment_method" id="payment_method" required> --}}
                                    {{-- <option value="bca">BCA</option>
                                    <option value="bni">BNI</option>
                                    <option value="qris">QRIS</option> --}}
                                    <select name="method" class="custom-select">
                                        <option name="QRIS" value="QRIS">QRIS</option>
                                        <option name="BRIVA" value="BRIVA">BRI VA</option>
                                        <option name="DANA" value="DANA">DANA</option>
                                        <option name="SHOPEEPAY" value="SHOPEEPAY">SHOPEEPAY</option>
                                      </select>
                                </select>
                                <button type="submit" class="btn btn-primary mt-4">Isi Saldo</button>
                            </div>
                        </form>
                    </div>

                    <div class="card shadow mb-4">
                        {{-- {{ $dokument }} --}}
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Riwayat Isi Saldo</h6>
                        </div>
                        <div class="card-body">
                            {{-- {{ $saldo }} --}}
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Referensi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>     
                                    <tbody>
                                        @foreach($saldo as $key => $uhuy)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $uhuy->merchant_ref}}</td>
                                            <td>{{ $uhuy->method}}</td>
                                            <td>{{ $uhuy->amount}}</td>
                                            <td>{{ $uhuy->status}}</td>
                                            {{-- {{ $uhuy }} --}}
                                            <td>
                                                @if($uhuy->status === 'unpaid')
                                                <!-- Tombol Bayar mengarah ke URL checkout -->
                                                <a href="{{ $uhuy->checkout_url }}" class="btn btn-success btn-sm" target="_blank">Bayar</a>
                                            @elseif($uhuy->status === 'paid')
                                                <span class="text-success">Sudah Bayar</span>
                                            @else
                                                <span class="text-muted">Menunggu Verifikasi</span>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

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

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('template/vendorvendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>

    <script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('template/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('template/js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>

</body>

</html>

