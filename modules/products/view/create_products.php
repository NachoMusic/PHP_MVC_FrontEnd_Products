<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">
<script type="text/javascript" src="modules/products/view/js/products.js" ></script>

<form  id="form_product" name="form_product"> <!-- quitar post, queda nombre e id -->

    <h1>Insert a product</h1>

    <fieldset>
        <legend><span class="number">1</span>Product's basic info</legend>
        <label for="product_name">Name:</label>
        <input type="text" id="product_name" placeholder="name" class="form-control" name="product_name" value=""><!-- substituir errores php por un div con id-->
        <div id="e_name"></div>

        <label for="product_description">Description:</label>
        <input type="text" id="product_description" class="form-control" placeholder="description" name="product_description" value=""></input>
        <div id="e_description"></div>

        <label for="product_price">Price:</label>
        <input type="text" id="product_price" placeholder="price" name="product_price" value="">
        <div id="e_price"></div>

        <label for="product_id">ID:</label>
        <input type="text" id="product_id" placeholder="Product id" name="product_id" value="">
        <div id="e_price"></div>
    </fieldset>

    <fieldset>
        <legend><span class="number">2</span>Product's profile</legend>
        <label>Enter Date:</label>
        <input type="text" id="enter_date" placeholder="dd/mm/yyyy" name="enter_date" value="">
        <div id="e_enter_date"></div>
        <label>Obsolescence date:</label>
        <input type="text" id="obsolescence_date" placeholder="dd/mm/yyyy" name="obsolescence_date" value="">
        <div id="e_obsolescence_date"></div>
    </fieldset>
    <fieldset>
        <label for="product_categoty">Category:</label>
        <select name="product_category" id="product_category">
            <option selected>Select product</option>
            <option value="Stratocaster">Stratocaster</option>
            <option value="Telecaster">Telecaster</option>
            <option value="SingleCut">SingleCut</option>
            <option value="DoubleCut">DoubleCut</option>
        </select>
        <div id="e_product_category"></div>
        <label>Availability:</label>
        Web <input type="checkbox" name="availability[]" class="messageCheckbox" value="Web">
        Warehouse  <input type="checkbox" name="availability[]" class="messageCheckbox" value="Warehouse">
        Physical_store  <input type="checkbox" name="availability[]" class="messageCheckbox" value="Physical_store">
        <div id="e_availability"></div>

        <!-- Dropzone img-->
        <div class="form-group" id="progress">
            <div id="bar"></div>
            <div id="percent">0%</div >
        </div>

        <div class="msg"></div>
        <br/>
        <div id="dropzone" class="dropzone"></div><br/>

    </fieldset>
    <button type="button" id="submit_product" name="submit_product">Register Product</button>
</form>
