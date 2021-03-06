<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Site voor Koninklijke Basketbalclub T&T Turnhout. Wedstrijdlocaties, toekomstige wedstrijden, afgelopen wedstrijden en wedstrijden deze week.">
    <meta name="application-name" content="KBBC T&T Turnhout">
    <!--
    <meta name="theme-color" content="HEXWAARDE"> -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" href="/favicon.ico">
    <title>KBBC T&T Turnhout</title>
    <link href="/css/app.css" rel="stylesheet">
    <style>
      .navbar {border-radius: 0px;}
      .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        vertical-align: middle;
      }
    </style>
    @yield('css')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110519674-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-110519674-1', {'anonymize_ip': true});
    </script>

  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
              @if (Auth::check())
              <li class="dropdown {{ (Request::is('admin/*')) ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Menu <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="{{ Request::is('admin/ploegen') ? 'active' : '' }}"><a href="/admin/ploegen">Alle Ploegen</a></li>
                </ul>
              </li>
              @endif

            <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact" style="margin-right:20px">Contact</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div style="margin-top:50px">

      <div class="jumbotron" style='display:flex;justify-content:center;padding-left:10%;padding-right:10%;'>
          <div>
            <h1>Nieuwe site</h1>
            <p>
              Momenteel wordt er gewerkt aan een nieuwe site. Je kan deze al bezoeken en eens rondkijken. Feedback mag altijd naar <a href="mailto:midaslamb@gmail.com">midaslamb@gmail.com</a> gestuurd worden.
            </p>
            <div>
              <a class="btn btn-primary btn-lg" href="/beta" onclick="gtag('event', 'click', {
                'event_category': 'link',
                'event_label': 'beta',
                'value': 1
              });">Naar de nieuwe site</a>
            </div>
          </div>
      </div>

      @yield('content')
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/app.js"></script>

    @yield('scripts')
  </body>
</html>