<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="img-container">
				<img id="image" src="<?php echo $image; ?>" alt="Picture">
			</div>
		</div>
		<div class="col-md-4">
			<div class="mb-4">
				<img src="<?php echo $thumb; ?>" width="100%">
			</div>
			<div class="docs-data docs-buttons docs-toggles">
				<div class="input-group input-group-sm mb-2">
					<span class="input-group-prepend">
						<label class="input-group-text" for="dataX">X</label>
					</span>
					<input type="text" class="form-control" id="dataX" placeholder="x">
					<span class="input-group-append">
						<span class="input-group-text">px</span>
					</span>
				</div>
				<div class="input-group input-group-sm mb-2">
					<span class="input-group-prepend">
						<label class="input-group-text" for="dataY">Y</label>
					</span>
					<input type="text" class="form-control" id="dataY" placeholder="y">
					<span class="input-group-append">
						<span class="input-group-text">px</span>
					</span>
				</div>
				<div class="input-group input-group-sm mb-2">
					<span class="input-group-prepend">
						<label class="input-group-text" for="dataWidth">Width</label>
					</span>
					<input type="text" class="form-control" id="dataWidth" placeholder="width">
					<span class="input-group-append">
						<span class="input-group-text">px</span>
					</span>
				</div>
				<div class="input-group input-group-sm mb-2">
					<span class="input-group-prepend">
						<label class="input-group-text" for="dataHeight">Height</label>
					</span>
					<input type="text" class="form-control" id="dataHeight" placeholder="height">
					<span class="input-group-append">
						<span class="input-group-text">px</span>
					</span>
				</div>
				<div class="input-group input-group-sm mb-2">
					<span class="input-group-prepend">
						<label class="input-group-text" for="dataRotate">Rotate</label>
					</span>
					<input type="text" class="form-control" id="dataRotate" placeholder="rotate">
					<span class="input-group-append">
						<span class="input-group-text">deg</span>
					</span>
				</div>
				<div class="input-group input-group-sm mb-2">
					<span class="input-group-prepend">
						<label class="input-group-text" for="dataScaleX">ScaleX</label>
					</span>
					<input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
				</div>
				<div class="input-group input-group-sm mb-2">
					<span class="input-group-prepend">
						<label class="input-group-text" for="dataScaleY">ScaleY</label>
					</span>
					<input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
				</div>
				<div class="btn-group mb-2">
					<button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, 0.1)">
							<span class="fa fa-search-plus"></span>
						</span>
					</button>
					<button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, -0.1)">
							<span class="fa fa-search-minus"></span>
						</span>
					</button>
				</div>
				<div class="btn-group mb-2">
					<button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, -10, 0)">
							<span class="fa fa-arrow-left"></span>
						</span>
					</button>
					<button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 10, 0)">
							<span class="fa fa-arrow-right"></span>
						</span>
					</button>
					<button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, -10)">
							<span class="fa fa-arrow-up"></span>
						</span>
					</button>
					<button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, 10)">
							<span class="fa fa-arrow-down"></span>
						</span>
					</button>
				</div>
				<div class="btn-group mb-2">
					<button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, -45)">
							<span class="fa fa-rotate-left"></span>
						</span>
					</button>
					<button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, 45)">
							<span class="fa fa-rotate-right"></span>
						</span>
					</button>
				</div>
				<div class="btn-group mb-2">
					<button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleX&quot;, -1)">
							<span class="fa fa-arrows-h"></span>
						</span>
					</button>
					<button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleY&quot;, -1)">
							<span class="fa fa-arrows-v"></span>
						</span>
					</button>
				</div>
				<div class="btn-group mb-2">
					<button type="button" class="btn btn-primary" data-method="reset" title="Reset">
						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;reset&quot;)">
							<span class="fa fa-refresh"></span>
						</span>
					</button>
				</div>
				<div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
					<label class="btn btn-primary active">
						<input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
						16:9
					</label>
					<label class="btn btn-primary">
						<input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
						4:3
					</label>
					<label class="btn btn-primary">
						<input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
						1:1
					</label>
					<label class="btn btn-primary">
						<input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
						2:3
					</label>
					<label class="btn btn-primary">
						<input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
						Free
					</label>
				</div>
				<div class="btn-group btn-group-crop mb-2">
					<button type="button" class="btn btn-secondary" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
						Preview
					</button>
				</div>
				<div class="btn-group btn-group-crop mb-2">
					<a href="javascript:void(0)" id="crop-image" class="btn btn-success">
						Save
					</a>
				</div>
				<div class="btn-group btn-group-crop mb-2">
					<a href="<?php echo $this->input->get('back'); ?>" class="btn btn-primary">
						Back
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<form id="crop-image-submit" method="post">
	<input type="hidden" name="base64">
</form>

<div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function () {
		'use strict';

		var console = window.console || { log: function () {} };
		var URL = window.URL || window.webkitURL;
		var $image = $('#image');
		var $dataX = $('#dataX');
		var $dataY = $('#dataY');
		var $dataHeight = $('#dataHeight');
		var $dataWidth = $('#dataWidth');
		var $dataRotate = $('#dataRotate');
		var $dataScaleX = $('#dataScaleX');
		var $dataScaleY = $('#dataScaleY');
		var options = {
			aspectRatio: 16 / 9,
			preview: '.img-preview',
			crop: function (e) {
				$dataX.val(Math.round(e.detail.x));
				$dataY.val(Math.round(e.detail.y));
				$dataHeight.val(Math.round(e.detail.height));
				$dataWidth.val(Math.round(e.detail.width));
				$dataRotate.val(e.detail.rotate);
				$dataScaleX.val(e.detail.scaleX);
				$dataScaleY.val(e.detail.scaleY);
			}
		};
		var originalImageURL = $image.attr('src');
		var uploadedImageName = 'cropped.jpg';
		var uploadedImageType = 'image/png';
		var uploadedImageURL;

		$image.cropper(options);

		if (!$.isFunction(document.createElement('canvas').getContext)) {
			$('button[data-method="getCroppedCanvas"]').prop('disabled', true);
		}

		if (typeof document.createElement('cropper').style.transition === 'undefined') {
			$('button[data-method="rotate"]').prop('disabled', true);
			$('button[data-method="scale"]').prop('disabled', true);
		}

		$('.docs-toggles').on('change', 'input', function () {
			var $this = $(this);
			var name = $this.attr('name');
			var type = $this.prop('type');
			var cropBoxData;
			var canvasData;

			if (!$image.data('cropper')) {
				return;
			}

			if (type === 'checkbox') {
				options[name] = $this.prop('checked');
				cropBoxData = $image.cropper('getCropBoxData');
				canvasData = $image.cropper('getCanvasData');

				options.ready = function () {
					$image.cropper('setCropBoxData', cropBoxData);
					$image.cropper('setCanvasData', canvasData);
				};
			} else if (type === 'radio') {
				options[name] = $this.val();
			}

			$image.cropper('destroy').cropper(options);
		});

		$('.docs-buttons').on('click', '[data-method]', function () {
			var $this = $(this);
			var data = $this.data();
			var cropper = $image.data('cropper');
			var cropped;
			var $target;
			var result;

			if ($this.prop('disabled') || $this.hasClass('disabled')) {
				return;
			}

			if (cropper && data.method) {

				data = $.extend({}, data); // Clone a new one

				if (typeof data.target !== 'undefined') {
					$target = $(data.target);

					if (typeof data.option === 'undefined') {
						try {
							data.option = JSON.parse($target.val());
						} catch (e) {
							console.log(e.message);
						}
					}
				}

				cropped = cropper.cropped;

				switch (data.method) {
					case 'rotate':
						if (cropped && options.viewMode > 0) {
							$image.cropper('clear');
						}
						break;

					case 'getCroppedCanvas':
						if (uploadedImageType === 'image/jpeg') {
							if (!data.option) {
								data.option = {};
							}

							data.option.fillColor = '#fff';
						}
						break;
				}

				result = $image.cropper(data.method, data.option, data.secondOption);

				switch (data.method) {
					case 'rotate':
						if (cropped && options.viewMode > 0) {
							$image.cropper('crop');
						}
						break;

					case 'scaleX':
					case 'scaleY':
						$(this).data('option', -data.option);
						break;

					case 'getCroppedCanvas':
						if (result) {
							var base64Data = $image.cropper('getCroppedCanvas').toDataURL();
							$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

						}
						break;

					case 'destroy':
						if (uploadedImageURL) {
							URL.revokeObjectURL(uploadedImageURL);
							uploadedImageURL = '';
							$image.attr('src', originalImageURL);
						}
						break;
				}

				if ($.isPlainObject(result) && $target) {
					try {
						$target.val(JSON.stringify(result));
					} catch (e) {
						console.log(e.message);
					}
				}
			}
		});

		$(document.body).on('keydown', function (e) {

			if (e.target !== this || !$image.data('cropper') || this.scrollTop > 300) {
				return;
			}

			switch (e.which) {
				case 37:
					e.preventDefault();
					$image.cropper('move', -1, 0);
					break;

				case 38:
					e.preventDefault();
					$image.cropper('move', 0, -1);
					break;

				case 39:
					e.preventDefault();
					$image.cropper('move', 1, 0);
					break;

				case 40:
					e.preventDefault();
					$image.cropper('move', 0, 1);
					break;
			}
		});

		$("#crop-image").on("click", function() {
	        var base64Data = $image.cropper('getCroppedCanvas').toDataURL();
	        $("#crop-image-submit").find('input[name=base64]').val(base64Data);
	        $("#crop-image-submit").submit();
	    })
	});
</script>