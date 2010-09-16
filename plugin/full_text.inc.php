<?php
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: full_text.inc.php,v 1.4 2010/09/10 00:00:00 akiyama Exp $
//
// Usage:
//	#full_text({})

function plugin_full_text_convert()
{
  return '<div class="full_text">' .
    '<br/>' .
    'If you have any questions, please send E-mail to' .
    '<img src="' . IMAGE_DIR . 'ia-board.gif"/>' .
    '<br/><br/>' .
    '<hr class="full"/>' .
    '<strong>-Mailing List-</strong><br/>' .
    'If you subscribe mailing list, please contact us ' .
    '<img src="' . IMAGE_DIR . 'ia-board.gif"/>' .
    '' .
    '<hr class="full"/>' .
    '<br/><br/><br/><br/>' .
    '<p class="full_footer">' .
    'Technical Committee on Internet Architecture' .
    '</p>' .
    '</div>' . "\n";
}
?>
