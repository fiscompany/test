<div id="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">بحث</h3>
                </div>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align:right;">اسم الزبون : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="customer_name" id="customer_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align:right;">اسم المرسل : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sender_name" id="sender_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align:right;">الدولة : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="country" id="country">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:right;">التاريخ :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" style="text-align:right;">من</label>
                                                    <div class="col-sm-10">
                                                        <input style="text-align:center;direction:ltr;" type="text" class="form-control datemask" name="from_date" id="from_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" style="text-align:right;">إلى</label>
                                                    <div class="col-sm-10">
                                                        <input style="text-align:center;direction:ltr;" type="text" class="form-control datemask" name="to_date" id="to_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:right;">المبلغ :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" style="text-align:right;">من</label>
                                                    <div class="col-sm-10">
                                                        <input style="text-align:center;" type="number" class="form-control" name="from_money" id="from_money">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" style="text-align:right;">إلى</label>
                                                    <div class="col-sm-10">
                                                        <input style="text-align:center;" type="number" class="form-control" name="to_money" id="to_money">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="search" type="button" class="col-sm-offset-5 col-sm-2 btn btn-info">بحث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box search-result">
                <div class="box-header">
                    <h3 class="box-title">نتائج البحث</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>اسم الزبون</th>
                                <th>اسم المرسل</th>
                                <th>الدولة</th>
                                <th>التاريخ</th>
                                <th>المبلغ</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
            			 	if(isset($query)){
                			foreach($query as $q){
                					?>
                                <tr>
                                    <th>
                                        <?php echo $q->name_ar;?>
                                    </th>
                                    <th>
                                        <?php echo $q->sender_name_ar;?>
                                    </th>
                                    <th>
                                        <?php echo $q->sender_country;?>
                                    </th>
                                    <th>
                                        <?php echo date('Y-m-d', strtotime($q->created_at));?> </th>
                                    <th>
                                        <?php echo $q->value;?>
                                        <?php echo $q->name;?>
                                    </th>
                                    <th>
                                        <a style="margin-left: 10px;" href="Admin/getImpTransEdit/<?php echo $q->id;?>"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a href="Admin/deleteImpTrans/<?php echo $q->id;?>" class="ConfirmDelete"><span class="glyphicon glyphicon-remove"></span></a>
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
<!-- page script -->
<script>
    $(document).ready(function() {
        // DataTable
        var table = $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json"
            }
        });
        //Datemask
        $(".datemask").inputmask("dd-mm-yyyy", {
            "placeholder": "dd-mm-yyyy"
        });
    });

    $('#customer_name,#sender_name,#country,#from_date,#to_date,#from_money,#to_money').keypress(function(e) {
        if (e.which == 13) {
            $('#search').click();
        }
    });

    $('#search').click(function() {
        if (checkDateRange() && checkMoneyRange()) {
            loading();
            $.ajax({
                type: "GET",
                url: "Transaction/ImpSearch",
                dataType: 'json',
                data: {
                    "customer_name": $('#customer_name').val(),
                    "sender_name": $('#sender_name').val(),
                    "country": $('#country').val(),
                    "from_date": $('#from_date').val(),
                    "to_date": $('#to_date').val(),
                    "from_money": $('#from_money').val(),
                    "to_money": $('#to_money').val(),
                },
                success: function(response) {
                    var table = $('#example1').DataTable();
                    table.clear().draw();
                    $.each(response, function(index, value) {
                        table.rows.add([{
                            0: value.customer_name,
                            1: value.sender_name_ar,
                            2: value.sender_country,
                            3: value.created_at,
                            4: value.value + ' ' + value.currency_name,
                            5: '<a style="margin-left: 10px;" href="Admin/getImpTransEdit/' + value.id + '">' +
                                '<span class="glyphicon glyphicon-edit"></span>' +
                                '</a>' +
                                '<a href="Admin/deleteImpTrans/' + value.id + '" class="ConfirmDelete">' +
                                '<span class="glyphicon glyphicon-remove"></span>' +
                                '</a>'
                        }]).draw();
                    });
                }
            });
            setTimeout(function() {
                unloading();
            }, 50);
        }
    });

    function checkDateRange() {
        if ($('#from_date').val().length > 0 && $('#to_date').val().length > 0) {
            var from_date = new Date($('#from_date').val())
            var to_date = new Date($('#to_date').val())
            if (from_date > to_date) {
                MakeMessage('الرجاء التأكد من التاريخ');
                return false;
            }
        }
        return true;
    }

    function checkMoneyRange() {
        if ($('#from_money').val().length > 0 && $('#to_money').val().length > 0) {
            if ($('#from_money').val() > $('#to_money').val()) {
                MakeMessage('الرجاء التأكد من قيمة المبلغ');
                return false;
            }
        }
        return true;
    }

    function loading() {
        $('.search-result').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    }

    function unloading() {
        $('.search-result').find('.overlay').remove();
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
    function MakeMessage(message) {
        $('#message p').html(message);
        $('#message').modal();
    }
</script>