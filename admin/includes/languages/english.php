<?php

	function lang($phrase) {

		static $lang = array(

			// Navbar Links

			'HOME_ADMIN' 	=> 'الرئيسية',
			'CATEGORIES' 	=> 'الأقسام',
			'ITEMS' 		=> 'المنتجات',
			'MEMBERS' 		=> 'الأعضاء',
			'COMMENTS'		=> 'التعليقات',
			'STATISTICS' 	=> 'الأحصائيات',
		);

		return $lang[$phrase];

	}
