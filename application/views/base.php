<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/dictionary/images/research.png">

    <title>字典網站</title>

    <!-- Bootstrap core CSS -->
    <link href="/dictionary/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/dictionary/css/justified-nav.css" rel="stylesheet">

    <!-- font Awesome -->
    <link href="/dictionary/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="/dictionary/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   <!-- Theme style -->
    <link href="/dictionary/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/dictionary/css/fileinput.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="/dictionary/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/dictionary/jscript/ie-emulation-modes-warning.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/dictionary/jscript/ie10-viewport-bug-workaround.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/dictionary/jscript/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <?php echo $render_main_jslist;?>
    <script src="/dictionary/jscript/fileinput.js" type="text/javascript"></script>
    <script src="/dictionary/jscript/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/dictionary/jscript/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="/dictionary/jscript/plugins/AdminLTE/app.js" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <nav role="navigation" class="navbar navbar-inverse">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">字典</a>
          </div>
          <!-- Collection of nav links, forms, and other content for toggling -->
          <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <?php echo $render_main_menubar;?>
<!--               <li class="active"><a href="#">Home</a></li>
              <li><a href="search">Search</a></li>
              <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Structure...<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  <li><a href="#">Structure...</a></li>
                  <li><a href="#">Structure...</a></li>
                  <li><a href="#">Structure...</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Structure...</a></li>
                </ul>
              </li> -->
            </ul>
          </div>
        </nav>
      </div>
      <?php echo $render_main_contents;?>

<!--       <div class="jumbotron">
        <h1>Welcome</h1>
        <p class="lead">This is a dicitionary web.</p>
        <p><a class="btn btn-lg btn-success" href="search" role="button">Get start</a></p>
      </div> -->

      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Company 2015</p>
      </footer>

    </div> <!-- /container -->               
  </body>
</html>
