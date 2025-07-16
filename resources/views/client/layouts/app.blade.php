<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Wepeka</title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="title" content="Wepeka" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
  <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
  <!--end::Primary Meta Tags-->

  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
  <!--end::Fonts-->

  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->

  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->

  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="{{ asset('adminlte4/css/adminlte.css') }}" />
  <!--end::Required Plugin(AdminLTE)-->

  <!-- apexcharts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />

  <!-- jsvectormap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />

  <!-- Custom Styles for Mobile Sidebar -->
  <style>
    /* Mobile Sidebar Styles */
    @media (max-width: 767.98px) {
      .app-sidebar {
        position: fixed;
        top: 0;
        left: -250px;
        width: 250px;
        height: 100vh;
        z-index: 1035;
        transition: left 0.3s ease-in-out;
      }

      .app-sidebar.show-mobile {
        left: 0;
        box-shadow: 5px 0 10px rgba(0,0,0,0.1);
      }

      .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 1030;
      }

      .sidebar-overlay.active {
        display: block;
      }

      .sidebar-open {
        overflow: hidden;
      }

      .app-wrapper.sidebar-collapse .app-sidebar {
        left: 0;
      }
    }

    /* Desktop Styles */
    @media (min-width: 768px) {
      .app-sidebar {
        position: static;
        height: auto;
      }

      .sidebar-overlay {
        display: none !important;
      }
    }
  </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!-- Sidebar Overlay (for mobile) -->
  <div class="sidebar-overlay"></div>

  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <!-- Toggle Sidebar Button -->
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>

          <!-- Navigation Links -->
          <li class="nav-item d-none d-md-block">
            <a href="#" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-md-block">
            <a href="{{ route('client.headquarters') }}" class="nav-link">Headquarters</a>
          </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
          @guest
            @if (Route::has('login'))
            <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif
          @else
            <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              </form>
            </div>
            </li>
          @endguest

          <li class="nav-item">
              <a href="./index.html" class="nav-link brand-link pe-3">
                <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Logo Here" class="brand-image opacity-100" style="height: 30px;" />
              </a>
            </li>
        </ul>
        <!--end::End Navbar Links-->
      </div>
      <!--end::Container-->
    </nav>
    <!--end::Header-->

    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
          <!--begin::Brand Image-->
          <img src="{{ asset("images/logowepeka_ed.png") }}" alt="Logo Here" class="brand-image opacity-100" />
          <!--end::Brand Image-->
        </a>
        <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <!--begin::Sidebar Menu-->
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-house"></i>
                <p>Home</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('client.headquarters') }}" class="nav-link">
                <i class="nav-icon bi bi-building"></i>
                <p>Headquarters</p>
              </a>
            </li>
            @auth
            <li class="nav-item">
              <div class="nav-link">
                <i class="nav-icon bi bi-person"></i>
                <p>{{ Auth::user()->name }}</p>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                <i class="nav-icon bi bi-box-arrow-right"></i>
                <p>Logout</p>
              </a>
              <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">
                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                <p>Login</p>
              </a>
            </li>
            @endauth
          </ul>
          <!--end::Sidebar Menu-->
        </nav>
      </div>
      <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
      @yield('content')
    </main>
    <!--end::App Main-->

    <!--begin::Footer-->
    <footer class="app-footer">
      <!--begin::To the end-->
      <div class="float-end d-none d-sm-inline">Anything you want</div>
      <!--end::To the end-->
      <!--begin::Copyright-->
    </footer>
    <!--end::Footer-->
  </div>
  <!--end::App Wrapper-->

  <!--begin::Script-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)-->

  <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)-->

  <!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)-->

  <!-- Load AdminLTE from CDN -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

  <!-- Only load one jQuery version -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Custom Sidebar Toggle Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarToggle = document.querySelector('[data-lte-toggle="sidebar"]');
      const sidebar = document.querySelector('.app-sidebar');
      const overlay = document.querySelector('.sidebar-overlay');

      // Toggle sidebar on button click
      if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
          e.preventDefault();

          if (window.innerWidth < 768) {
            // Mobile behavior
            sidebar.classList.toggle('show-mobile');
            overlay.classList.toggle('active');
            document.body.classList.toggle('sidebar-open');
          } else {
            // Desktop behavior - let AdminLTE handle it
            const sidebarCollapse = document.body.classList.contains('sidebar-collapse');
            document.body.classList.toggle('sidebar-collapse', !sidebarCollapse);
          }
        });
      }

      // Close sidebar when clicking on overlay
      if (overlay) {
        overlay.addEventListener('click', function() {
          sidebar.classList.remove('show-mobile');
          overlay.classList.remove('active');
          document.body.classList.remove('sidebar-open');
        });
      }

      // Close sidebar when clicking on nav links (optional)
      const navLinks = document.querySelectorAll('.sidebar-menu a');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          if (window.innerWidth < 768) {
            sidebar.classList.remove('show-mobile');
            overlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
          }
        });
      });

      // Handle window resize
      window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
          // Reset mobile states when resizing to desktop
          sidebar.classList.remove('show-mobile');
          overlay.classList.remove('active');
          document.body.classList.remove('sidebar-open');
        }
      });

      // Initialize OverlayScrollbars for sidebar
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };

      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>

  <!-- OPTIONAL SCRIPTS -->
  <!-- sortablejs -->
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
    integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
  <script>
    const connectedSortables = document.querySelectorAll('.connectedSortable');
    connectedSortables.forEach((connectedSortable) => {
      let sortable = new Sortable(connectedSortable, {
        group: 'shared',
        handle: '.card-header',
      });
    });

    const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
    cardHeaders.forEach((cardHeader) => {
      cardHeader.style.cursor = 'move';
    });
  </script>

  <!-- apexcharts -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

  <!-- ChartJS -->
  <script>
    const sales_chart_options = {
      series: [
        {
          name: 'Digital Goods',
          data: [28, 48, 40, 19, 86, 27, 90],
        },
        {
          name: 'Electronics',
          data: [65, 59, 80, 81, 56, 55, 40],
        },
      ],
      chart: {
        height: 300,
        type: 'area',
        toolbar: {
          show: false,
        },
      },
      legend: {
        show: false,
      },
      colors: ['#0d6efd', '#20c997'],
      dataLabels: {
        enabled: false,
      },
      stroke: {
        curve: 'smooth',
      },
      xaxis: {
        type: 'datetime',
        categories: [
          '2023-01-01',
          '2023-02-01',
          '2023-03-01',
          '2023-04-01',
          '2023-05-01',
          '2023-06-01',
          '2023-07-01',
        ],
      },
      tooltip: {
        x: {
          format: 'MMMM yyyy',
        },
      },
    };

    const sales_chart = new ApexCharts(
      document.querySelector('#revenue-chart'),
      sales_chart_options,
    );
    sales_chart.render();
  </script>

  <!-- jsvectormap -->
  <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
    integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
    integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>

  <!-- jsvectormap -->
  <script>
    const visitorsData = {
      US: 398, // USA
      SA: 400, // Saudi Arabia
      CA: 1000, // Canada
      DE: 500, // Germany
      FR: 760, // France
      CN: 300, // China
      AU: 700, // Australia
      BR: 600, // Brazil
      IN: 800, // India
      GB: 320, // Great Britain
      RU: 3000, // Russia
    };

    // World map by jsVectorMap
    const map = new jsVectorMap({
      selector: '#world-map',
      map: 'world',
    });

    // Sparkline charts
    const option_sparkline1 = {
      series: [
        {
          data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
        },
      ],
      chart: {
        type: 'area',
        height: 50,
        sparkline: {
          enabled: true,
        },
      },
      stroke: {
        curve: 'straight',
      },
      fill: {
        opacity: 0.3,
      },
      yaxis: {
        min: 0,
      },
      colors: ['#DCE6EC'],
    };

    const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
    sparkline1.render();

    const option_sparkline2 = {
      series: [
        {
          data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
        },
      ],
      chart: {
        type: 'area',
        height: 50,
        sparkline: {
          enabled: true,
        },
      },
      stroke: {
        curve: 'straight',
      },
      fill: {
        opacity: 0.3,
      },
      yaxis: {
        min: 0,
      },
      colors: ['#DCE6EC'],
    };

    const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
    sparkline2.render();

    const option_sparkline3 = {
      series: [
        {
          data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
        },
      ],
      chart: {
        type: 'area',
        height: 50,
        sparkline: {
          enabled: true,
        },
      },
      stroke: {
        curve: 'straight',
      },
      fill: {
        opacity: 0.3,
      },
      yaxis: {
        min: 0,
      },
      colors: ['#DCE6EC'],
    };

    const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
    sparkline3.render();
  </script>
  <!--end::Script-->

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  @stack('scripts')
</body>
</html>