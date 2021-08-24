@extends('layouts.master')


@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Edit Data</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Edit Data</li>
                </ol>
                <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>
                    Create New</button>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data</h4>
                    <form action="/biodata/{{$biodata->id}}" method="POST" class="mt-4" enctype="multipart/form-data">
                    @method('PUT')
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="avatar">Upload Gambar</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" onchange="loadFile(event)">
                        </div>
                        <div class="form-group">
                            <img id="imgoutput" class="img-circle img-fluid" style="width: 100px;">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Nama Lengkap" name="nama_lengkap">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select class="custom-select col-12" name="prov_id" id="prov">
                                <option selected="">Choose...</option>
                                @foreach($prov as $prov)
                                <option value="{{$prov->id}}">{{$prov->nama_prov}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kabupaten/Kota</label>
                            <select class="custom-select col-12" name="kabkota_id" id="kabkota">
                                <option value="0" disabled="true" selected="true">Choose...</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select class="custom-select col-12" name="kec_id" id="kec">
                                <option value="0" disabled="true" selected="true">Choose...</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
@endsection
@section('js')
<script>
    var loadFile = function(event) {
        console.log('succes');
        var imgoutput = document.getElementById('imgoutput');
        imgoutput.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('change', '#prov', function() {
            // console.log("ganti lur");

            var prov_id=$(this).val();
            // console.log(prov_id);

            var div=$(this).parent();
            var op=" ";

            $.ajax({
                type:'get',
                url:'{!!URL::to('findkabkotaname')!!}',
                data:{'id':prov_id},
                success:function(data){
                    // console.log('success');

                    // console.log(data);
                    
                    op+='<option value="0" selected disabled>Pilih Kabkota</option>';
                    for(var i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].nama_kabkota+'</option>';
                    }

                    $('#kabkota').html(op);
                    div.find('#kabkota').append(" ");
                }
            })
        });
        $(document).on('change', '#kabkota', function() {
            // console.log("ganti lur");

            var kabkota_id=$(this).val();
            console.log(kabkota_id);

            var div=$(this).parent();
            var op=" ";

            $.ajax({
                type:'get',
                url:'{!!URL::to('findkecname')!!}',
                data:{'id':kabkota_id},
                success:function(data){
                    console.log('success');

                    console.log(data);
                    
                    op+='<option value="0" selected disabled>Pilih Kecamatan</option>';
                    for(var i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].nama_kec+'</option>';
                    }

                    $('#kec').html(op);
                    div.find('#kec').append(" ");
                }
            })
        });
    })
</script>
@endsection
