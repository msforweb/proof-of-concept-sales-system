<?php
class Basket {

	public $products;
	public $cart;

    public function __construct()
    {
    	$this->products['R01']['name'] = 'Red Widget';
	    $this->products['R01']['Price'] = '32.95';


	    $this->products['G01']['name'] = 'Green Widget';
	    $this->products['G01']['Price'] = '24.95';


	    $this->products['B01']['name'] = 'Blue Widget';
	    $this->products['B01']['Price'] = '7.95';

	    $this->cart = array();

    }
	public function get_delivery_charge($total)
	{
		$charge = 0;
		if($total > 0 && $total < 50 )
		{
			$charge = 4.95;
		}
		elseif($total > 50 && $total < 90)
		{
			$charge = 2.95;
		}
		return $charge;
	}


	public function get_product($code)
    {
    	return  $this->products[$code];
    }

	public function add($product_code)
	{

		foreach($product_code as $value)
		{
			$this->cart[$value][] = $this->get_product($value);
		}

	}
	public function round($number)
	{
		$num = ceil($number); // Round up decimals to an integer

		if($num % 2 == 1) $num--; // If odd, add one

		return $num;

	}
	public function total(){
		$price = 0;

		$red_product_price = 0;
		$blue_product_price = 0;
		$green_product_price = 0;
		if(is_array($this->cart) && count($this->cart) > 0)
		{

			if(isset($this->cart['R01']))
			{
				$red_product_price = array_sum(array_column($this->cart['R01'],'Price'));
				if(count($this->cart['R01']) > 1)
				{
					$divider = $this->round(count($this->cart['R01']));

					$red_product_price = $red_product_price - (($divider/2)*($this->products['R01']['Price']/2));
				}

			}
			if(isset($this->cart['G01']))
			{
				$green_product_price = array_sum(array_column($this->cart['G01'],'Price'));
			}
			if(isset($this->cart['B01']))
			{
				$blue_product_price = array_sum(array_column($this->cart['B01'],'Price'));
			}

			$price = $red_product_price +$blue_product_price +$green_product_price;

		}


		$delivery_charge = $this->get_delivery_charge($price);
		$price += $delivery_charge;

		return number_format($price, 2);
	}

	public function clear()
	{
		$this->cart = array();
	}
}

$products_example[] = array('B01','G01');
$products_example[] = array('R01','R01');
$products_example[] = array('R01','G01');
$products_example[] = array('B01','B01','R01','R01','R01');

$basket = new Basket();

foreach($products_example as $key => $product)
{
	$basket->add($product);
	echo "Product: ";
	echo implode(",",$product);

	echo "<br/>";
	echo "$".$basket->total();
	$basket->clear();
	echo "<br/>";
	echo "<br/>";
}
?>