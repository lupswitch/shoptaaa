<?php
class OfferModel extends CI_Model

	{
	function __construct()
		{
		parent::__construct();
		// $this->db = $this->load->database('default', true); 
		 $this->load->model('webservices/CommonFormate');
		 $this->load->model('webservices/Pushnotification_model');
		}

	function addoffers($data)
		{
		$usersId 		  = $data['usersId'];
		$s_id 	 		  = $data['s_id'];
		$name 	 		  = $data['offrerName'];
		$offrdescription  = $data['offrdescription'];
		$price 			  = $data['price'];
		$location_id 	  = $data['location_id'];
		$quantity 		  = $data['quantity'];
		$created_at 	  = $data['created_at'];

		$location_id = explode(',', $location_id );
	

		$SubscriptionData = $this->CommonFormate->getSubscriptionData($usersId, $s_id);
		if ($SubscriptionData == "NotSub")
			{
			return "NotSub";
			}
		  else
		if ($SubscriptionData == "NotBal")
			{
			return "NotBal";
			}
		  else
			{
				$Offerdata = array(
									'usersId' 		   => $usersId,
									'offrerName' 	   => $name,
									'offrdescription'  => $offrdescription,
									'price'            => $price,
									'quantity' 		   => $quantity,
									'created_at' 	   => $created_at
								 );

				foreach ($location_id as $loc) {

						$this->db->insert('offers', array(
									'usersId' 		   => $usersId,
									'offrerName' 	   => $name,
									'offrdescription'  => $offrdescription,
									'price'            => $price,
									'location_id' 	   => $loc,
									'quantity' 		   => $quantity,
									'created_at' 	   => $created_at
								 ));
						$lastId = $this->db->insert_id();
				}
			
								
				$this->db->select('*');
				$this->db->from('users');
				$this->db->where('userId !=', $usersId);
				$query = $this->db->get();
				$users = $query->result_array();
				/* echo "<pre>";print_r($users);die; */
				foreach($users as $device)
				{
				 	$deviceid = $device['deviceid'];
				 	$message  = "New offer Added";
				 	$notfi    = $this->Pushnotification_model->send_newOffer_notification($deviceid,$message);
				}
			
				$this->db->select('*');
				$this->db->from('offers of');
				$this->db->JOIN('locations l', 'of.location_id=l.loc_id');
				$this->db->where('of.off_id', $lastId);
				$query = $this->db->get();
				$SubscriptionDataUpdata = $this->CommonFormate->SubscriptionDataUpdata($usersId, $s_id);
				return $userData = $query->result_array();
			}
		}

	function getOfferLocation($data) // Working here
		{
		$usersId = $data['id'];
		$this->db->select('*');
		$this->db->from('locations loc');
		$this->db->Join('offers of', 'of.location_id=loc.loc_id');
		$query = $this->db->get();
		$locData = $query->result_array();
		if (!empty($locData))
			{
			foreach($locData as $loc)
				{
				$review = $this->CommonFormate->getReviewsOnLocation($loc['loc_id']);
				$fava = $this->CommonFormate->getFavarite($loc['off_id'], $usersId);
				$favaAll = $this->CommonFormate->getAllFavarite($loc['off_id']);
				$claimData = $this->CommonFormate->getclaimedOffer($loc['off_id'], $usersId);
				$num = count($review);
				if ($loc['off_id'] == $claimData[0]['offerId'])
					{
					$loc['is_claim'] = "true";
					}
				  else
					{
					$loc['is_claim'] = "False";
					}

				if ($loc['off_id'] == $fava[0]['offers_id'])
					{
					$loc['is_fav'] = "true";
					}
				  else
					{
					$loc['is_fav'] = "False";
					}

				if ($loc['off_id'])
					{
					$loc['claimed'] = $favaAll . "/" . $loc['quantity'];
					}
				  else
					{
					$loc['claimed'] = "0" . "/" . $loc['quantity'];;
					}

				if ($loc['loc_id'] == $review[0]['location_id'])
					{
					$loc['overAllRating'] = $review[0]['overAllRating'];
					}
				  else
					{
					$loc['overAllRating'] = "0";
					}

				if ($loc['loc_id'] == $review[0]['location_id'])
					{
					$loc['reviewNum'] = "$num";
					}
				  else
					{
					$loc['reviewNum'] = "0";
					}

				if ($loc['loc_id'] == $review[0]['location_id'])
					{
					$loc['review'] = $review;
					}
				  else
					{
					$loc['review'] = [];
					}

				$allData[] = $loc;
				}

			return $allData;
			}
		  else
			{
			return "Not";
			}
		}
	function getLocationOffer($id)
		{
			$this->db->select('*');
			$this->db->from('locations');
			$this->db->where('users_id', $id);
			$query = $this->db->get();
			$data = $query->result_array();
			if(!empty($data))
			{
				foreach ($data as  $location) {
					$off = $this->CommonFormate->getOfferLocId($location['loc_id']);

					if($off)
					{
						$location['offer_data'] = $off;
					}
					else
					{
						$location['offer_data'] = [];
					}
				$all[] = $location;
				}
				//print_r($all);
				return $all;
			}
		}

	function getoffer($data)
		{
		$this->db->select('*');
		$this->db->from('offers of');
		$this->db->where('usersId', $data['id']);
		$query = $this->db->get();
		$offersData = $query->result_array();
		if (!empty($offersData))
			{
			foreach($offersData as $offer)
				{
				$loc = $this->CommonFormate->getLocationById($offer['location_id'], $data['id']);
				if ($offer['location_id'] == $loc[0]['loc_id'])
					{
					$data2 = array_merge($offer, $loc[0]);
					}
				  else
					{
					$data2 = $offer;
					}

				$daa12[] = $data2;
				}

			return $daa12;
			}
		  else
			{
			return "Offer";
			}
		}

	function updateoffer($data)
		{
		$id          = $data['id'];
		$usersId     = $data['usersId'];
		$name 		 = $data['offrerName'];
		$description = $data['offrdescription'];
		$price 		 = $data['price'];
		$location 	 = $data['location'];
		$quantity 	 = $data['quantity'];
		$offer 		 = $this->CommonFormate->getLocationsMan($id, $usersId);
		if (!empty($offer))
			{
			$this->db->where('off_id', $id);

			$this->db->update('offers', array(
				'offrerName' 	  => $name,
				'offrdescription' => $description,
				'price' 		  => $price,
				'location_id' 	  => $location,
				'quantity' 		  => $quantity
				));

			$this->db->select('*');
			$this->db->from('offers');
			$this->db->where('off_id', $id);
			$query = $this->db->get();
			return $query->result_array();
			}
		  else
			{
			return "Not";
			}
		}

	function deleteoffer($data)
		{
		$id = $data['id'];
		$this->db->select('*');
		$this->db->from('offers');
		$this->db->where('off_id', $id);
		$query 		= $this->db->get();
		$offerData 	= $query->result_array();
		if (!empty($offerData))
			{
			$this->db->where('off_id', $id);
			$this->db->delete('offers');
			return "delete";
			}
		  else
			{
			return "Not";
			}
		}

	function claimOffer($data)
		{
		//print_r($data); die;
		$user_id 		  = $data['user_id'];
		$offer_id 		  = $data['offer_id'];
		$claimCurrentTime = $data['claimCurrentTime'];
		$claimExpTime 	  = $data['claimExpTime'];
		
		$userData 		= $this->CommonFormate->getUserdata($user_id);
		$OfferData 		= $this->CommonFormate->getOffersById($offer_id);
		$numberOfClaim  = $this->CommonFormate->getTotalClaimedOffer($offer_id);
		$tt = count($numberOfClaim);
	
		// echo "<pre>";print_r($OfferData);die;

		/*if($OfferData[0]['quantity']==$tt)
		{
		$UserOffer = $this->CommonFormate->Useroffer($user_id, $offer_id);
		if (!empty($UserOffer))
		{
		$this->db->where('users_id', $user_id);
		$this->db->where('offerId', $offer_id);
		$this->db->delete('ClaimOffer');

		// $OfferUpdate = $this->CommonFormate->offerUnclaim($offer_id);

		return $OfferData = $this->CommonFormate->getUpdatedOffersData($offer_id, $user_id);
		}

		return "LimitOut";
		}
		  else
		{*/
		if (!empty($OfferData))
			{

			if (!empty($userData))
				{

				if ($OfferData[0]['quantity'] == $tt)
					{
						
						$UserOffer = $this->CommonFormate->Useroffer($user_id, $offer_id);
						if (!empty($UserOffer))
							{
								$this->db->where('users_id', $user_id);
								$this->db->where('offerId', $offer_id);
								$this->db->delete('ClaimOffer');
								// $OfferUpdate = $this->CommonFormate->offerUnclaim($offer_id);
								return $OfferData = $this->CommonFormate->getUpdatedOffersData($user_id, $offer_id); 
							}
						return "LimitOut";
					}
				  else
					{
		
						$UserOffer = $this->CommonFormate->Useroffer($user_id, $offer_id);
	
						if (!empty($UserOffer))
							{
										
								$this->db->where('users_id', $user_id);
								$this->db->where('offerId', $offer_id);
								$this->db->delete('ClaimOffer');
								//$OfferUpdate = $this->CommonFormate->offerUnclaim($offer_id);
								return $OfferData = $this->CommonFormate->getUpdatedOffersData($user_id, $offer_id);
							}
						  else
							{
								$claimData = array(
									'users_id' 	=> $user_id,
									'offerId'  	=> $offer_id,
									'claimDate' => $claimCurrentTime,
									'claimExp'  => $claimExpTime
									);
								$this->db->insert('ClaimOffer', $claimData);
								//$OfferUpdate = $this->CommonFormate->offerQuentityUpdate($offer_id);
								return $OfferData = $this->CommonFormate->getUpdatedOffersData($user_id, $offer_id); 
							}
					}
				}
			  else
				{
				return "User";
				}
			}
		  else
			{
			return "Offer";
			}
		}
	function claimExpiredWithCron()
	{
		$claimdate = date("Y-m-d H:i");
		
		$this->db->select('*');
		$this->db->from('ClaimOffer cOff');
		$query = $this->db->get();
		$offerData = $query->result_array();
		print_r($offerData);
		
	}
	function getClaimOffer($data)
		{
		$user_id = $data['user_id'];
		$this->db->select('cOff.*,u.first_name,u.last_name,u.username');
		$this->db->from('ClaimOffer cOff');
		$this->db->Join('users u', 'u.userId=cOff.users_id');
		$this->db->where('cOff.users_id', $user_id);
		$query = $this->db->get();
		$offerData = $query->result_array();
		foreach($offerData as $offer)
			{
			$offerss = $this->CommonFormate->getOfferDetails($offer['offerId']);
			if ($offer['offerId'] == $offerss[0]['off_id'])
				{
				$offer = array_merge($offer, $offerss[0]);
				}

			$realData[] = $offer;
			}

		if (!empty($realData))
			{
			return $realData;
			}

		return "Npt";
		}

	function checkClaimOffer($data)
		{
		$user_id = $data['user_id'];
		$offer_id = $data['offer_id'];
		$userData = $this->CommonFormate->getUpdatedOffersData($user_id, $offer_id);
		if (!empty($userData))
			{
			return $userData;
			}
		  else
			{
			return "Not";
			}
		}

	function addOfferFavarite($data)
		{
		$userid = $data['userid'];
		$offerid = $data['offerid'];
		$offerData = $this->CommonFormate->getOffersById($offerid);
		$userData = $this->CommonFormate->getUserdata($userid);
		if (!empty($offerData))
			{
			if (!empty($userData))
				{
				$this->db->select('*');
				$this->db->from('OffersFavourite');
				$this->db->where('users_id', $userid);
				$this->db->where('offers_id', $offerid);
				$query = $this->db->get();
				$favData = $query->result_array();
				if (!empty($favData))
					{
					$this->db->where('users_id', $userid);
					$this->db->where('offers_id', $offerid);
					$this->db->delete('OffersFavourite');
					return $this->CommonFormate->getCountFav2($userid);
					}
				  else
					{
					$claimData = array(
						'users_id' => $userid,
						'offers_id' => $offerid,
						'favAt' => date("Y-m-d")
					);
					$this->db->insert('OffersFavourite', $claimData);
					return $this->CommonFormate->getCountFav($userid, $offerid);
					}
				}
			  else
				{
				return "User";
				}
			}
		  else
			{
			return "Offer";
			}
		}

	function savedoffer($data)
		{
		$userid    = $data['userid'];
		$offerid   = $data['offerid'];
		$offerData = $this->CommonFormate->getOffersById($offerid);
		$userData  = $this->CommonFormate->getUserdata($userid);
		if (!empty($offerData))
			{
			if (!empty($userData))
				{
					$this->db->select('*');
					$this->db->from('offerSaved');
					$this->db->where('users_id', $userid);
					$this->db->where('offers_id', $offerid);
					$query = $this->db->get();
					$offerData = $query->result_array();
					if (!empty($offerData))
						{
							$this->db->where('users_id', $userid);
							$this->db->where('offers_id', $offerid);
							$this->db->delete('offerSaved');
							return "Remove";
						}
					else
						{
							$claimData = array(
									'users_id'  => $userid,
									'offers_id' => $offerid
									);
							$this->db->insert('offerSaved', $claimData);
							return "Favourite";
						}
				}
			  else
				{
				return "User";
				}
			}
		  else
			{
			return "Offer";
			}
		}

	function getSavedOffer($data)
		{
		$userid = $data['userid'];
		$userData = $this->CommonFormate->getUserdata($userid);
		if (!empty($userData))
			{
			$this->db->select('*');
			$this->db->from('OffersFavourite os');
			$this->db->join('offers o', 'os.offers_id = o.off_id');
			$this->db->join('locations loc', 'o.location_id = loc.loc_id');
			$this->db->where('os.users_id', $userid);
			$query = $this->db->get();
			$offerData = $query->result_array();
			foreach($offerData as $loc)
				{
					$review    = $this->CommonFormate->getReviewsOnLocation($loc['loc_id']);
					$fava 	   = $this->CommonFormate->getFavarite($loc['off_id'], $userid);
					$favaAll   = $this->CommonFormate->getAllFavarite($loc['off_id']);
					$claimData = $this->CommonFormate->getclaimedOffer($loc['off_id'], $userid);
					$num 	   = count($review);
					if ($loc['off_id'] == $claimData[0]['offerId'])
						{
						$loc['is_claim'] = "true";
						}
					else
						{
						$loc['is_claim'] = "False";
						}

					if ($loc['off_id'] == $fava[0]['offers_id'])
						{
						$loc['is_fav'] = "true";
						}
					else
						{
						$loc['is_fav'] = "False";
						}

					if ($loc['off_id'])
						{
						$loc['claimed'] = $favaAll . "/" . $loc['quantity'];
						}
					else
						{
						$loc['claimed'] = "0" . "/" . $loc['quantity'];;
						}

					if ($loc['loc_id'] == $review[0]['location_id'])
						{
						$loc['overAllRating'] = $review[0]['overAllRating'];
						}
					else
						{
						$loc['overAllRating'] = "0";
						}

					if ($loc['loc_id'] == $review[0]['location_id'])
						{
						$loc['reviewNum'] = "$num";
						}
					else
						{
						$loc['reviewNum'] = "0";
						}

					if ($loc['loc_id'] == $review[0]['location_id'])
						{
						$loc['review'] = $review;
						}
					else
						{
						$loc['review'] = [];
						}

					$allData[] = $loc;
				}
			if (!empty($allData))
				{
				return $allData;
				}
			  else
				{
				return "Not";
				}
			}
		  else
			{
			return "User";
			}
		}
	}
?>