<div class="nav_menu">
    <nav class="" role="navigation">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt="">
                    <?php
                        $this->load->library('session');
                        $name = $this->session->userdata('Name');
                        echo $name;
                    ?>
                </a>
            </li>
        </ul>
    </nav>
</div>
