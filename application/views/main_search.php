
                    <!-- END ALERTS AND CALLOUTS -->
                    <!-- START CUSTOM TABS -->
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li><a href="#tab_page" id="character" data-toggle="tab" class="active">單字</a></li>
                                    <li><a href="#tab_page" id="phone" data-toggle="tab">字音</a></li>
                                    <li><a href="#tab_page" id="part" data-toggle="tab">部件</a></li>
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
                                        <form role="form" method="post" id="submit-form" action="search" enctype="multipart/form-data">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="comment">請輸入想查詢的單字 (例如: <button type="button" class="btn btn-default btn-xs" id="example1">我</button> 或 <button type="button" class="btn btn-default btn-xs" id="example2">饥</button>):</label>
                                                    <input type="text" class="form-control" name="search-ch" id="search-ch" placeholder="單字..." style="width: 140px">
                                                </div>
                                                <div class="form-group" id="only-phone">
                                                    <label>
                                                        <input name="phoneval" type="radio" value="phone_realvalue" checked="checked"> <a title="There are two types of representations to fit varing needs of different computational models. One is coded by real valuse between 0.0 and 1.0, and the other one is coded by binary numbers (0 or 1). Users can select the one they want by clicking the corresponding checkbox. The default one is real code.">RealValue</a> 
                                                    </label>
                                                    <label>
                                                        <input name="phoneval" type="radio" value="phone_binary"> <a title="轉換二進位碼">Binary</a> 
                                                    </label>
                                                    <h6>&nbsp;&nbsp;&nbsp;註：出處來自於 http://php.scripts.psu.edu/pul8/chi_rep/chinese_patphon.html</h6>
                                                </div>
                                                <input type='hidden' id='search_type' name='search_type' value='character'>
                                                <div id='rm_tmp'>
                                                    <?php echo $page_rm_tmp;?>
                                                </div>                                                
                                            </div><!-- /.box-body -->

                                            <div class="box-footer">                                            
                                                <button type="button" class="btn btn-primary" id="validate">輸入</button>
                                                <button type="reset" class="btn btn-default">重置</button>
                                                <label id="error-msg" style="color: red"></label>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">                    
                                                    <label for="comment">或上傳檔案 : </br>(副檔名為txt)</br>(可查詢多個單字，以空格作為分隔，例如 : 我 饥):</label>
                                                    <input id="file-0a" class="file" type="file" name="FILE">
                                                </div>
                                            </div><!-- /.box-body -->
                                        </form></br></br>
                                        <!-- Loading (remove the following to stop the loading)-->
                                        <div class="overlay" style="display:none"></div>
                                        <div class="loading-img" style="display:none"></div>

                                        <div id='result-tab'>
                                            <div class="box-header">
                                                <i class='ion ion-android-promotion'></i>  
                                                <h3 class="box-title">查詢結果&nbsp;&nbsp;<h4>(移動游標至欄位名稱上方，可見欄位說明)</h4></h3>                                   
                                            </div><!-- /.box-header -->
                                            <div class="box-body table-responsive" id="table-header">
                                            </div>                               
                                        </div></br>
                                        <div id='result-download'>
                                            <?php echo $page_file_search;?></br>                                      
                                        </div>  
                            </div><!-- /.box -->



                                    </div>
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div>
    </body>
</html>