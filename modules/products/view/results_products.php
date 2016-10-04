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
        <input type="text" name="enter_date" disabled="true">
        <label>Obsolescence date:</label>
        <input type="text" name="obsolescence_date" disabled="true">
    </fieldset>
    <fieldset>
        <label for="product_categoty">Category:</label>
        <select name="product_categoty" id="product_categoty">
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
</form>

<?php
//debugPHP($_SESSION);
/*$product = $_SESSION;
foreach ($product as $indice => $valor) {
    echo "<br><b>$indice</b>: $valor";
}
*/
$product = $_SESSION['product'];
$msage = $_SESSION['msje'];

foreach ($product as $indice => $valor) {
    if ($indice == 'availability') {
        echo "<br><b>Interests:</b><br>";
        $availability = $product['availability'];
        foreach ($availability as $indice => $valor) {
            echo "<b>---> $indice</b>: $valor<br>";
        }
    } else {
        echo "<br><b>$indice</b>: $valor";
    }
}
echo "<br>" . "<b style='color:green'>" . $msage;
