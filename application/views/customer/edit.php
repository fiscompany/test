<div id="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <?php echo form_open_multipart(null,array("class"=>"form-horizontal")) ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">رقم الهوية : </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="id_no" id="id_no" value="<?php echo $customer[0]->id_no; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة العربية : </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name_ar" id="name_ar" value="<?php echo $customer[0]->name_ar; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">الاسم باللغة الإنجليزية : </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name_en" id="name_en" value="<?php echo $customer[0]->name_en; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">رقم الجوال :</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $customer[0]->mobile; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align:right;">صورة الهوية</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control col-sm-10" name="file" id="file">
                                <div class="row">
                                    <span class="col-xs-12" style="color:red;"><strong>تنويه :</strong> الصيغ المسموح بها للرفع هي (jpg , png , jpeg) والحجم 500KB</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">الصورة المرفوعة</label>
                            <?php if ($customer[0]->file_name != null) { ?>
                            <img class="col-sm-8" alt="صورة الهوية" style="width: 17%;" src="uploads/<?php echo $customer[0]->file_name; ?>">
                            <?php }else{ ?>
                            <p>لا يوجد صورة</p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="col-sm-offset-5 col-sm-2 btn btn-info">حفظ</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>