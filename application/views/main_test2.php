
                    <!-- END ALERTS AND CALLOUTS -->
                    <!-- START CUSTOM TABS -->
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_page" id="tab_1" data-toggle="tab">單字</a></li>
                                    <li><a href="#tab_page" id="tab_2" data-toggle="tab">字音</a></li>
                                    <li><a href="#tab_page" id="tab_3" data-toggle="tab">部件</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_page">



                            <div class="box box-default">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">                                        
                                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->

                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">
                                        搜尋
                                    </h3>
                                </div>                                      
                                        <!-- form start -->
                                        <!-- multipart/form-data則是不做任何編碼，如果需要上傳文件時，就要使用它 -->
                                        <form role="form" method="post" id="submit-form" enctype="multipart/form-data">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="comment">請輸入想查詢的字 (例如: <button type="button" class="btn btn-default btn-xs" id="example1">我</button> 或 <button type="button" class="btn btn-default btn-xs" id="example2">饥</button>):</label>
                                                    <input type="text" class="form-control" name="search-ch" id="search-ch" placeholder="單字..." style="width: 140px">
                                                </div>
                                                <div class="form-group" id="only-phone">
                                                    <label>
                                                        <input name="phoneval" type="radio" value="phone_realvalue" checked="checked"> RealValue 
                                                    </label>
                                                    <label>
                                                        <input name="phoneval" type="radio" value="phone_binary"> Binary 
                                                    </label>
                                                </div> 
                                                <div class="form-group">                    
                                                    <label for="comment">或上傳檔案:</label>
                                                    <input id="file-0a" class="file" type="file" name="FILE" multiple>
                                                </div>
                                            </div><!-- /.box-body -->

                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary">輸入</button>
                                                <button type="reset" class="btn btn-default">重置</button>
                                                <label id="error-msg" style="color: red"></label>
                                            </div>
                                        </form></br></br>
                                        <!-- Loading (remove the following to stop the loading)-->
                                        <div class="overlay" style="display:none"></div>
                                        <div class="loading-img" style="display:none"></div>

                                        <div id='result-tab'>
                                            <div class="box-header">
                                                <i class='ion ion-android-promotion'></i>  
                                                <h3 class="box-title">查詢結果</h3>                                   
                                            </div><!-- /.box-header -->
                                            <div class="box-body table-responsive" id="table-header">
                                            </div>
                                        </div>
                            </div><!-- /.box -->



                                    </div>
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div>
    </body>
</html>