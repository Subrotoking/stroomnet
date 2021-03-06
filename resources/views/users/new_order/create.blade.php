@extends('layouts.app')
@section('content')
<?php
    function rupiah($angka){
        $hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
        return $hasil_rupiah;                                                                                   
    }
?>
<section class="about" id="tambah_pelanggan_form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">TAMBAH ORDER <br> {{$customer->nama_customer}} </h1>
                    </div>
                    <div class="card-body">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus"></i> Tambah Order
                        </button>
                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{$customer->nama_customer}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ route('order.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Originating</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="" id="originating"
                                                        name="originating" required><small class="form-text text-muted">*jika
                                                        kosong isi (-)</small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Terminating</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="" id="terminating"
                                                        name="terminating" required>
                                                    <small class="form-text text-muted">*jika kosong isi (-)</small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Jenis Layanan</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="nama_product"
                                                        name="nama_product" required>
                                                    <small class="form-text text-muted" >*jika kosong isi (-)</small>
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Kapasitas</label>
                                                <div class="col-md-3 ">
                                                    <input type="number" class="form-control" placeholder=""
                                                        id="kapasitas" name="kapasitas" required>
                                                    <small class="form-text text-muted">Ex. 1 Gbps/ 2 Unit</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="satuan_kapasitas" class="form-control">
                                                        <option value="Kbps">Kbps</option>
                                                        <option value="Mbps">Mbps</option>
                                                        <option value="Gbps">Gbps</option>
                                                        <option value="Unit">Unit</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Biaya
                                                    Berlangganan</label>
                                                <div class="col-md-6">
                                                    <input type="number" class="form-control" id="biaya_langganan"
                                                        name="biaya_langganan" required>
                                                    <small class="form-text text-muted" >Ex. 1000000 (Hanya Diisi
                                                        Angka)</small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">Biaya
                                                    Instalasi</label>
                                                <div class="col-md-6">
                                                    <input type="number" class="form-control" id="biaya_instalasi"
                                                        name="biaya_instalasi" required>
                                                    <small class="form-text text-muted">Ex. 1000000 (Hanya Diisi
                                                        Angka)</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- tampilan data -->
                        <div class="form-group">
                            <div class="">
                                <div>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>no</th>
                                                <th>originating</th>
                                                <th>terminating</th>
                                                <th>nama layanan</th>
                                                <th>kapasitas</th>
                                                <th>biaya langganan</th>
                                                <th>biaya instalasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php $no=0 ?>
                                            @foreach ($order as $p)
                                            <?php $no++ ?>
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $p->originating }}</td>
                                                <td>{{ $p->terminating }}</td>
                                                <td>{{ $p->nama_product }}</td>
                                                <td>{{ $p->kapasitas }}</td>
                                                <td>
                                                    
                                                    <?php
                                                        
                                                        if($p->biaya_langganan == "0" ){
                                                            echo'-';
                                                        }
                                                        else
                                                            echo rupiah($p->biaya_langganan);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        
                                                        if($p->biaya_instalasi == "0" ){
                                                            echo'-';
                                                        }
                                                        else
                                                            echo rupiah($p->biaya_instalasi);
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="/users/new/order/delete/{{ $p->id }}" type="button"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- end of tampilan -->
                    </div>
                    <div class="card-footer">
                        <div class="" style="float: right;">
                            <a class="btn btn-primary" type="button" id="button_next"
                                onclick="konfirmasi()">Selanjutnya</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <form action="{{ route('penagihan.store') }}" method="post">
                        {{ csrf_field() }}
                    <!-- tgl mulai penagihan -->
                    <div class="card"  style="text-align:center;">
                        <div class="card-header">
                            <h4> <br> </h4>
                        </div>
                        <div class="card-body">
                                <label>Jangka Waktu Berlangganan</label> 
                            <div class="form-group row justify-content-center" >
                                <div class="col-md-5">
                                    <input type="number" class="form-control" id=""
                                            name="jangka_waktu" value="{{ old('jangka_waktu') ? old('jangka_waktu') : $customer->jangka_waktu }}" required>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" type="text" name="" value="Bulan" disabled>
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label>Tanggal Mulai Penagihan</label>
                                <div class="col-md ">
                                    <input type="date" class="form-control" id="tgl_penagihan"
                                        name="tgl_penagihan" value="{{ old('tgl_penagihan') ? old('tgl_penagihan') : $customer->tgl_penagihan }}">
                                        <br>
                                </div>

                                <div class="col-md">
                                    <input placeholder="tambahkan catatan" type="text" name="catatan_penagihan" class="form-control" value="{{ old('catatan_penagihan') ? old('catatan_penagihan') : $customer->catatan_penagihan }}">
                                    
                                </div>
                            </div>
                        </div>                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>                        
                    </div>
                    <!-- end of tgl mulai penagihan -->
                </form> 
            </div>
        </div>
    </div>
</section>
@endsection
