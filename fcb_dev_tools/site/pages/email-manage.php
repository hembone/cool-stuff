<?php $this->title='Manage'; ?>

<div id="manage-overlay">
    <div class="banner-nav">
        <button id="close-overlay" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
        <div class="clearfix"></div>
    </div>
    <div class="container">

    </div>
</div>

<div class="container-fluid">

    <ul id="manage-tabs" class="nav nav-tabs">
        <li class="active"><a href="#blocks" data-toggle="tab">Blocks</a></li>
        <li><a href="#categories" data-toggle="tab">Categories</a></li>
        <li><a href="#clients" data-toggle="tab">Clients</a></li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="blocks">
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
            			<form id="block_filters" method="post" action="#">
            			<div class="col-md-4">
            				<input id="name" class="form-control input-sm" type="text" name="name" placeholder="Name...">
            			</div>
            			<div class="col-md-3">
            				<select id="category" class="form-control input-sm" name="category">
            					<option value="">Category...</option>
            				</select>
            			</div>
            			<div class="col-md-3">
            				<select id="brand" class="form-control input-sm" name="brand">
            					<option value="">Brand...</option>
            				</select>
            			</div>
            			<div class="col-md-2">
            				<button id="search_btn" class="btn btn-primary btn-sm btn-block" type="button"><i class="fa fa-search"></i> Search</button>
            			</div>
            			</form>
            		</div>
                </div>
                <div class="col-sm-2">
                    <button id="new-block" class="btn btn-success btn-sm btn-block" type="button"><i class="fa fa-plus"></i> New Block</button>
                </div>
            </div>
        </div><!-- / #blocks -->

        <div class="tab-pane" id="categories">
            <div class="row">
                <div class="col-sm-9">
                    <div id="insert-categories"></div>
                </div>
                <div class="col-sm-3">
                    <form id="new-category" method="post" action="">
                		<div class="form-group">
                			<input class="form-control" type="text" name="cat_name" placeholder="Category Name...">
                		</div>
                		<div class="form-group">
                			<button class="btn btn-success btn-block" type="submit"><i class="fa fa-plus"></i> Create Category</button>
                		</div>
                	</form>
                </div>
            </div>
        </div><!-- / #categories -->

        <div class="tab-pane" id="clients">
            <div class="row">
                <div class="col-sm-9">
                    <div id="insert-clients"></div>
                </div>
                <div class="col-sm-3">
                    <form  id="new-client" method="post" action="">
                		<div class="form-group">
                			<input class="form-control" type="text" name="client_name" placeholder="Client Name...">
                		</div>
                		<div class="form-group">
                			<button class="btn btn-success btn-block" type="submit"><i class="fa fa-plus"></i> Create Client</button>
                		</div>
                	</form>
                </div>
            </div>
        </div><!-- / #clients -->

    </div>

</div><!-- / .container-fluid -->
