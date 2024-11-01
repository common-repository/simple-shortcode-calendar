<?php
/*
Plugin Name: Simple Shortcode Calendar
Plugin URI: http://wordpress.org/extend/plugins/simple-shortcode-calendar/
Description: Outputs a calendar for any given month. Optionally highlights certain dates.
Version: 1.0
Author: kamontander
Author URI: http://wordpress.org/support/profile/kamontander
License: GPLv2 or later
Copyright: 
*/

/* add shortcode */
add_shortcode( 'calendar', 'calendar_shortcode' );

/* draw a calendar */
function calendar_shortcode( $atts ) {

	/* set defaults & extract attributes */
	extract( shortcode_atts(
		array(
			'year' => date('Y'),  /* A full numeric representation of a year, 4 digits */
			'month' => date('n'), /* Numeric representation of a month, without leading zeros */
			'dates' => '',
			'day_names' => 'Mon,Tue,Wed,Thu,Fri,Sat,Sun',
			'month_names' => '',
			'week_start' => 'Monday'
		), $atts )
	);

	/* buffer the output */
	ob_start();

	/* get names for days */
	$day_names = explode(",",$day_names);

	/* get names for months */
	$month_local = date('F',mktime(0,0,0,$month,1,$year));
	if ($month_names <> ''):
		$month_names = explode(",",$month_names);
		switch ($month_local) {
			case "January":   $month_local = $month_names[0];  break;
			case "February":  $month_local = $month_names[1];  break;
			case "March":     $month_local = $month_names[2];  break;
			case "April":     $month_local = $month_names[3];  break;
			case "May":       $month_local = $month_names[4];  break;
			case "June":      $month_local = $month_names[5];  break;
			case "July":      $month_local = $month_names[6];  break;
			case "August":    $month_local = $month_names[7];  break;
			case "September": $month_local = $month_names[8];  break;
			case "October":   $month_local = $month_names[9];  break;
			case "November":  $month_local = $month_names[10]; break;
			case "December":  $month_local = $month_names[11]; break;
			default:          $month_local = "Unknown";        break;
		}
	endif;

	/* custom first day of the week */
	$week_start = strtolower(substr($week_start, 0, 3));
	switch ($week_start)  {
		case "mon": $week_shift = -1; break; // OK
		case "sat": $week_shift = 1; array_unshift($day_names, array_pop($day_names)); array_unshift($day_names, array_pop($day_names)); break;
		case "sun": $week_shift = 0; array_unshift($day_names, array_pop($day_names)); break; // not OK
	}

	/* draw table & fill in the first row */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar"><tr><td colspan="7">'.$month_local.' '.$year.'.</td>';

	/* table headings */
	$calendar.= '<tr><th>'.implode('</th><th>',$day_names).'</th></tr>';

	/* days and weeks vars */
	$running_day = date('N',mktime(0,0,0,$month,1,$year))+$week_shift;
	if ($running_day == 7): $running_day = 0; elseif ($running_day == 8): $running_day = 1; endif; /* compensate for the week_shift */
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = explode(",",$dates);

	/* row for week one */
	$calendar.= '<tr>';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		
		/* check for important dates */
		$calendar.= '<td';
			for($x = 0; $x < count($dates_array); $x++):
				if (intval($dates_array[$x]) == $list_day):
					$calendar.= ' class="highlight"';
				endif;
			endfor;
		$calendar.= '>'.$list_day.'</td>';
		
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr>';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* print "blank" days until the end of the table row */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
		
	/* flush buffer and display the calendar */
	$output = ob_get_clean();
	echo $output;

}