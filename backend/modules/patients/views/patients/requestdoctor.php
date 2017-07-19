<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Request Doctor';
$this->params ['breadcrumbs'] [] = [ 
		'label' => 'Request Doctors',
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="box box-primary">
	<div class="box-body">
<?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
<h3>Doctor Information</h3>
		<div class="form-group col-lg-12 col-sm-12">
			<select id="target">
				<option value="">Select Doctor</option>
				<option value="content_1">Dr.Shankar</option>
				<option value="content_2">Dr.Krishnamurthy</option>
				<option value="content_3">Dr.Venkat ama rao</option>
			</select>
		</div>
		<div class="form-group col-lg-12 col-sm-12">
			<div id="content_1" class="inv form-group col-lg-6 col-sm-12">
				<div class="row">
					<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
						<div class="right">Name</div>
						<div class="right-content">:</div>
						<div class="right-second">Shankar</div>

						<div class="right">Email</div>
						<div class="right-content">:</div>
						<div class="right-second">shankar@gmail.com</div>

						<div class="right">Qualification</div>
						<div class="right-content">:</div>
						<div class="right-second">MBBS</div>

						<div class="right">Specialities</div>
						<div class="right-content">:</div>
						<div class="right-second">Anesthesiologist.</div>

						<div class="right">Country Name</div>
						<div class="right-content">:</div>
						<div class="right-second">Austria</div>

						<div class="right">State Name</div>
						<div class="right-content">:</div>
						<div class="right-second">Schleswig-Holstein</div>

						<div class="right">City Name</div>
						<div class="right-content">:</div>
						<div class="right-second">hyderabad</div>

						<div class="right">Present Address</div>
						<div class="right-content">:</div>
						<div class="right-second">Present Address..ok</div>

						<div class="right">Permanent Adress</div>
						<div class="right-content">:</div>
						<div class="right-second">Permanent Address</div>

						<div class="right">Pin Code</div>
						<div class="right-content">:</div>
						<div class="right-second">34500</div>

						<div class="right">Mobile</div>
						<div class="right-content">:</div>
						<div class="right-second">9014866078</div>
					</div>
					<!---main-wrap closed-->
				</div>
			</div>
			<div id="content_2" class="inv form-group col-lg-6 col-sm-12">
				<div class="row">
					<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
						<div class="right">Name</div>
						<div class="right-content">:</div>
						<div class="right-second">Krishnamurthy</div>

						<div class="right">Email</div>
						<div class="right-content">:</div>
						<div class="right-second">krishna@gmail.com</div>

						<div class="right">Qualification</div>
						<div class="right-content">:</div>
						<div class="right-second">MD</div>

						<div class="right">Specialities</div>
						<div class="right-content">:</div>
						<div class="right-second">Anesthesiologist.</div>

						<div class="right">Country Name</div>
						<div class="right-content">:</div>
						<div class="right-second">India</div>

						<div class="right">State Name</div>
						<div class="right-content">:</div>
						<div class="right-second">Telangana</div>

						<div class="right">City Name</div>
						<div class="right-content">:</div>
						<div class="right-second">Hyderabad</div>

						<div class="right">Present Address</div>
						<div class="right-content">:</div>
						<div class="right-second">Present Address..ok</div>

						<div class="right">Permanent Adress</div>
						<div class="right-content">:</div>
						<div class="right-second">Permanent Address</div>

						<div class="right">Pin Code</div>
						<div class="right-content">:</div>
						<div class="right-second">500034</div>

						<div class="right">Mobile</div>
						<div class="right-content">:</div>
						<div class="right-second">9014866078</div>
					</div>
					<!---main-wrap closed-->
				</div>
			</div>
		</div>
		<hr>
		<h3>Patient Information</h3>
		<div class="form-group col-lg-6 col-sm-12" style="border:1px solid #ccc; border-radius:5px;">
		<div class="row">
			<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
				<div class="right">Patient Name</div>
				<div class="right-content">:</div>
				<div class="right-second">Sareesh&nbsp;N</div>

				<div class="right">PatientUnique ID</div>
				<div class="right-content">:</div>
				<div class="right-second">00002PAT06072017</div>

				<div class="right">Gender</div>
				<div class="right-content">:</div>
				<div class="right-second">Male</div>

				<div class="right">Age</div>
				<div class="right-content">:</div>
				<div class="right-second">27</div>

				<div class="right">Country Name</div>
				<div class="right-content">:</div>
				<div class="right-second">India</div>

				<div class="right">State Name</div>
				<div class="right-content">:</div>
				<div class="right-second">Telangana</div>

				<div class="right">City Name</div>
				<div class="right-content">:</div>
				<div class="right-second">Hyderabad</div>

				<div class="right">District</div>
				<div class="right-content">:</div>
				<div class="right-second">Hyerabad</div>

				<div class="right">Mandal</div>
				<div class="right-content">:</div>
				<div class="right-second">Bajarahills</div>

				<div class="right">Village</div>
				<div class="right-content">:</div>
				<div class="right-second">Bajarahills</div>

				<div class="right">Pin Code</div>
				<div class="right-content">:</div>
				<div class="right-second">500034</div>
				<div class="right">Mobile</div>
				<div class="right-content">:</div>
				<div class="right-second">1234567890</div>
			</div>
			<!---main-wrap closed-->

			<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">

				<div class="right">Height</div>
				<div class="right-content">:</div>
				<div class="right-second">6</div>


				<div class="right">Weight</div>
				<div class="right-content">:</div>
				<div class="right-second">65</div>

				<div class="right">Respiration Rate</div>
				<div class="right-content">:</div>
				<div class="right-second">5454</div>
				<div class="right">BP LeftArm</div>
				<div class="right-content">:</div>
				<div class="right-second">121</div>

				<div class="right">BP RightArm</div>
				<div class="right-content">:</div>
				<div class="right-second">1212</div>

				<div class="right">Pulse Rate</div>
				<div class="right-content">:</div>
				<div class="right-second">1212</div>

				<div class="right">Temparature</div>
				<div class="right-content">:</div>
				<div class="right-second">1212</div>

				<div class="right">Diseases</div>
				<div class="right-content">:</div>
				<div class="right-second">1212</div>

				<div class="right">AllergicMedicine</div>
				<div class="right-content">:</div>
				<div class="right-second">sfasfasdf</div>

				<div class="right">PatientCompliant</div>
				<div class="right-content">:</div>
				<div class="right-second">adfasf asfas fasf asf</div>
			</div>
			<!---main-wrap closed-->
		</div>
	</div>
<script>
document.getElementById('target')
.addEventListener('change', function () {
	'use strict';
	var vis = document.querySelector('.vis'),
	target = document.getElementById(this.value);
	if (vis !== null) {
		vis.className = 'inv';
		}
	if (target !== null ) {
		target.className = 'vis form-group col-lg-6 col-sm-12';
		}
	});
</script>
<?php ActiveForm::end(); ?>
</div>
</div>
<style>
.inv {
	display: none;
}

.vis {
	border: 1px solid #ccc;
	border-radius: 5px;
}

h3 {
	margin-top: 0px;
}
</style>