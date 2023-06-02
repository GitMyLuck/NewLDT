<?php return array (
  'v' => 's:112014:"﻿﻿﻿<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>25</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><th colspan=\'5\' align=\'left\' bgcolor=\'#e9b96e\'>Dump <i>$_SERVER</i></th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$_SERVER[\'REMOTE_ADDR\']&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'127.0.0.1\'</font> <i>(length=9)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$_SERVER[\'REQUEST_METHOD\']&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'GET\'</font> <i>(length=3)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$_SERVER[\'REQUEST_URI\']&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'/NewLDT/php/elabora.scheda.news.php?pagina=eventi&amp;news=9&amp;search=tutti&amp;random=0.9225670852683728\'</font> <i>(length=95)</i>
</pre></td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#4)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$id&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'9\'</font> <i>(length=1)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$news&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=0)</i>
  <i><font color=\'#888a85\'>empty</font></i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$page_content&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$pagina&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$scheda&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>NEWTEXT</i>)[<i>4</i>]
  <i>public</i> \'risultato\' <font color=\'#888a85\'>=&gt;</font> <font color=\'#3465a4\'>null</font>
  <i>public</i> \'news\' <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=0)</i>
      <i><font color=\'#888a85\'>empty</font></i>
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> 
    <b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
      <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;#titolo#&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;#foto#&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:#data_evento_vis#&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; #data_evento#&lt;/div&gt;&lt;!--data_e\'...</font> <i>(length=3569)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$search&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'tutti\'</font> <i>(length=5)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$template&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;#titolo#&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;#foto#&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:#data_evento_vis#&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; #data_evento#&lt;/div&gt;&lt;!--data_e\'...</font> <i>(length=3569)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$testo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$titolo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>31</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#4)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$id&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'9\'</font> <i>(length=1)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$news&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=0)</i>
  <i><font color=\'#888a85\'>empty</font></i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$page_content&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$pagina&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$scheda&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>NEWTEXT</i>)[<i>4</i>]
  <i>public</i> \'risultato\' <font color=\'#888a85\'>=&gt;</font> <font color=\'#3465a4\'>null</font>
  <i>public</i> \'news\' <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=0)</i>
      <i><font color=\'#888a85\'>empty</font></i>
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> 
    <b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
      <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;#foto#&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:#data_evento_vis#&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; #data_evento#&lt;/div&gt;&lt;!--data_evento--&gt;\'...</font> <i>(length=3561)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$search&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'tutti\'</font> <i>(length=5)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$template&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;#foto#&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:#data_evento_vis#&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; #data_evento#&lt;/div&gt;&lt;!--data_evento--&gt;\'...</font> <i>(length=3561)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$testo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$titolo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>290880</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;data_evento&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>34</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'data_evento\'</font> <i>(length=11)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>291024</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;gruppo&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>37</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'gruppo\'</font> <i>(length=6)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>291016</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;localita&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>40</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'localita\'</font> <i>(length=8)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>307384</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;telefono&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>43</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'telefono\'</font> <i>(length=8)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>46</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#4)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$id&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'9\'</font> <i>(length=1)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$news&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=0)</i>
  <i><font color=\'#888a85\'>empty</font></i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$page_content&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$pagina&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$scheda&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>NEWTEXT</i>)[<i>4</i>]
  <i>public</i> \'risultato\' <font color=\'#888a85\'>=&gt;</font> <font color=\'#3465a4\'>null</font>
  <i>public</i> \'news\' <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=0)</i>
      <i><font color=\'#888a85\'>empty</font></i>
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> 
    <b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
      <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;public/php/immagini_eventi/&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:none&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; #data_evento#&lt;/div&gt;&lt;!--data_e\'...</font> <i>(length=3541)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$search&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'tutti\'</font> <i>(length=5)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$template&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;public/php/immagini_eventi/&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:none&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; #data_evento#&lt;/div&gt;&lt;!--data_e\'...</font> <i>(length=3541)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$testo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$titolo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>51</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#4)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><font color=\'#3465a4\'>null</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$id&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'9\'</font> <i>(length=1)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$news&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=0)</i>
  <i><font color=\'#888a85\'>empty</font></i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$page_content&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$pagina&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$scheda&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>NEWTEXT</i>)[<i>4</i>]
  <i>public</i> \'risultato\' <font color=\'#888a85\'>=&gt;</font> <font color=\'#3465a4\'>null</font>
  <i>public</i> \'news\' <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=0)</i>
      <i><font color=\'#888a85\'>empty</font></i>
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> 
    <b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
      <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;public/php/immagini_eventi/&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:none&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; #data_evento#&lt;/div&gt;&lt;!--data_e\'...</font> <i>(length=3541)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$search&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'tutti\'</font> <i>(length=5)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$template&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;public/php/immagini_eventi/&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:none&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; #data_evento#&lt;/div&gt;&lt;!--data_e\'...</font> <i>(length=3541)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$testo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$titolo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>25</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>323736</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getTags(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>56</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$tag&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$tag_report&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$tags&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>48</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>323816</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getMap(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>59</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$mappa_report&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>340304</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;video&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>62</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'video\'</font> <i>(length=5)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>340296</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;link_1&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>65</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'link_1\'</font> <i>(length=6)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>340288</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;link_2&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>68</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'link_2\'</font> <i>(length=6)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>356664</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;pdf&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>71</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'pdf\'</font> <i>(length=3)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>356664</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;info_mail&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>74</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'info_mail\'</font> <i>(length=9)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\elabora.testi.scheda.class.php on line <i>65</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>356648</td><td bgcolor=\'#eeeeec\'>NEWTEXT->getOption( <span>$nome = </span><span>&#39;sottotitolo&#39;</span> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>77</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$dato&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$nome&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'sottotitolo\'</font> <i>(length=11)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$vis&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'block\'</font> <i>(length=5)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 0 in C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>80</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0000</td><td bgcolor=\'#eeeeec\' align=\'right\'>141720</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>222816</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\elabora.scheda.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.scheda.news.php<b>:</b>29</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>223008</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0156</td><td bgcolor=\'#eeeeec\' align=\'right\'>255960</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?>﻿<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l\'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION[\'data\'] );
		//		la chiave di ricerca
		$search = $_SESSION[\'search\'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION[\'pagina\'];
		//		id della notizia
		$id = $_SESSION[\'id\'];
		//exit(var_dump($pagina)); 
		$page_content = \'\';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda.news.html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0][\'titolo\'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\\\	elabora immagine
		$template->replace("foto", 
								\'public/php/immagini_\' . $pagina . \'/\' . $news[0][\'foto\']);
								
// DATA EVENTO  OPTIONAL
		$scheda->getOption(\'data_evento\');
		
// GRUPPO  OPTIONAL
		$scheda->getOption(\'gruppo\');
		
// LOCALITA\'  OPTIONAL
		$scheda->getOption(\'localita\');
		
// TELEFONO OPTIONAL
		$scheda->getOption(\'telefono\');
		
// DATA EVENTO 
		$data_evento = $news[0][\'data_evento\'];
		//  se non c\'e\' data evento
		if ( $data_evento == \'\' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0][\'data\'];
			}
		$template->replace (\'data_evento\', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption(\'video\');
		
//		LINK_1
		$scheda->getOption(\'link_1\');
		
//		LINK_2
		$scheda->getOption(\'link_2\');

//		PDF
		$scheda->getOption(\'pdf\');
		
//		INFO-MAIL	
		$scheda->getOption(\'info_mail\');
		
//		SOTTOTITOLO
		$scheda->getOption(\'sottotitolo\');
		
// 		TESTO
		$testo = $scheda->tText( $news[0][\'testo\'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l\'output
		$page_content .= $template->publish();
		echo $page_content;


?>\'</font> )</td><td title=\'C:\\Users\\Administrator\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#4)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><font color=\'#3465a4\'>null</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$id&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'9\'</font> <i>(length=1)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$news&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=0)</i>
  <i><font color=\'#888a85\'>empty</font></i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$page_content&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$pagina&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$scheda&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>NEWTEXT</i>)[<i>4</i>]
  <i>public</i> \'risultato\' <font color=\'#888a85\'>=&gt;</font> <font color=\'#3465a4\'>null</font>
  <i>public</i> \'news\' <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=0)</i>
      <i><font color=\'#888a85\'>empty</font></i>
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> 
    <b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
      <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;public/php/immagini_eventi/&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:none&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; &lt;/div&gt;&lt;!--data_evento--&gt;&#10;			&lt;\'...</font> <i>(length=3450)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$search&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'tutti\'</font> <i>(length=5)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$template&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div class=&quot;scheda-news&quot;&gt;&#10;	&#10;	&lt;div class=&quot;scheda-news-colonne sx&quot;&gt;&#10;		&lt;div class=&quot;scheda_news_tipo&quot;&gt;eventi&lt;/div&gt;	&lt;!--	tipo notizia (eventi, news, ecc) --&gt;&#10;		&lt;div class=&quot;scheda_news_titolo&quot;&gt;&lt;/div&gt;&lt;!--titolo--&gt;&#10;		&lt;div id=&quot;super_cont&quot; class=&quot;scheda_news_foto&quot; style=&quot;display:block;&quot;&gt;&lt;img src=&quot;public/php/immagini_eventi/&quot; alt=&quot;immagine&quot; title=&quot;foto&quot;&gt;&lt;/div&gt;&lt;!--foto--&gt;&#10;		&lt;div class=&quot;scheda-dati&quot;&gt;&#10;			&lt;div class=&quot;scheda_news_indirizzo&quot;  style=&quot; display:none&quot;&gt;&lt;b&gt;Data :&lt;/b&gt;&amp;nbsp; &amp;nbsp; &lt;/div&gt;&lt;!--data_evento--&gt;&#10;			&lt;\'...</font> <i>(length=3450)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$testo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\' valign=\'top\'><i>Undefined</i></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$titolo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
</table></font>
﻿
<div class="scheda-news">
	
	<div class="scheda-news-colonne sx">
		<div class="scheda_news_tipo">eventi</div>	<!--	tipo notizia (eventi, news, ecc) -->
		<div class="scheda_news_titolo"></div><!--titolo-->
		<div id="super_cont" class="scheda_news_foto" style="display:block;"><img src="public/php/immagini_eventi/" alt="immagine" title="foto"></div><!--foto-->
		<div class="scheda-dati">
			<div class="scheda_news_indirizzo"  style=" display:none"><b>Data :</b>&nbsp; &nbsp; </div><!--data_evento-->
			<div class="scheda_news_indirizzo"  style=" display:none"><b>Gruppo Ospitante :</b>&nbsp; &nbsp; #gruppo#</div><!--gruppo-->
			<div class="scheda_news_indirizzo" style=" display:none"><b>Località :</b>&nbsp;#localita#</div><!--localita-->
			<div class="scheda_news_indirizzo" style=" display:none"><b>Telefono :</b>&nbsp;#telefono#</div><!--telefono-->
		</div>
	</div> <!-- Fine colonna 1 -->

	<div class="scheda-news-buttons dx">
				<!--			DATA 			-->
				<div id="data" class="scheda-btn first" >Data Evento 
					<div class="icona-btn calendar-btn"></div>
					<div class="data-btn"></div>
				</div><!--data_evento-->
			
				<!--			TAGS 			-->
				<div id="parole-chiave" class="scheda-btn hoverable"  style="display:none;" >Tags
					<div class="icona-btn tags-btn"></div>
					<div id="box_tags" class="cont-tags">﻿
﻿﻿						<ul class="cont-keys">#tags#</ul>
					</div>
				</div><!--tags-->
		<!--			GoogleMaps® 			-->
		<div id="mappa-go" class="scheda-btn hoverable" style="display:none;">GoogleMaps® 
				<div class="icona-btn map-btn"></div>
				<div class="cont-map">#embed#
				</div>
		</div><!--embed-->
		
		<!--			video			-->
		<div id="video" class="scheda-btn hoverable" style="display:none;" name="#video#" >Guarda il video 
				<div class="icona-btn video-btn"></div>
		</div><!--video-->
		
		<!--			LINK 1 			-->
			<div id="link1" class="scheda-btn hoverable"  style="display:none;" >Link 
				<div class="icona-btn link-btn"></div>
				<div class="data-btn">#link_1#</div>
			</div><!--link_1-->
		
		<!--			LINK 2 			-->
		<div id="link2" class="scheda-btn hoverable"  style="display:none;" >Link 
				<div class="icona-btn link-btn"></div>
				<div class="data-btn">#link_2#</div>
		</div><!--link_2-->

			
		<!--			doc PDF					-->
		<div id="pdf-go" class="scheda-btn hoverable" style="display:none;">Scarica PDF 
				<div class="icona-btn pdf-btn"></div>
				<div class="cont-pdf"  style="visibility: hidden">#pdf#</div>
		</div><!--doc_pdf-->
		
		<!--		 E-mail			-->
		<div id="mail" class="scheda-btn hoverable" style="display:none;" >Contatto 
				<div class="icona-btn mail-btn"></div>
				<div class="data-btn">#info_mail#</div>
		</div><!--info_mail-->
		
		<!--		 condividi su FaceBook			-->
		<div id="pdf-go" class="scheda-btn hoverable" onclick="return share(\'9\', \'eventi\');" >Condividi 
				<div class="icona-btn fb-btn"></div>
		</div><!-- NULL -->

		<!--		 condividi su FaceBook			-->
		<div id="return-go" class="scheda-btn hoverable" >Indietro
				<div class="icona-btn return-btn"></div>
		</div><!-- NULL -->
		
		
	</div> <!-- Fine colonna 2 -->
	
<div style="width:100%;clear:both;height:20px;"></div>
<hr><br>
<div class="scheda_news_descrizione"><strong  style="display:none">#sottotitolo#</strong><br></div>
</div> <!-- fine scheda news -->

<div style="width:100%;clear:both;height:3px;"></div>
<!-- ******************** ultimi eventi ********************* -->";',
  'l' => 1449399796,
);