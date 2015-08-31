<?php $this->load->view('admin/components/page_head'); ?>
<body>
    <div class="navbar navbar-static-top navbar-inverse">
        <div class="navbar-inner">
            <a class="brand" href="#"><?php echo $meta_title; ?></a>
            <ul class="nav">
                <li class="active"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
                <li><?php echo anchor('admin/page','pages')?></li>
                <li><?php echo anchor('admin/user','users')?></li>
            </ul>
            <div style="float: right;">
                <div class="span3">
                    <section>
                        <?php echo mailto('me@geewantha.com','<i class="icon-user"></i>me@geewantha.com'); ?><br/>
                        <?php echo anchor('admin/user/logout','<i class="icon-off"></i>logout'); ?>
                    </section>
                </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row">
            <!-- Main Column -->
            <div class="span12">
                <?php $this->load->view($subview);?>
            </div>
            <!-- Siderbar -->

        </div>
    </div>


<?php $this->load->view('admin/components/page_tail'); ?>