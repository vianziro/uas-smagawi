@extends('admin.template')

@section('content')
    <legend>Atur Peserta</legend>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Ruang</th>
                <th> : {{$ruang->nama_ruang}}</th>
            </tr>
            <tr>
                <th>Kuota</th>
                <th> : {{$ruang->kuota}}</th>
            </tr>
        </thead>
    </table>

    
    @if(count($peserta)<$ruang->kuota)
        
    @else
        <div class="alert alert-info">
            Kuota Sudah Terpenuhi
        </div>
    @endif

    @if(Session::has('pesan'))
        <div class="alert alert-success">
            {{Session::get('pesan')}}
        </div>
    @endif

    <div id="pesan"></div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Meja</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0;?>
            <!--
            @foreach($peserta as $row)
                <?php $no++;?>
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$row->no_meja}}</td>
                    <td>{{$row->nis}}</td>
                    <td>{{$row->siswa->nama}}</td>
                    <td>{{$row->siswa->kd_kelas}}</td>
                    <td>
                        <a href="#" class="btn btn-danger">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            -->
            <tr>
                <td>1</td>
                <td>1</td>
                <td>7923</td>
                <td>Jamal Apriadi</td>
                <td>X.IS.1</td>
                <td>
                    <a href="#" class="btn btn-danger hapus">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>2</td>
                <td>7923</td>
                <td>Jamal Apriadi</td>
                <td>X.IS.1</td>
                <td>
                    <a href="#" class="btn btn-danger hapus">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>3</td>
                <td>7923</td>
                <td>Jamal Apriadi</td>
                <td>X.IS.1</td>
                <td>
                    <a href="#" class="btn btn-danger hapus">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>4</td>
                <td>7923</td>
                <td>Jamal Apriadi</td>
                <td>X.IS.1</td>
                <td>
                    <a href="#" class="btn btn-danger hapus">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>5</td>
                <td>7923</td>
                <td>Jamal Apriadi</td>
                <td>X.IS.1</td>
                <td>
                    <a href="#" class="btn btn-danger hapus">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
@stop

@section('footer')
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="konfirmasi" class="btn btn-primary">Hapus</button>
          </div>
        </div>
      </div>
    </div>


    <script>
        $(function(){
            $(".hapus").click(function(){
                $("#pesan").html('');
                $("#myModal").modal("show");
            });

            $("#konfirmasi").click(function(){
                $("#pesan").html("<div class='alert alert-success'>Data Berhasil dihapus</div>");
                $("#myModal").modal("hide");
            })
        })
    </script>
@stop