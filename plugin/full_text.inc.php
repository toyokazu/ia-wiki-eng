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
    '<a href="index.php?yokou">' .
    '��ͽ�ƽ��ʵ��Ѹ������ˤ�ͽ����ɤ򤪴ꤤ�פ��ޤ���' .
    '</a><br/><br/>' .
    '���������ˤĤ��ƤΤ��ո��������' .
    '<img src="' . IMAGE_DIR . 'ia-board.gif"/>' .
    '�ޤ�<br/><br/>' .
    '<hr class="full"/>' .
    '<strong>-�����ۿ��᡼��󥰥ꥹ��-</strong><br/>' .
    '�᡼��󥰥ꥹ�Ȥؤ���Ͽ���˾������������뤤���䤤��碌��' .
    '<img src="' . IMAGE_DIR . 'ia-board.gif"/>' .
    '�ޤǥ᡼������겼�������ʤ������Υ᡼��󥰥ꥹ�Ȥ�������¤����ꡢ��Ͽ�԰ʳ�����ƤϤǤ��ޤ���Τǡ���λ������������' .
    '<hr class="full"/>' .
    '<br/><br/><br/><br/>' .
    '<p class="full_footer">' .
    '�ŻҾ����̿��ز�/�̿��������ƥ������󥿡��ͥåȥ������ƥ����㸦���<br/>' .
    'Technical Committee on Internet Architecture' .
    '</p>' .
    '</div>' . "\n";
}
?>
