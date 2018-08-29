<?php
	defined('BASEPATH') OR exit('No direct script access allowed.');
	/********************************************************************************
		* Description : This file helps to filter and modified the structure of Cart Array
		*				Send from mobile App, and convert the array same as used in Cart
		*				Library in web site so that we will remove all the confection and
		*				make a better environment which support throw out the Application.
		*
		* Developer  :	Er.Parwinder Singh
		* DOC		 :	09-May-2017
		*
	**********************************************************************************/
	/********************************************************************
		*	@Description : @SpinAppCartArray is used to process the array in loop
		*	@Developer	 : Er.Parwinder Singh
		*	@param		 : Array
		*	@Doc		 : 09-May-2017
		*	@return		 : Data in New Array
	********************************************************************/
	
	if (!function_exists('SpinAppCartArray'))
	{
		function SpinAppCartArray($cartArry = "")
		{
			if (!is_array($cartArry) OR count($cartArry) == 0)
			{
				log_message('error', 'App Cart should have a least one item in a cart.');
				return FALSE;
			}
			
			$ModifiedCartArry = array();
			$GetNewROWIdKey = "";
			foreach($cartArry AS $key => $CartVal)
			{
				//	pr($CartVal);
				$GetNewROWIdKey = Validate_GenrateRowKey($CartVal);
				if ($GetNewROWIdKey)
				{
					// Create a new index with our new row ID
					$CartVal['rowid'] = $GetNewROWIdKey;
					// add new variable for product subtotal
					$CartVal['subtotal'] = ($CartVal['price'] * $CartVal['qty']);
					// And add the new items to the cart array
					$ModifiedCartArry[$GetNewROWIdKey] = $CartVal;
				}
			}
			return $ModifiedCartArry;
		}
	}
	
	if (!function_exists('Validate_GenrateRowKey')){	
		
		function Validate_GenrateRowKey($items = array())
		{
			// Was any cart data passed? No? Bah...
			if (!is_array($items) OR count($items) === 0)
			{
				log_message('error', 'The insert method must be passed an array containing data.');
				return FALSE;
			}
			// --------------------------------------------------------------------
			// Does the $items array contain an id, quantity, price, and name?  These are required
			
			if (!isset($items['id']) OR !isset($items['qty']) OR !isset($items['price']) OR !isset($items['name']))
			{
				log_message('error', 'App-Cart : The cart array must contain a product ID, quantity, price, and name.');
				return FALSE;
			}
			// --------------------------------------------------------------------
			// --------------------------------------------------------------------
			// Prep the quantity. It can only be a number.  Duh... also trim any leading zeros
			
			$items['qty'] = (float)$items['qty'];
			
			// If the quantity is zero or blank there's nothing for us to do
			
			if ($items['qty'] == 0)
			{
				return FALSE;
			}
			
			// --------------------------------------------------------------------
			// Validate the product ID. It can only be alpha-numeric, dashes, underscores or periods
			// Not totally sure we should impose this rule, but it seems prudent to standardize IDs.
			// Note: These can be user-specified by setting the $this->product_id_rules variable.
			
			if (!preg_match("/^[\.a-z0-9_-]+$/i", $items['id']))
			{
				log_message('error', ' APp-Cart :Invalid product ID.  The product ID can only contain alpha-numeric characters, dashes, and underscores');
				return FALSE;
			}
			
			// --------------------------------------------------------------------
			// Validate the product name. It can only be alpha-numeric, dashes, underscores, colons or periods.
			// Note: These can be user-specified by setting the $this->product_name_rules variable.
			
			if (TRUE && !preg_match('/^[\w \-\.\:]+$/i' . (UTF8_ENABLED ? 'u' : '') , $items['name']))
			{
				log_message('error', 'An invalid name was submitted as the product name: ' . $items['name'] . ' The name can only contain alpha-numeric characters, dashes, underscores, colons, and spaces');
				return FALSE;
			}
			// --------------------------------------------------------------------
			// Prep the price. Remove leading zeros and anything that isn't a number or decimal point.
			
			$items['price'] = (float)$items['price'];
			
			// We now need to create a unique identifier for the item being inserted into the cart.
			// Every time something is added to the cart it is stored in the master cart array.
			// Each row in the cart array, however, must have a unique index that identifies not only
			// a particular product, but makes it possible to store identical products with different options.
			// For example, what if someone buys two identical t-shirts (same product ID), but in
			// different sizes?  The product ID (and other attributes, like the name) will be identical for
			// both sizes because it's the same shirt. The only difference will be the size.
			// Internally, we need to treat identical submissions, but with different options, as a unique product.
			// Our solution is to convert the options array to a string and MD5 it along with the product ID.
			// This becomes the unique "row ID"
			
			if (isset($items['options']) && count($items['options']) > 0)
			{
				$rowid = md5($items['id'] . serialize($items['options']));
			}
			else
			{
				// No options were submitted so we simply MD5 the product ID.
				// Technically, we don't need to MD5 the ID in this case, but it makes
				// sense to standardize the format of array indexes for both conditions
				$rowid = md5($items['id']);
			}
			
			return $rowid;
		}
		
		
	}
	
	
	if (!function_exists('ReverseSpinAppCartArray'))
	{
		
		
		function ReverseSpinAppCartArray($OldcartArry = ""){
		
			if (!is_array($OldcartArry) OR count($OldcartArry) == 0)
			{
				log_message('error', 'App Cart should have a least one item in a cart.');
				return FALSE;
			}			
			$WithOutKeyArry = array();			
			foreach($OldcartArry AS $key => $CartVal)
			{
				$WithOutKeyArry[] = $CartVal;
			}
			return $WithOutKeyArry;
		
		}
		
	}		