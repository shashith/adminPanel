<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>VideoEditor</span></a>
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile">
    <div class="profile_pic">
      <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
      <span>Welcome,</span>
        <h2>
            <?php
                $this->load->library('session');
                echo $this->session->userdata('Name');
            ?>
        <h2>
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>General</h3>
      <ul class="nav side-menu">
        <li><a><i class="fa fa-home"></i> Home </a>
            <?php $this->load->library('session'); ?>
            <ul class="nav child_menu">
              <li <?php echo ($this->session->userdata('selected_page') == 'admin_panel' ? "class = \"selected\"" : "") ?>><a href="#">Admin Panel</a></li>
              <li <?php echo ($this->session->userdata('selected_page') == 'to_frame_set' ? "class = \"selected\"" : "") ?>><a href="#">To Frame Set</a></li>
              <li <?php echo ($this->session->userdata('selected_page') == 'to_frame_set_from_image' ? "class = \"selected\"" : "") ?>><a href="#">To Frame Set From Image</a></li>
              <li <?php echo ($this->session->userdata('selected_page') == 'to_merge_frame_set' ? "class = \"selected\"" : "") ?>><a href="#">To Merge Frame Set</a></li>
              <li <?php echo ($this->session->userdata('selected_page') == 'to_final_video' ? "class = \"selected\"" : "") ?>><a href="#">To Final Video</a></li>
              <li <?php echo ($this->session->userdata('selected_page') == 'output' ? "class = \"selected\"" : "") ?>><a href="#">OutPut</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- /sidebar menu -->
</div>
