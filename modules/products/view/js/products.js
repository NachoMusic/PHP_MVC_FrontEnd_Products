jQuery.fn.fill_or_clean = function() {
    this.each(function() {
        if ($("#product_name").val() === "") { //cambiar la forma a val
            $("#product_name").val("Introduce name");
            $("#product_name").focus(function() {
                if ($("#product_name").val() === "Introduce name") {
                    $("#product_name").val("");
                }
            });
        }
        $("#product_name").blur(function() { //Onblur se activa cuando el usuario retira el foco
            if ($("#product_name").val() === "") {
                $("#product_name").val("Introduce name");
            }
        });

        if ($("#product_description").val() === "") {
            $("#product_description").val("Introduce the product description");
            $("#product_description").focus(function() {
                if ($("#product_description").val() === "Introduce the product description") {
                    $("#product_description").val("");
                }
            });
        }
        $("#product_description").blur(function() {
            if ($("#product_description").val() === "") {
                $("#product_description").val("Introduce the product description");
            }
        });

        if ($("#product_price").val() === "") {
            $("#product_price").val("Introduce product price");
            $("#product_price").focus(function() {
                if ($("#product_price").val() === "Introduce product price") {
                    $("#product_price").val("");
                }
            });
        }
        $("#product_price").blur(function() {
            if ($("#product_price").val() === "") {
                $("#product_price").val("Introduce product price");
            }
        });

        if ($("#product_id").val() === "") {
            $("#product_id").val("Introduce product id");
            $("#product_id").focus(function() {
                if ($("#product_id").val() === "Introduce product id") {
                    $("#product_id").val("");
                }
            });
        }
        $("#product_id").blur(function() {
            if ($("#product_id").val() === "") {
                $("#product_id").val("Introduce product id");
            }
        });

        if ($("#enter_date").val() === "") {
            $("#enter_date").val("Introduce entering date");
            $("#enter_date").focus(function() {
                if ($("#enter_date").val() === "Introduce entering date") {
                    $("#enter_date").val("");
                }
            });
        }
        $("#enter_date").blur(function() {
            if ($("#enter_date").val() === "") {
                $("#enter_date").val("Introduce entering date");
            }
        });

        if ($("#obsolescence_date").val() === "") {
            $("#obsolescence_date").val("Introduce obsolescence date");
            $("#obsolescence_date").focus(function() {
                if ($("#obsolescence_date").val() === "Introduce obsolescence date") {
                    $("#obsolescence_date").val("");
                }
            });
        }
        $("#obsolescence_date").blur(function() {
            if ($("#obsolescence_date").val() === "") {
                $("#obsolescence_date").val("Introduce obsolescence date");
            }
        });

    }); //each
    return this;

};

Dropzone.autoDiscover = false;
$(document).ready(function() {
    $(function() {
        $("#enter_date").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
        });
    });

    $(function() {
        $("#obsolescence_date").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
        });
    });

    $(this).fill_or_clean();


    var email_reg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var date_reg = /(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/]((175[7-9])|(17[6-9][0-9])|(1[8-9][0-9][0-9])|([2-9][0-9][0-9][0-9]))/i;
    var address_reg = /^[a-z0-9- -.]+$/i;
    var pass_reg = /^[0-9a-zA-Z]{6,32}$/;
    var string_reg = /^[A-Za-z]{2,30}$/;
    var longstring_reg = /^[A-Za-z]{2,300}$/;
    var usr_reg = /^[0-9a-zA-Z]{2,20}$/;
    var number_reg = /^\d+$/;

    //Valida products
    $("#submit_product").click(function() {
        validate_product();
    });

    //Security control. If you go back the data is removed.
    $.get("modules/products/controller/controller_products.class.php?load_data=true",
        function(response) {
            //alert(response.user);
            console.log(response);
            if (response.product === "") {
                $("#product_name").val('');
                $("#product_description").val('');
                $("#product_price").val('');
                $("#product_id").val('');
                $("#enter_date").val('');
                $("#obsolescence_date").val('');
                $("#product_category").val('Select product');
                var inputElements = document.getElementsByClassName('availability');
                for (var i = 0; i < inputElements.length; i++) {
                    if (inputElements[i].checked) {
                        inputElements[i].checked = false;
                    }
                }
                //siempre que creemos un plugin debemos llamarlo, sino no funcionará
                $(this).fill_or_clean();
            } else {
                // $("#product_name").val(response.product.product_name);
                // $("#product_description").val(response.product.product_description);
                // $("#product_price").val(response.product.product_price);
                // $("#product_id").val(response.product.product_id);
                // $("#enter_date").val(response.product.enter_date);
                // $("#obsolescence_date").val(response.product.obsolescence_date);
                /*
                var inputElements = document.getElementsByClassName('messageCheckbox');
                for (var i = 0; i < interests.length; i++) {
                    for (var j = 0; j < inputElements.length; j++) {
                        if (interests[i] === inputElements[j])
                            inputElements[j].checked = true;
                    }
                }*/
            }
        }, "json");

    //Dropzone function //////////////////////////////////
    $("#dropzone").dropzone({
        url: "modules/products/controller/controller_products.class.php?upload=true",
        addRemoveLinks: true,
        maxFileSize: 1000,
        dictResponseError: "Ha ocurrido un error en el server",
        acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',
        init: function() {
            this.on("success", function(file, response) {
                //alert(response);
                console.log(response);
                $("#progress").show();
                $("#bar").width('100%');
                $("#percent").html('100%');
                $('.msg').text('').removeClass('msg_error');
                $('.msg').text('Success Upload image!!').addClass('msg_ok').animate({
                    'right': '300px'
                }, 300);
            });
        },
        complete: function(file) {
            //if(file.status == "success"){
            //alert("El archivo se ha subido correctamente: " + file.name);
            //}
        },
        error: function(file) {
            //alert("Error subiendo el archivo " + file.name);
        },
        removedfile: function(file, serverFileName) {
            var name = file.name;
            $.ajax({
                type: "POST",
                url: "modules/products/controller/controller_products.class.php?delete=true",
                data: "filename=" + name,
                success: function(data) {
                    console.log("eliminar");
                    $("#progress").hide();
                    $('.msg').text('').removeClass('msg_ok');
                    $('.msg').text('').removeClass('msg_error');
                    $("#e_avatar").html("");

                    var json = JSON.parse(data);
                    if (json.res === true) {
                        var element;
                        if ((element = file.previewElement) !== null) {
                            element.parentNode.removeChild(file.previewElement);
                            //alert("Imagen eliminada: " + name);
                            //console.log("dentro2");
                        } else {
                            false;
                        }
                    } else { //json.res == false, elimino la imagen también
                        var element;
                        if ((element = file.previewElement) !== null) {
                            element.parentNode.removeChild(file.previewElement);
                        } else {
                            false;
                        }
                    }
                }
            });
        }
    });

    $("#product_name").keyup(function() {
        if ($(this).val() !== "" && string_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#product_description").keyup(function() {
        if ($(this).val() !== "" && longstring_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#product_price, #product_id").keyup(function() {
        if ($(this).val() !== "" && number_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#enter_date, #obsolescence_date").keyup(function() {
        if ($(this).val() !== "" && date_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    // 3 combobox
    load_countries_v1();
    $("#provincia").empty();
    $("#provincia").append('<option value="" selected="selected">Selecciona una Provincia</option>');
    $("#provincia").prop('disabled', true);
    $("#poblacion").empty();
    $("#poblacion").append('<option value="" selected="selected">Selecciona una Poblacion</option>');
    $("#poblacion").prop('disabled', true);

    $("#pais").change(function() {
        var pais = $(this).val();
        var provincia = $("#provincia");
        var poblacion = $("#poblacion");

        if(pais !== 'ES'){
            provincia.prop('disabled', true);
            poblacion.prop('disabled', true);
            $("#provincia").empty();
            $("#poblacion").empty();
        }else{
            provincia.prop('disabled', false);
            poblacion.prop('disabled', false);
            load_provincias_v1();
        }//fi else
    });

    $("#provincia").change(function() {
        var prov = $(this).val();
        if(prov > 0){
            load_poblaciones_v1(prov);
        }else{
            $("#poblacion").prop('disabled', false);
        }
    });
});

function load_countries_v1() {
    $.get( "modules/products/controller/controller_products.class.php?load_pais=true",
        function( response ) {
            if(response === 'error'){
                load_countries_v2("resources/ListOfCountryNamesByName.json");
            }else{
                load_countries_v2("modules/products/controller/controller_products.class.php?load_pais=true"); //oorsprong.org
            }
    })
    .fail(function(response) {
        load_countries_v2("resources/ListOfCountryNamesByName.json");
    });
}

function load_countries_v2(cad) {
    $.getJSON( cad, function(data) {
        $("#pais").empty();
        $("#pais").append('<option value="" selected="selected">Selecciona un Pais</option>');
        // console.log(data);
        $.each(data, function (i, valor) {
            $("#pais").append("<option value='" + valor.sISOCode + "'>" + valor.sName + "</option>");
        });
    })
    .fail(function() {
        alert( "error load_countries" );
    });
}

function load_provincias_v1() { //provinciasypoblaciones.xml - xpath
    $.get( "modules/products/controller/controller_products.class.php?load_provincias=true",
    function( response ) {
        $("#provincia").empty();
        $("#provincia").append('<option value="" selected="selected">Selecciona una Provincia</option>');
        // console.log(response);
        //alert(response);
        var json = JSON.parse(response);
        var provincias=json.provincias;
        //alert(provincias);
        //console.log(provincias);
        //alert(provincias[0].id);
        //alert(provincias[0].nombre);
        if(provincias === 'error'){
            load_provincias_v2();
        }else{
            for (var i = 0; i < provincias.length; i++) {
                $("#provincia").append("<option value='" + provincias[i].id + "'>" + provincias[i].nombre + "</option>");
            }
        }
    })
    .fail(function(response) {
        load_provincias_v2();
    });
}

function load_provincias_v2() {
    $.get("resources/provinciasypoblaciones.xml", function (xml) {
	    $("#provincia").empty();
	    $("#provincia").append('<option value="" selected="selected">Selecciona una Provincia</option>');

        $(xml).find("provincia").each(function () {
            var id = $(this).attr('id');
            var nombre = $(this).find('nombre').text();
            $("#provincia").append("<option value='" + id + "'>" + nombre + "</option>");
        });
    })
    .fail(function() {
        alert( "error load_provincias" );
    });
}


function load_poblaciones_v1(prov) { //provinciasypoblaciones.xml - xpath
    var datos = { idPoblac : prov  };
    $.post("modules/products/controller/controller_products.class.php", datos, function(response) {
        // console.log(response);
        var json = JSON.parse(response);
        var poblaciones=json.poblaciones;
        //alert(poblaciones);
        //console.log(poblaciones);
        //alert(poblaciones[0].poblacion);

        $("#poblacion").empty();
        $("#poblacion").append('<option value="" selected="selected">Selecciona una Poblacion</option>');

        if(poblaciones === 'error'){
            load_poblaciones_v2(prov);
        }else{
            for (var i = 0; i < poblaciones.length; i++) {
                $("#poblacion").append("<option value='" + poblaciones[i].poblacion + "'>" + poblaciones[i].poblacion + "</option>");
            }
        }
    })
    .fail(function() {
        load_poblaciones_v2(prov);
    });
}

function load_poblaciones_v2(prov) {
    $.get("resources/provinciasypoblaciones.xml", function (xml) {
		$("#poblacion").empty();
	    $("#poblacion").append('<option value="" selected="selected">Selecciona una Poblacion</option>');

		$(xml).find('provincia[id=' + prov + ']').each(function(){
    		$(this).find('localidad').each(function(){
    			 $("#poblacion").append("<option value='" + $(this).text() + "'>" + $(this).text() + "</option>");
    		});
        });
	})
	.fail(function() {
        alert( "error load_poblaciones" );
    });
}

function validate_product() {
    var result = true;

    var product_name = document.getElementById("product_name").value;
    var product_description = document.getElementById("product_description").value;
    var product_price = document.getElementById("product_price").value;
    var product_id = document.getElementById("product_id").value;
    var enter_date = document.getElementById("enter_date").value;
    var obsolescence_date = document.getElementById("obsolescence_date").value;
    var product_category = document.getElementById("product_category").value;
    var product_availability = document.getElementsByClassName("messageCheckbox");
    var availability = [];
    var j = 0;
    for (var i = 0; i < product_availability.length; i++) {
        if (product_availability[i].checked) {
            availability[j] = product_availability[i].value;
            j++;
        }
    }
    // combobox //
    // function validate_pais(pais) {
    //     if (pais == null) {
    //         //return 'default_pais';
    //         return false;
    //     }
    //     if (pais.length == 0) {
    //         //return 'default_pais';
    //         return false;
    //     }
    //     if (pais === 'Selecciona un Pais') {
    //         //return 'default_pais';
    //         return false;
    //     }
    //     if (pais.length > 0) {
    //         // var regexp = /^[a-zA-Z]*$/;
    //         // return regexp.test(pais);
    //         return true;
    //     }
    //     return false;
    // }
    // function validate_provincia(provincia) {
    //     if (provincia == null) {
    //         return 'default_provincia';
    //     }
    //     if (provincia.length == 0) {
    //         return 'default_provincia';
    //     }
    //     if (provincia === 'Selecciona una Provincia') {
    //         //return 'default_provincia';
    //         return false;
    //     }
    //     if (provincia.length > 0) {
    //         // var regexp = /^[a-zA-Z0-9, ]*$/;
    //         // return regexp.test(provincia);
    //         return true;
    //     }
    //     return false;
    // }
    // function validate_poblacion(poblacion) {
    //     if (poblacion == null) {
    //         return 'default_poblacion';
    //     }
    //     if (poblacion.length == 0) {
    //         return 'default_poblacion';
    //     }
    //     if (poblacion === 'Selecciona una Poblacion') {
    //         //return 'default_poblacion';
    //         return false;
    //     }
    //     if (poblacion.length > 0) {
    //         // var regexp = /^[a-zA-Z/, -'()]*$/;
    //         // return regexp.test(poblacion);
    //         return true;
    //     }
    //     return false;
    // }

    var pais = document.getElementById("pais").value;
    var provincia = document.getElementById("provincia").value;
    var poblacion = document.getElementById("poblacion").value;
    // var v_pais = validate_pais(pais);
	// var v_provincia = validate_provincia(provincia);
	// var v_poblacion = validate_poblacion(poblacion);

    var email_reg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var date_reg = /(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/]((175[7-9])|(17[6-9][0-9])|(1[8-9][0-9][0-9])|([2-9][0-9][0-9][0-9]))/i;
    var address_reg = /^[a-z0-9- -.]+$/i;
    var pass_reg = /^[0-9a-zA-Z]{6,32}$/;
    var string_reg = /^[A-Za-z]{2,30}$/;
    var longstring_reg = /^[A-Za-z]{2,300}$/;
    var usr_reg = /^[0-9a-zA-Z]{2,20}$/;
    var number_reg = /^\d+$/;

    $(".error").remove();
    if ($("#product_name").val() === "" || $("#product_name").val() == "Introduce name") {
        $("#product_name").focus().after("<span class='error'>Introduce name</span>");
        result = false;
        return false;
    } else if (!string_reg.test($("#product_name").val())) {
        $("#product_name").focus().after("<span class='error'>Name must be 2 to 30 letters</span>");
        result = false;
        return false;
    }

    if ($("#product_description").val() === "") {
        $("#product_description").focus().after("<span class='error'>Introduce the product description</span>");
        result = false;
        return false;
    } else if (!longstring_reg.test($("#product_description").val())) {
        $("#product_description").focus().after("<span class='error'>Product description must be 2 to 300 letters</span>");
        result = false;
        return false;
    }

    if ($("#product_price").val() === "" || $("#product_price").val() == "Introduce price") {
        $("#product_name").focus().after("<span class='error'>Introduce price</span>");
        result = false;
        return false;
    } else if (!number_reg.test($("#product_price").val())) {
        $("#product_price").focus().after("<span class='error'>Price must be a number</span>");
        result = false;
        return false;
    }

    if ($("#product_id").val() === "" || $("#product_id").val() == "Introduce product id") {
        $("#product_id").focus().after("<span class='error'>Introduce product id</span>");
        result = false;
        return false;
    } else if (!number_reg.test($("#product_id").val())) {
        $("#product_id").focus().after("<span class='error'>ID must be a number</span>");
        result = false;
        return false;
    }

    if ($("#enter_date").val() === "" || $("#enter_date").val() == "Introduce entering date") {
        $("#enter_date").focus().after("<span class='error'>Introduce entering date</span>");
        result = false;
        return false;
    } else if (!date_reg.test($("#enter_date").val())) {
        $("#enter_date").focus().after("<span class='error'>error format date (dd/mm/yyyy)</span>");
        result = false;
        return false;
    }

    if ($("#obsolescence_date").val() === "" || $("#obsolescence_date").val() == "Introduce obsolescence date") {
        $("#obsolescence_date").focus().after("<span class='error'>Introduce obsolescence date</span>");
        result = false;
        return false;
    } else if (!date_reg.test($("#obsolescence_date").val())) {
        $("#obsolescence_date").focus().after("<span class='error'>error format date (dd/mm/yyyy)</span>");
        result = false;
        return false;
    }

    // if(!v_pais){
    //     $("#pais").focus().after("<span class='error'>Introduce obsolescence date</span>");
    //     // document.getElementById("e_pais").innerHTML = "You have to select the country";
    //     result = false;
    //     return false;
    // }
    if ($("#pais").val() === "" || $("#pais").val() == "Selecciona un Pais") {
        $("#pais").focus().after("<span class='error'>Introduce pais</span>");
        result = false;
        return false;
    }
    if ($("#provincia").val() === "" || $("#provincia").val() == "Selecciona una Provincia") {
        if ($("#pais").val() == "ES"){
            $("#provincia").focus().after("<span class='error'>Introduce provincia</span>");
            result = false;
            return false;
        } else {
            $("#provincia").val("default_provincia");
        }
    }
    if ($("#poblacion").val() === "" || $("#poblacion").val() == "Selecciona una Poblacion") {
        if ($("#pais").val() == "ES"){
            $("#poblacion").focus().after("<span class='error'>Introduce poblacion</span>");
            result = false;
            return false;
        } else {
            $("#poblacion").val("default_poblacion");
        }
    }

    //Si ha ido todo bien, se envian los datos al servidor
    if (result) {
        var data = {
            "product_name": product_name,
            "product_description": product_description,
            "product_price": product_price,
            "product_id": product_id,
            "enter_date": enter_date,
            "obsolescence_date": obsolescence_date,
            "product_category": product_category,
            "availability": availability,
            "country": pais,
            "province": provincia,
            "town": poblacion
        };

        var data_products_JSON = JSON.stringify(data);

        $.post('modules/products/controller/controller_products.class.php', {
                alta_products_json: data_products_JSON
            },
            function(response) {
                console.log(typeof(response));
                //var responseObj = JSON.parse(response); //I convert the string to a object!
                console.log(response);
                console.log(response.success);
                if (response.success) {
                    window.location.href = response.redirect;
                }

            }, "json").fail(function(xhr) {
             //console.log(xhr.responseJSON);

            if (xhr.responseJSON.error.product_name)
                $("#product_name").focus().after("<span  class='error1'>" + xhr.responseJSON.error.product_name + "</span>");

            if (xhr.responseJSON.error.product_description)
                $("#product_description").focus().after("<span  class='error1'>" + xhr.responseJSON.error.product_description + "</span>");

            if (xhr.responseJSON.error.product_price)
                $("#product_price").focus().after("<span  class='error1'>" + xhr.responseJSON.error.product_price + "</span>");

            if (xhr.responseJSON.error.product_id)
                $("#product_id").focus().after("<span  class='error1'>" + xhr.responseJSON.error.product_id + "</span>");

            if (xhr.responseJSON.error.enter_date)
                $("#enter_date").focus().after("<span  class='error1'>" + xhr.responseJSON.error.enter_date + "</span>");

            if (xhr.responseJSON.error.obsolescence_date)
                $("#obsolescence_date").focus().after("<span  class='error1'>" + xhr.responseJSON.error.obsolescence_date + "</span>");

            if (xhr.responseJSON.error.product_category)
                $("#product_category").focus().after("<span  class='error1'>" + xhr.responseJSON.error.product_category + "</span>");

            if (xhr.responseJSON.error.availability)
                $("#availability").focus().after("<span  class='error1'>" + xhr.responseJSON.error.availability + "</span>");

            if (xhr.responseJSON.error_avatar)
                $("#dropzone").focus().after("<span  class='error1'>" + xhr.responseJSON.error_avatar + "</span>");

            if (xhr.responseJSON.success1) {
                if (xhr.responseJSON.img_avatar !== "/nacho_framework2DAW/media/default-avatar.png") {
                    //$("#progress").show();
                    //$("#bar").width('100%');
                    //$("#percent").html('100%');
                    //$('.msg').text('').removeClass('msg_error');
                    //$('.msg').text('Success Upload image!!').addClass('msg_ok').animate({ 'right' : '300px' }, 300);
                }
            } else {
                $("#progress").hide();
                $('.msg').text('').removeClass('msg_ok');
                $('.msg').text('Error Upload image!!').addClass('msg_error').animate({
                    'right': '300px'
                }, 300);
            }
        });
    }
}
