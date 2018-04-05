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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align:right;">رقم الهوية : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="id_no" id="id_no">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة العربية : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name_ar" id="name_ar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة الإنجليزية : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name_en" id="name_en">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="text-align:right;">رقم الجوال :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="mobile" id="mobile">
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
		<div class="col-xs-12">
			<div class="box search-result">
	            <div class="box-header">
	              <h3 class="box-title">نتائج البحث</h3>
	            </div><!-- /.box-header -->
	            <div class="box-body">
	              	<table class="table table-bordered table-hover" id="example1">
	              		<thead>
	              			<tr>
	                  			<th>رقم الهوية</th>
	                  			<th>الاسم بالعربية</th>
	                  			<th>الاسم بالانجليزية</th>
                  				<th>رقم الجوال</th>
	                  			<th>تعديل</th>
	                		</tr>
	              		</thead>
	                	<tbody>
	                		<?php
            			 	if(isset($query)){
                			foreach($query as $q){
                					?>
        					<tr data-row-id="<?php echo $q->id;?>">
	                  			<th data-name='id_no'><?php echo $q->id_no;?></th>
	                  			<th data-name='name_ar'><?php echo $q->name_ar;?></th>
	                  			<th data-name='name_en'><?php echo $q->name_en;?></th>
	                  			<th data-name='mobile'><?php echo $q->mobile;?></th>
	                  			<th>
	                  				<a style="margin-left: 10px;" class="ifram edit" data-id="<?php echo $q->id;?>" title="تعديل بيانات الموظف" href="Customer/Edit/<?php echo $q->id;?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
		                  			<a href="Customer/Delete/<?php echo $q->id;?>" class="ConfirmDelete">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
	                  			</th>
                			</tr>
	                		<?php
	                			}
	                		}
	                		?>
	              		</tbody>
          			</table>
                </div>
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
} );
</script>

<input type="hidden" id="c_id">
<script>
    $(document).ready(function() {
        
        $('#iframModal').on('hidden.bs.modal', function() {
            GetCustomer();
        });
        
        $('.edit').on('click', function() {
            $('#c_id').val( $(this).data('id') );
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
                    
                    var tr = $('tr[data-row-id="'+$('#c_id').val()+'"]');
                    
                    $(tr).find('[data-name="id_no"]').html(response[0]['id_no']);
                    $(tr).find('[data-name="name_ar"]').html(response[0]['name_ar']);
                    $(tr).find('[data-name="name_en"]').html(response[0]['name_en']);
                    $(tr).find('[data-name="mobile"]').html(response[0]['mobile']);
                    
                    tr.animate({backgroundColor: "#d1ebfb"}, 500);
                    tr.animate({backgroundColor: "#ffff"}, 500);
                }
            }
        });
    }
    
    $('#name_ar,#id_no,#name_en,#mobile').keypress(function(e) {
        if(e.which == 13) {
            $('#search').click();
        }
    });
    
    $('#search').click(function() {
        loading();
        $.ajax({
            type: "GET",
            url: "Customer/Search",
            dataType: 'json',
            data: {
                "id_no": $('#id_no').val(),
                "name_ar": $('#name_ar').val(),
                "name_en": $('#name_en').val(),
                "mobile": $('#mobile').val(),
            },
            success: function(response) {
                var table = $('#example1').DataTable();
                table.clear().draw();
                $.each(response,function(index,value) {
                    table.rows.add([{
                        0:value.id_no,
                        1:value.name_ar,
                        2:value.name_en,
                        3:value.mobile,
                        4:
                        '<a style="margin-left: 10px;" title="تعديل بيانات الموظف" class="ifram edit" data-id="'+value.id+'" href="Customer/Edit/'+value.id+'">'+
                        '<span class="glyphicon glyphicon-edit"></span>'+
                        '</a>'+
		                '<a href="Customer/Delete/'+value.id+'" class="ConfirmDelete">'+
                        '<span class="glyphicon glyphicon-remove"></span>'+
                        '</a>'
                    }]).draw();
                });
            }
        });
        setTimeout(function(){ unloading(); }, 50);
    });
    
    function loading () {
        $('.search-result').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    }
    function unloading () {
        $('.search-result').find('.overlay').remove();
    }
</script>