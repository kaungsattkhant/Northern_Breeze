<?php
   $myan_currency=\App\Model\Currency::where('name','Myanmar Kyat')->first();
   return [
       'point_expire_of_year'=>1,
       'pagination_page'=>10,
       'myanmar_currency'=>$myan_currency->id,
   ]
?>
