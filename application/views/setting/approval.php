<style type="text/css">
	.table>thead>tr {
	    color: #f6ebeb;
	    background: repeat-x #8a3333;
	    background-image: -webkit-linear-gradient(top,#F8F8F8 0,#ECECEC 100%);
	    background-image: -o-linear-gradient(top,#F8F8F8 0,#ECECEC 100%);
	    background-image: linear-gradient(to bottom,#8f8d8d 0,#332828 100%);
	   
	}
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="ace-icon fa fa-home home-icon"></i>
      <a href="#">Home</a>
    </li>
    <li class="active">Dashboard</li>
  </ul><!-- /.breadcrumb -->
  <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
  <div class="nav-search" id="nav-search">

  </div><!-- /.nav-search -->
</div>
<div class="page-content">
    <div class="page-header">
      <h1 id="judul">
        <?php echo $title ?>
      </h1>
    </div><!-- /.page-header -->

    <div class="row">

      <div class="table-header">
      	<?php echo $title ?> &nbsp;&nbsp;
        <button class="btn btn-success" id="btnAdd">
              <i class="ace-icon fa fa-plus align-top bigger-125"></i>&nbsp;Add
        </button>
        <button class="btn btn-info" id="btnRefresh">
              <i class="ace-icon fa fa-refresh align-top bigger-125"></i>&nbsp;Refresh
        </button>
        <!-- <button class="btn btn-warning" id="btnExport">
              <i class="ace-icon fa fa-file align-top bigger-125"></i>&nbsp;Export
        </button> -->
      </div>
      <div>
        
        <div id="isi-tabel">
          	<?php echo $tabel ?>
        </div>
      </div>
    </div>
</div>
<?php
  $this->load->view($modal); 
?>



