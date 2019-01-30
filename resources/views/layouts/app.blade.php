<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        @hasrole('Admin|Writer')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true" v-pre>
                                Posts <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                @if(auth()->user()->can('Create Post') || auth()->user()->can('Administer roles & permissions'))
                                    <li>
                                        <a href="{{ route('post.create') }}">
                                            Create new post
                                        </a>
                                    </li>
                                @else
                                    <li style="margin-left: 14px">
                                        Create new post
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('post.list') }}">
                                        List of post
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasrole
                        @hasrole('Admin')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true" v-pre>
                                Users <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                @if(auth()->user()->can('Create Ueser') || auth()->user()->can('Administer roles & permissions'))
                                <li>
                                    <a href="{{ route('user.create') }}">
                                        Create new user
                                    </a>
                                </li>
                                @else
                                    <li style="margin-left: 14px">
                                            Create new user
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('user.list') }}">
                                        List of users
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasrole
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true" v-pre>
                                Permissions <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                @hasrole('Admin')
                                <li>
                                    <a href="{{ route('permission.create') }}">
                                        Create new permission
                                    </a>
                                </li>
                                @else
                                    <li style="margin-left: 4px">
                                        Create new permission
                                    </li>
                                    @endhasrole
                                    <li>
                                        <a href="{{ route('permission.list') }}">
                                            List of permissions
                                        </a>
                                    </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true" v-pre>
                                Roles <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                @hasrole('Admin')
                                <li>
                                    <a href="{{ route('role.create') }}">
                                        Create new role
                                    </a>
                                </li>
                                @else
                                <li style="margin-left: 16px">
                                        Create new role
                                </li>
                                @endhasrole
                                <li>
                                    <a href="{{ route('role.list') }}">
                                        List of roles
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @if(Session::has('msg'))
        <div class="container">
            <div class="alert alert-success"><em> {!! session('msg') !!}</em>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include ('errors.list') {{-- Including error file --}}
        </div>
    </div>
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
