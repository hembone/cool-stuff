<?php $this->title='Banner Tester'; ?>

<div id="settings-overlay">
    <button id="close-settings" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
    <div class="container">
        <form id="banner-form" class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-2">
                    <select class="form-control size-selection">
                        <option value="">Select Size...</option>
                        <option value="160x600">160 x 600</option>
                        <option value="180x150">180 x 150</option>
                        <option value="300x250">300 x 250</option>
                        <option value="300x600">300 x 600</option>
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
        <button id="add-field" class="btn btn-success btn-block btn-lg pull-right"><i class="fa fa-plus"></i> Add</button>
    </div>
</div>

<button id="settings" class="btn btn-default"><i class="fa fa-cog"></i> Settings</button>
<button id="refresh" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</button>

<div class="container">
    <div class="row">
        <div id="insert-iframes" class="col-sm-12"></div>
    </div>
</div>
