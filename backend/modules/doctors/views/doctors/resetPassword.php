<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- start Sign In -->
      <div class="box box-primary">
		<div class="box-body" style="min-height: 500px;">
             <div class="benefits_menus">
		<p>Please choose your new password:</p>
		</div>
        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
		 <div class="form-group col-lg-4 col-sm-12 btnWithTooltip"  data-placement="top" 
            data-original-title="this is a tooltip that your registered email" 
            data-html="true" placeholder="password" required >
        	
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'confirmpassword')->passwordInput(['autofocus' => true]) ?>
       		 
        </div>
          <div class="clearfix"></div>
          <div class="col-lg-4 col-sm-12 reg-bwn"> <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?></div>
          
          
            <?php ActiveForm ::end();?>
          <div class="clearfix"></div>
        </div>
      
    </div>

	<!-- End  Sign In -->
	
	

	
  <script>$(function() {
    $(".btnWithTooltip").tooltip();
});
</script>
	<style>
.tooltip-inner {
	width: 200px;
	background: #000;
	font-family:Calibri, Arial;
	font-size:1em;}
div.form-group {
	position: relative;
}
div.form-group input  i.fa {
	position: absolute;
	right: -5px;
	bottom: 25px;
	font-size: 1em;
	left:0px !important;
	
	
}
.Qty-symbol-tooltip
{
		float:right;
		width:0px;
		margin-top:-35px

}
</style>



