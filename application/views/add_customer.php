<div id="content">
    <div class="alert alert-danger alert-dismissable hide">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>aaa</h4><span>aaa</span>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- showimg modal -->
            <div id="showimg" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">صورة الهوية</h4>
                        </div>
                        <div class="modal-body">

                            <img id="showimgmodal" width="300px" height="300px" style="display: block;margin-left: auto;margin-right: auto" src="" alt="صورة الهوية">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">اغلاق</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div id="CustomerMessageSuccess" class="alert alert-success alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>تم بنجاح</h4><span></span>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">اضافة زبون جديد</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" enctype="multipart/form-data" id="customer_form" action="Customer/Add">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">رقم الهوية</label>
                            <div class="col-sm-8">
                                <input type="integer" class="form-control" name="id_no" id="id_no" value="<?php if(isset($query)) echo $query[0]->id_no;
			            	elseif(isset($ssn)) print_r($ssn); else echo set_value('id_no'); ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة العربية</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name_ar" id="name_ar" value="<?php if(isset($query)) echo $query[0]->name_ar; else echo set_value('name_ar'); ?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة الانجليزية</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name_en" value="<?php if(isset($query)) echo $query[0]->name_en; else echo set_value('name_en'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">رقم الجوال</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mobile" value="<?php if(isset($query)) echo $query[0]->mobile; else echo set_value('mobile'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">صورة الهوية</label>
                            <div class="col-sm-8 file_upload">
                                <?php if(isset($query)) {?>
                                <img href="#showimg" name="showimg" data-toggle="modal" data-target="#showimg" src="uploads/<?php echo $query[0]->file_name;?>" width="40px" height="30px" alt="صورة الهوية" class="col-sm-2">
                                <?php }  else {?>
                                <input type="file" class="form-control col-sm-10" name="file_name" value="<?php if(isset($query)) echo $query[0]->file_name;?>">
                                <div class="row">
                                    <span class="col-xs-12" style="color:red;"><strong>تنويه :</strong> الصيغ المسموح بها للرفع هي (jpg , png , jpeg) والحجم 500KB</span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" id="box-btns">
                        <a id="editclient" style="<?php if(!isset($query)) {echo 'display:none;';}else {echo 'display:block;';} ?>" href="<?php if(isset($query)) {echo 'Customer/Edit/'.$query[0]->id;} ?>" class="col-sm-3 btn btn-info pull-right ifram" title="تعديل بيانات الموظف">تعديل البيانات</a>
                        <a id="clear_customer" style="<?php if(!isset($query)) {echo 'display:none;';}else {echo 'display:block;';} ?>" href="admin/add" type="button" class="col-sm-offset-1 col-sm-3 btn btn-info pull-right">مستخدم جديد</a>
                        <?php if(!isset($query)) {?>
                        <button type="button" id="new_customer" class="col-sm-2 btn btn-info pull-right">حفظ</button>
                        <?php } ?>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">الحوالات الصادرة</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped" id="table1">

                        <thead>
                            <tr>
                                <th>اسم المستقبل</th>
                                <th>التاريخ</th>
                                <th>المبلغ</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
            			 	if(isset($query1)){
                			foreach($query1 as $q){
                					?>
                                <tr>
                                    <th>
                                        <?php echo $q->recipient_name_ar;?>
                                    </th>
                                    <th>
                                        <?php echo date('Y-m-d', strtotime($q->created_at));?> </th>
                                    <th>
                                        <?php echo $q->value;?>
                                    </th>
                                </tr>
                                <?php
	                			}
	                		}
	                		?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">اضافة حوالة جديدة</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="trans_form" action="Transaction/Add" method="post">
                    <input type="hidden" name="c_id" id="c_id" value="<?php if(isset($query)) echo $query[0]->id;
			            	elseif(isset($ssn)) print_r($ssn);?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">نوع الحوالة</label>
                            <div class="col-sm-8">
                                <select name="type">
			            	<option value="1">حوالة صادرة</option>
			            	<option value="2">حوالة واردة</option>
			            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة العربية</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="c_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">رقم الجوال</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="c_mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">الدولة</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="c_country">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">المبلغ</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="c_value">
                            </div>
                            <div class="col-sm-4">
                                <select name="c_curr">
		          			<?php foreach ($query3 as $q) {
	          				?>
	          					<option value="<?php echo $q->id?>">
					            	<?php echo $q->name?>	
				            	</option>
			            	<?php
		          			}
		          			?>
		            	</select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button id="new_trans" type="button" class="col-sm-2 btn btn-info pull-right">حفظ</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">الحوالات الواردة</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped" id="table2">

                        <thead>
                            <tr>
                                <th>اسم المرسل</th>
                                <th>التاريخ</th>
                                <th>المبلغ</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
            			 	if(isset($query2)){
                			foreach($query2 as $q){
                					?>
                                <tr>
                                    <th>
                                        <?php echo $q->sender_name_ar;?>
                                    </th>
                                    <th>
                                        <?php echo date('Y-m-d', strtotime($q->created_at));?> </th>
                                    <th>
                                        <?php echo $q->value;?>
                                    </th>
                                </tr>
                                <?php
	                			}
	                		}
	                		?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {


        /*****************************/

        var name_ar = new Array();
        $('#name_ar').typeahead({
            source: function(request, response) {
                $.ajax({
                    url: 'Admin/get_custumers',
                    dataType: "json",
                    type: "GET",
                    data: {
                        text_string: request
                    },
                    //contentType: "application/json;",
                    success: function(data) {
                        var arr_names = [];
                        //var data = $.parseJSON(data);
                        if (data != " ") {
                            $.each(data, function(index, item) {
                                name_ar.push(item.name_ar);
                            });
                            response($.map(data, function(item) {
                                arr_names.push(item.name_ar);
                            }))
                        }

                        response(arr_names);
                        // SET THE WIDTH AND HEIGHT OF UI AS "auto" ALONG WITH FONT.
                        // YOU CAN CUSTOMIZE ITS PROPERTIES.
                        $("#name_ar").closest("div").find(".dropdown-menu").css("width", "100%");
                        $("#name_ar").closest("div").find(".dropdown-menu").css("max-height", "300px");
                        $("#name_ar").closest("div").find(".dropdown-menu").css("font", "15px Verdana");
                        $("#name_ar").closest("div").find(".dropdown-menu").css("margin-right", "3%");
                    },
                    updater: function(selection) {
                        $('#name_ar').val(selection);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        GetErrorMessage(jqXHR, textStatus, errorThrown);
                    }
                });
            },
            hint: true, // SHOW HINT (DEFAULT IS "true").
            highlight: true, // HIGHLIGHT (SET <strong> or <b> BOLD). DEFAULT IS "true".
            minLength: 3, // MINIMUM 1 CHARACTER TO START WITH.
            autoSelect: true,
            matcher: function(item) {
                return true;
            }
        });

        /*
        	$("#name_ar").change(function(){
        		var valu = $(this).val();
        		if (inArray(name_ar) === -1 ){
        			$("#name_ar").val(valu);
        		}
        	})
        */
        $('#name_ar').change(function() {
            var value = $(this).val();
            if (name_ar.length > 0) {
                if ($.inArray(value, name_ar) != -1) {
                    $("#name_ar").val(value);
                }
            }
            $(".typeahead dropdown-menu").hide();
            /*
            var inputs = $(this).closest('form').find(':input');
            if (value != "" && value != null) {
            	inputs.eq(inputs.index(this) + 1).focus();
            }
            */
        });
        /***************************/






        $('#showimg').on('shown.bs.modal', function() {
            var src = $('.file_upload img').attr("src");
            $('#showimg #showimgmodal').attr("src", src);

        });
        $("#id_no").keypress(function(e) {
            var value = $(this).val();
            if (e.charCode === 13) {
                check_id(1, value)
            }
        });
        $("#name_ar").keypress(function(e) {
            var value = $(this).val();
            if (e.charCode === 13) {
                check_id(2, value)
            }
        });
        $("#new_customer").click(function(e) {
            $("#customer_form").submit();
        });
        $("#new_trans").click(function(e) {
            if ($("#c_id").val() != "") {
                $("#trans_form").submit();
            } else {
                MakeMessage('الرجاء تحديد زبون');
            }
        });
    });
    var check_id = function(type, value) {
        $.ajax({
            type: "POST",
            url: "Admin/getCustomerInfo",
            data: {
                "type": type,
                "id_no": value
            },
            success: function(response) {
                //console.log(response);
                if (response.status == true) {
                    var query = response.result["query"];
                    $("#customer_form input[name=mobile]").val(query[0]["mobile"]);
                    $("#customer_form input[name=id_no]").val(query[0]["id_no"]);
                    $("#customer_form input[name=name_ar]").val(query[0]["name_ar"]);
                    $("#customer_form input[name=name_en]").val(query[0]["name_en"]);
                    $("#customer_form input[name=showimg]").attr('src', 'uploads/' + query[0]["filename"]);
                    $("#customer_form input[type=file]").remove();
                    //$('.file_upload img').remove();
                    $('.file_upload').html('');
                    $(".file_upload").append('<img href="#showimg" name="showimg" data-toggle="modal" data-target="#showimg" src="uploads/' + query[0]["file_name"] + '" width="40px" height="30px" alt="صورة الهوية" class="col-sm-2">');

                    //$('#box-btns').html();
                    //$('#box-btns').html('');
                    $('#editclient').css('display','block');
                    $('#editclient').attr('href','Customer/Edit/'+query[0]["id"]);
                    $('#clear_customer').css('display','block');
                    $('#new_customer').css('display','none');

                    var query2 = response.result["query2"];
                    var query1 = response.result["query1"];

                    var table_body2;
                    $.each(query2, function(index, item) {

                        var date = item.created_at.split(" ");
                        table_body2 += '<tr>';
                        table_body2 += '<td>' + item.sender_name_ar + '</td>';
                        table_body2 += '<td>' + date[0] + '</td>';
                        table_body2 += '<td>' + item.value + ' ' + item.currency_name + '</td>';
                        table_body2 += '</tr>';
                    });

                    $("#table2 tbody").html(table_body2);
                    var table_body1;
                    $.each(query1, function(index, item) {

                        var date = item.created_at.split(" ");
                        table_body1 += '<tr>';
                        table_body1 += '<td>' + item.recipient_name_ar + '</td>';
                        table_body1 += '<td>' + date[0] + '</td>';
                        table_body1 += '<td>' + item.value + ' ' + item.currency_name + '</td>';
                        table_body1 += '</tr>';
                    });

                    $("#table1 tbody").html(table_body1);

                    $('#c_id').val(query[0]["id"]);

                } else {
                    MakeMessage(response.message);
                }
                return false;
            },
            error: function() {
                console.log("Invalide!");
            }
        });
    }
    
    $(document).ready(function() {
        
        $('#iframModal').on('hidden.bs.modal', function() {
            GetCustomer();
        });
        
    });
    
    function GetCustomer() {
        $.ajax({
            type: "POST",
            url: "Customer/GetCustomer",
            dataType: 'json',
            data: {
                "id": $('#c_id').val()
            },
            success: function(response) {
                //console.log(response);
                if (response != null) {
                    $('#id_no').val(response[0]['id_no']);
                    $('#name_ar').val(response[0]['name_ar']);
                    $('input[name="name_en"]').val(response[0]['name_en']);
                    $('input[name="mobile"]').val(response[0]['mobile']);
                    //$('.file_upload img').remove();
                    $('.file_upload').html('');
                    $(".file_upload").append('<img href="#showimg" name="showimg" data-toggle="modal" data-target="#showimg" src="uploads/' +response[0]['file_name']+ '" width="40px" height="30px" alt="صورة الهوية" class="col-sm-2">');
                }
            }
        });
    }

</script>

<div id="message" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">إشعار</h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">حسناً</a>
                </div>
            </div>
        </div>
    </div>

<script>
    function MakeMessage (message) {
        $('#message p').html(message);
        $('#message').modal();
    }
</script>