<?php
// $Id: ieice_schedule_table.inc.php,v 0.01 2010/09/10 00:00:00 akiyama Exp $
//
// IEICE schedule table plugin
//
// Usage:
//	#ieice_schedule_table({[title], [tgid], [from], [to], [lang]})
//  tgid: e.g. IEICE-IA
//	from: yyyy-mm-dd
//	to: yyyy-mm-dd

function plugin_ieice_schedule_table_convert()
{
	if (func_num_args()) {
    $args = func_get_args();
    $title = $args[0];
    $tgid = $args[1];
    $from = $args[2];
    $to = $args[3];
    $lang = $args[4];
	}

  //$from = "2010-04-01"; $to = "2011-03-31";
  //$tgid = "IEICE-IA";
  //$content = file_get_contents("http://www.ieice.org/ken/program/?cmd=serialized_schedule&tgid=$tgid&from=$from&to=$to");
  // read content from file
  $content = file_get_contents(DATA_HOME . 'test.data');
  $schedule_vars_list = unserialize($content);

  $ret = "\n" .
    '<table id="ieice_schedule">' . "\n" .
    '  <thead class="ieice_schedule">' . "\n" .
    '    <tr>' . "\n" .
    '      <th colspan="2">' . $title . '</th>' . "\n" .
    '    </tr>' . "\n" .
    '  </thead>' . "\n" .
    '  <tbody class="ieice_schedule">' . "\n";
  date_default_timezone_set('Asia/Tokyo');
  $now = new DateTime("now");
  foreach ($schedule_vars_list as $key => $schedule_vars) {
    $number = ($key + 1) . 'th';
    if (($key + 1) == 1) {
      $number = '1st';
    } elseif (($key + 1) == 2) {
      $number = '2nd';
    } elseif (($key + 1) == 3) {
      $number = '3rd';
    }
    $ret .= '  <tr>' . "\n";
    $ret .= '    <td class="ieice_schedule_left">' .
      '<a href="http://www.ieice.org/ken/program/index.php?tgs_regid=' . $schedule_vars['tgs_regid'] . '">' .
      '<span class="ieice_schedule_event">'.
      $number . ' Meeting' .
      '</span>' .
      '</a>' .
      '</td>' . "\n";
    $start_date = new DateTime($schedule_vars['tgs_yy'] . '-' . $schedule_vars['tgs_mm'] . '-' . $schedule_vars['tgs_dd']);
    $end_date = clone $start_date;
    $end_date->add(new DateInterval('P' . ($schedule_vars['tgs_ndays'] - 1) . 'D'));
    $invert_now = $now->diff($end_date);
    // show workshop status
    if ($invert_now->invert == 1 && $invert_now->days > 7) { // program is finished more than a week ago
      $ret .= '    <td class="ieice_schedule_right">' .
        '</td>' . "\n";
    } elseif ($schedule_vars['tgs_prg_openflag'] == '1') { // program is already opened
      $ret .= '    <td class="ieice_schedule_right">' .
        '<span class="ieice_schedule_status">' .
        '...Program is published' .
        '</span>' .
        '</td>' . "\n";
    } elseif (strpos($schedule_vars['tgs_rdl_type'], 'MANUAL') !== false || strpos($schedule_vars['tgs_rdl_type'], 'AUTO') !== false) { // paper submission page is already opened
      $ret .= '    <td class="ieice_schedule_right">' .
        '<span class="ieice_schedule_status">' .
        '...Call for submission' .
        '</span>' .
        '</td>' . "\n";
    } else {
      $ret .= '    <td class="ieice_schedule_right">' .
        '</td>' . "\n";
    }
    $ret .= '  </tr>' . "\n";

    // show workshop dates
    $ret .= '  <tr class="ieice_schedule">' . "\n";
    $ret .= '    <td class="ieice_schedule_left">';
    if ($invert_now->invert == 1 && $invert_now->days > 7) { // program is finished more than a week ago
        $ret .= '<strike>' .
        $start_date->format('n/j') . '-' . $end_date->format('n/j') .
        '</strike>';
    } else {
        $ret .= $start_date->format('n/j') . '-' . $end_date->format('n/j');
    }
    $ret .= '</td>' . "\n" .
      '    <td class="ieice_schedule_right">' .
      '<a href="' . $schedule_vars['tgs_urle'] . '" class="ieice_schedule">' .
      '<span>' .
      $schedule_vars['tgs_placee'] .
      '</span>' .
      '</a>' .
      '</td>' . "\n" .
      '  </tr>' . "\n";
  }
  $ret .= '  <tr>' . "\n" .
    '    <td class="ieice_schedule" colspan=2>' .
    '' .
    '</td>' . "\n" .
    '  </tr>' . "\n" .
    '  <tr>' . "\n" .
    '    <td class="ieice_schedule_align_right" colspan=2>' .
    '<a href="http://www.ieice.org/ken/program/index.php?tgid=IEICE-IA&layout=&lang=' . $lang . '" class="ieice_schedule">' .
    '...Meeting Schedule&gt;&gt;&gt;' .
    '</a>' .
    '</td>' . "\n" .
    '  </tr>' . "\n" .
    '  <tr class="ieice_schedule">' . "\n" .
    '    <td class="ieice_schedule" colspan=2>' .
    '' .
    '</td>' . "\n" .
    '  </tr>' . "\n" .
    '  </tbody>' . "\n" .
    '</table>' . "\n";

  return $ret;
}
?>
