<style type="text/css">
  .box-widget {
    border: none;
    position: relative;
  }
  .box {
      position: relative;
      border-radius: 3px;
      background: #e0eef7;
      border-top: 3px solid #d2d6de;
      margin-bottom: 20px;
      width: 100%;
      box-shadow: 0 1px 1px rgba(0,0,0,0.1);
  }
  .box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
  }
  .box-header {
      color: #444;
      display: block;
      padding: 10px;
      position: relative;
  }
  .box-header:before, .box-body:before, .box-footer:before, .box-header:after, .box-body:after, .box-footer:after {
    content: " ";
    display: table;
  }
  .user-block:before, .user-block:after {
    content: " ";
    display: table;
  }
  .user-block img {
    width: 40px;
    height: 40px;
    float: left;
  }
  .img-circle {
      border-radius: 50%;
  }
  .user-block .username {
    font-size: 16px;
    font-weight: 600;
  }
  .user-block .username, .user-block .description, .user-block .comment {
      display: block;
    
  }
  .user-block .description {
      color: #999;
      font-size: 13px;
  }
  .user-block .username, .user-block .description, .user-block .comment {
      display: block;
  }
  .user-block:after {
    clear: both;
}
.user-block:before, .user-block:after {
    content: " ";
    display: table;
}
.box-header>.box-tools {
    position: absolute;
    right: 10px;
    top: 5px;
}
.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
}
.box-comments {
    background: #f7f7f7;
}
.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}
.box-comments .box-comment:first-of-type {
    padding-top: 0;
}
.box-comments .box-comment {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}
.img-sm, .box-comments .box-comment img, .user-block.user-block-sm img {
    width: 30px !important;
    height: 30px !important;
}
.img-sm, .img-md, .img-lg, .box-comments .box-comment img, .user-block.user-block-sm img {
    float: left;
}
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="ace-icon fa fa-home home-icon"></i>
      <a href="#">Home</a>
    </li>
    <li class="active">Carrier</li>
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
    <?php 
      foreach($loker as $row)
      { ?>
        <div class="row">      
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
               
                <span class="username"><a href="#"><?php echo $row->PositionStructural ?></a></span>
                <span class="description"><?php echo $row->Location ?> - 7:30 PM Today</span>
              </div>
            </div>
            <div class="box-body">
              <?php echo $row->RemarkJobDescription ?>
              
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-get-pocket"></i> More</button>
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
              <span class="pull-right text-muted">2 comments</span>
            </div>
          </div>
        </div>
      <?php }?>
</div>
<?php
  $this->load->view($modal); 
?>


