<?php 
//header('Content-type: text/html;charset=utf-8');
class NEWPAGE extends BUILD
{

/*			@author		giovanni.avallone@hotmail.com 			*/
public $pagina;							//  nome della pagina
public $superFunction;				//  stringa completa che contiene il testo html per costruire i box 
public $boxes;								//  contiene i vari box della pagina
public $funct;								//  1 = main_page,  2 = varia_page,  3 = nuovo_page
public $var_val = 'notizia';				//  nome della variabile che permette  di recuperare il dato tramite
													//  le funzioni input		($ [ ..notizia.. ] ['id_funct'])
public $user_num;							//  tipo di utente (1 = administrator, 2 = sub-administrator, 3-4-ecc. = user
public $user_type = array("", "administrator", "sub-administrator", "user-premium", "user-gold", "user-silver", "user-base");
/*			COSTRUZIONE BOXES											*/
public $id_box;					//  numero assegnato al box per il prelievo delle relative funzioni e per la relativa 
											//  posizione all'interno della pagina
public $num_box;						//  numero assegnato al box
public $class_width;				//  classe che indica la larghezza del box (single, double, triple)
public $class_id;					//  preleva id per questo b
public $testata;						//  titolo che viene mostrato sulla testata del box
public $type_box;					//  tipo di box da rappresentare (text, maxi-text, img, pdf)
public $visible_box;				//  tipo di box se nascondibile o no  (valori: blind, no_blind)
public $inflate_box;				//  tipo di chiusura per questo box (to_single_width, to_single_heigth)
public $button_test;				//  tipo di pulsante nella testata del box  (arrow_left, arrow_down)
public $help_box;					//  variabile che indica se applicare o meno tasto help_box
public $help_test;					//  stringa html che contiene help-button
public $head_box;					//  testata html del box

/*                 FUNZIONI  INPUT  ALL'INTERNO  DEI  BOXES				*/
public $indice;					// indice di servizio usato per inserire classe '' first '' negli input
public $function = array();					//  array che contiene dati delle funzioni per il box
public $label;						//  label della funzione
public $sub_label;				//  testo esplicativo (opzionale)
public $id;							//  id della funzione
public $type;						//  tipo di input
public $title;						//  alt al passaggio del mouse
public $visible_funct;		//  valore che decide se la funzione input viene mostrata o no
public $value;						//  contenuto della funzione input
public $height;					//  valore che regola l'altezza della funzione input (solo per text-area)
public $select_values;		//  elenco valori preimpostati per una selectBox
public $help;						// valore bool se mostrare o no pulsante-help
public $binding;					//  valore integer (0 - 1) se campo e' obbligatorio
public $bind_control;			//  tipo di controllo da effettuare oltre a quello su
											//  obbligatorieta' del contenuto

		public function __construct($pagina) 
			{
				//  zona in cui possiamo effettuare dei controlli
				//  o delle lavorazioni sugli attributi passati,
				//  prima di renderli pubblici per la classe
                $this->pagina = $pagina;
			}
			
		public function buildPage($funct, $user_num)
			{
				//  rendo pubblica $funct
				$this->funct = $funct;
				//  rendo pubblico $user_num			NUMERO IDENTIFICATIVO DELL'USER
				$this->user_num = $user_num;
				// azzero super variabile
				$this->superFunction = '';
				//preleva tutti i box della pagina
				$this->boxes = $this->contaBox();
				//conta le funzioni totali
				$fun = $this->contaFunct();
				//exit(var_dump($fun)); 
				//se esistono box per questa pagina ...
				if (isset ($this->boxes[$this->pagina]))
					{
						// preleva il numero di box relativi a questa pagina...
						$len_boxes = (count($this->boxes[$this->pagina]));		// RIS OK 08/11/14 20:44 
						$this->aggBox($len_boxes);
							//----ciclo creazione boxes----//
							for ($indice = 1; $indice <= $len_boxes; $indice++)
								{
									//  controllo sulla visibilita' basandosi su $user_num passato 
									$this->visible_box = $this->boxes[$this->pagina][$indice]['display_box'];
									$visible = true;
									$visible = $visible && $this->userControl($indice, 'box');
									//  se il box deve essere rappresentato
									if ($visible)
										{
											$error = true;
											//-----------______________------------//
											//  preleva dati del box [$indice]
											$error = $error && $this->prelevaDati($indice); 
											//-----------______________------------//
											//  costruisci la head del box
											$error = $error && $this->buildTestata($indice);
											//-----------______________------------//
											//  costruisci funzioni nel box
											$error = $error && $this->buildFunctions($indice);
											// se box-type = 'text' allora chiudi il form
											if ( $this->type_box == 'text' && $this->funct != 2)
												{
													$this->superFunction .= '</div></form>';
												}
											//  aggiungi la parte finale per questo box
											$this->superFunction .= '</div>	<!-- fine del box -->';
											//  restituisci errore
											if (!$error) return 'errore... nella creazione dei BOX';
										}
								} // END FOR CYCLE  COSTRUISCI BOX
							$this->aggFunct($fun);
					}		// FINE IF EXIST BOX
				else 
					{
						//non esistono box per questa pagina
						return 'non esistono box nel DataBase per questa pagina';
					}		// FINE IF NOT EXIST BOX
				
				//return $len_boxes;
				//$this->debug($this->superFunction);
				return $this->superFunction;
				
			} 		//  END  OF  FUNCTION buildPage
			
			
		public function userControl($indice, $entity)
			{
				$confronto = $this->visible_box;
				if ($entity != 'box')
					{
						$confronto = $this->visible_funct;
						//exit(var_dump($confronto)); 
					}
				switch ($confronto) 
							{
										// NULL 	=  il box box viene rappresentato per tutti i tipi di utenti
										case (NULL || '' || null) :
												return true;
										break;
										
										// BLIND  = il box viene rappresentato solo agli utenti 1 (ADMINISTRATOR) e 2 (SUB-ADMINISTRATOR)
										case 'blind' :
												if ($this->user_num == 1 || $this->user_num == 2)
														{
															return true;
														}
												else	
														{
															return false;
														}
										break;
										// ELENCO UTENTI  = IL BOX VIENE RAPPRESENTATO SOLO AGLI UTENTI CON GRADO INDICATO
										// NELL'ELENCO 'display_box' (es: 3,4,5)
										case (!NULL || !'blind') :
												$menber = split(",", $confronto);
												$menber = array_unique($menber);
												$visible = in_array($this->user_num, $menber);
												
												if ($visible)
													{
														return true;
													} else {
														return false;
													}
												
										break;
										
										default :
												return false;
										break;
										
							}		// END OF SWITCH
			}
			
			
			
		public function prelevaDati($indice)
			{
				$this->id_box = $this->boxes[$this->pagina][$indice]['num_box'];			
				// numero assegnato al box per il prelievo delle relative funzioni
				//------------------------------------------------------// 
				$this->class_width = $this->boxes[$this->pagina][$indice]['width_box'];	
				// classe che indica la larghezza del box (single, double, triple)
				//------------------------------------------------------// 
				$this->class_id = $this->boxes[$this->pagina][$indice]['id_box'];			
				// preleva id per questo box
				//------------------------------------------------------// 
				$this->testata = strtoupper($this->boxes[$this->pagina][$indice]['title_box']);		
				// titolo che viene mostrato sulla testata del box
				//------------------------------------------------------// 
				$this->type_box = $this->boxes[$this->pagina][$indice]['type_box'];		
				// tipo di box da rappresentare (text, maxi-text, img, pdf)
				//------------------------------------------------------// 
				//------I N F L A T E   B O X---------------------------// 
				$this->inflate_box = $this->boxes[$this->pagina][$indice]['inflate_box'];
				// tipo di chiusura per questo box (to_single_width, to_single_heigth)
				$this->button_test = '';		//<div id="btn_test" class="arrow_left"></div>
				switch ($this->inflate_box) {
														case 'to_single_width':
														$this->button_test = '<div id="btn_test" class="arrow_left"></div>';
														break;
														case 'to_single_height':
														$this->button_test = '<div id="btn_test" class="freccia arrow_down"></div>';
														break;
														// caso in cui non venga trovato parametro
														default :
														$this->superFunction .= 'ERRORE !  Classe \'inflate\' non individuata...';
														return false;
														break;
													}	//END OF SWITCH
				//------H E L P  B U T T O N   B O X---------------------------// 
				$this->help_box = $this->boxes[$this->pagina][$indice]['help_box'];
				$this->help_test = ''; 		// resetto html del pulsante help-button
				if ( $this->help_box == 'help' )
					{
							$this->help_test = '<div id="btn_help" class="help"></div>';
					}
				return true;
			
			}		//  END  OF  FUNCTION   prelevaDati()
			
			
		public function buildTestata($indice)
			{
				//exit(var_dump($this->class_width)); 
				switch ($this->type_box)
					{
						case 'text' :			//  BOX  TEXT
						$this->head_box = '<form class="modulo_completo"><div class="box_cp ' . $this->class_width . '" id="' . $this->class_id . '" name="' . $this->id_box . '"><div class="testata"  >' . $this->testata . $this->button_test . $this->help_test . '</div><div id="box_content">';
						//  se si tratta di pagina-varia non mettere  l'apertura del form <modulo_completo>
						if ($this->funct == 2)
							{
								$this->head_box = '<div class="box_cp ' . $this->class_width . '" id="' . $this->class_id . '" name="' . $this->id_box . '"><div class="testata"  >' . $this->testata . $this->button_test . $this->help_test . '</div>';
							}
						$this->superFunction .= $this->head_box; 
						return true;
						break;
						
						case 'img' :			// BOX IMAGE
						$this->head_box = '<div class="box_cp ' . $this->class_width . ' immagini" id="' . $this->class_id . '_img" name="' . $this->id_box . '"><div class="testata">' . $this->testata . '</div><div id="wait_spin_img" class="show_spin"></div>';
						$this->superFunction .= $this->head_box; 
						return true;
						break;
						
						case 'pdf' :			// BOX PDF
						$this->head_box = '<div class="box_cp ' . $this->class_width . ' immagini" id="' . $this->class_id . '_pdf" name="' . $this->id_box . '"><div class="testata">' . $this->testata . '</div><div id="wait_spin_img" class="show_spin"></div>';
						$this->superFunction .= $this->head_box; 
						return true;
						break;
						
						case 'maxi_text' :			// BOX   MAXI TEXT
						$this->head_box = '<div class="box_cp ' . $this->class_width . '" id="box_text" name="' . $this->id_box . '"><div class="testata">' . $this->testata . $this->button_test . '</div><div id="wait_spin_text" class="show_spin"></div>';
						$this->superFunction .= $this->head_box; 
						return true;
						break;
						
						case 'tags-box' :			// BOX   TAGS  BOX
						$this->head_box = '<div class="box_cp ' . $this->class_width . '" id="box_tags" name="' . $this->id_box . '" ><div class="testata">' . $this->testata . $this->button_test . '</div><div id="cont_tags"></div>';
						$this->superFunction .= $this->head_box; 
						return true;
						break;
						
						case 'multi-image' :			// BOX   MULTI  IMAGE
						$end_form = '</form>';
						$this->head_box = '';
						if ($this->funct != 1)		//se [funct = 1] => page_main
							{							//non costruire il box immagine singolo
								$this->head_box .= $end_form . '<div class="box_cp ' . $this->class_width . ' immagini" id="' . $this->class_id . '_img" name="' . $this->id_box . '" ><div class="testata">IMMAGINI</div><div id="wait_spin_img" class="show_spin"></div></div>';
							}
						$this->head_box .= '<div class="box_cp ' . $this->class_width . '" id="show_image"  name="' . $this->id_box . '" ><div class="testata">FOTO ALBUM' . $this->button_test . '</div>';
						$this->superFunction .= $this->head_box; 
						return true;
						break;
						
						default :
						$this->superFunction .= 'Errore! Non individuato tipo di Box';
						return false;
						break;
					}		//END OF SWITCH
				return true;
			}		//  END  OF  FUNCTION  buildTestata()
		
		public function buildFunctions($indice)
			{
				//CERCA NEL DATABASE LE FUNCTIONS PREDISPOSTE PER QUESTO BOX  (BOX [$indice])
				$this->function = $this->getFunctions($indice);
				//inizializzo la var $functions che dovrà contenere
				//tutte le functions del box[$indice]
				$functions = '<br /> ';
				$len_function = count($this->function[$indice]);	//numero di funzioni per il box [$indice]
				//azzero indice di servizio
				$this->indice = 1;
				for ($f = 1; $f <= $len_function; $f++)
							{
									//  controllo sulla visibilita basandosi su $user_num passato 
									$this->visible_funct = $this->function[$indice][$f]['visible_funct'];
									$visible = true;
									$visible = $visible && $this->userControl($indice, 'funct');
									// se la funzione deve essere costruita
									if ($visible)
										{
												$error = true;
												//  preleva dati funxione
												$error = $error && $this->prelevaDatiFunction($f, $indice);
												//  costruisci funzione input
												$error = $error && $this->buildFunction();
												//  incremento indice di servizio
												$this->indice ++;
												if(!$error)  return 'errore nella costruzione della input-function';
										}
								
							} 		//  END  OF  FOR  CYCLE
				
				return true;			//		->$error
			}		//  END  OF  FUNCTION  buildFunctions

		public function buildFunction()
			{
				// costruisci label
				$this->getLabel();
				// costruisci funzione input in base al tipo
				switch ($this->type)
							{
								case 'text':
									$this->funct == 1 ?$temp_function = $this->getInputText():$this->funct;
									$this->funct == 2 ?$temp_function = $this->getInputTextVaria():$this->funct;
									$this->funct == 3 ?$temp_function = $this->getInputTextNuovo():$this->funct;
								break;
								case 'textarea':
									$this->funct == 1 ?$temp_function = $this->getTextArea():$this->funct;
									$this->funct == 2 ?$temp_function = $this->getTextAreaVaria():$this->funct;
									$this->funct == 3 ?$temp_function = $this->getTextAreaNuovo():$this->funct;
								break;
								case 'select':
									$this->funct == 1 ?$temp_function = $this->getSelect():$this->funct;
									$this->funct == 2 ?$temp_function = $this->getSelectVaria():$this->funct;
									$this->funct == 3 ?$temp_function = $this->getSelectNuovo():$this->funct;
								break;
								case 's-select':
									$this->funct == 1 ?$temp_function = $this->getSuperSelect():$this->funct;
									$this->funct == 2 ?$temp_function = $this->getSuperSelectVaria():$this->funct;
									$this->funct == 3 ?$temp_function = $this->getSuperSelectNuovo():$this->funct;
								break;
								case 'seq-inpu':
									$this->funct == 1 ?$temp_function = $this->getSeqInput():$this->funct;
									$this->funct == 2 ?$temp_function = $this->getSeqInputVaria():$this->funct;
									$this->funct == 3 ?$temp_function = $this->getSeqInputNuovo():$this->funct;
								break;
								case 'date':
									$this->funct == 1 ?$temp_function = $this->getDatePicker():$this->funct;
									$this->funct == 2 ?$temp_function = $this->getDatePickerVaria():$this->funct;
									$this->funct == 3 ?$temp_function = $this->getDatePickerNuovo():$this->funct;
								break;
								default :
									$temp_function = 'Tipo di input non compatibile';
									// funzione che elimina i file ed elimina le tabelle 
									// in caso in cui ci sia sia questo tipo di errore
									/*$tabelle = new TABELLE();			// DA SISTEMARE
									$tabelle->doServer();
									$tabelle->eliminaTabelle($this->pagina);
									//exit(var_dump($this->pagina)); */
								break;
							}			//END  OF  SWITCH  
				$this->superFunction .= $temp_function;
				return true;
			}		//  END  OF  FUNCTION  buildFunction()
			
			
		public function prelevaDatiFunction($f, $indice)
			{
				//prelevo gli attributi
				// prelevo la label
				$this->label = ucfirst($this->function[$indice][$f]['label_funct']);
				$this->sub_label = strtolower($this->function[$indice][$f]['sub_label_funct']);
				//zona input
				//prelevo gli attributi per input
				$this->id = $this->function[$indice][$f]['id_funct'];			// prelevo id dell'input
				$this->type = $this->function[$indice][$f]['type_funct'];		// prelevo il type dell'input
				$this->title = strtolower($this->function[$indice][$f]['title_funct']);		// perlevo eventuale title
				// assegno valore da recuperare in main e in varia
				$this->value = htmlspecialchars('<?php echo $' . $this->var_val . '["' . $this->id . '"] ?>');	
				//nel caso in cui sia la funct num 3 (pagina nuovo) il valore sara nullo
				if ($this->funct == 3)
						{
							$this->value = '';
						}
				// assegno valore altezza per TextArea
				$this->height = $this->function[$indice][$f]['height_funct'];
				
				//valori delle options della Select
				$this->select_values = $this->function[$indice][$f]['select_val_funct'];
				
				//  bool che indica se mostrare tasto help $this->help = 1; oppure no $this->help = 0
				$this->help = $this->function[$indice][$f]['help'];
				//	bool che indica sel il campo e' obbligatorio $this->binding = 1; oppure no $this->binding = 0
				$this->binding = $this->function[$indice][$f]['binding'];
				$this->bind_control = $this->function[$indice][$f]['bind_control'];
				//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 
				return true;
			
			}		//  END  OF  FUNCTION  prelevaDatiFunction
			
			
//--------------------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------   COSTRUTTORI   INPUTS  E  LABELS  ---------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------------------------------------------//

//-------------------------------------------------- LABEL  E  SUB LABEL  -----------------------------------------------------------------------// 
/****				costruisci  label per input
*		@return		string 		$temp_function		parte di codice html
*****/			
		public function getLabel()
			{
					$label_class = 'label help_no_funct';
					$bind_mark = '';
					//		funzione  nascosta
					if ($this->type == "seq-inpu")
						{
							return;
						}
					//		funzione con help
					if ($this->help == 1)
							{
								$label_class = 'label help_funct';
								//		CREA   FILE  ISTRUZIONI	SE QUESTA FUNCTION LO PREVEDE 
								$error = $this->creaFileIstruzioni($this->label, $this->pagina);
								if ( !$error ) 
									{
										exit( 'Errore nella creazione del file istruzioni ');
									}
							}
						//		funzione obbligatoria
						if ($this->binding == 1)
							{
								$label_class .= ' binding';
								$bind_mark = '<font  style="font-size:1.2em;color: red;">*&nbsp;</font>';
							}
							
						if ($this->sub_label != NULL)
								{
										$temp_function = '<div class="' . $label_class . '" >' . $bind_mark . $this->label . '<font  style="font-size:0.6em;">(' . $this->sub_label . ')</font></div>';
								}
						else
								{
										$temp_function = '<div class="' . $label_class . '" >' . $bind_mark . $this->label . '</div>';
								}
					$this->superFunction .= $temp_function;
			}		//  END  OF  FUNCTION  getLabel()

//---------------------------------------------------------- INPUT  TEXT  -----------------------------------------------------------------------// 
/****				costruisci  INPUT TEXT
*		@return		string 		$temp_function		parte di codice html
*****/	
		public function getInputText()			//  PER PAGINA MAIN
				{
					// controllo se questo input e' il primo attraverso $indice
					$s_class = $this->isIndex();
					$temp_function = '	<input class="text_input' . $s_class . '" id="' . $this->id . '" type="text" name="' . $this->id . '" title="' . $this->title . '" value="' . $this->value . '" disabled /><br />';
					return $temp_function;
				}		//  END  OF  FUNCTION   getInputText()

		public function getInputTextVaria()			//  PER PAGINA VARIA
				{
					$s_class = $this->isIndex();
					$binding = '';
					if ( $this->binding == 1 )
						{
							$binding = ' bind_input';
						}
					$temp_function = '<form name="' . $this->id . '" class="form_input" >';
					$temp_function .= '	<input class="text_input' . $s_class . $binding . '" id="' . $this->id . '" type="text" name="' . $this->id . '" title="' . $this->title . '" value="' . $this->value . '" />';
					$temp_function .= '<input class="buttons varia" type="button" value="invia"  onclick="spedisci($(this).parent());" />';
					$temp_function .= '</form>';
					return $temp_function;
				}		//  END  OF  FUNCTION  getInputTextVaria()
				
			public function getInputTextNuovo()			// PER PAGINA NUOVO
				{
					$s_class = $this->isIndex();
					$binding = '';
					$rel = 'rel="/"';
					if ( $this->binding == 1 )
						{
							$binding = ' bind_input';
						}
					$temp_function = '	<input class="text_input' . $s_class . $binding . '" id="' . $this->id . '" type="text" name="' . $this->id . '" title="' . $this->title . '" value="' . $this->value . '" ' . $rel . ' /><br />';
					return $temp_function;
				}		//  END  OF  FUNCTION  getInputTextNuovo()
				
				
//---------------------------------------------------------- SEQ    INPUT   -----------------------------------------------------------------------// 
/****				costruisci  SEQ  INPUT 
*		@return		string 		$temp_function		parte di codice html
*****/	
			public function getSeqInput()
				{
					
					$temp_function = '';
					return $temp_function;
				
				}
				
			public function getSeqInputVaria()
				{
					$s_class = $this->isIndex();
					$temp_function = '<form name="' . $this->id . '" class="form_input" >';
					$temp_function .= '	<input class="text_input' . $s_class . ' seq" id="' . $this->id . '_seq" type="hidden" name="' . $this->id . '" rel="' . strtolower($this->label) . '"  value="'. $this->value . '"  />';
					$temp_function .= '</form>';
					return $temp_function;
				}
			public function getSeqInputNuovo()
				{
					// controllo se questo input e' il primo attraverso $indice
					$s_class = $this->isIndex();
					$temp_function = '	<input class="text_input' . $s_class . ' seq" id="' . $this->id . '_seq" type="hidden" name="' . $this->id . '" title="' . $this->title . '" value="' . $this->value . '" />';
					return $temp_function;
				}
			
			
//------------------------------------------------------------ TEXT  AREA -----------------------------------------------------------------------// 
/****				costruisci  TEXT AREA
*		@return		string 		$temp_function		parte di codice html
*****/	
		public function getTextArea()			// TEXT AREA MAIN PAGE
				{
					$s_class = $this->isIndex();
					// se non esiste altezza inserisci default "rows="3"
					$this->height != '' ? $height = 'rows="' . $this->height .'"' : $height = 'rows="3"';
					$temp_function = '<textarea class="text_input' . $s_class . '" id="'  . $this->id .'" name="' . $this->id . '" title="' . $this->title . '" ' . $height . ' disabled >' . $this->value . '</textarea><br />';
					
					return $temp_function;
				}		//  END  OF  FUNCTION  getTextArea()
				
		public function getTextAreaVaria()			// TEXT AREA PAGINA VARIA
				{
					// se non esiste altezza inserisci default "rows="3"
					$this->height != '' ? $height = 'rows="' . $this->height .'"' : $height = 'rows="3"';
					$s_class = $this->isIndex();
					$temp_function = '<form name="' . $this->id . '" class="form_input" >';
					$temp_function .= '	<textarea class="text_input' . $s_class . '" id="'  . $this->id .'" name="' . $this->id . '" title="' . $this->title . '" ' . $height . ' >' . $this->value . '</textarea>';
					$temp_function .= '<input class="buttons varia" type="button" value="invia"  onclick="spedisci($(this).parent());">';
					$temp_function .= '</form><br /><br /><br />';
					return $temp_function;
				}		//  END  OF  FUNCTION  getTextAreaVaria()
				
		public function getTextAreaNuovo()			// TEXT  AREA PAGINA NUOVO
				{
					$s_class = $this->isIndex();
					// se non esiste altezza inserisci default "rows="3"
					$this->height != '' ? $height = 'rows="' . $this->height .'"' : $height = 'rows="3"';
					$temp_function = '<textarea class="text_input' . $s_class . '" id="'  . $this->id .'" name="' . $this->id . '" title="' . $this->title . '" ' . $height . ' >' . $this->value . '</textarea><br />';
					return $temp_function;
				}		//  END  OF  FUNCTION  getTextAreaNuovo()

				
//------------------------------------------------------------   SELECT   -----------------------------------------------------------------------// 
/****				costruisci  SELECT
*		@return		string 		$temp_function		parte di codice html
*****/	

		public function getSelect()
				{
					$s_class = $this->isIndex();
					$temp_function = '	<select class="select_input' . $s_class . '" id="' . $this->id . '" name="'  . $this->id . '" title="' . $this->title . '" disabled>';
					$temp_function .= '<option selected >' . $this->value . '</option>';
					$temp_function .= '	</select><br />';
					return $temp_function;
				}
				
		public function getSelectVaria()
				{
					$s_class = $this->isIndex();
					$temp_function = '<form name="' . $this->id . '" class="form_input" >';
					$temp_function .= '	<select class="select_input' . $s_class . '" id="' . $this->id . '" name="'  . $this->id . '" title="' . $this->title . '">';
					//MECCANISMO CHE CARICA IL PHP NECESSARIO PER SETTARE IL GIUSTO OPTION SU SELECTED
					$temp_function .= '<?php
											$option_value = $' . $this->var_val . '[\'' . $this->id . '\'];
											$options = array();
											$valori = \'' . $this->select_values . '\';
											$options = explode(",", $valori);
											$stop = (count($options))-1;
										for ($i = 0; $i <= $stop; $i++)
											{
												if ($options[$i] == $option_value)
													{
														echo \'<option value="\' . $options[$i] . \'" selected >\' . $options[$i] . \'</option>\';
													}
												else
													{
														echo \'<option value="\' . $options[$i] . \'">\' . $options[$i] . \'</option>\';
													}
											}
									?>';
					$temp_function .= '	</select>';
					$temp_function .= '<input class="buttons varia" type="button" value="invia"  onclick="spedisci($(this).parent());">';
					$temp_function .= '</form>';
					return $temp_function;
				}		//  END  OF  FUNCTION   getSelectVaria()

		public function getSelectNuovo()
				{
					$valori = array();
					$valori = explode(",", $this->select_values);
					//array_unshift($valori, " ");
					$s_class = $this->isIndex();
					$len_valori = (count($valori) - 1);
					$temp_function = '<select class="select_input' . $s_class . '" id="' . $this->id . '" name="'  . $this->id . '" title="' . $this->title . '">';
						for ($i = 0; $i <= $len_valori; $i++)
							{
								 $temp_function .= '<option value="' . $valori[$i] . '" >' . $valori[$i] . '</option>';
							}
						
					$temp_function .= '	</select><br />';
					return $temp_function;
				}		//  END  OF  FUNCTION  getSelectNuovo
				
//--------------------------------------------------------SUPER  SELECT   ---------------------------------------------------------------------// 

		public function getSuperSelect()
			{
					$s_class = $this->isIndex();
					$temp_function = '	<select class="select_input super ' . $s_class . '" id="' . $this->id . '" name="'  . $this->id . '" title="' . $this->title . '" disabled>';
					$temp_function .= '<?php 
															$option_index = $' . $this->var_val . '[\'' . $this->id . '\'];
															if ( $option_index )
																{
																	$tabella = \'' . $this->id . '\';
																	$option = $conn->getOptionValue($tabella, $option_index);
																	echo \'<option selected>\' . $option . \'</option>\';
																}
															else
																{
																	echo \'<option selected>...</option>\';
																}
												?>';
					$temp_function .= '	</select><br />';
					// COSTRUISCI LA TABELLA DI LOOK-UP 
					$create = $this->creaLookUp($this->pagina, $this->id);
					//return $create;
					return $temp_function;
			}
			
		public function getSuperSelectVaria()
			{
					$s_class = $this->isIndex();
					$riga_vuota = '';
					//	SE IL CAMPO DESTINATO AI VALORI DELLA SELECT INDICA 'select_no'
					//	INTRODUCI UN CAMPO OPTION VUOTO ALL'INIZIO
					if ( $this->select_values == 'select_no' )
						{
							$riga_vuota = 'echo \'<option value="" style="color:#ddd;font-weight:bold;font-size:1.2em;letter-spacing:2px;">nessuno</option>\';';
						}
					$temp_function = '<form name="' . $this->id . '" class="form_input" >';
					$temp_function .= '	<select class="select_input super ' . $s_class . '" id="' . $this->id . '" name="'  . $this->id . '" title="' . $this->title . '">';
					//MECCANISMO CHE CARICA IL PHP NECESSARIO PER SETTARE IL GIUSTO OPTION SU SELECTED
					$temp_function .= '<?php
											$option_index = $' . $this->var_val . '[\'' . $this->id . '\'];
											$tabella = \'' . $this->id . '\';
											$valori = array();
											$valori = $conn->getValori($tabella);
											$max_id = count($valori);' . $riga_vuota .
											'for ($i = 1; $i <= $max_id; $i++)
												{
													if ( $valori[$i][\'id\'] == $option_index )
														{
															echo \' <option value="\' . $valori[$i][\'id\'] . \'" selected > \' . $valori[$i][\'titolo\'] . \'</option>\';
														}
													else
														{
															echo \' <option value="\' . $valori[$i][\'id\'] . \'" > \' . $valori[$i][\'titolo\'] . \'</option>\';
														}
												}	?>';
					$temp_function .= '	</select>';
					$temp_function .= '<input class="buttons varia" type="button" value="invia"  onclick="spedisci($(this).parent());">';
					$temp_function .= '</form>';
					return $temp_function;
			}

		public function getSuperSelectNuovo()
			{
					$s_class = $this->isIndex();
					$riga_vuota = '';
					//	SE IL CAMPO DESTINATO AI VALORI DELLA SELECT INDICA 'select_no'
					//	INTRODUCI UN CAMPO OPTION VUOTO ALL'INIZIO
					if ( $this->select_values == 'select_no' )
						{
							$riga_vuota = 'echo \'<option value="" style="color:#ddd;font-weight:bold;font-size:1.2em;letter-spacing:2px;">nessuno</option>\';';
						}
					$temp_function = '<form name="' . $this->id . '" class="form_input" >';
					$temp_function .= '	<select class="select_input super ' . $s_class . '" id="' . $this->id . '" name="'  . $this->id . '" title="' . $this->title . '">';
					//MECCANISMO CHE CARICA IL PHP NECESSARIO PER SETTARE IL GIUSTO OPTION SU SELECTED
					$temp_function .= '<?php 
											$tabella = \'' . $this->id . '\';
											$valori = array();
											$valori = $conn->getValori($tabella);
											$max_id = count($valori);' . $riga_vuota .
											'for ($i = 1; $i <= $max_id; $i++)
												{
													echo \' <option value="\' . $valori[$i][\'id\'] . \'" > \' . $valori[$i][\'titolo\'] . \'</option>\';
												}			
					
												?>';
					$temp_function .= '	</select><br />';
					return $temp_function;
			}


//----------------------------------------------------------  DATE PICKER  -----------------------------------------------------------------------// 
/****				costruisci  DATE PICKER
*		@return		string 		$temp_function		parte di codice html
*****/	
		public function getDatePicker()
				{
					$s_class = $this->isIndex();
					$temp_function = '	<input class="text_input data_picker mostra" id="' . $this->id . '" type="text" name="' . $this->id . '" title="' . $this->id . '" value="' . $this->value . '" disabled ><br />';
					return $temp_function;
				}	

		public function getDatePickerVaria()
				{
					$s_class = $this->isIndex();
					$temp_function = '<form name="' . $this->id . '" class="form_input" >';
					$temp_function .= '	<input class="text_input data_varia data_picker" id="' . $this->id . '" type="text" name="' . $this->id . '" title="data evento" value="' . $this->value . '" >';
					$temp_function .= '<input class="buttons varia" type="button" value="invia"  onclick="spedisci($(this).parent());">';
					$temp_function .= '</form>';
					return $temp_function;
				}
				
		public function getDatePickerNuovo()
				{
					$s_class = $this->isIndex();
					$temp_function = '	<input class="text_input data_picker" id="' . $this->id . '" type="text" name="' . $this->id . '" title="data evento" value="' . $this->value . '"  ><br />';
					return $temp_function;

				}
				
				
		public function debug($string)
			{
				exit(htmlspecialchars($string)); 
				//exit(($string));
				//exit(var_dump($string)); 
			}
			
		public function isIndex()
			{
				$s_class = '';
					if ( $this->indice === 1 )
						{
							$s_class = ' first';
						}
				return $s_class;
			
			}
			
		public function isHelp($string)
			{
			
				if ($this->help != 1)
					{
						$string .= '<br /> ';
					}
				return $string;
			}
			
		public function creaFileIstruzioni($label, $pagina)
			{
					include "php/config.inc.php";
					//istruzioni/it/function/strutture.album-foto.txt
					
					$dir = $dir_cache . 'istruzioni/' . $lang . '/functions/';
					$name_file = $dir . $pagina . '.' . $label . '.txt';
					$file = fopen($name_file, 'w');
					fwrite($file, 'contenuto istruzioni');
					fclose($file);
					return $file;
			}
}		// END  OF  CLASS  NEWPAGE()
?>