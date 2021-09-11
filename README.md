# Proof of concept for sales system
- index.php file contains one class & different functions to manage product catalog, cart & total

**Products initialized with their respective code & price**
1. Red Widget | R01 | $32.95
2. Green Widget | G01 | $24.95
3. Blue Widget | B01 | $7.95

**Discount offer has been setup for product "Red Widget":** buy one red widget & get the second at half price

**Delivery charges:**
1. Orders under $50 => cost $4.95. 
2. Orders under $90 => cost $2.95. 
3. Orders of $90 or more => free delivery

**Example to add items to cart & calculate total amount**
```
$product = array('B01','G01');

$basket = new Basket();

$basket->add($product);

$total = $basket->total();

echo "Product: ";
echo implode(",",$product);
echo "$".$total();
$basket->clear();
```
