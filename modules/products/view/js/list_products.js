////////////////////////////////////////////////////////////////
function load_users_ajax() {
    $.ajax({
        type: 'GET',
        url: "modules/users/controller/controller_users.class.php?load=true",
        //dataType: 'json',
        async: false
    }).success(function(data) {
        var json = JSON.parse(data);

        //alert(json.user.usuario);

        pintar_user(json);

    }).fail(function(xhr) {
        alert(xhr.responseText);
    });
}

////////////////////////////////////////////////////////////////
function load_users_get_v1() {
    $.get("modules/users/controller/controller_users.class.php?load=true", function(data, status) {
        var json = JSON.parse(data);
        //$( "#content" ).html( json.msje );
        //alert("Data: " + json.user.usuario + "\nStatus: " + status);

        pintar_user(json);
    });
}

////////////////////////////////////////////////////////////////
function load_users_get_v2() {
    var jqxhr = $.get("modules/products/controller/controller_products.class.php?load=true", function(data) {
        var json = JSON.parse(data);
        console.log(json);
        pintar_user(json);
        //alert( "success" );
    }).done(function() {
        //alert( "second success" );
    }).fail(function() {
        //alert( "error" );
    }).always(function() {
        //alert( "finished" );
    });

    jqxhr.always(function() {
        //alert( "second finished" );
    });
}

$(document).ready(function() {
    //load_users_ajax();
    //load_users_get_v1();
    //console.log("entra");
    load_users_get_v2();
});

function pintar_user(data) {
    //alert(data.user.avatar);
    var content = document.getElementById("content");
    var div_product = document.createElement("div");
    var parrafo = document.createElement("p");

    var msje = document.createElement("div");
    msje.innerHTML = "msje = ";
    msje.innerHTML += data.msje;

    var product_name = document.createElement("div");
    product_name.innerHTML = "product_name = ";
    product_name.innerHTML += data.product.product_name;

    var product_description = document.createElement("div");
    product_description.innerHTML = "product_description = ";
    product_description.innerHTML += data.product.product_description;

    var product_price = document.createElement("div");
    product_price.innerHTML = "product_price = ";
    product_price.innerHTML += data.product.product_price;

    var product_id = document.createElement("div");
    product_id.innerHTML = "product_id = ";
    product_id.innerHTML += data.product.product_id;

    var enter_date = document.createElement("div");
    enter_date.innerHTML = "enter_date = ";
    enter_date.innerHTML += data.product.enter_date;

    var obsolescence_date = document.createElement("div");
    obsolescence_date.innerHTML = "obsolescence_date = ";
    obsolescence_date.innerHTML += data.product.obsolescence_date;

    var product_category = document.createElement("div");
    product_category.innerHTML = "product_category = ";
    product_category.innerHTML += data.product.product_category;

    var availability = document.createElement("div");
    availability.innerHTML = "availability = ";
    for (var i = 0; i < data.product.availability.length; i++) {
        availability.innerHTML += " - " + data.product.availability[i];
    }

    //arreglar ruta IMATGE!!!!!

    var cad = data.product.avatar;
    //console.log(cad);
    //var cad = cad.toLowerCase();
    var img = document.createElement("div");
    var html = '<img src="' + cad + '" height="75" width="75"> ';
    img.innerHTML = html;
    //alert(html);

    div_product.appendChild(parrafo);
    parrafo.appendChild(msje);
    parrafo.appendChild(product_name);
    parrafo.appendChild(product_description);
    parrafo.appendChild(product_price);
    parrafo.appendChild(product_id);
    parrafo.appendChild(enter_date);
    parrafo.appendChild(obsolescence_date);
    parrafo.appendChild(product_category);
    parrafo.appendChild(availability);
    content.appendChild(div_product);
    content.appendChild(img);
}
