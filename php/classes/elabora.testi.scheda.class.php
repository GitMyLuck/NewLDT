<?php 
class NEWTEXT
{
	public $risultato;
	public $news;
	public $template;
		public function __construct($news, $template) 
				{
						$this->news = $news;
						$this->template = $template;
				}
		
		public function tText($text, $search)
				{
					$pattern = $search;
					$replacement = "<span class='found' title='chiave cercata'>" . $search . "</span>";
					$new_text = stripcslashes(str_ireplace( $pattern, $replacement, $text));
					$nuovo_testo = str_ireplace(array("\n","\r"), "<br />", $new_text);
					return $nuovo_testo;
				}

//			TAGS
		public function getTags()
				{
						$tag_report = '';
						if ( $this->news[0]['tags'] != ',' && $this->news[0]['tags'] != '')
							{
								$tags = explode(",", $this->news[0]['tags']);
								foreach ($tags as $tag )
									{
										if ( $tag != '' )
											{
												$tag_report .= "<li class='tag-scheda' >" . $tag . "</li>";
											}
									}
								if ( $tag_report )
									{
										$tag_report .= '<li class="fine_button" style="visibility: hidden;">&nbsp;</li>';
									}
								$this->template->replace("tags", $tag_report);
								$this->template->replace("tags_vis", 'block');
							}
						else
							{
								$this->template->replace("tags_vis", 'none');
							}
				}
//		GOOGLE MAP
			public function getMap()
				{
						$mappa_report = '';
						$dato = (isset($this->news[0]['embed'])) ? $this->news[0]['embed']:null;
						if ( $dato != '' )
							{
								$this->template->replace("embed", $dato);
								$this->template->replace("embed_vis", 'block');
							}
						else
							{
								$this->template->replace("embed_vis", 'none');
							}
				}
//		OPZIONE PDF 
//		(quando vuoto PDF restituisce '.'
			public function getOptionPDF($nome)
				{
					$vis = 'block';
					$dato = (isset($this->news[0][$nome])) ? $this->news[0][$nome] : null;
					//return $dato;
					if ( $dato != '' )
						{
							$this->template->replace("pdf", $this->news[0]['pdf']);	
							$this->template->replace($nome . "_vis", $vis);
						}
					else
						{
							$vis = 'none';
							$this->template->replace($nome . "_vis", $vis);
						}
				}
				
//		OPZIONI GENERALI	
			public function getOption($nome)
				{
					$vis = 'block';
					$dato = (isset($this->news[0][$nome])) ? $this->news[0][$nome] : null ;
					if ( $dato != '' )
						{
							$this->template->replace($nome, $dato);
							$this->template->replace($nome . "_vis", $vis);
						}
					else
						{
							$vis = 'none';
							$this->template->replace($nome . "_vis", $vis);
						}
				}
				
			

}		//  // END  OF  CLASS 
?>