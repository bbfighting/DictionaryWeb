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
                                <form role="form" method="post" action="search" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="comment">請輸入想查詢的字:</label>
                                            <input type="text" class="form-control" name="search_character" maxlength="3" placeholder="字..." style="width: 140px">
                                        </div>
                                        <div class="form-group">                    
                                            <label for="comment">或上傳檔案:</label>
                                            <input id="file-0a" class="file" type="file" name="FILE" multiple>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">輸入</button>
                                        <button type="reset" class="btn btn-default">重置</button>
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

                                    <h3 class='box-title'>查詢結果</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body no-padding'>
                                    <div class='box-body table-responsive'>
                                        <table class='table table table-bordered table-hove'>    
                                                <?php echo $page_table_search;?>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                        </section>
                    </div>