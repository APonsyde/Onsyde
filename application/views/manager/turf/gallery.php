<div class="booking manager-dashboard">
    <div class="slots">
        <form id="fileupload" action="https://jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
            <div class="">
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-7 flexpanel align-center">
                        <span class="btn slotbtn add fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Add files...</span>
                            <input type="file" name="files[]" multiple />
                        </span>
                        <button type="submit" class="btn slotbtn add start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start upload</span>
                        </button>
                        <button type="reset" class="btn slotbtn add text-white">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel upload</span>
                        </button>
                        <button type="button" class="btn slotbtn add delete">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete selected</span>
                        </button>
                        <input type="checkbox" class="toggle" />
                        <span class="fileupload-process"></span>
                    </div>
                    <div class="col-lg-5 fileupload-progress fade">
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="">
                    <table role="presentation" class="table mb-0">
                        <tbody class="files">
                            <?php foreach ($images as $key => $image) { ?>
                                <tr class="template-download fade show">
                                    <td>
                                        <span class="preview">
                                            <a href="<?php echo base_url('uploads/turfs/'.$turf['id'].'/gallery/'.$image['name']); ?>" title="<?php echo $image['name']; ?>" download="<?php echo $image['name']; ?>" data-gallery=""><img src="<?php echo base_url('uploads/turfs/'.$turf['id'].'/gallery/thumbnail/'.$image['name']); ?>"></a>
                                        </span>
                                    </td>
                                    <td>
                                        <p class="name">
                                            <a href="<?php echo base_url('uploads/turfs/'.$turf['id'].'/gallery/'.$image['name']); ?>" title="<?php echo $image['name']; ?>" download="<?php echo $image['name']; ?>" data-gallery=""><?php echo $image['name']; ?></a>
                                        </p>
                                    </td>
                                    <td>
                                        <span class="size"><?php echo format_size_units($image['size']); ?></span>
                                    </td>
                                    <td>
                                        <button class="btn slotbtn add delete" data-type="DELETE" data-url="<?php echo site_url('manager/upload/delete?type=turf_gallery&table=turf_images&id='.$turf['id'].'&file='.$image['name']) ?>">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                        <input type="checkbox" name="delete" value="1" class="toggle">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even" >
                        <div class="slides"></div>
                        <h3 class="title"></h3>
                        <a class="prev">‹</a>
                        <a class="next">›</a>
                        <a class="close">×</a>
                        <a class="play-pause"></a>
                        <ol class="indicator"></ol>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
	$(function() {
		'use strict';
		$('#fileupload').fileupload({
			url: SITE_URL+'manager/upload/turf/<?php echo $turf['id']; ?>'
		});
	});
</script>

<script id="template-upload" type="text/x-tmpl">
  {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-upload fade">
          <td>
              <span class="preview"></span>
          </td>
          <td>
              {% if (window.innerWidth > 480 || !o.options.loadImageFileTypes.test(file.type)) { %}
                  <p class="name">{%=file.name%}</p>
              {% } %}
              <strong class="error text-danger"></strong>
          </td>
          <td>
              <p class="size">Processing...</p>
              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
          </td>
          <td>
              {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                    <i class="glyphicon glyphicon-edit"></i>
                    <span>Edit</span>
                </button>
              {% } %}
              {% if (!i && !o.options.autoUpload) { %}
                  <button class="btn btn-primary start" disabled>
                      <i class="glyphicon glyphicon-upload"></i>
                      <span>Start</span>
                  </button>
              {% } %}
              {% if (!i) { %}
                  <button class="btn btn-warning cancel">
                      <i class="glyphicon glyphicon-ban-circle"></i>
                      <span>Cancel</span>
                  </button>
              {% } %}
          </td>
      </tr>
  {% } %}
</script>
<script id="template-download" type="text/x-tmpl">
  {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-download fade">
          <td>
              <span class="preview">
                  {% if (file.thumbnailUrl) { %}
                      <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                  {% } %}
              </span>
          </td>
          <td>
              {% if (window.innerWidth > 480 || !file.thumbnailUrl) { %}
                  <p class="name">
                      {% if (file.url) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                      {% } else { %}
                          <span>{%=file.name%}</span>
                      {% } %}
                  </p>
              {% } %}
              {% if (file.error) { %}
                  <div><span class="label label-danger">Error</span> {%=file.error%}</div>
              {% } %}
          </td>
          <td>
              <span class="size">{%=o.formatFileSize(file.size)%}</span>
          </td>
          <td>
              {% if (file.deleteUrl) { %}
                  <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                      <i class="glyphicon glyphicon-trash"></i>
                      <span>Delete</span>
                  </button>
                  <input type="checkbox" name="delete" value="1" class="toggle">
              {% } else { %}
                  <button class="btn btn-warning cancel">
                      <i class="glyphicon glyphicon-ban-circle"></i>
                      <span>Cancel</span>
                  </button>
              {% } %}
          </td>
      </tr>
  {% } %}
</script>