<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script> -->
<!--<script type="text/javascript" src="modules/products/view/js/list_products.js" ></script>-->
<form>
    <h1>Insert a product</h1>

    <fieldset>
        <legend><span class="number">1</span>Product's basic info</legend>
        <label for="name">Name:</label>
        <input type="text" id="product_name" disabled="true">

        <label for="description">Description:</label>
        <textarea id="description" disabled="true" name="product_description"></textarea>

        <label for="price">Price:</label>
        <input type="text" id="price" disabled="true" name="product_price">

        <label for="id">ID:</label>
        <input type="text" id="id" disabled="true" name="product_id">

    </fieldset>

    <fieldset>
        <legend><span class="number">2</span>Product's profile</legend>
        <label>Enter Date:</label>
        <input type="text" disabled="true">
        <label>Obsolescence date:</label>
        <input type="text" disabled="true">
    </fieldset>
    <fieldset>
        <label for="product_category">Category:</label>
        <select name="product_category" id="product_category">
            <option selected>Select product</option>
            <option value="Stratocaster">Stratocaster</option>
            <option value="Telecaster">Telecaster</option>
            <option value="SingleCut">SingleCut</option>
            <option value="DoubleCut">DoubleCut</option>
        </select>

        <label>Availability:</label>
        Web <input type="checkbox" name="availability[]" value="Web">
        Warehouse  <input type="checkbox" name="availability[]" value="Warehouse">
        Physical_store  <input type="checkbox" name="availability[]" value="Physical_store">

    </fieldset>
    <fieldset>
        <div id="content"></div>
        <script type="text/javascript" src="modules/products/view/js/list_products.js" ></script>
    </fieldset>
</form>
