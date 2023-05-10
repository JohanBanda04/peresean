
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="dashboard.html">Dashboard</a></li>
        <li class="active"><?php echo $judul_web; ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"> <small><?php echo $judul_web; ?></small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <?php
            echo $this->session->flashdata('msg');
            $level 	= $this->session->userdata('level');
            $link3  = strtolower($this->uri->segment(3));
            ?>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Daftar Raperda / Raperkada</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">No.</th>
                                <th width="45%">Judul</th>
                                <th>Jenis</th>
                                <th width="15%" style="text-align: center">Download</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $no=1;
                            foreach ($query->result() as $baris):?>
                                <tr>
                                    <td><b><?php echo $no++; ?>.</b> </td>
                                    <td><?php echo $baris->nama_kegiatan; ?></td>
                                    <td><?php echo $baris->jenis_dokumen; ?></td>
                                    <td style="text-align: center">
                                        <a href="<?php echo base_url($baris->lamp_surat_undangan);?>"
                                           class="btn btn-info btn-xs" title="Detail"
                                           download="">

                                            <i class="fa fa-download"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->

<?php $this->load->view('users/berita/modal_konfirm'); ?>
