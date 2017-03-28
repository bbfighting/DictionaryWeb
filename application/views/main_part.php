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
                                        搜尋
                                    </h3>
                                </div>
                                <!-- form start -->
                                <!-- multipart/form-data則是不做任何編碼，如果需要上傳文件時，就要使用它 -->
                                <form role="form" method="post" id="submit-form" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="comment">請輸入想查詢的部件 (例如: <button type="button" class="btn btn-default btn-xs" id="example1">糹</button> 或 <button type="button" class="btn btn-default btn-xs" id="example2">糹丩</button>):</label>
                                            <input type="text" class="form-control" name="search-part" id="search-part" placeholder="部件..." style="width: 140px">
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
                                <div id='result-part'>
                                    <div class="box-header">
                                        <i class='ion ion-android-promotion'></i>
                                        <h3 class="box-title">查詢結果</h3>                                    
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                        <?php echo $page_table_search;?>
                                    </div>
                                </div>                              
                            </div><!-- /.box -->
                        </div>
                    </div>