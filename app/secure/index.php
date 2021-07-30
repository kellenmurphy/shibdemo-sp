<html>
  <head>
    <title>IDM Integration Development Server: kellen-shibdev</title>
    <link rel="stylesheet" href="/css/style.css">
  </head>

    <?php

    $shibLogo = "/images/Shibboleth_logo.png";
    $sspLogo = "/images/simplesamlphp_logo.png";
    $adfsLogo = "/images/ADFS.png";

    $SP = $_SERVER['HTTP_HOST'] . "/shibboleth";
    $logoutUrlSP = $_SERVER['Shib-Handler'] . "/Logout";

    $IDP = $_SERVER['Shib-Identity-Provider'];
    
    if ( containsWord($IDP,'shibboleth')) {
      $logo = $shibLogo;
      $logoutUrlIDP = substr($IDP,0,-10)."profile/Logout";
    }
    elseif ( containsWord($IDP,'simplesaml')) {
      $logo = $sspLogo;
      $logoutUrlIDP = substr($IDP,0,-12)."SingleLogoutService.php?ReturnTo=/";
    }
    elseif ( containsWord($IDP,'adfs/services/trust')) {
      $logo = $adfsLogo;
      $logoutUrlIDP = null;
      $isADFS = true;
    }

    else {
      $logo = " ";
    }
    
    $logoutLink = (!$isADFS ? "<a href=" . $logoutUrlIDP . ">logout (IdP-only)</a>" : "IdP-only logout unavailable for ADFS");

    ?>

  
  <body>

    <img src="/images/bg.jpeg" id="bg" />
    <a href="https://idmintegration.com" >
      <img src="https://idmengineering.com/wp-content/themes/bcse/img/logo.png" style="position: fixed; bottom: 15px; right: 15px; width: 75px;" />
    </a>



    <div class="opaque centering" style="margin-top: -10px; margin-bottom: -10px; padding-bottom: 0px; padding-top:10px" id="outer_wrap">

      <div class="centering content">
	<h2>Service Provider:</h2>
	<img src="<?php echo($shibLogo)?>" width="200px" /><h4><?php echo($SP)?></h4>
	<a href="<?php echo($logoutUrlSP);?>">logout (SP-only)</a>
      </div>

      <div class="content" style="border-bottom: white 1px solid; margin: 20px 0px;"></div>      

      <div class="centering content">
	<h2>Identity Provider:</h2>
	<img src="<?php echo($logo)?>" width="200px" />
	<h4><?php echo($IDP)?></h4>
	<?php echo $logoutLink; ?>
      </div>
      
      <div class="content" style="border-bottom: white 1px solid; margin: 20px 0px;"></div>

      <div>
	<h1 style="text-align: left; padding-left: 5px; text-decoration: underline;">Server Variables:</h1>
      </div>
      <div>
	<table style="font-size: 14px;">
	  <?php
	  foreach ($_SERVER as $name => $value) {
	    $highlight = "";
	    echo "<tr>";
	    if ( in_array(strtolower(substr($name,5)), $attrib) || in_array(strtolower($name), $attrib) || substr($name,0,4) == "Shib" ) {
	      $highlight = "class='highlight'";
	    }
	    echo "<td $highlight style='width: 25%;'>$name</td>";
	    echo "<td $highlight style='width: 3%;'>=</td>";
	    echo "<td $highlight>$value</td>";
	    echo "</tr>";
	  }
	  ?>
	</table>
      </div>

    </div>
    </div>

  </body>

</html>


<?php
function containsWord($str, $word)
{
  return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
}
?>
