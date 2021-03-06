@extends('pengawas.template')

@section('head')
	<style>
		.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
		.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
		.percent { position:absolute; display:inline-block; top:3px; left:48%; }
	</style>
@stop

@section('content')
	<div class="row">
		<div class="col-lg-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Pengawas
				</div>

				<div class="panel-body">
					<table class="table table-striped">
						<tr>
							<td>NIP</td>
							<td> : {{$pengawas->nip}}</td>
						</tr>
						<tr>
							<td>Nama</td>
							<td> : {{$pengawas->nama}}</td>
						</tr>
						<tr>
							<td>Mata Pelajaran</td>
							<td> : {{$mapel->nm_mapel}}</td>
						</tr>
						<tr>
							<td>Kelas</td>
							<td> : {{$mengawasi->kd_kelas}}</td>
						</tr>
						<tr>
							<td>Ruang Ujian</td>
							<td> :  {{$ruang->nama_ruang}}</td>
						</tr>
						<tr>
							<td>Sesi</td>
							<input type="hidden" id="sesi" value="{{$mengawasi->sesi}}">
							<td> :  {{$mengawasi->sesi}}</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="alert alert-info">
				<p>Untuk Memulai Ujian silahkan Klik Start</p>
			</div>
			
			{{Form::open(['url'=>'pengawas/get-token','method'=>'post','id'=>'formku'])}}
				<div class="progress" style="display:none;">
					<div class="bar"></div >
					<div class="percent">0%</div >
				</div>


				<div class="form-group">
					<label for="">Token</label>
					<input type="hidden" id="idmengawasi" name="idmengawasi" value="{{$mengawasi->id}}" class="form-control">
					<input type="text" class="form-control" name="token" id="token" value="{{$mengawasi->token}}" readonly="readonly">
				</div>

				<div class="form-group">
					<button class="btn btn-primary">
						<i class="glyphicon glyphicon-play-circle"></i>
						Generate Token
					</button>
				</div>
			{{Form::close()}}
		</div>

		<div class="col-lg-8">
			<div class="panel panel-success">
				<div class="panel-heading">
					<p>Login Siswa</p>
				</div>

				<div class="panel-body">
					<a href="#" class="btn btn-success" id="pilih" ruang="{{$ruang->id_ruang}}"
					kelas="{{$mengawasi->kd_kelas}}">
						<i class="glyphicon glyphicon-refresh"></i>
						Load Siswa
					</a>

					<hr>

					<div id="loading" style="display:none;">Loading. . .</div>

					<div id="tampil"></div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('footer')
	{{Html::script('assets/js/jquery.form.min.js')}}
	<script>
		$(function(){
			var bar = $('.bar');
			var percent = $('.percent');
			var status = $('#status');

			var options={
				beforeSend:function(){
					status.empty();
			        var percentVal = '0%';
			        bar.width(percentVal)
			        percent.html(percentVal);
			        $("#pesan").html('');
					$(".progress").show();
				},
				clearForm:true,
				uploadProgress: function(event, position, total, percentComplete) {
			        var percentVal = percentComplete + '%';
			        bar.width(percentVal)
			        percent.html(percentVal);
					//console.log(percentVal, position, total);
			    },
				success:function(data){
					$(".progress").hide();
					$("#tampil").html('');
					$("#token").val(data);
					var percentVal = '100%';
			        bar.width(percentVal)
			        percent.html(percentVal);
				},
				complete: function(xhr) {
					status.html(xhr.responseText);
				},
				error:function(){
					$(".progress").hide();
					$("#pesan").html("<div class='alert alert-danger'>Terjadi Kesalahan, Koneksi dengan facebook bermasalah, Coba Refresh kembali</div>");
				}
			}

			$("#formku").ajaxForm(options);

			$("#pilih").click(function(){
				var kelas=$(this).attr("kelas");
				var ruang=$(this).attr("ruang");
				var sesi=$("#sesi").val();

				$.ajax({
					url:"{{URL::to('pengawas/load-siswa')}}",
					type:"GET",
					data:"kelas="+kelas+"&ruang="+ruang+"&sesi="+sesi,
					cache:false,
					beforeSend:function(){
						$("#loading").show();
					},
					success:function(html){
						$("#loading").hide();
						$("#tampil").html(html);
					},
					error:function(){
						$("#loading").hide();
						alert("Data Gagal ditampilkan");
					}
				})
			})
		})
	</script>
@stop