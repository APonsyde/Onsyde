$(document).ready(function() {
    init_product_buttons();
})

function init_product_buttons()
{
    $('.js-btn-minus').on('click', function(e){
        e.preventDefault();
        if ( $(this).closest('.input-group').find('.form-control').val() > 1  ) {
            var val = parseInt($(this).closest('.input-group').find('.form-control').val()) - 1;
            $(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
            $(this).parents('.product').find('.btn-add-to-cart').attr('data-quantity', (val >=1) ? val : 1);
        }
    });

    $('.js-btn-plus').on('click', function(e){
        e.preventDefault();
        var val = parseInt($(this).closest('.input-group').find('.form-control').val()) + 1;
        $(this).closest('.input-group').find('.form-control').val(parseInt(val));
        $(this).parents('.product').find('.btn-add-to-cart').attr('data-quantity', (val >=1) ? val : 1);
    });

    $('.btn-add-to-cart').on('click', function () {
        var reload;
        var product_id = $(this).data('id');
        var goto = $(this).data('goto');
        var price = $(this).data('price');
        var quantity = (typeof $(this).attr('data-quantity') !== "undefined") ? parseInt($(this).attr('data-quantity')) : 1;
        if ($(this).hasClass('refresh-me'))
            reload = true;
        else if (goto != null)
            reload = goto;
        else
            reload = false;
        manage_shopping_cart('add', product_id, reload, price, quantity);
    });

    $(".btn-wishlist").on("click", function () {
        var _this = $(this);
        var id = _this.data("id");
        var action = _this.data("action");
        $.ajax({
            dataType: "json",
            url: SITE_URL+"product/wishlist?id="+id,
            success: function(response) {
                if(response.success == true) {
                    if(action == 'remove') {
                        _this.parents('.wishlist').remove();
                        if(!$('.wishlist').length) {
                            $("#v-pills-wishlist").text('Your wishlist is empty!');
                        }
                    } else {
                        if(response.state == true) {
                            _this.find('.fa-heart').addClass('text-danger');
                        } else {
                            _this.find('.fa-heart').removeClass('text-danger');
                        }
                    }
                    new_alert('success', response.message);
                } else {
                    new_alert('error', response.message);
                }
            }
        })
    });

    $('.btn-quickview').on('click', function() {
        var _this = $(this);
        $('#modalquikview .modal-body').html("");
        $('#modalquikview .modal-content').waitMe({effect: 'facebook'});
        var id = _this.attr('data-id');
        $.ajax({
            url: SITE_URL+"home/get_product/"+id,
            success: function(html) {
                $('#modalquikview .modal-body').html(html);
                initProductBtns();
                $('#modalquikview .modal-content').waitMe("hide");
            }
        });
    });
}

function remove_product(id, reload)
{
    manage_shopping_cart('remove', id, reload);
}

function manage_shopping_cart(action, product_id, reload, price, quantity)
{
    var quantity = typeof quantity != "undefined" ? quantity : 1; 
    var action_error_msg = 'Some error occured';

    if (action == 'add') {
        $('.btn-add-to-cart a[data-id="' + product_id + '"] span').hide();
        $('.btn-add-to-cart a[data-id="' + product_id + '"] img').show();
        var action_success_msg = 'Added to cart successfully!';
    }

    if (action == 'remove') {
        var action_success_msg = 'Removed from cart successfully!';
    }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: SITE_URL+"cart/manage",
        data: {product_id: product_id, action: action, quantity: quantity}
    }).done(function (data) {
        if (reload == true) {
            location.reload(false);
            return;
        } else {
            $('.site-cart .count').html(data.total_items);
            if(action == 'add') {
                new_alert('success', 'Product added to cart successfully!');
            } else {
                new_alert('success', 'Product removed from cart successfully!');
            }
            return;
        }
    }).always(function () {
        if (action == 'add') {
            $('.btn-add-to-cart a[data-id="' + product_id + '"] span').show();
            $('.btn-add-to-cart a[data-id="' + product_id + '"] img').hide();
        }
    });
}

function clear_cart()
{
    $.ajax({
        type: "POST", 
        url: SITE_URL+"cart/clear"
    }).done(function (data) {
        $('.site-cart .count').html(0);
        new_alert('success', 'Cart cleared successfully');
    });
}

function new_alert(type, message)
{
    $(".notification-"+type+" .message").text(message);
    $(".notification-"+type).slideToggle();
    setTimeout(function(){ $(".notification-"+type).slideToggle(); }, 2000);
}