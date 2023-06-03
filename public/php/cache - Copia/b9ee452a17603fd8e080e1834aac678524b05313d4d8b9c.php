<?php return array (
  'v' => 's:206923:"﻿<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 1 in C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>71</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0010</td><td bgcolor=\'#eeeeec\' align=\'right\'>150048</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\elabora.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0100</td><td bgcolor=\'#eeeeec\' align=\'right\'>287848</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\elabora.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.news.php<b>:</b>92</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0120</td><td bgcolor=\'#eeeeec\' align=\'right\'>495896</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0120</td><td bgcolor=\'#eeeeec\' align=\'right\'>536520</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?><?php 
		@session_start();
		$data = unserialize( $_SESSION[\'data\'] );
		$chunk = $_SESSION[\'chunk\'];
		$max_chunk = $_SESSION[\'max_chunk\'];
		$search_key = $_SESSION[\'search\'];
		//$pagina = $_SESSION[\'pagina\'];
		$zonaShow = $_SESSION[\'zona\'];
		$filePost = "";
		($zonaShow == \'page\') ? $filePost = ".main.page" : $filePost;
		$ezona = \'-\' . $zonaShow;
		
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$chunks = count ( $data );
		$page_content = "";
		$index = 1;
		
		//		CHUNK  PARTS
		foreach ( $data as $key => $value ) 
			{
				if ( $key == $chunk )
					{
						//	INTERNAL GROUP OF CHUNKES
						foreach ( $value as $subKey => $subValue ) 
							{
								$scheda = $template->load("box.news" . $filePost . ".html");
								//		numero della notizia in base all\'ordine di rappresentazione
								$template->replace("id_not", $index);
								//		id della notizia
								$template->replace("id", $value[$subKey][\'id\']);
								//    pagina/categoria della notizia ( eventi, news, ecc )
								$template->replace("pagina", $value[$subKey][\'categoria\']);
								//	zona in cui viene caricato
								$template->replace("zona", $ezona);
								//  testo della ricerca
								$template->replace("search", $search_key);
								$titolo = transTitolo( $value[$subKey][\'titolo\'], $search_key );
								$template->replace("titolo", $titolo);
						
								//\\\\	elabora data
								$data_evento = transData( $value[$subKey][\'data_evento\'] );
								$template->replace("anno", $data_evento[2]);
								$template->replace("giorno", $data_evento[0]);
								$template->replace("mese", $data_evento[1]);
						
								//\\\\   elabora testo
								$testo = transTesto($value[$subKey][\'testo\'], $search_key);
								$template->replace("testo", $testo);
						
								//\\\\	elabora immagine
								$template->replace("immagine", 
								\'public/php/\' . $value[$subKey][\'foto\']);
				
								$page_content .= $template->publish();
								$index++;
							}		/// END OF INTERNAL GROUPS
					}		///  END OF SELECTED CHUNK
				
			}
				$index--;
				$page_content .= "<div class=\'void\'>...</div>";
				$page_content .= "<div id=\'max\'>" . $index . "</div>";
				echo $page_content;
				
				
				function transData($data_evento)
				{
					$mese = array(\'ll\', \'GEN\', \'FEBB\', \'MAR\', \'APR\', \'MAG\', \'GIU\', \'LUG\', \'AGO\', \'SET\', \'OTT\', \'NOV\', \'DIC\');
					$array_data = explode( "/" , $data_evento );
					$array_data[1] = $mese[(int)$array_data[1]];
					return $array_data;
				}
				
			function transTesto($testo, $search)
				{
					$nuovo_testo = str_replace("\\n", "<br />", $testo);
					$part_news = (substr($nuovo_testo, 0, 120));
					$find_pos = strrpos($part_news, " ");
					$part_news = substr($nuovo_testo, 0 , $find_pos);
					$part_news .= \' ...\';	//puntini
					$nuovo_testo = $part_news;
					$pattern = $search;
					$replacement = "<span class=\'found\'>" . $search . "</span>";
					$nuovo_testo = str_ireplace( $pattern, $replacement, $nuovo_testo);
					return $nuovo_testo;
				
				}
				
			function transTitolo($titolo, $search)
				{
					$pattern = $search;
					$replacement = "<span class=\'found\'>" . $search . "</span>";
					$nuovo_titolo = str_ireplace( $pattern, $replacement, $titolo);
					//exit(var_dump($replacement)); 
					return $nuovo_titolo;
				}
?>
\'</font> )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0190</td><td bgcolor=\'#eeeeec\' align=\'right\'>589392</td><td bgcolor=\'#eeeeec\'>transData( <span>$data_evento = </span><span>&#39;&#39;</span> )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>42</td></tr>
<tr><th colspan=\'5\' align=\'left\' bgcolor=\'#e9b96e\'>Dump <i>$_SERVER</i></th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$_SERVER[\'REMOTE_ADDR\']&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'127.0.0.1\'</font> <i>(length=9)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$_SERVER[\'REQUEST_METHOD\']&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'GET\'</font> <i>(length=3)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$_SERVER[\'REQUEST_URI\']&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'/LDTNew/php/elabora.news.php?search=tutti&amp;pagina=eventi&amp;chunk=0&amp;zona=news&amp;pages=eventi,news,homepage\'</font> <i>(length=100)</i>
</pre></td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$array_data&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=1)</i>
  0 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$mese&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=13)</i>
  0 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'ll\'</font> <i>(length=2)</i>
  1 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'GEN\'</font> <i>(length=3)</i>
  2 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'FEBB\'</font> <i>(length=4)</i>
  3 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'MAR\'</font> <i>(length=3)</i>
  4 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'APR\'</font> <i>(length=3)</i>
  5 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'MAG\'</font> <i>(length=3)</i>
  6 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'GIU\'</font> <i>(length=3)</i>
  7 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LUG\'</font> <i>(length=3)</i>
  8 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'AGO\'</font> <i>(length=3)</i>
  9 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'SET\'</font> <i>(length=3)</i>
  10 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'OTT\'</font> <i>(length=3)</i>
  11 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'NOV\'</font> <i>(length=3)</i>
  12 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'DIC\'</font> <i>(length=3)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 2 in C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>43</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0010</td><td bgcolor=\'#eeeeec\' align=\'right\'>150048</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\elabora.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0100</td><td bgcolor=\'#eeeeec\' align=\'right\'>287848</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\elabora.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.news.php<b>:</b>92</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0120</td><td bgcolor=\'#eeeeec\' align=\'right\'>495896</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0120</td><td bgcolor=\'#eeeeec\' align=\'right\'>536520</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?><?php 
		@session_start();
		$data = unserialize( $_SESSION[\'data\'] );
		$chunk = $_SESSION[\'chunk\'];
		$max_chunk = $_SESSION[\'max_chunk\'];
		$search_key = $_SESSION[\'search\'];
		//$pagina = $_SESSION[\'pagina\'];
		$zonaShow = $_SESSION[\'zona\'];
		$filePost = "";
		($zonaShow == \'page\') ? $filePost = ".main.page" : $filePost;
		$ezona = \'-\' . $zonaShow;
		
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$chunks = count ( $data );
		$page_content = "";
		$index = 1;
		
		//		CHUNK  PARTS
		foreach ( $data as $key => $value ) 
			{
				if ( $key == $chunk )
					{
						//	INTERNAL GROUP OF CHUNKES
						foreach ( $value as $subKey => $subValue ) 
							{
								$scheda = $template->load("box.news" . $filePost . ".html");
								//		numero della notizia in base all\'ordine di rappresentazione
								$template->replace("id_not", $index);
								//		id della notizia
								$template->replace("id", $value[$subKey][\'id\']);
								//    pagina/categoria della notizia ( eventi, news, ecc )
								$template->replace("pagina", $value[$subKey][\'categoria\']);
								//	zona in cui viene caricato
								$template->replace("zona", $ezona);
								//  testo della ricerca
								$template->replace("search", $search_key);
								$titolo = transTitolo( $value[$subKey][\'titolo\'], $search_key );
								$template->replace("titolo", $titolo);
						
								//\\\\	elabora data
								$data_evento = transData( $value[$subKey][\'data_evento\'] );
								$template->replace("anno", $data_evento[2]);
								$template->replace("giorno", $data_evento[0]);
								$template->replace("mese", $data_evento[1]);
						
								//\\\\   elabora testo
								$testo = transTesto($value[$subKey][\'testo\'], $search_key);
								$template->replace("testo", $testo);
						
								//\\\\	elabora immagine
								$template->replace("immagine", 
								\'public/php/\' . $value[$subKey][\'foto\']);
				
								$page_content .= $template->publish();
								$index++;
							}		/// END OF INTERNAL GROUPS
					}		///  END OF SELECTED CHUNK
				
			}
				$index--;
				$page_content .= "<div class=\'void\'>...</div>";
				$page_content .= "<div id=\'max\'>" . $index . "</div>";
				echo $page_content;
				
				
				function transData($data_evento)
				{
					$mese = array(\'ll\', \'GEN\', \'FEBB\', \'MAR\', \'APR\', \'MAG\', \'GIU\', \'LUG\', \'AGO\', \'SET\', \'OTT\', \'NOV\', \'DIC\');
					$array_data = explode( "/" , $data_evento );
					$array_data[1] = $mese[(int)$array_data[1]];
					return $array_data;
				}
				
			function transTesto($testo, $search)
				{
					$nuovo_testo = str_replace("\\n", "<br />", $testo);
					$part_news = (substr($nuovo_testo, 0, 120));
					$find_pos = strrpos($part_news, " ");
					$part_news = substr($nuovo_testo, 0 , $find_pos);
					$part_news .= \' ...\';	//puntini
					$nuovo_testo = $part_news;
					$pattern = $search;
					$replacement = "<span class=\'found\'>" . $search . "</span>";
					$nuovo_testo = str_ireplace( $pattern, $replacement, $nuovo_testo);
					return $nuovo_testo;
				
				}
				
			function transTitolo($titolo, $search)
				{
					$pattern = $search;
					$replacement = "<span class=\'found\'>" . $search . "</span>";
					$nuovo_titolo = str_ireplace( $pattern, $replacement, $titolo);
					//exit(var_dump($replacement)); 
					return $nuovo_titolo;
				}
?>
\'</font> )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#4)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$chunk&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$chunks&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>1</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=1)</i>
  0 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=13)</i>
      0 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=15)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1455750000\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451770547\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Deus te, domine mi rex Karle, omni sapientiae lumine inluminavit et scientiae claritate ornavit, ut non solum magistrorum ingenia prompte subsequi, sed etiam in multis velociter praecurrere possis, et licet flammivomo tuae sapientiae lumini scintilla ingenioli mei nil addere possit, tamen ne me aliqui inoboedientem notent, tuis promptulus respondeo interrogationibus, et utinam tam sagaciter quam oboedienter. Primum mihi, magister, huius artis vel studii initium pande. Pandam penes auctoritatem veterum.\'</font> <i>(length=507)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/02/2016\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Nuova Notizia\'</font> <i>(length=13)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'brigidino,\'</font> <i>(length=10)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Pizza E&#39; Pronta\'</font> <i>(length=18)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'webmaster\'</font> <i>(length=9)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111759-2D00E45BBA6B.jpg\'</font> <i>(length=41)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      1 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453935600\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447621888\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem cacchius ipsum dolor pacchos sit amet, consectetuer adipiscing elit. Nam cursus.&#10;&#10; Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit \'...</font> <i>(length=711)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'28/01/2016\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Prova Del Fuoco\'</font> <i>(length=18)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una nuova sfida per il Control Panel\'</font> <i>(length=36)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'www.smartaweb.it\'</font> <i>(length=16)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Fucecchio\'</font> <i>(length=9)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'pb=!1m14!1m12!1m3!1d11522.567089930897!2d10.592864476423305!3d43.78029446210764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sit!2sit!4v1448987939513\'</font> <i>(length=153)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'info@gappistoia.it\'</font> <i>(length=18)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'39365555658\'</font> <i>(length=11)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511152221-BE5968E1EC3F.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      2 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'8\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453330800\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453370698\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'8\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Ad bene dicendi scientiam. In quibus versatur rebus?\'</font> <i>(length=52)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'21/01/2016\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Mandragola\'</font> <i>(length=13)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'trofeo,pilatus,\'</font> <i>(length=15)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una radice preziosa\'</font> <i>(length=19)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1601211104-FCC97EE46710.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      3 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=15)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1452034800\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1452073335\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'In prima approssimazione, la configurazione canard è aerodinamicamente più efficiente del classico layout con stabilizzatori in coda perché in quest ultima la forza necessaria ad equilibrare le rotazioni attorno al baricentro si ottiene mantenendo gli impennaggi in portanza negativa , mentre nel caso del canard entrambe le superfici portanti  lavorano in portanza positiva.\'</font> <i>(length=378)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'06/01/2016\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lo Xeno Multiplex\'</font> <i>(length=17)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Un modello dal volo stupendo\'</font> <i>(length=28)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'webmaster\'</font> <i>(length=9)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111805-FBC8FF60FA6F.jpg\'</font> <i>(length=41)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      4 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=15)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451516400\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451555448\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Cui dono lepidum nouum libellum arida modo pumice expolitum?&#13;&#10;Corneli, tibi: namque tu solebas meas esse aliquid putare nugas&#13;&#10;iam tum, cum ausus es unus Italorum omne aeuum tribus explicare cartis&#13;&#10;doctis, Iuppiter, et laboriosis.&#13;&#10;Quare habe tibi quidquid hoc libelli qualecumque, quod, patrona virgo&#13;&#10;plus uno maneat perenne saeclo.\'</font> <i>(length=335)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'31/12/2015\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La ragazza di Ipanema\'</font> <i>(length=21)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'biplano,cornelium,\'</font> <i>(length=18)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Poesia e Musica\'</font> <i>(length=15)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'www.google.it\'</font> <i>(length=13)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Webmaster\'</font> <i>(length=9)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111202-59C7146F5BB1.jpg\'</font> <i>(length=41)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      5 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1336255200\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447625927\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Il nuovo appuntamento con l&#39;aerotraino al campo del LUCCA DELTA TEAM si è svolto il 6 maggio scorso.&#10;La pioggia a tratti non ci ha impedito di portare a termine l&#39;edizione 2012 del &#10;4 TROFEO LUCCA DELTA TEAM - Formula Pelizza Il LUCCA DELTA TEAM è sempre in movimento..\'</font> <i>(length=271)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'06/05/2012\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'AEROTRAINO ALIANTI ...\'</font> <i>(length=22)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'aerotraino,alianti,pelizza,trofeo,\'</font> <i>(length=34)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'https://www.youtube.com/watch?v=aX6o2cqD7Uo\'</font> <i>(length=43)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511152318-2A33D09E8776.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      6 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1332025200\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447627407\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Domenica 18 Marzo si è svolta, presso la palestra&#13;&#10;del Liceo Scientifico Maiorana di Capannori&#13;&#10;la gara di acrobazia Indoor valevole per il Campionato Italiano 2012 Cat F3P.&#13;&#10;L&#39;impegno di Benito Bertolani e del LUCCA DELTA TEAM hanno permesso il successo di questa prima competizione indoor.\'</font> <i>(length=292)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/03/2012\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'ACROBAZIA INDOOR F3P\'</font> <i>(length=20)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\',\'</font> <i>(length=1)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161126-B7AF6FEBD0C0.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      7 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'4\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1318111200\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447669908\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'4\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La classica gara acrobatica di Carlo Allara,&#13;&#10;si è svolta sulla nostra aviosuperficie il 09 OTTOBRE scorso ....\'</font> <i>(length=112)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'09/10/2011\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'23mo MOBBY TROPHY\'</font> <i>(length=17)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161130-260383EF98AC.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      8 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'5\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1316296800\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447670551\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'5\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La gara comincia con la solita premessa,&#13;&#10;il meteo promette acquazzoni, e per tanto i concorrenti la vivono con un pò di trepidazione.&#13;&#10;Inizio gara alle ore 09:00. Il Direttore di gara, Carlo Ceragioli, dopo un breve briefing dà il via ai cronometri. Inizia così la terza edizione del * Trofeo Pelizza * al campo del LUCCA DELTA TEAM.\'</font> <i>(length=337)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/09/2011\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'TROFEO PELIZZA 2011\'</font> <i>(length=19)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'aerotraino,alianti,pelizza,trofeo,\'</font> <i>(length=34)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Appuntamento con l&#39;aerotraino\'</font> <i>(length=29)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161142-482F1B800075.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      9 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'6\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1307138400\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447754882\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'6\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una splendida gara con uragano finale....&#13;&#10;Sì avete capito bene, la 2 Edizione del&#13;&#10;* Trofeo Giuliana Pagni *&#13;&#10;Prova di Cat F3A, si è conclusa domenica sera con un tempo tutto sommato buono, ma dopo la premiazione, una bonba d&#39;acqua si è riversata sul campo... Tutto però è filato liscio grazie alla splendida organizzazione e grazie al meteo, che per una volta ci ha permesso di svolgere tutta la gara in piena tranquillità.&#13;&#10;L&#39; uragano poi, che si è scatenato dopo la premiazione, è un&#39;altra storia...\'</font> <i>(length=511)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'04/06/2011\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2° TROFEO GIULIANA PAGNI\'</font> <i>(length=25)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Alta Acrobazia\'</font> <i>(length=14)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Aviosuperficie LDT\'</font> <i>(length=18)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511171107-AEC4597C09C9.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      10 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'7\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1284847200\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447755996\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'7\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Dopo un sabato incerto,&#13;&#10;a tratti piovoso,&#13;&#10;è arrivato il giorno della gara.Alle 9,00 il direttore di gara, Carlo Ceragioli, fa partire i cronometri,il cielo comunque è sempre nuvoloso, anche se stiamo aspettando la schiarita promessa dalle previsioni del tempo segue...\'</font> <i>(length=272)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'19/09/2010\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'TROFEO LUCCA DELTA TEAM\'</font> <i>(length=23)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'salutare,vetrina,indoor,\'</font> <i>(length=24)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una&#39;altra splendida manifestazione\'</font> <i>(length=34)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Aviosuperficie\'</font> <i>(length=14)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511171125-578C85EBBD86.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      11 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=12)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453332853\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi m\'...</font> <i>(length=692)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'p\'</font> <i>(length=1)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
      12 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=12)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453367833\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. &#13;&#10;Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi\'...</font> <i>(length=1036)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Notizia 2\'</font> <i>(length=9)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=2)</i>
  0 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
  1 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'ll\'</font> <i>(length=2)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$ezona&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'-news\'</font> <i>(length=5)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$filePost&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$index&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>12</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$key&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>0</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$max_chunk&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>0</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$page_content&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div  id=&quot;2&quot; name=&quot;1&quot; class=&quot;block-news block-color-news&quot;&gt;&#10;&#10;				&lt;div id=&quot;box-titolo&quot; class=&quot;box-titolo class-news&quot;&gt;Nuova Notizia&lt;/div&gt;&#10;				&lt;div class=&quot;categoria&quot;&gt;news&lt;/div&gt;&#10;				&lt;div id=&quot;2016&quot; class=&quot;box-data-news&quot;&gt;&#10;						&lt;div class=&quot;block-anno&quot;&gt;2016&lt;/div&gt;&#10;						&lt;div class=&quot;block-giorno&quot;&gt;18&lt;/div&gt;&#10;						&lt;div class=&quot;block-mese&quot;&gt;FEBB&lt;/div&gt;&#10;				&lt;/div&gt;&#10;				&lt;div id=&quot;box-image&quot; class=&quot;box-image&quot;&gt;&#10;						&lt;img src=&quot;public/php/immagini_news/1601111759-2D00E45BBA6B.jpg&quot;	alt=&quot;&amp;nbsp; nessuna immagine&amp;nbsp;&amp;nbsp;&quot;/&gt;&#10;		\'...</font> <i>(length=9905)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$scheda&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><font color=\'#3465a4\'>null</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$search_key&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$subKey&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>11</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$subValue&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=12)</i>
  \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
  \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
  \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453332853\'</font> <i>(length=10)</i>
  \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
  \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
  \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi m\'...</font> <i>(length=692)</i>
  \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
  \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'p\'</font> <i>(length=1)</i>
  \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
  \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
  \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
  \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$template&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div  id=&quot;2&quot; name=&quot;12&quot; class=&quot;block-news block-color-homepage&quot;&gt;&#10;&#10;				&lt;div id=&quot;box-titolo&quot; class=&quot;box-titolo class-homepage&quot;&gt;p&lt;/div&gt;&#10;				&lt;div class=&quot;categoria&quot;&gt;homepage&lt;/div&gt;&#10;				&lt;div id=&quot;#anno#&quot; class=&quot;box-data-news&quot;&gt;&#10;						&lt;div class=&quot;block-anno&quot;&gt;#anno#&lt;/div&gt;&#10;						&lt;div class=&quot;block-giorno&quot;&gt;#giorno#&lt;/div&gt;&#10;						&lt;div class=&quot;block-mese&quot;&gt;#mese#&lt;/div&gt;&#10;				&lt;/div&gt;&#10;				&lt;div id=&quot;box-image&quot; class=&quot;box-image&quot;&gt;&#10;						&lt;img src=&quot;#immagine#&quot;	alt=&quot;&amp;nbsp; nessuna immagine&amp;nbsp;&amp;nbsp;&quot;/&gt;&#10;				&lt;/div&gt;&#10;				&lt;div id=&quot;box-tex\'...</font> <i>(length=760)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$testo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'Dopo un sabato incerto,&#13;&lt;br /&gt;a tratti piovoso,&#13;&lt;br /&gt;è arrivato il giorno della gara.Alle 9,00 il direttore di gara, ...\'</font> <i>(length=122)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$titolo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'p\'</font> <i>(length=1)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$value&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=13)</i>
  0 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=15)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1455750000\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451770547\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Deus te, domine mi rex Karle, omni sapientiae lumine inluminavit et scientiae claritate ornavit, ut non solum magistrorum ingenia prompte subsequi, sed etiam in multis velociter praecurrere possis, et licet flammivomo tuae sapientiae lumini scintilla ingenioli mei nil addere possit, tamen ne me aliqui inoboedientem notent, tuis promptulus respondeo interrogationibus, et utinam tam sagaciter quam oboedienter. Primum mihi, magister, huius artis vel studii initium pande. Pandam penes auctoritatem veterum.\'</font> <i>(length=507)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/02/2016\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Nuova Notizia\'</font> <i>(length=13)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'brigidino,\'</font> <i>(length=10)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Pizza E&#39; Pronta\'</font> <i>(length=18)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'webmaster\'</font> <i>(length=9)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111759-2D00E45BBA6B.jpg\'</font> <i>(length=41)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
  1 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453935600\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447621888\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem cacchius ipsum dolor pacchos sit amet, consectetuer adipiscing elit. Nam cursus.&#10;&#10; Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit \'...</font> <i>(length=711)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'28/01/2016\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Prova Del Fuoco\'</font> <i>(length=18)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una nuova sfida per il Control Panel\'</font> <i>(length=36)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'www.smartaweb.it\'</font> <i>(length=16)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Fucecchio\'</font> <i>(length=9)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'pb=!1m14!1m12!1m3!1d11522.567089930897!2d10.592864476423305!3d43.78029446210764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sit!2sit!4v1448987939513\'</font> <i>(length=153)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'info@gappistoia.it\'</font> <i>(length=18)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'39365555658\'</font> <i>(length=11)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511152221-BE5968E1EC3F.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  2 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'8\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453330800\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453370698\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'8\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Ad bene dicendi scientiam. In quibus versatur rebus?\'</font> <i>(length=52)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'21/01/2016\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Mandragola\'</font> <i>(length=13)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'trofeo,pilatus,\'</font> <i>(length=15)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una radice preziosa\'</font> <i>(length=19)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1601211104-FCC97EE46710.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  3 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=15)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1452034800\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1452073335\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'In prima approssimazione, la configurazione canard è aerodinamicamente più efficiente del classico layout con stabilizzatori in coda perché in quest ultima la forza necessaria ad equilibrare le rotazioni attorno al baricentro si ottiene mantenendo gli impennaggi in portanza negativa , mentre nel caso del canard entrambe le superfici portanti  lavorano in portanza positiva.\'</font> <i>(length=378)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'06/01/2016\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lo Xeno Multiplex\'</font> <i>(length=17)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Un modello dal volo stupendo\'</font> <i>(length=28)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'webmaster\'</font> <i>(length=9)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111805-FBC8FF60FA6F.jpg\'</font> <i>(length=41)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
  4 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=15)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451516400\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451555448\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Cui dono lepidum nouum libellum arida modo pumice expolitum?&#13;&#10;Corneli, tibi: namque tu solebas meas esse aliquid putare nugas&#13;&#10;iam tum, cum ausus es unus Italorum omne aeuum tribus explicare cartis&#13;&#10;doctis, Iuppiter, et laboriosis.&#13;&#10;Quare habe tibi quidquid hoc libelli qualecumque, quod, patrona virgo&#13;&#10;plus uno maneat perenne saeclo.\'</font> <i>(length=335)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'31/12/2015\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La ragazza di Ipanema\'</font> <i>(length=21)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'biplano,cornelium,\'</font> <i>(length=18)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Poesia e Musica\'</font> <i>(length=15)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'www.google.it\'</font> <i>(length=13)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Webmaster\'</font> <i>(length=9)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111202-59C7146F5BB1.jpg\'</font> <i>(length=41)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
  5 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1336255200\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447625927\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Il nuovo appuntamento con l&#39;aerotraino al campo del LUCCA DELTA TEAM si è svolto il 6 maggio scorso.&#10;La pioggia a tratti non ci ha impedito di portare a termine l&#39;edizione 2012 del &#10;4 TROFEO LUCCA DELTA TEAM - Formula Pelizza Il LUCCA DELTA TEAM è sempre in movimento..\'</font> <i>(length=271)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'06/05/2012\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'AEROTRAINO ALIANTI ...\'</font> <i>(length=22)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'aerotraino,alianti,pelizza,trofeo,\'</font> <i>(length=34)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'https://www.youtube.com/watch?v=aX6o2cqD7Uo\'</font> <i>(length=43)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511152318-2A33D09E8776.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  6 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1332025200\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447627407\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Domenica 18 Marzo si è svolta, presso la palestra&#13;&#10;del Liceo Scientifico Maiorana di Capannori&#13;&#10;la gara di acrobazia Indoor valevole per il Campionato Italiano 2012 Cat F3P.&#13;&#10;L&#39;impegno di Benito Bertolani e del LUCCA DELTA TEAM hanno permesso il successo di questa prima competizione indoor.\'</font> <i>(length=292)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/03/2012\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'ACROBAZIA INDOOR F3P\'</font> <i>(length=20)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\',\'</font> <i>(length=1)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161126-B7AF6FEBD0C0.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  7 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'4\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1318111200\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447669908\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'4\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La classica gara acrobatica di Carlo Allara,&#13;&#10;si è svolta sulla nostra aviosuperficie il 09 OTTOBRE scorso ....\'</font> <i>(length=112)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'09/10/2011\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'23mo MOBBY TROPHY\'</font> <i>(length=17)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161130-260383EF98AC.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  8 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'5\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1316296800\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447670551\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'5\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La gara comincia con la solita premessa,&#13;&#10;il meteo promette acquazzoni, e per tanto i concorrenti la vivono con un pò di trepidazione.&#13;&#10;Inizio gara alle ore 09:00. Il Direttore di gara, Carlo Ceragioli, dopo un breve briefing dà il via ai cronometri. Inizia così la terza edizione del * Trofeo Pelizza * al campo del LUCCA DELTA TEAM.\'</font> <i>(length=337)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/09/2011\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'TROFEO PELIZZA 2011\'</font> <i>(length=19)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'aerotraino,alianti,pelizza,trofeo,\'</font> <i>(length=34)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Appuntamento con l&#39;aerotraino\'</font> <i>(length=29)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161142-482F1B800075.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  9 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'6\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1307138400\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447754882\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'6\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una splendida gara con uragano finale....&#13;&#10;Sì avete capito bene, la 2 Edizione del&#13;&#10;* Trofeo Giuliana Pagni *&#13;&#10;Prova di Cat F3A, si è conclusa domenica sera con un tempo tutto sommato buono, ma dopo la premiazione, una bonba d&#39;acqua si è riversata sul campo... Tutto però è filato liscio grazie alla splendida organizzazione e grazie al meteo, che per una volta ci ha permesso di svolgere tutta la gara in piena tranquillità.&#13;&#10;L&#39; uragano poi, che si è scatenato dopo la premiazione, è un&#39;altra storia...\'</font> <i>(length=511)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'04/06/2011\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2° TROFEO GIULIANA PAGNI\'</font> <i>(length=25)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Alta Acrobazia\'</font> <i>(length=14)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Aviosuperficie LDT\'</font> <i>(length=18)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511171107-AEC4597C09C9.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  10 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'7\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1284847200\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447755996\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'7\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Dopo un sabato incerto,&#13;&#10;a tratti piovoso,&#13;&#10;è arrivato il giorno della gara.Alle 9,00 il direttore di gara, Carlo Ceragioli, fa partire i cronometri,il cielo comunque è sempre nuvoloso, anche se stiamo aspettando la schiarita promessa dalle previsioni del tempo segue...\'</font> <i>(length=272)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'19/09/2010\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'TROFEO LUCCA DELTA TEAM\'</font> <i>(length=23)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'salutare,vetrina,indoor,\'</font> <i>(length=24)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una&#39;altra splendida manifestazione\'</font> <i>(length=34)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Aviosuperficie\'</font> <i>(length=14)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511171125-578C85EBBD86.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  11 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=12)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453332853\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi m\'...</font> <i>(length=692)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'p\'</font> <i>(length=1)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
  12 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=12)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453367833\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. &#13;&#10;Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi\'...</font> <i>(length=1036)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Notizia 2\'</font> <i>(length=9)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$zonaShow&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 1 in C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>71</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0010</td><td bgcolor=\'#eeeeec\' align=\'right\'>150048</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\elabora.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0100</td><td bgcolor=\'#eeeeec\' align=\'right\'>287848</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\elabora.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.news.php<b>:</b>92</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0120</td><td bgcolor=\'#eeeeec\' align=\'right\'>495896</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0120</td><td bgcolor=\'#eeeeec\' align=\'right\'>536520</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?><?php 
		@session_start();
		$data = unserialize( $_SESSION[\'data\'] );
		$chunk = $_SESSION[\'chunk\'];
		$max_chunk = $_SESSION[\'max_chunk\'];
		$search_key = $_SESSION[\'search\'];
		//$pagina = $_SESSION[\'pagina\'];
		$zonaShow = $_SESSION[\'zona\'];
		$filePost = "";
		($zonaShow == \'page\') ? $filePost = ".main.page" : $filePost;
		$ezona = \'-\' . $zonaShow;
		
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$chunks = count ( $data );
		$page_content = "";
		$index = 1;
		
		//		CHUNK  PARTS
		foreach ( $data as $key => $value ) 
			{
				if ( $key == $chunk )
					{
						//	INTERNAL GROUP OF CHUNKES
						foreach ( $value as $subKey => $subValue ) 
							{
								$scheda = $template->load("box.news" . $filePost . ".html");
								//		numero della notizia in base all\'ordine di rappresentazione
								$template->replace("id_not", $index);
								//		id della notizia
								$template->replace("id", $value[$subKey][\'id\']);
								//    pagina/categoria della notizia ( eventi, news, ecc )
								$template->replace("pagina", $value[$subKey][\'categoria\']);
								//	zona in cui viene caricato
								$template->replace("zona", $ezona);
								//  testo della ricerca
								$template->replace("search", $search_key);
								$titolo = transTitolo( $value[$subKey][\'titolo\'], $search_key );
								$template->replace("titolo", $titolo);
						
								//\\\\	elabora data
								$data_evento = transData( $value[$subKey][\'data_evento\'] );
								$template->replace("anno", $data_evento[2]);
								$template->replace("giorno", $data_evento[0]);
								$template->replace("mese", $data_evento[1]);
						
								//\\\\   elabora testo
								$testo = transTesto($value[$subKey][\'testo\'], $search_key);
								$template->replace("testo", $testo);
						
								//\\\\	elabora immagine
								$template->replace("immagine", 
								\'public/php/\' . $value[$subKey][\'foto\']);
				
								$page_content .= $template->publish();
								$index++;
							}		/// END OF INTERNAL GROUPS
					}		///  END OF SELECTED CHUNK
				
			}
				$index--;
				$page_content .= "<div class=\'void\'>...</div>";
				$page_content .= "<div id=\'max\'>" . $index . "</div>";
				echo $page_content;
				
				
				function transData($data_evento)
				{
					$mese = array(\'ll\', \'GEN\', \'FEBB\', \'MAR\', \'APR\', \'MAG\', \'GIU\', \'LUG\', \'AGO\', \'SET\', \'OTT\', \'NOV\', \'DIC\');
					$array_data = explode( "/" , $data_evento );
					$array_data[1] = $mese[(int)$array_data[1]];
					return $array_data;
				}
				
			function transTesto($testo, $search)
				{
					$nuovo_testo = str_replace("\\n", "<br />", $testo);
					$part_news = (substr($nuovo_testo, 0, 120));
					$find_pos = strrpos($part_news, " ");
					$part_news = substr($nuovo_testo, 0 , $find_pos);
					$part_news .= \' ...\';	//puntini
					$nuovo_testo = $part_news;
					$pattern = $search;
					$replacement = "<span class=\'found\'>" . $search . "</span>";
					$nuovo_testo = str_ireplace( $pattern, $replacement, $nuovo_testo);
					return $nuovo_testo;
				
				}
				
			function transTitolo($titolo, $search)
				{
					$pattern = $search;
					$replacement = "<span class=\'found\'>" . $search . "</span>";
					$nuovo_titolo = str_ireplace( $pattern, $replacement, $titolo);
					//exit(var_dump($replacement)); 
					return $nuovo_titolo;
				}
?>
\'</font> )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>5</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0360</td><td bgcolor=\'#eeeeec\' align=\'right\'>672264</td><td bgcolor=\'#eeeeec\'>transData( <span>$data_evento = </span><span>&#39;&#39;</span> )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code\' bgcolor=\'#eeeeec\'>..\\cache.class.php(122) : eval()\'d code<b>:</b>42</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#5)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$array_data&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=1)</i>
  0 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$mese&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=13)</i>
  0 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'ll\'</font> <i>(length=2)</i>
  1 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'GEN\'</font> <i>(length=3)</i>
  2 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'FEBB\'</font> <i>(length=4)</i>
  3 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'MAR\'</font> <i>(length=3)</i>
  4 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'APR\'</font> <i>(length=3)</i>
  5 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'MAG\'</font> <i>(length=3)</i>
  6 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'GIU\'</font> <i>(length=3)</i>
  7 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LUG\'</font> <i>(length=3)</i>
  8 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'AGO\'</font> <i>(length=3)</i>
  9 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'SET\'</font> <i>(length=3)</i>
  10 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'OTT\'</font> <i>(length=3)</i>
  11 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'NOV\'</font> <i>(length=3)</i>
  12 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'DIC\'</font> <i>(length=3)</i>
</pre></td></tr>
</table></font>
<br />
<font size=\'1\'><table class=\'xdebug-error xe-notice\' dir=\'ltr\' border=\'1\' cellspacing=\'0\' cellpadding=\'1\'>
<tr><th align=\'left\' bgcolor=\'#f57900\' colspan="5"><span style=\'background-color: #cc0000; color: #fce94f; font-size: x-large;\'>( ! )</span> Notice: Undefined offset: 2 in C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php(122) : eval()\'d code on line <i>43</i></th></tr>
<tr><th align=\'left\' bgcolor=\'#e9b96e\' colspan=\'5\'>Call Stack</th></tr>
<tr><th align=\'center\' bgcolor=\'#eeeeec\'>#</th><th align=\'left\' bgcolor=\'#eeeeec\'>Time</th><th align=\'left\' bgcolor=\'#eeeeec\'>Memory</th><th align=\'left\' bgcolor=\'#eeeeec\'>Function</th><th align=\'left\' bgcolor=\'#eeeeec\'>Location</th></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>1</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0010</td><td bgcolor=\'#eeeeec\' align=\'right\'>150048</td><td bgcolor=\'#eeeeec\'>{main}(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\elabora.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.news.php<b>:</b>0</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>2</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0100</td><td bgcolor=\'#eeeeec\' align=\'right\'>287848</td><td bgcolor=\'#eeeeec\'>CACHE->getCache(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\elabora.news.php\' bgcolor=\'#eeeeec\'>..\\elabora.news.php<b>:</b>92</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>3</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0120</td><td bgcolor=\'#eeeeec\' align=\'right\'>495896</td><td bgcolor=\'#eeeeec\'>CACHE->creaPagina(  )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>55</td></tr>
<tr><td bgcolor=\'#eeeeec\' align=\'center\'>4</td><td bgcolor=\'#eeeeec\' align=\'center\'>0.0120</td><td bgcolor=\'#eeeeec\' align=\'right\'>536520</td><td bgcolor=\'#eeeeec\'>eval( <font color=\'#00bb00\'>\'?><?php 
		@session_start();
		$data = unserialize( $_SESSION[\'data\'] );
		$chunk = $_SESSION[\'chunk\'];
		$max_chunk = $_SESSION[\'max_chunk\'];
		$search_key = $_SESSION[\'search\'];
		//$pagina = $_SESSION[\'pagina\'];
		$zonaShow = $_SESSION[\'zona\'];
		$filePost = "";
		($zonaShow == \'page\') ? $filePost = ".main.page" : $filePost;
		$ezona = \'-\' . $zonaShow;
		
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$chunks = count ( $data );
		$page_content = "";
		$index = 1;
		
		//		CHUNK  PARTS
		foreach ( $data as $key => $value ) 
			{
				if ( $key == $chunk )
					{
						//	INTERNAL GROUP OF CHUNKES
						foreach ( $value as $subKey => $subValue ) 
							{
								$scheda = $template->load("box.news" . $filePost . ".html");
								//		numero della notizia in base all\'ordine di rappresentazione
								$template->replace("id_not", $index);
								//		id della notizia
								$template->replace("id", $value[$subKey][\'id\']);
								//    pagina/categoria della notizia ( eventi, news, ecc )
								$template->replace("pagina", $value[$subKey][\'categoria\']);
								//	zona in cui viene caricato
								$template->replace("zona", $ezona);
								//  testo della ricerca
								$template->replace("search", $search_key);
								$titolo = transTitolo( $value[$subKey][\'titolo\'], $search_key );
								$template->replace("titolo", $titolo);
						
								//\\\\	elabora data
								$data_evento = transData( $value[$subKey][\'data_evento\'] );
								$template->replace("anno", $data_evento[2]);
								$template->replace("giorno", $data_evento[0]);
								$template->replace("mese", $data_evento[1]);
						
								//\\\\   elabora testo
								$testo = transTesto($value[$subKey][\'testo\'], $search_key);
								$template->replace("testo", $testo);
						
								//\\\\	elabora immagine
								$template->replace("immagine", 
								\'public/php/\' . $value[$subKey][\'foto\']);
				
								$page_content .= $template->publish();
								$index++;
							}		/// END OF INTERNAL GROUPS
					}		///  END OF SELECTED CHUNK
				
			}
				$index--;
				$page_content .= "<div class=\'void\'>...</div>";
				$page_content .= "<div id=\'max\'>" . $index . "</div>";
				echo $page_content;
				
				
				function transData($data_evento)
				{
					$mese = array(\'ll\', \'GEN\', \'FEBB\', \'MAR\', \'APR\', \'MAG\', \'GIU\', \'LUG\', \'AGO\', \'SET\', \'OTT\', \'NOV\', \'DIC\');
					$array_data = explode( "/" , $data_evento );
					$array_data[1] = $mese[(int)$array_data[1]];
					return $array_data;
				}
				
			function transTesto($testo, $search)
				{
					$nuovo_testo = str_replace("\\n", "<br />", $testo);
					$part_news = (substr($nuovo_testo, 0, 120));
					$find_pos = strrpos($part_news, " ");
					$part_news = substr($nuovo_testo, 0 , $find_pos);
					$part_news .= \' ...\';	//puntini
					$nuovo_testo = $part_news;
					$pattern = $search;
					$replacement = "<span class=\'found\'>" . $search . "</span>";
					$nuovo_testo = str_ireplace( $pattern, $replacement, $nuovo_testo);
					return $nuovo_testo;
				
				}
				
			function transTitolo($titolo, $search)
				{
					$pattern = $search;
					$replacement = "<span class=\'found\'>" . $search . "</span>";
					$nuovo_titolo = str_ireplace( $pattern, $replacement, $titolo);
					//exit(var_dump($replacement)); 
					return $nuovo_titolo;
				}
?>
\'</font> )</td><td title=\'C:\\Users\\Giovanni\\Desktop\\NewLDT\\php\\classes\\cache.class.php\' bgcolor=\'#eeeeec\'>..\\cache.class.php<b>:</b>122</td></tr>
<tr><th align=\'left\' colspan=\'5\' bgcolor=\'#e9b96e\'>Variables in local scope (#4)</th></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$chunk&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$chunks&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>1</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=1)</i>
  0 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=13)</i>
      0 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=15)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1455750000\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451770547\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Deus te, domine mi rex Karle, omni sapientiae lumine inluminavit et scientiae claritate ornavit, ut non solum magistrorum ingenia prompte subsequi, sed etiam in multis velociter praecurrere possis, et licet flammivomo tuae sapientiae lumini scintilla ingenioli mei nil addere possit, tamen ne me aliqui inoboedientem notent, tuis promptulus respondeo interrogationibus, et utinam tam sagaciter quam oboedienter. Primum mihi, magister, huius artis vel studii initium pande. Pandam penes auctoritatem veterum.\'</font> <i>(length=507)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/02/2016\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Nuova Notizia\'</font> <i>(length=13)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'brigidino,\'</font> <i>(length=10)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Pizza E&#39; Pronta\'</font> <i>(length=18)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'webmaster\'</font> <i>(length=9)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111759-2D00E45BBA6B.jpg\'</font> <i>(length=41)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      1 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453935600\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447621888\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem cacchius ipsum dolor pacchos sit amet, consectetuer adipiscing elit. Nam cursus.&#10;&#10; Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit \'...</font> <i>(length=711)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'28/01/2016\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Prova Del Fuoco\'</font> <i>(length=18)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una nuova sfida per il Control Panel\'</font> <i>(length=36)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'www.smartaweb.it\'</font> <i>(length=16)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Fucecchio\'</font> <i>(length=9)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'pb=!1m14!1m12!1m3!1d11522.567089930897!2d10.592864476423305!3d43.78029446210764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sit!2sit!4v1448987939513\'</font> <i>(length=153)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'info@gappistoia.it\'</font> <i>(length=18)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'39365555658\'</font> <i>(length=11)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511152221-BE5968E1EC3F.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      2 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'8\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453330800\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453370698\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'8\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Ad bene dicendi scientiam. In quibus versatur rebus?\'</font> <i>(length=52)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'21/01/2016\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Mandragola\'</font> <i>(length=13)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'trofeo,pilatus,\'</font> <i>(length=15)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una radice preziosa\'</font> <i>(length=19)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1601211104-FCC97EE46710.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      3 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=15)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1452034800\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1452073335\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'In prima approssimazione, la configurazione canard è aerodinamicamente più efficiente del classico layout con stabilizzatori in coda perché in quest ultima la forza necessaria ad equilibrare le rotazioni attorno al baricentro si ottiene mantenendo gli impennaggi in portanza negativa , mentre nel caso del canard entrambe le superfici portanti  lavorano in portanza positiva.\'</font> <i>(length=378)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'06/01/2016\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lo Xeno Multiplex\'</font> <i>(length=17)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Un modello dal volo stupendo\'</font> <i>(length=28)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'webmaster\'</font> <i>(length=9)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111805-FBC8FF60FA6F.jpg\'</font> <i>(length=41)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      4 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=15)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451516400\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451555448\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Cui dono lepidum nouum libellum arida modo pumice expolitum?&#13;&#10;Corneli, tibi: namque tu solebas meas esse aliquid putare nugas&#13;&#10;iam tum, cum ausus es unus Italorum omne aeuum tribus explicare cartis&#13;&#10;doctis, Iuppiter, et laboriosis.&#13;&#10;Quare habe tibi quidquid hoc libelli qualecumque, quod, patrona virgo&#13;&#10;plus uno maneat perenne saeclo.\'</font> <i>(length=335)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'31/12/2015\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La ragazza di Ipanema\'</font> <i>(length=21)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'biplano,cornelium,\'</font> <i>(length=18)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Poesia e Musica\'</font> <i>(length=15)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'www.google.it\'</font> <i>(length=13)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Webmaster\'</font> <i>(length=9)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111202-59C7146F5BB1.jpg\'</font> <i>(length=41)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      5 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1336255200\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447625927\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Il nuovo appuntamento con l&#39;aerotraino al campo del LUCCA DELTA TEAM si è svolto il 6 maggio scorso.&#10;La pioggia a tratti non ci ha impedito di portare a termine l&#39;edizione 2012 del &#10;4 TROFEO LUCCA DELTA TEAM - Formula Pelizza Il LUCCA DELTA TEAM è sempre in movimento..\'</font> <i>(length=271)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'06/05/2012\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'AEROTRAINO ALIANTI ...\'</font> <i>(length=22)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'aerotraino,alianti,pelizza,trofeo,\'</font> <i>(length=34)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'https://www.youtube.com/watch?v=aX6o2cqD7Uo\'</font> <i>(length=43)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511152318-2A33D09E8776.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      6 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1332025200\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447627407\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Domenica 18 Marzo si è svolta, presso la palestra&#13;&#10;del Liceo Scientifico Maiorana di Capannori&#13;&#10;la gara di acrobazia Indoor valevole per il Campionato Italiano 2012 Cat F3P.&#13;&#10;L&#39;impegno di Benito Bertolani e del LUCCA DELTA TEAM hanno permesso il successo di questa prima competizione indoor.\'</font> <i>(length=292)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/03/2012\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'ACROBAZIA INDOOR F3P\'</font> <i>(length=20)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\',\'</font> <i>(length=1)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161126-B7AF6FEBD0C0.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      7 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'4\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1318111200\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447669908\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'4\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La classica gara acrobatica di Carlo Allara,&#13;&#10;si è svolta sulla nostra aviosuperficie il 09 OTTOBRE scorso ....\'</font> <i>(length=112)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'09/10/2011\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'23mo MOBBY TROPHY\'</font> <i>(length=17)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161130-260383EF98AC.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      8 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'5\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1316296800\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447670551\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'5\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La gara comincia con la solita premessa,&#13;&#10;il meteo promette acquazzoni, e per tanto i concorrenti la vivono con un pò di trepidazione.&#13;&#10;Inizio gara alle ore 09:00. Il Direttore di gara, Carlo Ceragioli, dopo un breve briefing dà il via ai cronometri. Inizia così la terza edizione del * Trofeo Pelizza * al campo del LUCCA DELTA TEAM.\'</font> <i>(length=337)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/09/2011\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'TROFEO PELIZZA 2011\'</font> <i>(length=19)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'aerotraino,alianti,pelizza,trofeo,\'</font> <i>(length=34)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Appuntamento con l&#39;aerotraino\'</font> <i>(length=29)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161142-482F1B800075.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      9 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'6\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1307138400\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447754882\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'6\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una splendida gara con uragano finale....&#13;&#10;Sì avete capito bene, la 2 Edizione del&#13;&#10;* Trofeo Giuliana Pagni *&#13;&#10;Prova di Cat F3A, si è conclusa domenica sera con un tempo tutto sommato buono, ma dopo la premiazione, una bonba d&#39;acqua si è riversata sul campo... Tutto però è filato liscio grazie alla splendida organizzazione e grazie al meteo, che per una volta ci ha permesso di svolgere tutta la gara in piena tranquillità.&#13;&#10;L&#39; uragano poi, che si è scatenato dopo la premiazione, è un&#39;altra storia...\'</font> <i>(length=511)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'04/06/2011\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2° TROFEO GIULIANA PAGNI\'</font> <i>(length=25)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Alta Acrobazia\'</font> <i>(length=14)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Aviosuperficie LDT\'</font> <i>(length=18)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511171107-AEC4597C09C9.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      10 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=21)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'7\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1284847200\'</font> <i>(length=10)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447755996\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'7\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Dopo un sabato incerto,&#13;&#10;a tratti piovoso,&#13;&#10;è arrivato il giorno della gara.Alle 9,00 il direttore di gara, Carlo Ceragioli, fa partire i cronometri,il cielo comunque è sempre nuvoloso, anche se stiamo aspettando la schiarita promessa dalle previsioni del tempo segue...\'</font> <i>(length=272)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'19/09/2010\'</font> <i>(length=10)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'TROFEO LUCCA DELTA TEAM\'</font> <i>(length=23)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'salutare,vetrina,indoor,\'</font> <i>(length=24)</i>
          \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una&#39;altra splendida manifestazione\'</font> <i>(length=34)</i>
          \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
          \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Aviosuperficie\'</font> <i>(length=14)</i>
          \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
          \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511171125-578C85EBBD86.jpg\'</font> <i>(length=43)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
      11 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=12)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453332853\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi m\'...</font> <i>(length=692)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'p\'</font> <i>(length=1)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
      12 <font color=\'#888a85\'>=&gt;</font> 
        <b>array</b> <i>(size=12)</i>
          \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
          \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453367833\'</font> <i>(length=10)</i>
          \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
          \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
          \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. &#13;&#10;Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi\'...</font> <i>(length=1036)</i>
          \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Notizia 2\'</font> <i>(length=9)</i>
          \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
          \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
          \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$data_evento&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=2)</i>
  0 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
  1 <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'ll\'</font> <i>(length=2)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$ezona&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'-news\'</font> <i>(length=5)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$filePost&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$index&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>13</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$key&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>0</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$max_chunk&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>0</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$page_content&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div  id=&quot;2&quot; name=&quot;1&quot; class=&quot;block-news block-color-news&quot;&gt;&#10;&#10;				&lt;div id=&quot;box-titolo&quot; class=&quot;box-titolo class-news&quot;&gt;Nuova Notizia&lt;/div&gt;&#10;				&lt;div class=&quot;categoria&quot;&gt;news&lt;/div&gt;&#10;				&lt;div id=&quot;2016&quot; class=&quot;box-data-news&quot;&gt;&#10;						&lt;div class=&quot;block-anno&quot;&gt;2016&lt;/div&gt;&#10;						&lt;div class=&quot;block-giorno&quot;&gt;18&lt;/div&gt;&#10;						&lt;div class=&quot;block-mese&quot;&gt;FEBB&lt;/div&gt;&#10;				&lt;/div&gt;&#10;				&lt;div id=&quot;box-image&quot; class=&quot;box-image&quot;&gt;&#10;						&lt;img src=&quot;public/php/immagini_news/1601111759-2D00E45BBA6B.jpg&quot;	alt=&quot;&amp;nbsp; nessuna immagine&amp;nbsp;&amp;nbsp;&quot;/&gt;&#10;		\'...</font> <i>(length=10759)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$scheda&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><font color=\'#3465a4\'>null</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$search_key&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$subKey&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>int</small> <font color=\'#4e9a06\'>12</font>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$subValue&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=12)</i>
  \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
  \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
  \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453367833\'</font> <i>(length=10)</i>
  \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
  \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
  \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. &#13;&#10;Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi\'...</font> <i>(length=1036)</i>
  \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
  \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Notizia 2\'</font> <i>(length=9)</i>
  \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
  \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
  \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
  \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$template&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>object</b>(<i>TEMPLATE</i>)[<i>3</i>]
  <i>public</i> \'template\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'﻿&#10;&lt;div  id=&quot;3&quot; name=&quot;13&quot; class=&quot;block-news block-color-homepage&quot;&gt;&#10;&#10;				&lt;div id=&quot;box-titolo&quot; class=&quot;box-titolo class-homepage&quot;&gt;Notizia 2&lt;/div&gt;&#10;				&lt;div class=&quot;categoria&quot;&gt;homepage&lt;/div&gt;&#10;				&lt;div id=&quot;#anno#&quot; class=&quot;box-data-news&quot;&gt;&#10;						&lt;div class=&quot;block-anno&quot;&gt;#anno#&lt;/div&gt;&#10;						&lt;div class=&quot;block-giorno&quot;&gt;#giorno#&lt;/div&gt;&#10;						&lt;div class=&quot;block-mese&quot;&gt;#mese#&lt;/div&gt;&#10;				&lt;/div&gt;&#10;				&lt;div id=&quot;box-image&quot; class=&quot;box-image&quot;&gt;&#10;						&lt;img src=&quot;#immagine#&quot;	alt=&quot;&amp;nbsp; nessuna immagine&amp;nbsp;&amp;nbsp;&quot;/&gt;&#10;				&lt;/div&gt;&#10;				&lt;div id=\'...</font> <i>(length=768)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$testo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, ...\'</font> <i>(length=115)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$titolo&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'Notizia 2\'</font> <i>(length=9)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$value&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'>
<b>array</b> <i>(size=13)</i>
  0 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=15)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1455750000\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451770547\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Deus te, domine mi rex Karle, omni sapientiae lumine inluminavit et scientiae claritate ornavit, ut non solum magistrorum ingenia prompte subsequi, sed etiam in multis velociter praecurrere possis, et licet flammivomo tuae sapientiae lumini scintilla ingenioli mei nil addere possit, tamen ne me aliqui inoboedientem notent, tuis promptulus respondeo interrogationibus, et utinam tam sagaciter quam oboedienter. Primum mihi, magister, huius artis vel studii initium pande. Pandam penes auctoritatem veterum.\'</font> <i>(length=507)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/02/2016\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Nuova Notizia\'</font> <i>(length=13)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'brigidino,\'</font> <i>(length=10)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Pizza E&#39; Pronta\'</font> <i>(length=18)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'webmaster\'</font> <i>(length=9)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111759-2D00E45BBA6B.jpg\'</font> <i>(length=41)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
  1 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453935600\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447621888\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem cacchius ipsum dolor pacchos sit amet, consectetuer adipiscing elit. Nam cursus.&#10;&#10; Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit \'...</font> <i>(length=711)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'28/01/2016\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Prova Del Fuoco\'</font> <i>(length=18)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una nuova sfida per il Control Panel\'</font> <i>(length=36)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'www.smartaweb.it\'</font> <i>(length=16)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Fucecchio\'</font> <i>(length=9)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'pb=!1m14!1m12!1m3!1d11522.567089930897!2d10.592864476423305!3d43.78029446210764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sit!2sit!4v1448987939513\'</font> <i>(length=153)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'info@gappistoia.it\'</font> <i>(length=18)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'39365555658\'</font> <i>(length=11)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511152221-BE5968E1EC3F.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  2 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'8\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453330800\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453370698\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'8\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Ad bene dicendi scientiam. In quibus versatur rebus?\'</font> <i>(length=52)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'21/01/2016\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La Mandragola\'</font> <i>(length=13)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'trofeo,pilatus,\'</font> <i>(length=15)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una radice preziosa\'</font> <i>(length=19)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1601211104-FCC97EE46710.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  3 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=15)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1452034800\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1452073335\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'In prima approssimazione, la configurazione canard è aerodinamicamente più efficiente del classico layout con stabilizzatori in coda perché in quest ultima la forza necessaria ad equilibrare le rotazioni attorno al baricentro si ottiene mantenendo gli impennaggi in portanza negativa , mentre nel caso del canard entrambe le superfici portanti  lavorano in portanza positiva.\'</font> <i>(length=378)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'06/01/2016\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lo Xeno Multiplex\'</font> <i>(length=17)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Un modello dal volo stupendo\'</font> <i>(length=28)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'webmaster\'</font> <i>(length=9)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111805-FBC8FF60FA6F.jpg\'</font> <i>(length=41)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
  4 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=15)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451516400\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1451555448\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Cui dono lepidum nouum libellum arida modo pumice expolitum?&#13;&#10;Corneli, tibi: namque tu solebas meas esse aliquid putare nugas&#13;&#10;iam tum, cum ausus es unus Italorum omne aeuum tribus explicare cartis&#13;&#10;doctis, Iuppiter, et laboriosis.&#13;&#10;Quare habe tibi quidquid hoc libelli qualecumque, quod, patrona virgo&#13;&#10;plus uno maneat perenne saeclo.\'</font> <i>(length=335)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'31/12/2015\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La ragazza di Ipanema\'</font> <i>(length=21)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'biplano,cornelium,\'</font> <i>(length=18)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Poesia e Musica\'</font> <i>(length=15)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'www.google.it\'</font> <i>(length=13)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Webmaster\'</font> <i>(length=9)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_news/1601111202-59C7146F5BB1.jpg\'</font> <i>(length=41)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
  5 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1336255200\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447625927\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Il nuovo appuntamento con l&#39;aerotraino al campo del LUCCA DELTA TEAM si è svolto il 6 maggio scorso.&#10;La pioggia a tratti non ci ha impedito di portare a termine l&#39;edizione 2012 del &#10;4 TROFEO LUCCA DELTA TEAM - Formula Pelizza Il LUCCA DELTA TEAM è sempre in movimento..\'</font> <i>(length=271)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'06/05/2012\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'AEROTRAINO ALIANTI ...\'</font> <i>(length=22)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'aerotraino,alianti,pelizza,trofeo,\'</font> <i>(length=34)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'https://www.youtube.com/watch?v=aX6o2cqD7Uo\'</font> <i>(length=43)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511152318-2A33D09E8776.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  6 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1332025200\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447627407\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Domenica 18 Marzo si è svolta, presso la palestra&#13;&#10;del Liceo Scientifico Maiorana di Capannori&#13;&#10;la gara di acrobazia Indoor valevole per il Campionato Italiano 2012 Cat F3P.&#13;&#10;L&#39;impegno di Benito Bertolani e del LUCCA DELTA TEAM hanno permesso il successo di questa prima competizione indoor.\'</font> <i>(length=292)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/03/2012\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'ACROBAZIA INDOOR F3P\'</font> <i>(length=20)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\',\'</font> <i>(length=1)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161126-B7AF6FEBD0C0.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  7 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'4\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1318111200\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447669908\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'4\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La classica gara acrobatica di Carlo Allara,&#13;&#10;si è svolta sulla nostra aviosuperficie il 09 OTTOBRE scorso ....\'</font> <i>(length=112)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'09/10/2011\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'23mo MOBBY TROPHY\'</font> <i>(length=17)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161130-260383EF98AC.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  8 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'5\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1316296800\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447670551\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'5\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'La gara comincia con la solita premessa,&#13;&#10;il meteo promette acquazzoni, e per tanto i concorrenti la vivono con un pò di trepidazione.&#13;&#10;Inizio gara alle ore 09:00. Il Direttore di gara, Carlo Ceragioli, dopo un breve briefing dà il via ai cronometri. Inizia così la terza edizione del * Trofeo Pelizza * al campo del LUCCA DELTA TEAM.\'</font> <i>(length=337)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'18/09/2011\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'TROFEO PELIZZA 2011\'</font> <i>(length=19)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'aerotraino,alianti,pelizza,trofeo,\'</font> <i>(length=34)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Appuntamento con l&#39;aerotraino\'</font> <i>(length=29)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511161142-482F1B800075.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  9 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'6\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1307138400\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447754882\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'6\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una splendida gara con uragano finale....&#13;&#10;Sì avete capito bene, la 2 Edizione del&#13;&#10;* Trofeo Giuliana Pagni *&#13;&#10;Prova di Cat F3A, si è conclusa domenica sera con un tempo tutto sommato buono, ma dopo la premiazione, una bonba d&#39;acqua si è riversata sul campo... Tutto però è filato liscio grazie alla splendida organizzazione e grazie al meteo, che per una volta ci ha permesso di svolgere tutta la gara in piena tranquillità.&#13;&#10;L&#39; uragano poi, che si è scatenato dopo la premiazione, è un&#39;altra storia...\'</font> <i>(length=511)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'04/06/2011\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2° TROFEO GIULIANA PAGNI\'</font> <i>(length=25)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Alta Acrobazia\'</font> <i>(length=14)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Aviosuperficie LDT\'</font> <i>(length=18)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511171107-AEC4597C09C9.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  10 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=21)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'7\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1284847200\'</font> <i>(length=10)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1447755996\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'7\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Dopo un sabato incerto,&#13;&#10;a tratti piovoso,&#13;&#10;è arrivato il giorno della gara.Alle 9,00 il direttore di gara, Carlo Ceragioli, fa partire i cronometri,il cielo comunque è sempre nuvoloso, anche se stiamo aspettando la schiarita promessa dalle previsioni del tempo segue...\'</font> <i>(length=272)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'19/09/2010\'</font> <i>(length=10)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'TROFEO LUCCA DELTA TEAM\'</font> <i>(length=23)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'salutare,vetrina,indoor,\'</font> <i>(length=24)</i>
      \'sottotitolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Una&#39;altra splendida manifestazione\'</font> <i>(length=34)</i>
      \'link_1\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'link_2\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'gruppo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'LuccaDeltaTeam\'</font> <i>(length=14)</i>
      \'localita\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Aviosuperficie\'</font> <i>(length=14)</i>
      \'embed\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'info_mail\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'visibility\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'tutto\'</font> <i>(length=5)</i>
      \'telefono\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'video\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'immagini_eventi/1511171125-578C85EBBD86.jpg\'</font> <i>(length=43)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'eventi\'</font> <i>(length=6)</i>
  11 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=12)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453332853\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi m\'...</font> <i>(length=692)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'p\'</font> <i>(length=1)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
  12 <font color=\'#888a85\'>=&gt;</font> 
    <b>array</b> <i>(size=12)</i>
      \'id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'3\'</font> <i>(length=1)</i>
      \'time_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'data\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'1453367833\'</font> <i>(length=10)</i>
      \'real_id\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'2\'</font> <i>(length=1)</i>
      \'visite\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'0\'</font> <i>(length=1)</i>
      \'testo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. &#13;&#10;Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi\'...</font> <i>(length=1036)</i>
      \'data_evento\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'titolo\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'Notizia 2\'</font> <i>(length=9)</i>
      \'tags\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'firma\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'\'</font> <i>(length=0)</i>
      \'foto\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'sostituta\'</font> <i>(length=9)</i>
      \'categoria\' <font color=\'#888a85\'>=&gt;</font> <small>string</small> <font color=\'#cc0000\'>\'homepage\'</font> <i>(length=8)</i>
</pre></td></tr>
<tr><td colspan=\'2\' align=\'right\' bgcolor=\'#eeeeec\' valign=\'top\'><pre>$zonaShow&nbsp;=</pre></td><td colspan=\'3\' bgcolor=\'#eeeeec\'><pre class=\'xdebug-var-dump\' dir=\'ltr\'><small>string</small> <font color=\'#cc0000\'>\'news\'</font> <i>(length=4)</i>
</pre></td></tr>
</table></font>
﻿
<div  id="2" name="1" class="block-news block-color-news">

				<div id="box-titolo" class="box-titolo class-news">Nuova Notizia</div>
				<div class="categoria">news</div>
				<div id="2016" class="box-data-news">
						<div class="block-anno">2016</div>
						<div class="block-giorno">18</div>
						<div class="block-mese">FEBB</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_news/1601111759-2D00E45BBA6B.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Deus te, domine mi rex Karle, omni sapientiae lumine inluminavit et scientiae claritate ornavit, ut non solum ...</div>
				<div class="box-footer-news box-news" onclick="location.href = \'eventi.php?news=2&pagina=news&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 1"></div> 
<!--	fine notizia	--> ﻿
<div  id="1" name="2" class="block-news block-color-eventi">

				<div id="box-titolo" class="box-titolo class-eventi">La Prova Del Fuoco</div>
				<div class="categoria">eventi</div>
				<div id="2016" class="box-data-news">
						<div class="block-anno">2016</div>
						<div class="block-giorno">28</div>
						<div class="block-mese">GEN</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_eventi/1511152221-BE5968E1EC3F.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Lorem cacchius ipsum dolor pacchos sit amet, consectetuer adipiscing elit. Nam cursus.<br /><br /> Morbi ut mi. Nullam ...</div>
				<div class="box-footer-news box-eventi" onclick="location.href = \'eventi.php?news=1&pagina=eventi&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 2"></div> 
<!--	fine notizia	--> ﻿
<div  id="8" name="3" class="block-news block-color-eventi">

				<div id="box-titolo" class="box-titolo class-eventi">La Mandragola</div>
				<div class="categoria">eventi</div>
				<div id="2016" class="box-data-news">
						<div class="block-anno">2016</div>
						<div class="block-giorno">21</div>
						<div class="block-mese">GEN</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_eventi/1601211104-FCC97EE46710.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Ad bene dicendi scientiam. In quibus versatur ...</div>
				<div class="box-footer-news box-eventi" onclick="location.href = \'eventi.php?news=8&pagina=eventi&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 3"></div> 
<!--	fine notizia	--> ﻿
<div  id="3" name="4" class="block-news block-color-news">

				<div id="box-titolo" class="box-titolo class-news">Lo Xeno Multiplex</div>
				<div class="categoria">news</div>
				<div id="2016" class="box-data-news">
						<div class="block-anno">2016</div>
						<div class="block-giorno">06</div>
						<div class="block-mese">GEN</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_news/1601111805-FBC8FF60FA6F.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">In prima approssimazione, la configurazione canard è aerodinamicamente più efficiente del classico layout con ...</div>
				<div class="box-footer-news box-news" onclick="location.href = \'eventi.php?news=3&pagina=news&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 4"></div> 
<!--	fine notizia	--> ﻿
<div  id="1" name="5" class="block-news block-color-news">

				<div id="box-titolo" class="box-titolo class-news">La ragazza di Ipanema</div>
				<div class="categoria">news</div>
				<div id="2015" class="box-data-news">
						<div class="block-anno">2015</div>
						<div class="block-giorno">31</div>
						<div class="block-mese">DIC</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_news/1601111202-59C7146F5BB1.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Cui dono lepidum nouum libellum arida modo pumice expolitum?<br />Corneli, tibi: namque tu solebas meas esse aliquid ...</div>
				<div class="box-footer-news box-news" onclick="location.href = \'eventi.php?news=1&pagina=news&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 5"></div> 
<!--	fine notizia	--> ﻿
<div  id="2" name="6" class="block-news block-color-eventi">

				<div id="box-titolo" class="box-titolo class-eventi">AEROTRAINO ALIANTI ...</div>
				<div class="categoria">eventi</div>
				<div id="2012" class="box-data-news">
						<div class="block-anno">2012</div>
						<div class="block-giorno">06</div>
						<div class="block-mese">MAG</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_eventi/1511152318-2A33D09E8776.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Il nuovo appuntamento con l\'aerotraino al campo del LUCCA DELTA TEAM si è svolto il 6 maggio scorso.<br />La pioggia a ...</div>
				<div class="box-footer-news box-eventi" onclick="location.href = \'eventi.php?news=2&pagina=eventi&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 6"></div> 
<!--	fine notizia	--> ﻿
<div  id="3" name="7" class="block-news block-color-eventi">

				<div id="box-titolo" class="box-titolo class-eventi">ACROBAZIA INDOOR F3P</div>
				<div class="categoria">eventi</div>
				<div id="2012" class="box-data-news">
						<div class="block-anno">2012</div>
						<div class="block-giorno">18</div>
						<div class="block-mese">MAR</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_eventi/1511161126-B7AF6FEBD0C0.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Domenica 18 Marzo si è svolta, presso la palestra<br />del Liceo Scientifico Maiorana di Capannori<br />la gara di ...</div>
				<div class="box-footer-news box-eventi" onclick="location.href = \'eventi.php?news=3&pagina=eventi&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 7"></div> 
<!--	fine notizia	--> ﻿
<div  id="4" name="8" class="block-news block-color-eventi">

				<div id="box-titolo" class="box-titolo class-eventi">23mo MOBBY TROPHY</div>
				<div class="categoria">eventi</div>
				<div id="2011" class="box-data-news">
						<div class="block-anno">2011</div>
						<div class="block-giorno">09</div>
						<div class="block-mese">OTT</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_eventi/1511161130-260383EF98AC.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">La classica gara acrobatica di Carlo Allara,<br />si è svolta sulla nostra aviosuperficie il 09 OTTOBRE scorso ...</div>
				<div class="box-footer-news box-eventi" onclick="location.href = \'eventi.php?news=4&pagina=eventi&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 8"></div> 
<!--	fine notizia	--> ﻿
<div  id="5" name="9" class="block-news block-color-eventi">

				<div id="box-titolo" class="box-titolo class-eventi">TROFEO PELIZZA 2011</div>
				<div class="categoria">eventi</div>
				<div id="2011" class="box-data-news">
						<div class="block-anno">2011</div>
						<div class="block-giorno">18</div>
						<div class="block-mese">SET</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_eventi/1511161142-482F1B800075.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">La gara comincia con la solita premessa,<br />il meteo promette acquazzoni, e per tanto i concorrenti la vivono con un ...</div>
				<div class="box-footer-news box-eventi" onclick="location.href = \'eventi.php?news=5&pagina=eventi&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 9"></div> 
<!--	fine notizia	--> ﻿
<div  id="6" name="10" class="block-news block-color-eventi">

				<div id="box-titolo" class="box-titolo class-eventi">2° TROFEO GIULIANA PAGNI</div>
				<div class="categoria">eventi</div>
				<div id="2011" class="box-data-news">
						<div class="block-anno">2011</div>
						<div class="block-giorno">04</div>
						<div class="block-mese">GIU</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_eventi/1511171107-AEC4597C09C9.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Una splendida gara con uragano finale....<br />Sì avete capito bene, la 2 Edizione del<br />* Trofeo Giuliana Pagni ...</div>
				<div class="box-footer-news box-eventi" onclick="location.href = \'eventi.php?news=6&pagina=eventi&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 10"></div> 
<!--	fine notizia	--> ﻿
<div  id="7" name="11" class="block-news block-color-eventi">

				<div id="box-titolo" class="box-titolo class-eventi">TROFEO LUCCA DELTA TEAM</div>
				<div class="categoria">eventi</div>
				<div id="2010" class="box-data-news">
						<div class="block-anno">2010</div>
						<div class="block-giorno">19</div>
						<div class="block-mese">SET</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/immagini_eventi/1511171125-578C85EBBD86.jpg"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Dopo un sabato incerto,<br />a tratti piovoso,<br />è arrivato il giorno della gara.Alle 9,00 il direttore di gara, ...</div>
				<div class="box-footer-news box-eventi" onclick="location.href = \'eventi.php?news=7&pagina=eventi&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 11"></div> 
<!--	fine notizia	--> ﻿
<div  id="2" name="12" class="block-news block-color-homepage">

				<div id="box-titolo" class="box-titolo class-homepage">p</div>
				<div class="categoria">homepage</div>
				<div id="" class="box-data-news">
						<div class="block-anno"></div>
						<div class="block-giorno"></div>
						<div class="block-mese">ll</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/sostituta"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, ...</div>
				<div class="box-footer-news box-homepage" onclick="location.href = \'eventi.php?news=2&pagina=homepage&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 12"></div> 
<!--	fine notizia	--> ﻿
<div  id="3" name="13" class="block-news block-color-homepage">

				<div id="box-titolo" class="box-titolo class-homepage">Notizia 2</div>
				<div class="categoria">homepage</div>
				<div id="" class="box-data-news">
						<div class="block-anno"></div>
						<div class="block-giorno"></div>
						<div class="block-mese">ll</div>
				</div>
				<div id="box-image" class="box-image">
						<img src="public/php/sostituta"	alt="&nbsp; nessuna immagine&nbsp;&nbsp;"/>
				</div>
				<div id="box-text" class="box-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, ...</div>
				<div class="box-footer-news box-homepage" onclick="location.href = \'eventi.php?news=3&pagina=homepage&search=\';">
				leggi tutto...  >
				</div>
</div>
<div class="fine-news 13"></div> 
<!--	fine notizia	--> <div class=\'void\'>...</div><div id=\'max\'>13</div>";',
  'l' => 1685740285,
);