<?php 

include_once 'includes/constants-inc.php';

	class Listing
	{
		private $listingTitle = "";
		private $listingCreator = "";		// To hold the userID
		private $listingFlag = 0;           // i.e. HOUSING, MISC, BOOK
		private $listingPrice = 0.0;
		private $listingDescription = "";
		private $datetime = "";             // Obtained upon Listing instantiation
		private $listingImage = "";        // A string to hold the image's path


		function __construct()
		{
            date_default_timezone_set("America/Chicago");
		    $this->datetime = date_create()->format('Y-m-d H:i:s');

		}

		/*
		 * This function is used for sanitizing user input in the event it contains undesirable attributes.
		 * Once sanitized, the data is ready for further processing.
		 */
        protected function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


        public function setListingTitle($title)
		{
			$this->listingTitle = $this->test_input($title);
		}

		public function getListingTitle()
		{
			return $this->listingTitle;
		}

		public function setListingFlag($flag)
        {
            if($flag === "BOOK")
            {
                $this->listingFlag = BOOK;
            }
            elseif ($flag === "HOUSING")
            {
                $this->listingFlag = HOUSING;
            }
            else // $flag === "MISC"
            {
                $this->listingFlag = MISC;
            }
        }

        public function getListingFlag()
        {
            return $this->listingFlag;
        }

		public function setListingCreator($creator)
		{
			$this->listingCreator = $this->test_input($creator);
		}

		public function getListingCreator()
		{
			return $this->listingCreator;
		}

		public function setListingPrice($price)
		{
			$this->listingPrice = $this->test_input($price);
		}

		public function getListingPrice()
		{
			return $this->listingPrice;
		}

		public function setListingDescription($description)
		{
			$this->listingDescription = $this->test_input($description);
		}

		public function getListingDescription()
		{
			return $this->listingDescription;
		}

		public function getListingDate()
        {
            return $this->datetime;
        }

		public function setListingImage($imageName)
        {
            $this->listingImage = $imageName;
        }

        public function getListingImage()
        {
            return $this->listingImage;
        }

	} // end class Listing

?>