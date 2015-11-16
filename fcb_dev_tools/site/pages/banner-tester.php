<?php $this->title='Banner Tester'; ?>

<div id="settings-overlay">
    <div class="banner-nav">
        <button id="close-settings" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
        <div class="clearfix"></div>
    </div>
    <div class="container">
        <form id="banner-form" class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-2">
                    <select class="form-control size-selection">
                        <option value="">Select Size...</option>
                        <option value="160x600">160 x 600</option>
                        <option value="180x150">180 x 150</option>
                        <option value="300x50">300 x 50</option>
                        <option value="300x250">300 x 250</option>
                        <option value="300x600">300 x 600</option>
                        <option value="320x50">320 x 50</option>
                        <option value="640x480">640 x 480</option>
                        <option value="728x90">728 x 90</option>
                        <option value="970x90">970 x 90</option>
                    </select>
                </div>
                <div class="col-sm-10">
                    <input class="form-control iframe-input" type="text" name=""/>
                </div>
            </div>
        </form>
        <button id="add-field" class="btn btn-success btn-block btn-lg"><i class="fa fa-plus"></i> Add</button>
    </div>
</div>

<div class="banner-nav">
    <button id="settings" class="btn btn-default"><i class="fa fa-cog"></i> Settings</button>
    <button id="shuffle" class="btn btn-default"><i class="fa fa-random"></i> Shuffle</button>
    <button id="refresh" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</button>
    <div class="clearfix"></div>
</div>

<div class="container">
    <div class="row">
        <div id="insert-iframes" class="col-sm-12">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <button id="get-started" class="btn btn-info btn-lg btn-block">Get Started <i class="fa fa-rocket"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
