(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */


	var s, mobile, 
		Web = {
	        settings: {
	            baseUrl: '/',
	            windowHeight: $(window).height(),
	            windowWidth: $(window).width(),
	            debug: false,
	            lang: 'en',
	        },
	        init: function () {

	            var currentUrl = window.location.href;
	            s = this.settings;

	            this.setEnvVars();
	            this.bindActions();
	            this.bindOnLoadActions();
	        },
	        bindActions: function (fireWhen) {

	            this.bindWindowResize();

	            var data_url = $("#data-url").val();

		        $("#sortable").sortable({
		            stop : function(event, ui) {
		                $.ajax({
		                    url: data_url,
		                    dataType: "json",
		                    type: "post",
		                    data: $(this).sortable('serialize'),
		                    success: function(data) {}
		                })
		            }
		        });

		        $("#sortable").disableSelection();

	            $(document).on("click", ".delete-confirm", function(e) {
					var _this = $(this);
					e.preventDefault();

					$.confirm({
					    title: 'Delete this?',
					    buttons: {
					        confirm: function () {
					            var href = _this.attr('href');
					            window.location = href;
					        },
					        cancel: function () {
					            return;
					        }
					    }
					});
				});

				$(document).on("click", ".sort", function(e) {
					var _this = $(this);
					e.preventDefault();

					$("#filter-form").find("#sort").val(_this.data('sort'));
					$("#filter-form").submit();
				});

				function calculateReverseGst(field) {
				    var gst = isNaN(parseFloat($("#"+field).val())) ? 0 : parseFloat($("#"+field).val());
				    var div = gst / 2;
				    $("#gst_rate").val(gst);
				    calculatePrice();
				}

				$(document).on("keyup", "#gst_rate", function () {
				    var id = $(this).attr('id');
				    calculateReverseGst(id);
				}); 

				$(document).on("keyup", "#price_excl_tax", function () {
				    var pet = parseFloat($(this).val());
				    var gst = parseFloat($("#gst_rate").val());
				    var tax = isNaN((pet * gst) / 100) ? 0 : ((pet * gst) / 100);
				    var price = tax + pet;
				    if(isNaN(price)) {
				        price = 0;
				    }
				    $("#price").val(price.toFixed(2));
				});

				$(document).on("keyup", "#price", function () {
				    calculatePrice();
				});

				$(document).on("change", "#gst_rate", function () {
				    var gst = parseFloat($(this).val());
				    var pet = parseFloat($("#price_excl_tax").val());
				    var tax = isNaN(((pet * gst) / 100)) ? 0 : ((pet * gst) / 100);
				    var price = tax + pet;
				    if(isNaN(price)) {
				        price = 0;
				    }
				    $("#price").val(price.toFixed(2));
				});

				function calculatePrice()
				{
				    var price = parseFloat($("#price").val());
				    var tax = 1 + parseFloat($("#gst_rate").val()) / 100;
				    var pet = isNaN(tax) ? price : price / tax;
				    if(isNaN(pet)) {
				        pet = 0;
				    }
				    $("#price_excl_tax").val(pet.toFixed(2));
				}

	            if (s.debug) {
	                console.log('All/most actions binding done ...');
	            }
	        },
	        avoidConsoleError: function () {
	            // Avoid 'console' errors in browsers that lack a console.
	            (function () {
	                "use strict";

	                var method;
	                var noop = function () {
	                };
	                var methods = [
	                    'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
	                    'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
	                    'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
	                    'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
	                ];
	                var length = methods.length;
	                var console = (window.console = window.console || {});

	                while (length--) {
	                    method = methods[length];

	                    // Only stub undefined methods.
	                    if (!console[method]) {
	                        console[method] = noop;
	                    }
	                }
	            });
	        },
	        bindWindowResize: function () {

	            $(window).resize(function () {
	                s.windowWidth = $(window).width();
	                s.windowHeight = $(window).height();
	                Web.setEnvVars();
	            });

	        },
	        setEnvVars: function () {
	            if (s.windowWidth < 768)
	                mobile = true;
	        },
	        bindOnLoadActions: function () {

	        }
	    }; //End of Web Object

	Web.init(); //Initialize

})(window);