<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('dashboard') }}">
                    <div class="brand-logo"><img class="logo" src="{{ asset('assets/site/images/icon.png') }}"></div>
                    <h2 class="brand-text mb-0 font-medium-2">اشتراک وردپرس</h2></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">

            <li class=" nav-item {{ \Illuminate\Support\Facades\Route::is('dashboard') ? 'active' : '' }}"><a href="/dashboard"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">داشبورد</span></a>
            </li>

            <li class=" nav-item"><a href=""><i class="menu-livicon" data-icon="user"></i><span class="menu-title" data-i18n="Users">کاربران</span></a>
                <ul class="menu-content">
                    <li class="{{ \Illuminate\Support\Facades\Route::is('users.index') ? 'active' : ''  }}"><a href="{{ route('users.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="User List">لیست</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href=""><i class="menu-livicon" data-icon="shoppingcart-in"></i><span class="menu-title" data-i18n="Dashboard">فاکتور</span></a>
                <ul class="menu-content">
                    <li class="{{ \Illuminate\Support\Facades\Route::is('factors.index') ? 'active' : ''  }}"><a href="{{ route('factors.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Factor List">لیست</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href=""><i class="menu-livicon" data-icon="box"></i><span class="menu-title" data-i18n="Dashboard">محصولات</span></a>
                <ul class="menu-content">
                    <li class="{{ \Illuminate\Support\Facades\Route::is('products.index') ? 'active' : ''  }}"><a href="{{ route('products.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product List">لیست</span></a>
                    </li>
                    <li class="{{ \Illuminate\Support\Facades\Route::is('categories.index') ? 'active' : ''  }}"><a href="{{ route('categories.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product Category">دسته بندی</span></a>
                    <li class="{{ \Illuminate\Support\Facades\Route::is('tags.index') ? 'active' : ''  }}"><a href="{{ route('tags.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product Tag">تگ ها</span></a>
                    </li>
                    <li class="{{ \Illuminate\Support\Facades\Route::is('versions.index') ? 'active' : ''  }}"><a href="{{ route('versions.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product Category">بروزرسانی</span></a>
                    </li>
                    <li class="{{ \Illuminate\Support\Facades\Route::is('details.index') ? 'active' : ''  }}"><a href="{{ route('details.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product Category">بروزرسانی جزئیات</span></a>
                    </li>
                    <li class="{{ \Illuminate\Support\Facades\Route::is('fakeproducts.index') ? 'active' : ''  }}"><a href="{{ route('fakeproducts.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product Category">فیک</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="menu-livicon" data-icon="box"></i><span class="menu-title" data-i18n="Dashboard">دوره ها</span></a>
                <ul class="menu-content">
                    <li class="{{ \Illuminate\Support\Facades\Route::is('courses.index') ? 'active' : ''  }}"><a href="{{ route('courses.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product List">لیست</span></a>
                    </li>
                    <li class="{{ \Illuminate\Support\Facades\Route::is('chapters.index') ? 'active' : ''  }}"><a href="{{ route('chapters.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product List">جلسات</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="menu-livicon" data-icon="box"></i><span class="menu-title" data-i18n="Dashboard">مقالات</span></a>
                <ul class="menu-content">
                    <li class="{{ \Illuminate\Support\Facades\Route::is('articles.index') ? 'active' : ''  }}"><a href="{{ route('articles.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product List">لیست</span></a>
                    </li>
                    <li class="{{ \Illuminate\Support\Facades\Route::is('article-categories.index') ? 'active' : ''  }}"><a href="{{ route('article-categories.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Product Category">دسته بندی</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href=""><i class="menu-livicon" data-icon="list"></i><span class="menu-title" data-i18n="Dashboard">منوها</span></a>
                <ul class="menu-content">
                    <li class="{{ \Illuminate\Support\Facades\Route::is('menus.index') ? 'active' : ''  }}"><a href="{{ route('menus.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Menu List">لیست</span></a>
                    </li>

                </ul>
            </li>

            <li class=" nav-item"><a href=""><i class="menu-livicon" data-icon="star"></i><span class="menu-title" data-i18n="Dashboard">اشتراک</span></a>
                <ul class="menu-content">
                    <li class="{{ \Illuminate\Support\Facades\Route::is('subscribe.index') ? 'active' : ''  }}"><a href="{{ route('subscribe.index') }}"><i class="bx bx-left-arrow-alt"></i><span class="menu-item" data-i18n="Subscribe">پلن ها</span></a>
                    </li>

                </ul>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('bundles.index') ? 'active' : ''  }} nav-item"><a href="{{ route('bundles.index') }}"><i class="menu-livicon" data-icon="box"></i><span class="menu-title" data-i18n="Transaction">پکیج ها</span></a>
            </li>


            <li class="{{ \Illuminate\Support\Facades\Route::is('wallet-gifts.index') ? 'active' : ''  }} nav-item"><a href="{{ route('wallet-gifts.index') }}"><i class="menu-livicon" data-icon="gift"></i><span class="menu-title" data-i18n="Wallet Gift">هدیه پلکانی</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('dashboard.discounts.index') ? 'active' : ''  }} nav-item"><a href="{{ route('dashboard.discounts.index') }}"><i class="menu-livicon" data-icon="divide-alt"></i><span class="menu-title" data-i18n="Discount">کد تخفیف</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('incomes.index') ? 'active' : ''  }} nav-item"><a href="{{ route('incomes.index') }}"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Income">درآمد فروشندگان</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('commissions.index') ? 'active' : ''  }} nav-item"><a href="{{ route('commissions.index') }}"><i class="menu-livicon" data-icon="piggybank"></i><span class="menu-title" data-i18n="Commission">کمیسیون سایت</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('licences.index') ? 'active' : ''  }} nav-item"><a href="{{ route('licences.index') }}"><i class="menu-livicon" data-icon="check-alt"></i><span class="menu-title" data-i18n="Licence">لایسنس</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('transactions.index') ? 'active' : ''  }} nav-item"><a href="{{ route('transactions.index') }}"><i class="menu-livicon" data-icon="us-dollar"></i><span class="menu-title" data-i18n="Transaction">تراکنش ها</span></a>
            </li>


            <li class="{{ \Illuminate\Support\Facades\Route::is('sellers.index') ? 'active' : ''  }} nav-item"><a href="{{ route('sellers.index') }}"><i class="menu-livicon" data-icon="user"></i><span class="menu-title" data-i18n="Transaction">درخواست فروشندگی</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('discussions.index') ? 'active' : ''  }} nav-item"><a href="{{ route('discussions.index') }}"><i class="menu-livicon" data-icon="comments"></i><span class="menu-title" data-i18n="Transaction">پرسش و پاسخ</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('comments.index') ? 'active' : ''  }} nav-item"><a href="{{ route('comments.index') }}"><i class="menu-livicon" data-icon="star-half"></i><span class="menu-title" data-i18n="Transaction">نظرات</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('withdraws.index') ? 'active' : ''  }} nav-item"><a href="{{ route('withdraws.index') }}"><i class="menu-livicon" data-icon="us-dollar"></i><span class="menu-title" data-i18n="Transaction">تسویه حساب</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('refunds.index') ? 'active' : ''  }} nav-item"><a href="{{ route('refunds.index') }}"><i class="menu-livicon" data-icon="shoppingcart-out"></i><span class="menu-title" data-i18n="Transaction">درخواست بازگشت</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('installs.index') ? 'active' : ''  }} nav-item"><a href="{{ route('installs.index') }}"><i class="menu-livicon" data-icon="hand-top"></i><span class="menu-title" data-i18n="Transaction">درخواست نصب</span></a>
            </li>

            <li class="{{ \Illuminate\Support\Facades\Route::is('contacts.index') ? 'active' : ''  }} nav-item"><a href="{{ route('contacts.index') }}"><i class="menu-livicon" data-icon="comment"></i><span class="menu-title" data-i18n="Transaction">تماس با ما</span></a>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
