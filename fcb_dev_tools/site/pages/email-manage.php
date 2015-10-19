<?php
$this->title='Manage';
$this->addScript('//cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/ace.js', true);
?>

<div id="manage-overlay">
    <div class="manage-overlay-nav">
        <div id="close-overlay"><i class="fa fa-remove"></i></div>
        <div class="clearfix"></div>
    </div>
    <div class="container-fluid">
        <form id="edit-block-form" role="form" method="post" action="">
        	<div class="col-md-9">
        		<div id="edit_box">
        			<div class="form-group">
        				<label for="name">CSS</label>
        				<div id="css_ace"></div>
        				<textarea style="display:none;" id="css" name="css"></textarea>
        			</div>
        			<div class="form-group">
        				<label for="name">HTML</label>
        				<div id="html_ace"></div>
        				<textarea style="display:none;" id="html" name="html"></textarea>
        			</div>
        		</div>
        	</div>
        	<div class="col-md-3">
        		<input type="hidden" name="block_id" value="">
        		<div class="form-group">
        			<label for="name">Name</label>
        			<input id="block-name" class="form-control" type="text" name="name" value="">
        		</div>
        		<div class="form-group">
        			<label for="category">Category</label>
        			<select id="edit-category" class="form-control" name="category"></select>
        		</div>
        		<div class="form-group">
        			<label for="client">Client</label>
        			<select id="edit-client" class="form-control" name="client"></select>
        		</div>
        		<!-- <div class="form-group">
        			<div id="filelist"></div>
        			<div id="upload_box">
        				<button id="pickfiles" class="btn btn-default btn-block" type="button"><i class="fa fa-image"></i> Select Images</button>
        			</div>
        		</div>
        		<div class="form-group">
        			<button style="display:none;" id="uploadfiles" class="btn btn-success btn-block" type="button"><i class="fa fa-upload"></i> Upload Images</button>
        		</div>
        		<div class="form-group">
        			<button class="btn btn-danger btn-block" type="button"><i class="fa fa-trash"></i> Delete Block</button>
        		</div> -->
        		<div class="form-group">
        			<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-check"></i> Save Block</button>
        		</div>
        		<!-- <div id="library" class="form-group"></div> -->
        	</div>
        </form>
    </div><!-- / .container-fluid -->
</div><!-- / #manage-overlay -->

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
            			<form id="block_filters" method="post" action="">
                			<div class="col-md-4">
                				<input id="name" class="form-control input-sm" type="text" name="name" placeholder="Name...">
                			</div>
                			<div class="col-md-3">
                				<select id="filter-category" class="form-control input-sm" name="category"></select>
                			</div>
                			<div class="col-md-3">
                				<select id="filter-client" class="form-control input-sm" name="client"></select>
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
            <div class="row">
                <div class="col-md-12">

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
