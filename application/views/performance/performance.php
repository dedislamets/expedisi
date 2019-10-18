<style type="text/css">
	.FormGrid .EditTable tr:first-child {
	    display: table-row;;
	}
	.modal.in .modal-dialog {
		width: 700px;
	}
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="ace-icon fa fa-home home-icon"></i>
      <a href="#">Home</a>
    </li>
    <li class="active">Training Development</li>
  </ul><!-- /.breadcrumb -->

  <div class="nav-search" id="nav-search">
    <form class="form-search">
      <span class="input-icon">
        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
        <i class="ace-icon fa fa-search nav-search-icon"></i>
      </span>
    </form>
  </div><!-- /.nav-search -->
</div>
<div class="page-content">
	<div class="page-header">
		<h1>
			<?php echo $title ?>
		</h1>
	</div>

	<div class="row">
		<div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active">
                <a data-toggle="tab" href="#home">
                  <i class="green ace-icon fa fa-home bigger-120"></i>
                  Basic Data
                </a>
              </li>

              <li>
                <a data-toggle="tab" href="#messages">
                  Family & Tax
                </a>
              </li>
              <li class="dropdown">
                <a data-toggle="tab" href="#education">
                  Education
                </a>
              </li>
          	</ul>
          	<div class="tab-content">
                  <div id="home" class="tab-pane fade in active"></div>
                  <div id="messages" class="tab-pane fade"></div>
                  <div id="education" class="tab-pane fade"></div>
             </div>
      	</div>
	</div>
</div>

<?php
  $this->load->view($modal); 
?>