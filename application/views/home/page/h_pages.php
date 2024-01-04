<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section>
    <div class="container">
        <div class="row">
            <?php $this->load->view('home/h_sidebar'); ?>
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center"><?= $detail['judul_page'] ?></h2>
                    <div class="single-blog-post">
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> <?= $detail['log_page'] ?></li>
                                <li><i class="fa fa-calendar"></i> <?= format_date($detail['update_page'],2) ?></li>
                            </ul>
                        </div>
                        <a href="#">
                            <?php
                            if(!is_null($detail['foto_page'])){
                                echo '<img class="lazyload blur-up" src="'. load_file($detail['foto_page']) .'" alt="'. ctk($detail['judul_page']) .'">';
                            }
                            ?>
                        </a>
                        <p><?= $detail['isi_page'] ?></p>
                    </div>
                </div><!--/blog-post-area-->

                <div class="rating-area" style="display: none">
                    <ul class="ratings">
                        <li class="rate-this">Rate this item:</li>
                        <li>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </li>
                        <li class="color">(6 votes)</li>
                    </ul>
                    <ul class="tag">
                        <li>TAG:</li>
                        <li><a class="color" href="">Pink <span>/</span></a></li>
                        <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                        <li><a class="color" href="">Girls</a></li>
                    </ul>
                </div><!--/rating-area-->

                <div class="socials-share">
                    <a href="">
                        
                    </a>
                </div><!--/socials-share-->
            </div>	
        </div>
    </div>
</section>
