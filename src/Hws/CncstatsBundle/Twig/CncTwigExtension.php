<?php

namespace Hws\CncstatsBundle\Twig;

class CncTwigExtension extends \Twig_Extension {
    public function getFunctions() {
        return array(
            'getBarCss' => new \Twig_Function_Method($this, 'getBarCss'),
            'getBarText' => new \Twig_Function_Method($this, 'getBarText'),
            'floor' => new \Twig_Function_Method($this, 'floor'),
        );
    }

    public function floor($value) {
	return floor($value);
    }

    public function getBarText($days) {
	$days = floor($days);

	if($days > 1) {
	    return 'Inactive from '.$days.' days!';
	} elseif($days == 1) {
	    return 'Inacetive from one day!';
	} else {
	    return 'Active!';
	}
    }

    public function getBarCss($days) {
	$days = (float) $days;
	if($days > 14) {
	    $days = 14;
	}

	$width = 100 - ($days / 14) * 100;

	if($days == 14) {
	    $color = '#ff2401';
	    $width = 100;
	} elseif($days < 14 && $days > 7) {
	    $color = '#ff2402';
	} elseif($days <= 7 && $days > 5) {
	    $color = 'orange';
	} elseif($days <= 5 && $days > 2) {
	    $color = 'yellow';
	} else {
	    $color = 'green';
	}

        return 'background-color: '.$color.'; width: '.$width.'%';
    }

    function percent2Color($value,$brightness = 255, $max = 100, $thirdColorHex = '00') {
	// Calculate first and second color (Inverse relationship)
	$second = (1-($value/$max))*$brightness;
	$first = ($value/$max)*$brightness;

	// Find the influence of the middle color (yellow if 1st and 2nd are red and green)
	$diff = abs($first-$second);
	$influence = ($brightness-$diff)/2;
	$first = intval($first + $influence);
	$second = intval($second + $influence);

	// Convert to HEX, format and return
	$firstHex = str_pad(dechex($first),2,0,STR_PAD_LEFT);
	$secondHex = str_pad(dechex($second),2,0,STR_PAD_LEFT);

	return $firstHex . $secondHex . $thirdColorHex;

	// alternatives:
	// return $thirdColorHex . $firstHex . $secondHex;
	// return $firstHex . $thirdColorHex . $secondHex;

    }

    public function getName() {
        return 'cnc_twig_extension';
    }
}