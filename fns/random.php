<!--
	PROGRAMMER	:	PRIDE MOKHELE
	SCRIPT NAME	:	random.php
	DATE		:	16-02-2012
	DESCRIPTION	:	Login facility. First page the user will be exposed to
					when  accessing the site
-->
<?php
    function rand_name()    {
        global $pname;
        $alpha = range('a','z');
        $numeric = range(10, 100);
        $pname = "";
        
        for ($cnt = 0; $cnt < 5; $cnt++)  {
            $say = rand(0, 25);
            
            $pname = $pname . $alpha[$say] . $numeric[$say];
        }
    }
?>