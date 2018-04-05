<div id="content">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-8">
	      	<div class="box box-info">
			    <div class="box-header with-border">
			      <h3 class="box-title">تعديل بيانات الزبون</h3>
			    </div><!-- /.box-header -->
			    <!-- form start -->
			    <form enctype="multipart/form-data" class="form-horizontal" action="Admin/updateCustomer" method="post">
				<input type="hidden" name="id" value="<?php echo (isset($query))?  $query[0]->id : '' ;?>">
			      <div class="box-body">
			      	<div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">رقم الهوية : </label>
			          <div class="col-sm-5">
			            <input type="text" class="form-control" name="id_no" value="<?php echo(isset($query)?  $query[0]->id_no : '');?>">
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة العربية : </label>
			          <div class="col-sm-5">
			            <input type="text" class="form-control" name="name_ar" value="<?php echo(isset($query)?  $query[0]->name_ar : '');?>">
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة الانليزية : </label>
			          <div class="col-sm-5">
			            <input type="text" class="form-control" name="name_en" value="<?php echo(isset($query)?  $query[0]->name_en: '');?>">
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">رقم الجوال :</label>
			          <div class="col-sm-5">
			            <input type="text" class="form-control" name="mobile" value="<?php echo(isset($query)?  $query[0]->mobile : '');?>">
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">صورة الهوية</label>
			          <div class="col-sm-6 file_upload">
			            <input type="file" class="form-control col-sm-10" name="file_name" value="<?php if(isset($query)) echo $query[0]->file_name;?>">
			            <img  name="showimg" id="showimg" src="uploads/<?php echo $query[0]->file_name;?>" width="125px" height="125px" alt="customer Image" >
			          </div>
			        </div>
			       
			      </div><!-- /.box-body -->
			      <div class="box-footer">
			        <button type="submit" class="col-sm-2 btn btn-info pull-right">حفظ</button>
			      </div><!-- /.box-footer -->
			    </form>
			</div>
			
		</div>
	</div>
</div>
