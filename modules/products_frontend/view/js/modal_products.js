//we do this so that  details_prod don't appear
$("#details_prod").hide();
$(document).ready(function () {
    $('.prod').click(function () {
        var id = this.getAttribute('id');
        //alert(id);

        $.get("modules/products/controller/controller_products.class.php?idProduct=" + id, function (data, status) {
            var json = JSON.parse(data);
            var product = json.product;
            //alert(product.name);
            //console.log(product);

            $("#img_prod").html('<img src="' + product.avatar + '" height="75" width="75"> ');
            $("#name_prod").html(product.name);
            $("#description_prod").html("<strong>Description: <br/></strong>" + product.description);
            $("#titration_prod").html("<strong>Titration:</strong>" + product.titration);
            $("#price_prod").html("Price: " + product.price + " €");

            //we do this so that  details_prod  appear
            $("#details_prod").show();


            $("#product").dialog({
                width: 850, //<!-- ------------- ancho de la ventana -->
                height: 500, //<!--  ------------- altura de la ventana -->
                //show: "scale", <!-- ----------- animación de la ventana al aparecer -->
                //hide: "scale", <!-- ----------- animación al cerrar la ventana -->
                resizable: "false", //<!-- ------ fija o redimensionable si ponemos este valor a "true" -->
                //position: "down",<!--  ------ posicion de la ventana en la pantalla (left, top, right...) -->
                modal: "true", //<!-- ------------ si esta en true bloquea el contenido de la web mientras la ventana esta activa (muy elegante) -->
                buttons: {
                    Ok: function () {
                        $(this).dialog("close");
                    }
                },
                show: {
                    effect: "blind",
                    duration: 1000
                },
                hide: {
                    effect: "explode",
                    duration: 1000
                }
            });
        })
        .fail(function (xhr) {
            //if  we already have an error 404
            if (xhr.status === 404) {
                $("#results").load("modules/products/controller/controller_products.class.php?view_error=false");
            } else {
                $("#results").load("modules/products/controller/controller_products.class.php?view_error=true");
            }
            ;
        });
    });
});
