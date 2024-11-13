

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="{{ route('input_kode_barang') }}" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">
                     <img
                src="{{ asset('/img/logo/logo.png') }}"
                alt=""
                style="width: 40px; height: 40px"
              />{{ $logo->nama_web }}
                    </h3>
                </a>
                <title>{{ $logo->nama_web }}</title>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h6 class="mb-0"></h6>
                        <span>
                            
                        </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    
                    <a href="{{ url('home/edit_data') }}" class="nav-item nav-link">
                        <i class="fa fa-th me-2"></i>Data Web
                    </a>
                   
                 
                    <a href="{{ url('home/activity-log') }}" class="nav-item nav-link">
                        <i class="fa fa-th me-2"></i>Activity
                    </a>
                
                    <a href="{{ url('home/documents') }}" class="nav-item nav-link">
                    <i class="fa fa-th me-2"></i>ketegori
                    <a href="{{ url('home/incoming-mails')}}" class="nav-item nav-link">
                        <i class="fa fa-th me-2"></i>email
                    </a>
                    <a href="{{ url('home/eoffice/leave-form')}}" class="nav-item nav-link">
                        <i class="fa fa-th me-2"></i>leave
                    </a>
                </div>
                
               
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-lg-inline-flex"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ url('login') }}" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>  
            
