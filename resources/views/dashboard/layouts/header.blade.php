<!-- BEGIN: Header-->
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="ficon bx bx-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="/" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="مشاهده سایت"><i class="ficon bx bx-home"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-expand"><i
                                class="ficon bx bx-fullscreen"></i>
                        </a>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link"
                           href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name">{{ auth()->user()->get_display_name() }}</span>
                            </div>
                            <span>
                                <img class="round" src="{{ img_url(auth()->user()->avatar) }}" alt="avatar" height="40"
                                       width="40">
                            </span>
                        </a>
                        <div class="dropdown-menu pb-0">
                            <a href="{{ route('profile.index') }}" class="dropdown-item">
                                <i class="bx bx-user mr-50"></i>
                                پروفایل کاربری
                            </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                       <i class="bx bx-power-off mr-50"></i>
                                 خروج
                                    </a>
                                </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->
