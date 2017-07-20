@extends('templates.shop.master2')
@section('title')
	Thông tin cá nhân {{ Auth::user()->fullname }}
@endsection
@section('content')
<div class="col-sm-8">
	<div id="contact-page" class="container">
		<div class="bg">
			<div class="row">
				<div class="col-sm-9">
					<div class="contact-form">
						<h2 class="title text-center">Thông tin cá nhân</h2>
						<div class="status alert alert-success" style="display: none"></div>
						<form id="main-contact-form" class="contact-form row" action="{{ route('shop.profile.update', ['slug' => str_slug(Auth::user()->fullname)]) }}" name="contact-form" method="post">

							@if ($errors->any())
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							@if(session('msg'))
								<p class="alert alert-success">{{ session('msg') }}</p>
							@endif
							{{ csrf_field() }}
							<div class="form-group col-md-6">
								<input type="text" name="username" readonly class="form-control" value="{{ Auth::user()->username }}" required="required" placeholder="Username">
							</div>
							<div class="form-group col-md-6">
								<input type="email" name="email" readonly class="form-control" value="{{ Auth::user()->email }}" required="required" placeholder="Email">
							</div>
							<div class="form-group col-md-12">
								<input type="text" name="fullname" class="form-control" value="{{ Auth::user()->fullname }}" required="required" placeholder="Nhập họ tên">
							</div>
							<div class="form-group col-md-12">
								<input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}"  placeholder="Nhập số điện thoại">
							</div>
							<div class="form-group col-md-12">
								<input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}" placeholder="Nhập địa chỉ">
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
@endsection
@section('js')
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
@endsection