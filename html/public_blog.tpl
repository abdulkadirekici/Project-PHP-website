
<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Blog</h1>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
            </div>
            <div class="col-sm-6">
                <ul class="breadcrumb pull-right">
                    <li><a href="../php/index.php">Home</a></li>
                    <li class="active">Blog</li>
                </ul>
            </div>
        </div>
    </div>
</section><!--/#title-->

<section id="blog" class="container">
    <div class="row">
        <aside class="col-sm-4 col-sm-push-8">
            <div class="widget search">
                <form role="form" action="index.php?pageid=7" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" placeholder="Search" id="search" name="search" value="{SEARCH}">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="submit"><i class="icon-search"></i></button>
                            </span>
                    </div>
                </form>
            </div>

            <p>
                <a href="index.php?pageid=7">Overzicht</a> -
                <a href="index.php?pageid=7&action=toevoegen">Blog toevoegen</a>
            </p>


            <div class="widget ads">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="#"><img class="img-responsive img-rounded" src="../images/ads/ad1.png" alt=""></a>
                    </div>

                    <div class="col-xs-6">
                        <a href="#"><img class="img-responsive img-rounded" src="../images/ads/ad2.png" alt=""></a>
                    </div>
                </div>
                <p> </p>
                <div class="row">
                    <div class="col-xs-6">
                        <a href="#"><img class="img-responsive img-rounded" src="../images/ads/ad3.png" alt=""></a>
                    </div>

                    <div class="col-xs-6">
                        <a href="#"><img class="img-responsive img-rounded" src="../images/ads/ad4.png" alt=""></a>
                    </div>
                </div>
            </div><!--/.ads-->

            <div class="widget categories">
                <h3>Blog Categories</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="arrow">
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Design</a></li>
                            <li><a href="#">Updates</a></li>
                            <li><a href="#">Tutorial</a></li>
                            <li><a href="#">News</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="arrow">
                            <li><a href="#">Joomla</a></li>
                            <li><a href="#">Wordpress</a></li>
                            <li><a href="#">Drupal</a></li>
                            <li><a href="#">Magento</a></li>
                            <li><a href="#">Bootstrap</a></li>
                        </ul>
                    </div>
                </div>
            </div><!--/.categories-->
            <div class="widget tags">
                <h3>Tag Cloud</h3>
                <ul class="tag-cloud">
                    <li><a class="btn btn-xs btn-primary" href="#">CSS3</a></li>
                    <li><a class="btn btn-xs btn-primary" href="#">HTML5</a></li>
                    <li><a class="btn btn-xs btn-primary" href="#">WordPress</a></li>
                    <li><a class="btn btn-xs btn-primary" href="#">Joomla</a></li>
                    <li><a class="btn btn-xs btn-primary" href="#">Drupal</a></li>
                    <li><a class="btn btn-xs btn-primary" href="#">Bootstrap</a></li>
                    <li><a class="btn btn-xs btn-primary" href="#">jQuery</a></li>
                    <li><a class="btn btn-xs btn-primary" href="#">Tutorial</a></li>
                    <li><a class="btn btn-xs btn-primary" href="#">Update</a></li>
                </ul>
            </div><!--/.tags-->

            <div class="widget facebook-fanpage">
                <h3>Facebook Fanpage</h3>
                <div class="widget-content">
                    <div class="fb-like-box" data-href="https://www.facebook.com/shapebootstrap" data-width="292" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
                </div>
            </div>
        </aside>

        <!-- START BLOCK : MELDING -->

        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <!-- END BLOCK : MELDING -->

        <!-- START BLOCK : BEGIN -->
        <div class="row">
            <!-- END BLOCK : BEGIN -->

        <!-- START BLOCK : BLOG -->
        <div class="col-lg-8">
            <div class="blog">
                <div class="blog-item">
                    <img class="img-responsive img-blog" src="../images/blog/blog1.jpg" width="100%" alt="" />
                    <div class="blog-content">
                        <a href="../php/index.php?pageid=4"><h3>{TITLE}</h3></a>
                        <div class="entry-meta">
                            <span><i class="icon-user"></i> <a href="#">{USERNAME}</a></span>
                            <span><i class="icon-folder-close"></i> <a href="#">Bootstrap</a></span>
                            <span><i class="icon-calendar"></i> Sept 16th, 2012</span>
                            <span><i class="icon-comment"></i> <a href="blog-item.html#comments">3 Comments</a></span>
                        </div>
                        <p>{CONTENT}</p>
                        <a class="btn btn-default" href="index.php?pageid=4&blogid={BLOGID}">Read More <i class="icon-angle-right"></i></a>
                        <a class="btn btn-default" href="index.php?pageid=7&action=wijzigen&blogid={BLOGID}">Wijzigen <i class="icon-angle-right"></i></a>
                    </div>
                </div><!--/.blog-item-->

                <ul class="pagination pagination-lg">
                    <li><a href="#"><i class="icon-angle-left"></i></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><i class="icon-angle-right"></i></a></li>
                </ul><!--/.pagination-->
            </div>
        </div><!--/.col-md-8-->

<!-- END BLOCK : BLOG -->

<!-- START BLOCK : END -->
    </div><!-- /.row -->
<!-- END BLOCK : END -->

<!-- START BLOCK : DETAILS -->
<div class="col-sm-12 col-md-8">
    <div class="blog">
        <div class="blog-item">
            <img class="img-responsive img-blog" src="../images/blog/blog1.jpg" width="100%" alt="" />
            <div class="blog-content">
                <a href="../php/index.php?pageid=4"><h3>{TITLE}</h3></a>
                <div class="entry-meta">
                    <span><i class="icon-user"></i> <a href="#">{USERNAME}</a></span>
                    <span><i class="icon-folder-close"></i> <a href="#">Bootstrap</a></span>
                    <span><i class="icon-calendar"></i> Sept 16th, 2015</span>
                    <span><i class="icon-comment"></i> <a href="blog-item.html#comments">3 Comments</a></span>
                </div>
                <p>{CONTENT}</p>
                <!-- <a class="btn btn-default" href="../php/index.php?pageid=4&idblog={BLOGID}">Read More <i class="icon-angle-right"></i></a>*}
                <a class="btn btn-default" href="../php/index.php?pageid=4&action=wijzigen&idblog={BLOGID}">Wijzigen <i class="icon-angle-right"></i></a> -->
            </div>
        </div><!--/.blog-item-->

        <!-- START BLOCK : COMMENT -->
        <div class="well">
            <small>Posted By <strong>{USERNAME}</strong></small>
            <p>{COMMENT}</p>
        </div>

        <!-- END BLOCK : COMMENT -->

        <!-- START BLOCK : COMMENTFORM -->
        <form class="form-horizontal" action="index.php?pageid=4&blogid={BLOGID}" method="post">
            <div class="form-group">
                <label for="editor1" class="col-sm-2 control-label">Comment</label>
                <div class="col-sm-10">
                    <textarea class="form-control"  rows="3" name="comment" id="editor1" placeholder="Comment">{COMMENT}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" value="{BLOGID}" name="blogid">
                    <button type="submit" class="btn btn-default">Plaats Comment</button>
                </div>
            </div>
        </form>

        <!-- END BLOCK : COMMENTFORM -->

    </div>
</div><!--/.col-md-8-->

<!-- END BLOCK : DETAILS -->

