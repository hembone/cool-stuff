<?php $this->title='Email Builder'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <form id="block-filters" method="post" action="#">
                <div class="form-group">
                    <input id="filter-name" class="form-control input-sm" type="text" name="name" placeholder="Name...">
                </div>
                <div class="form-group">
                    <select id="filter-category" class="form-control input-sm" name="category"></select>
                </div>
                <div class="form-group">
                    <select id="filter-client" class="form-control input-sm" name="client"></select>
                </div>
            </form>
            <div id="insert-blocks"></div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <form id="block-filters" method="post" action="#">
                    <div class="col-md-4">
                        <select id="global-css" class="form-control input-sm" name="global-css">
                            <option value="">Global CSS...</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-md-offset-6">
                        <button id="download-zip" class="btn btn-success btn-sm btn-block"><i class="fa fa-download"></i> Download Zip</button>
                    </div>
                </form>
            </div>
            <div id="insert-email"></div>
        </div>
    </div>
</div><!-- /.container-fluid -->
