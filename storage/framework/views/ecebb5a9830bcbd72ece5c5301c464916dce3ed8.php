<?php $__env->startSection('title'); ?>
	Thông tin cá nhân <?php echo e(Auth::user()->fullname); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="col-sm-8">
	<div id="contact-page" class="container">
		<div class="bg">
			<div class="row">
				<div class="col-sm-9">
					<div class="contact-form">
						<h2 class="title text-center">Thông tin cá nhân</h2>
						<div class="status alert alert-success" style="display: none"></div>
						<form id="main-contact-form" class="contact-form row" action="<?php echo e(route('shop.profile.update', ['slug' => str_slug(Auth::user()->fullname)])); ?>" name="contact-form" method="post">

							<?php if($errors->any()): ?>
								<div class="alert alert-danger">
									<ul>
										<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li><?php echo e($error); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
							<?php endif; ?>
							<?php if(session('msg')): ?>
								<p class="alert alert-success"><?php echo e(session('msg')); ?></p>
							<?php endif; ?>
							<?php echo e(csrf_field()); ?>

							<div class="form-group col-md-6">
								<input type="text" name="username" readonly class="form-control" value="<?php echo e(Auth::user()->username); ?>" required="required" placeholder="Username">
							</div>
							<div class="form-group col-md-6">
								<input type="email" name="email" readonly class="form-control" value="<?php echo e(Auth::user()->email); ?>" required="required" placeholder="Email">
							</div>
							<div class="form-group col-md-12">
								<input type="text" name="fullname" class="form-control" value="<?php echo e(Auth::user()->fullname); ?>" required="required" placeholder="Nhập họ tên">
							</div>
							<div class="form-group col-md-12">
								<input type="text" name="phone" class="form-control" value="<?php echo e(Auth::user()->phone); ?>"  placeholder="Nhập số điện thoại">
							</div>
							<div class="form-group col-md-12">
								<input type="text" name="address" class="form-control" value="<?php echo e(Auth::user()->address); ?>" placeholder="Nhập địa chỉ">
							</div>
							<div class="form-group">
								<div class="col-md-1">
									<input type="checkbox" value="off" id="check" name="check">
								</div>
								<p class="col-md-11 control-label">Bạn có muốn thay đổi mật khẩu không?</p>
							</div>

							<div class="form-group">
								<div class="form-group col-md-12">
									<input type="password" disabled="false" class="form-control" id="password" name="password" value="" placeholder="Nhập mật khẩu...">
								</div>
							</div>

							<div class="form-group">
								<div class="form-group col-md-12">
									<input type="password" disabled="false" id="confirm_password" class="form-control" name="confirm-password" value="" placeholder="Nhập lại mật khẩu...">
								</div>
							</div>
							<div class="form-group col-md-12">
								<input type="submit" name="submit" class="btn btn-primary pull-right" value="Cập nhật">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('change', '#check', function () {
			if(this.checked){
				$('#confirm_password').prop('disabled', false);
				$('#password').attr('disabled', false);
				$('#check').val('on');
			} else{
				$('#confirm_password').prop('disabled', true);
				$('#password').attr('disabled', true);
				$('#check').val('off');
			}
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>