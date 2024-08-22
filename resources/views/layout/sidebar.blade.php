<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a class="logo logo-dark">
            <span class="logo-lg">
                <img src="../assets/images/logo-dark-sm.png" alt="" height="28">
            </span>
            <span class="logo-lg">
               <b style="color:rgb(20, 20, 20); font-size: 110%;">CostSheet Automation</b>
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-lg">
                <img src="../assets/images/logo-light.png" alt="" height="30">
            </span>
            <span class="logo-sm">
                <img src="../assets/images/logo-light-sm.png" alt="" height="26">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Dashboard</li>

               <li>
                    <a href="dash">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                        <span class="badge rounded-pill bg-primary">2</span>
                    </a>

                </li>

                <li class="menu-title" data-key="t-applications">Applications</li>
                @if(auth()->user()->role=="Marketing")
                <li>
                    <a href="market" >
                        <i class="bx bx-envelope icon nav-icon"></i>
                        <span class="menu-item" data-key="t-email">Marketing</span>
                    </a>
                </li>
                 <li>
                    <a href="uom" >
                        <i class="bx bx-pen icon nav-icon"></i>
                        <span class="menu-item" data-key="t-uom">UOM</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role=="R&D")
                <li>
                    <a  href="purchase">
                        <i class="bx bx-calendar-event icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar"> RM Rate</span>
                    </a>
                </li>
                <li>
                    <a href="formulation">
                        <i class="bx bx-check-square icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar">R&D Formulation</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role=="purchase")
                <li>
                    <a href="rmrate">
                        <i class="bx bx-file-find icon nav-icon"></i>
                        <span class="menu-item" data-key="t-filemanager">RM Rate</span>
                    </a>
                    <a href="pmbom">
                        <i class="bx bx-check-square icon nav-icon"></i>
                        <span class="menu-item" data-key="t-filemanager">PM BOM</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role=="oprations")
                <li>
                    <a  href="oprations">
                        <i class="bx bx-file-find icon nav-icon"></i>
                        <span class="menu-item" data-key="t-filemanager">Operation</span>
                    </a>
                </li>
                @endif

                    @if(auth()->user()->role=="Tax")
                <li>
                    <a href="taxation">
                        <i class="bx bx-file-find icon nav-icon"></i>
                        <span class="menu-item" data-key="t-filemanager">Taxation</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role=="Packaging")
                <li>
                    <a href="packing">
                        <i class="bx bx-file-find icon nav-icon"></i>
                        <span class="menu-item" data-key="t-filemanager">Packaging</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role=="Logistic")
                <li>
                    <a href="javascript: void(0);">
                        <i class="bx bx-file-find icon nav-icon"></i>
                        <span class="menu-item" data-key="t-filemanager">Logistic</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="Logistic" data-key="t-products">Primary Freight
                        </a></li>
                        <li><a href="LogisticSub" data-key="t-product-detail">Secondary Freight</a></li>
                    </ul>
                </li>

                @endif
                @if(auth()->user()->role=="Finance")
                <li>
                    <a href="finance">
                        <i class="bx bx-file-find icon nav-icon"></i>
                        <span class="menu-item" data-key="t-filemanager">Finance</span>
                    </a>
                </li>
                <li>
                    <a href="product_approval">
                        <i class="bx bx-file-find icon nav-icon"></i>
                        <span class="menu-item" data-key="t-product-detail">Product Approval</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    </div>
    <!-- Left Sidebar End -->
