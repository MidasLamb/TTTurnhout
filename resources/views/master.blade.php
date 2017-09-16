<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>KBBC T&T Turnhout</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar-fixed-side.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <style>
      .navbar {border-radius: 0px;}
    </style>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">KBBC T&T Turnhout</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/"> Home </a></li>
            <li class="{{ Request::is('kalender') ? 'active' : '' }}"><a href="/kalender">Kalender</a></li>
            <li class="dropdown {{ (Request::is('ploeg/*') || Request::is('ploegen')) ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ploegen <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="{{ Request::is('ploegen') ? 'active' : '' }}"><a href="/ploegen">Alle Ploegen</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Seniors</li>
                @foreach (Helpers::teamSenCodes() as $teamkey => $teamval)
                  <li class="{{ Request::is('ploeg/'.$teamval) ? 'active' : '' }}"><a class="teamlink" href="/ploeg/{{$teamval}}#team"> {{ $teamkey }}</a></li>
                @endforeach
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Jeugd</li>
                @foreach (Helpers::teamYouthCodes() as $teamkey => $teamval)
                  <li class="{{ Request::is('ploeg/'.$teamval) ? 'active' : '' }}"><a class="teamlink" href="/ploeg/{{$teamval}}#team"> {{ $teamkey }}</a></li>
                @endforeach
              </ul>
            </li>
          </ul>


          <ul class="nav navbar-nav navbar-right">
            <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div>
      @yield('content')
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @yield('scripts')
  </body>
</html>