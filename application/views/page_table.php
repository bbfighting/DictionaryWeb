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

    <title>Dictionary_web</title>

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

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/dictionary/jscript/ie-emulation-modes-warning.js"></script>

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
            <a href="#" class="navbar-brand">Dictionary</a>
          </div>
          <!-- Collection of nav links, forms, and other content for toggling -->
          <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="home">Home</a></li>
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
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <!-- Jumbotron -->

                    <div class="row">
                        <!-- left column -->
                        <div class="col-xs-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">                                        
                                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->

                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">
                                        Search
                                    </h3>
                                </div>
                                <!-- form start -->
                                <!-- multipart/form-data則是不做任何編碼，如果需要上傳文件時，就要使用它 -->
                                <form role="form" method="post" action="table" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="comment">type you want search word:</label>
                                            <input type="text" class="form-control" name="search_character" maxlength="3" placeholder="character..." style="width: 140px">
                                        </div>
                                        <div class="form-group">                    
                                            <label for="comment">Or upload a file:</label>
                                            <input id="file-0a" class="file" type="file" name="FILE" multiple>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                    <div class='row'>
                        <!-- Left col -->
                        <section class='col-md-12 connectedSortable'> 
                            <!-- Box (with bar chart) -->
                            <div class='box box-info' id='loading-example'>
                                <div class='box-header'>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
                                        <button class='btn btn-info btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>
                                    </div><!-- /. tools -->
                                    <i class='ion ion-android-promotion'></i>

                                    <h3 class='box-title'>Output</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body no-padding'>
                                    <div class='box-body table-responsive'>
                                        <table class='table table table-bordered table-hove'>    
                                            <thead>
                                                <tr>
                                                    <th>正體</th>
                                                    <th>編碼</th>
                                                    <th>部首</th>
                                                    <th>部首筆畫</th>                                           
                                                    <th>偏旁筆畫</th>
                                                    <th>簡體</th>
                                                    <th>簡體對應正體字</th>
                                                </tr>                                                                                                                                     
                                            </thead>
                                            <tbody>
                                                <?php echo $page_table_search;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                        </section>
                    </div>

      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Company 2015</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/dictionary/jscript/ie10-viewport-bug-workaround.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/dictionary/jscript/bootstrap.min.js" type="text/javascript"></script>
    <script src="/dictionary/jscript/fileinput.js" type="text/javascript"></script>
    <script src="/dictionary/jscript/plugins/AdminLTE/app.js" type="text/javascript"></script>
  </body>
</html>