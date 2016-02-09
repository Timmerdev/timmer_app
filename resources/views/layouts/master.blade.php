<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon"
                type="image/png"
                href="{{ URL::to('/images/icon.png') }}">

    <title>Timmer App</title>

    {!! HTML::style('/assets/plugins/bootstrap/css/bootstrap.min.css') !!}
    {!! HTML::style('/assets/css/navbar-static-top.css') !!}

        @yield('head')
        
  </head>
 <body>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Timmer App</a>
        </div>
         <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            @if(!Auth::check())
                <li><a href="{{ url('login')  }}">Home</a></li>
            @else
                <li><a href="{{ url('day')  }}">Home</a></li>
            @endif
                <li><a href="{{ url('about')  }}">About</a></li>
                 <li><a href="#"> <div id="clockbox" style="text-align:center"></div></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(!Auth::check())
                <li><a href="{{ url('login') }}">Login</a></li>
                <li><a href="{{ url('register') }}">Register</a></li>
                @else
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->first_name }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header"><b>Actions</b></li>
                            <li><a href="{{ url('day') }}">Logs</a></li>
                            <li><a href="{{ url('week') }}">Lists</a></li>
                            <li><a href="{{ url('thisMonth') }}">Monthly View</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('logout') }}">Logout</a></li>
                            </ul>
                </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class = "container">
    @yield('content')

    

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {!! HTML::script('/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
{!! HTML::script('/assets/js/ie10-viewport-bug-workaround.js') !!}
{!! HTML::script('/assets/js/clock.js') !!}


@yield('footer')
  </body>


  
 

  </html>