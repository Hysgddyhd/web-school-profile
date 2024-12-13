 <?php  
	/**
	 * 
	 */
	class book{
		var $category ;
		public  $price =25;
		var  $page ;
		function book{
			
		}
		
	}
	$tale = new book();
	echo ($tale instanceof book) ? "Yes" : "No";
	$tale -> category = "Story";
	$tale -> page = 120;
	echo ( "<br>"."tale is of ".$tale -> category);
?>