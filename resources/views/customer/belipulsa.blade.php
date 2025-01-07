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

            <!-- Divider -->
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
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Top Up E-Wallet</h2>
                                <ul id="tabs" class="nav nav-tabs">
                                    <li class="nav-item"><a href="" data-target="#home1" data-toggle="tab" class="nav-link small text-uppercase active">TOP UP DANA</a></li>
                                    <li class="nav-item"><a href="" data-target="#profile1" data-toggle="tab" class="nav-link small text-uppercase">TOP UP GOPAY</a></li>
                                    <li class="nav-item"><a href="" data-target="#messages1" data-toggle="tab" class="nav-link small text-uppercase">TOP UP SHOPEEPAY</a></li>
                                    <li class="nav-item"><a href="" data-target="#messages2" data-toggle="tab" class="nav-link small text-uppercase">TOKEN LISTRIK</a></li>
                                </ul>
                                <br>
                                <div id="tabsContent" class="tab-content">
                                    <div id="home1" class="tab-pane fade active show">
                                        <div class="card shadow mb-4">
                                            @if(session('message'))
                                            <div class="alert alert-success">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                    
                                        @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                            <form action="{{route('customer.topup')}}" method="POST">
                                                @csrf
                                                <div class="form-group uhuy">
                                                    <label for="phone">Nomor Telepon:</label>
                                                    <input type="number" name="phone" class="form-control" id="phone" required>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="amount">Nominal:</label>
                                                    <input type="hidden" name="code" id="code" value=""> <!-- Menyimpan kode produk -->
                                                    <input type="hidden" name="amount" id="amount" value=""> <!-- Menyimpan nominal dalam format harga -->
                                                    <input type="text" id="amountText" class="form-control" readonly> <!-- Menampilkan nominal yang dipilih -->
                                            
                                                    <div class="btn-group d-flex flex-wrap" role="group" aria-label="Nominal options">
                                                        <button type="button" class="btn btn-secondary" data-code="DNA10" data-amount="12175" data-text="10.000">10.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA100" data-amount="102175" data-text="100.000">100.000</button> --}}
                                                        <button type="button" class="btn btn-secondary" data-code="DNA15" data-amount="17175" data-text="15.000">15.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA150" data-amount="152175" data-text="150.000">150.000</button> --}}
                                                        <button type="button" class="btn btn-secondary" data-code="DNA20" data-amount="22175" data-text="20.000">20.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA200" data-amount="202175" data-text="200.000">200.000</button> --}}
                                                        <button type="button" class="btn btn-secondary" data-code="DNA25" data-amount="27175" data-text="25.000">25.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA250" data-amount="252175" data-text="250.000">250.000</button> --}}
                                                        <button type="button" class="btn btn-secondary" data-code="DNA30" data-amount="32175" data-text="30.000">30.000</button>
                                                        <button type="button" class="btn btn-secondary" data-code="DNA35" data-amount="37175" data-text="35.000">35.000</button>
                                                        <button type="button" class="btn btn-secondary" data-code="DNA40" data-amount="42175" data-text="40.000">40.000</button>
                                                        <button type="button" class="btn btn-secondary" data-code="DNA45" data-amount="47175" data-text="45.000">45.000</button>
                                                        <button type="button" class="btn btn-secondary" data-code="DNA50" data-amount="52175" data-text="50.000">50.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA300" data-amount="302175" data-text="300.000">300.000</button> --}}
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary mb-4">Isi Saldo</button>
                                                </div>
                                            </form>
                                            
                                            <script>
                                                document.querySelectorAll('.btn-secondary').forEach(button => {
                                                    button.addEventListener('click', function() {
                                                        document.getElementById('code').value = this.getAttribute('data-code');
                                                        document.getElementById('amount').value = this.getAttribute('data-amount');
                                                        document.getElementById('amountText').value = this.getAttribute('data-text');
                                                    });
                                                });
                                            </script>
                                            
                                            
                                        </div>
                                        
                                        <style>
                                            .form-group {
                                                margin-left: 12px;
                                                margin-right: 12px;
                                            }
                                        
                                            .btn-group .btn {
                                                margin: 4px;
                                            }
                                        </style>
                                        
                                    </div>
                                    <div id="profile1" class="tab-pane fade">
                                        <div class="card shadow mb-4">
                                            @if(session('message'))
                                            <div class="alert alert-success">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                    
                                        @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                            <form action="{{route('customer.gopay')}}" method="POST">
                                                @csrf
                                                <div class="form-group uhuy">
                                                    <label for="gopay_phone">Nomor Telepon:</label>
                                                    <input type="number" name="gopay_phone" class="form-control" id="gopay_phone" required>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="amount">Nominal:</label>
                                                    <input type="hidden" name="gopay_code" id="gopay_code" value=""> <!-- Menyimpan kode produk -->
                                                    <input type="hidden" name="gopay_amount" id="gopay_amount" value=""> <!-- Menyimpan nominal dalam format harga -->
                                                    <input type="text" id="gopay_amountText" class="form-control" readonly> <!-- Menampilkan nominal yang dipilih -->
                                            
                                                    <div class="btn-group d-flex flex-wrap" role="group" aria-label="Nominal options">
                                                        <button type="button" class="btn btn-secondary" data-code="GJ10" data-amount="12440" data-text="10.000">10.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA100" data-amount="102175" data-text="100.000">100.000</button> --}}
                                                        <button type="button" class="btn btn-secondary" data-code="GJ15" data-amount="17440" data-text="15.000">15.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA150" data-amount="152175" data-text="150.000">150.000</button> --}}
                                                        <button type="button" class="btn btn-secondary" data-code="GJ20" data-amount="22440" data-text="20.000">20.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA200" data-amount="202175" data-text="200.000">200.000</button> --}}
                                                        <button type="button" class="btn btn-secondary" data-code="GJ25" data-amount="27440" data-text="25.000">25.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA250" data-amount="252175" data-text="250.000">250.000</button> --}}
                                                        <button type="button" class="btn btn-secondary" data-code="GJ30" data-amount="32440" data-text="30.000">30.000</button>
                                                        <button type="button" class="btn btn-secondary" data-code="GJ35" data-amount="37490" data-text="35.000">35.000</button>
                                                        <button type="button" class="btn btn-secondary" data-code="GJ40" data-amount="42440" data-text="40.000">40.000</button>
                                                        <button type="button" class="btn btn-secondary" data-code="GJ45" data-amount="47490" data-text="45.000">45.000</button>
                                                        <button type="button" class="btn btn-secondary" data-code="GJ50" data-amount="52440" data-text="50.000">50.000</button>
                                                        {{-- <button type="button" class="btn btn-secondary" data-code="DNA300" data-amount="302175" data-text="300.000">300.000</button> --}}
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary mb-4">Isi Saldo</button>
                                                </div>
                                            </form>
                                            
                                            <script>
                                                document.querySelectorAll('.btn-secondary').forEach(button => {
                                                    button.addEventListener('click', function() {
                                                        document.getElementById('gopay_code').value = this.getAttribute('data-code');
                                                        document.getElementById('gopay_amount').value = this.getAttribute('data-amount');
                                                        document.getElementById('gopay_amountText').value = this.getAttribute('data-text');
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div id="messages1" class="tab-pane fade">
                                        <div class="card shadow mb-4">
                                                <style>
                                                    .uhuy {
                                                        margin-left: 12px;
                                                        margin-right: 12px;
                                                        margin-top: 15px;
                                                    }
                                                </style>
                                                
                                        </div>
                                    </div>
                                    <div id="messages2" class="tab-pane fade">
                                        <div class="card shadow mb-4">
                                                <style>
                                                    .uhuy {
                                                        margin-left: 12px;
                                                        margin-right: 12px;
                                                        margin-top: 15px;
                                                    }
                                                </style>
                                                @if(session('message'))
                                                <div class="alert alert-success">
                                                    {{ session('message') }}
                                                </div>
                                            @endif
                                        
                                            @if(session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                                <form action="{{route('customer.token')}}" method="POST">
                                                    @csrf
                                                    <div class="form-group uhuy">
                                                        <label for="listrik_phone">Nomor Telepon:</label>
                                                        <input type="number" name="listrik_phone" class="form-control" id="listrik_phone" required>
                                                    </div>
                                                    <div class="form-group uhuy">
                                                        <label for="idcust">ID Customer:</label>
                                                        <input type="number" name="listrik_idcust" class="form-control" id="idcust" required>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <label for="amount">Nominal:</label>
                                                        <input type="hidden" name="listrik_code" id="listrik_code" value=""> <!-- Menyimpan kode produk -->
                                                        <input type="hidden" name="listrik_amount" id="listrik_amount" value=""> <!-- Menyimpan nominal dalam format harga -->
                                                        <input type="text" id="listrik_amountText" class="form-control" readonly> <!-- Menampilkan nominal yang dipilih -->
                                                
                                                        <div class="btn-group d-flex flex-wrap" role="group" aria-label="Nominal options">
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="GJ10" data-amount="12440" data-text="10.000">10.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="DNA100" data-amount="102175" data-text="100.000">100.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="GJ15" data-amount="17440" data-text="15.000">15.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="DNA150" data-amount="152175" data-text="150.000">150.000</button> --}}
                                                            <button type="button" class="btn btn-secondary" data-code="PLN5" data-amount="12440" data-text="5.000">5.000</button>
                                                            <button type="button" class="btn btn-secondary" data-code="PLN20" data-amount="22440" data-text="20.000">20.000</button>
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="DNA200" data-amount="202175" data-text="200.000">200.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="GJ25" data-amount="27440" data-text="25.000">25.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="DNA250" data-amount="252175" data-text="250.000">250.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="GJ30" data-amount="32440" data-text="30.000">30.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="GJ35" data-amount="37490" data-text="35.000">35.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="GJ40" data-amount="42440" data-text="40.000">40.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="GJ45" data-amount="47490" data-text="45.000">45.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="GJ50" data-amount="52440" data-text="50.000">50.000</button> --}}
                                                            {{-- <button type="button" class="btn btn-secondary" data-code="DNA300" data-amount="302175" data-text="300.000">300.000</button> --}}
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary mb-4">Isi Token</button>
                                                    </div>
                                                </form>
                                                
                                                <script>
                                                    document.querySelectorAll('.btn-secondary').forEach(button => {
                                                        button.addEventListener('click', function() {
                                                            document.getElementById('listrik_code').value = this.getAttribute('data-code');
                                                            document.getElementById('listrik_amount').value = this.getAttribute('data-amount');
                                                            document.getElementById('listrik_amountText').value = this.getAttribute('data-text');
                                                        });
                                                    });
                                                </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    <!-- Page Heading -->
                    {{-- {{ $products}} --}}
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        {{-- <h1 class="h3 mb-0 text-gray-800">{{$products->message}}</h1> --}}
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
                                            <th>Kode</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>     
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product['code'] }}</td>
                                            <td>{{ $product['description'] }}</td>
                                            <td>Rp {{ number_format($product['price'] + 2000, 0, ',', '.') }}</td>
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

