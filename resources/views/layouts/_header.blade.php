<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
        <div class="container "> 
        <!-- logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                shop
            </a>
            <!-- .navbar-toggler 用於我們的折疊插件和其他 navigation toggling 行為。 -->
            <!-- aria-expanded:该元素或其控制的另一个分组元素当前处于展开还是折叠状态 true or flase -->
            <!-- data-toggle 和 data-target 控制折叠类 .collapse 表示隐藏-->
            <!-- 如果控件元素只对准一个单个元素——即data-target的值指向一个id选择器，你可以给这个控件元素添加额外的aria-controls属性，容纳这个折叠块元素的id。现代的屏幕阅读器以及类似的辅助技术利用这个属性向用户提供额外的快捷方式，直接导航到折叠块元素本身。 -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navHeaderContent" aria-controls="navHeaderContent" aria-expanded="flase" aria-lable="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- .collapse.navbar-collapse用于通过父断点进行分组和隐藏导航列内容。 -->
            <div id="navHeaderContent" class="collapse navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!-- .navbar-nav 提供完整的高和轻便的导航（包括对下拉菜单的支持）。 -->
                <ul class="navbar-nav mr-auto">

                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav navbar-right"> 
                    <!-- Authentication Links -->
                    <!-- 用单独的元素嵌套.nav-item 和 .nav-link， -->
                    <!-- auth 和 guest 指令可以用来快速确定当前用户是否已通过身份验证，是否为访客： -->
                    @auth
                        <li class="nav-item dropdown">
                            <!-- 添加 data-toggle="dropdown" 在A链接或按钮上，以启用下拉菜单组件。 -->
                            <!-- aria-haspopup :true表示点击的时候会出现菜单或是浮动元素； false表示没有pop-up效果。 -->
                            <a class="nav-link dropdown-toggle" href="#" id="NavDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="http://{{$_SERVER['HTTP_HOST']}}/images/DefaultAvatar.jpg" class="img-fluid rounded-circle" width="30px" height="30px">
                               {{Auth::user()->name}}
                            </a>
                            <!-- aria-labelledby 的值为某个元素的 id 。那么屏幕阅读器就可以读取它的值 -->
                            <div class="dropdown-menu" aria-lablledby="NavDropDown">
                                <a class="dropdown-item" href="{{ route('products.favoriteslist') }}">我的收藏</a>
                                <a class="dropdown-item" href="{{ route('user_addresses.index') }}">收货地址</a>
                                <a class="dropdown-item" id="logout" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出登陆</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display:none">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">登陆</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">注册</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</header>