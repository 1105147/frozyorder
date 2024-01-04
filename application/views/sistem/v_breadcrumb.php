<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs hide" id="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }

    </script>
    <ul class="breadcrumb" style="text-transform: capitalize">
        <li>
            <a href="<?= site_url() ?>"><i class="ace-icon fa fa-home home-icon"></i></a>
        </li>
        <?= breadcrumb($breadcrumb);?>
    </ul>
    <!-- /.breadcrumb -->
</div>
<!-- /section:basics/content.breadcrumbs -->
<div class="page-title">
    <div class="title_left">
        <h3>
            <?= $title[0] ?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?= $title[1] ?>
            </small>
        </h3>
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
