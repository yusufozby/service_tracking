<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @php
        $titles = [
            [
                'title' => 'Gösterge Paneli',
                'link' => 'dashboard.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
        </svg>',
            ],
            [
                'title' => 'Bildirimler',
                'link' => "notifications.index",
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>',
            ],
            [
                'title' => 'Takvim',
                'link' => 'schedule.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>',
            ],
            [
                'title' => 'Raporlar',
                'link' => 'report.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10"></line>
            <line x1="12" y1="20" x2="12" y2="4"></line>
            <line x1="6" y1="20" x2="6" y2="14"></line>
        </svg>',
            ],
            [
                'title' => 'Cihazlar',
                'link' => 'device.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="5" y="2" width="14" height="20" rx="2"></rect>
            <line x1="12" y1="18" x2="12.01" y2="18"></line>
        </svg>',
            ],
            [
                'title' => 'Satışlar',
                'link' => 'sale.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
  <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
  <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
</svg>'
            ]
        ];

        // Servis dropdown öğeleri.
        // 'link' alanına kendi route adlarını yaz (örn. 'fault.index').
        // Route henüz tanımlı değilse bağlantı '#' olarak kalır, sayfa hata vermez.
        $serviceMenu = [
            [
                'title' => 'Arızalar',
                'desc' => 'Açık arıza kayıtlarını yönet',
                'link' => 'fault.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
            <line x1="12" y1="9" x2="12" y2="13"></line>
            <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>',
            ],
            [
                'title' => 'Talepler',
                'desc' => 'Müşteri ve servis talepleri',
                'link' => 'request.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
            <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
        </svg>',
            ],
            [
                'title' => 'Personeller',
                'desc' => 'Teknisyen ve ekip yönetimi',
                'link' => 'staff.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>',
            ],
        ];

        $chevron = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
    @endphp
    <nav class="nav-header">
        <div class="nav-header-content">
            <ul class="nav-list">
                @foreach ($titles as $title)
                    <li class="nav-item"><a class="nav-link" href="{{ route($title['link']) }}">{{ $title['title'] }}</a></li>
                @endforeach

                <li id="dropdown" class="nav-item">
                    <a class="nav-link nav-link-dropdown" href="#" aria-haspopup="true">
                        Servis
                        <span class="nav-chevron">{!! $chevron !!}</span>
                    </a>
                    <ul class="dropdown-nav-list">
                        @foreach ($serviceMenu as $item)
                            <li class="nav-dropdown-item">
                                <a class="nav-dropdown-link"
                                    href="{{ Route::has($item['link']) ? route($item['link']) : '#' }}">
                                    <span class="nav-dropdown-icon">{!! $item['icon'] !!}</span>
                                    <span class="nav-dropdown-text">
                                        <strong>{{ $item['title'] }}</strong>
                                        <small>{{ $item['desc'] }}</small>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

            </ul>
            <div class="last">


  @auth
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn-login">
            Çıkış Yap
        </button>
    </form>
@endauth
@guest
<a href="{{ route('login') }}" class="btn-login">Giriş Yap</a>
<a href="{{ route('register') }}" class="btn-register">Kayıt Ol</a>

@endguest

            </div>
        </div>
        <div class="nav-menu">
            <button onclick="toggleDrawer()" class="nav-menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div class="drawer-menu-glass" id="drawer-menu-glass-closed">
                <div class="drawer-menu" id="drawer-menu-closed">

                    <div class="drawer-header">
                        <span class="drawer-title">Menü</span>

                        <button onclick="closeDrawerMenu()" class="drawer-close-button">
                            &times;
                        </button>
                    </div>

                    <ul class="drawer-nav-list">
                        @foreach ($titles as $title)
                            <li class="drawer-nav-item">
                                <a class="drawer-nav-link" href="{{ route($title['link']) }}">
                                    {!! $title['icon'] !!} {{ $title['title'] }}
                                </a>
                            </li>
                        @endforeach

                        <li class="drawer-nav-item">
                            <button onclick="toggleDropdownDrawerMenu()" id="drawerDropdown" class="drawer-nav-link"
                                type="button" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                                </svg>
                                <span class="drawer-dropdown-label">Servis</span>
                                <span class="drawer-chevron">{!! $chevron !!}</span>
                            </button>

                            <ul class="drawer-dropdown-list" id="drawerDropdownList">
                                @foreach ($serviceMenu as $item)
                                    <li>
                                        <a href="{{ Route::has($item['link']) ? route($item['link']) : '#' }}">
                                            <span class="drawer-dropdown-icon">{!! $item['icon'] !!}</span>
                                            {{ $item['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>



                    </ul>
                    <div class="row p-2">
                        <div class="col-1-2">
                            <button class="btn-login w-100">Giriş Yap</button>
                        </div>
                        <div class="col-1-2">
                            <button class="btn-register w-100">Kayıt Ol</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </nav>






    <script>
        const drawer = document.querySelector(".drawer-menu");
        const drawerGlass = document.querySelector(".drawer-menu-glass");

        function toggleDrawer() {


            if (
                drawer.id === "drawer-menu-closed" ||
                drawerGlass.id === "drawer-menu-glass-closed"
            ) {
                drawer.removeAttribute("id");
                drawerGlass.removeAttribute("id");
            } else {
                drawer.id = "drawer-menu-closed";
                drawerGlass.id = "drawer-menu-glass-closed";
            }
        }

        function closeDrawerMenu() {
            drawer.id = "drawer-menu-closed";
            drawerGlass.id = "drawer-menu-glass-closed";
        }

        function toggleDropdownDrawerMenu() {
            const list = document.querySelector("#drawerDropdownList");
            const button = document.querySelector("#drawerDropdown");

            const isOpen = list.classList.toggle("open");
            button.classList.toggle("open", isOpen);
            button.setAttribute("aria-expanded", isOpen);
        }
    </script>
   <div class="container mt-4">
    @yield('content')

   </div>
</body>

</html>
