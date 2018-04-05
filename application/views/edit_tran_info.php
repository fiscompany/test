<div id="content">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
	      	<div class="box box-info">
			    <div class="box-header with-border">
			      <h3 class="box-title">تعديل الحوالة</h3>
			    </div><!-- /.box-header -->
			    <!-- form start -->
			    <form class="form-horizontal" id="trans_form" action="Admin/updateExpTrans" method="post">
				<input type="hidden" name="id" value="<?php echo (isset($query))?  $query[0]->id : '' ;?>">
				<input type="hidden" name="type" value="<?php echo ($typeid)?  $typeid : '' ;?>">
			      <div class="box-body">
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">اسم الزبون : </label>
			          <label class="col-sm-5 control-label" style="text-align:right;"><?php echo isset($query)?  $query[0]->name_ar : '' ;?></label>
			        </div>
		         	<div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">نوع الحوالة : </label>
			          <label class="col-sm-4 control-label" style="text-align:right;"><?php echo isset($type)?  $type : '' ;?></label>
			        </div>
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة العربية</label>
			          <div class="col-sm-5">
			            <input type="text" class="form-control" name="c_name" value="<?php echo(isset($query)?  $query[0]->c_name : '');?>">
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">رقم الجوال</label>
			          <div class="col-sm-5">
			            <input type="text" class="form-control" name="c_mobile" value="<?php echo(isset($query)?  $query[0]->c_mobile : '');?>">
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">الدولة</label>
			          <div class="col-sm-5">
			            <input type="text" class="form-control" name="c_country" value="<?php echo(isset($query)?  $query[0]->c_country : '');?>">
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-sm-4 control-label" style="text-align:right;">المبلغ</label>
			          <div class="col-sm-3">
			            <input type="number" class="form-control" name="c_value" value="<?php echo(isset($query)?  $query[0]->value : '');?>">
			          </div>
			          <div class="col-sm-4">
		          		<select name="c_curr">
		          			<?php foreach ($query1 as $q) {
	          				?>
	          					<option value="<?php echo $q->id?>" <?php echo(( $q->id == $query[0]->currency_id)? 'selected' : '');?> >
					            	<?php echo $q->name?>	
				            	</option>
			            	<?php
		          			}
		          			?>
		            	</select>
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
