<?php 
	
	function _header() {
		require ROOT.'pages/header.php';
	}

	function _footer() {
		require ROOT.'pages/footer.php';
	}

	function _page($par) {
		require ROOT.'pages/'.$par.'.php';
	}
	function _services() {
		require ROOT.'pages/services.php';
	}

	function url() {
		echo URL;
	}


    function _total($file) {

			
				$data = getcontents(FORM_DIR.'_database/'.$file);
        $data = unserialize($data);

//         $hmc = $data['how_many_co'] ? $data['how_many_co'] : 1;
//        $s = $hmc + 1;
				
				
				
				
				$s = @$data['how_many_co'] + 1;
				
				
				
				
				
				            $total = 0;

				
  for ($iii = 1; $iii <= gc('form_items_no'); $iii++) {
    
    
    


				$type = gc('form_item_'.$iii.'_type');

				$label = gc('form_item_'.$iii.'_label');
				$required = gc('form_item_'.$iii.'_required');
				$help = gc('form_item_'.$iii.'_label_help');
				$name = gc('form_item_'.$iii.'_name');
				$titles = gc('form_item_'.$iii.'_titles');
				$descs = gc('form_item_'.$iii.'_descs');
				$prices = gc('form_item_'.$iii.'_prices');
				$price_titles = gc('form_item_'.$iii.'_price_titles');

						$fnc = 'f'.md5($type.$name);


				if (@$prices) {
					

							foreach (gca('form_item_'.$iii.'_prices') as $i => $ss) {
								
								if ($data[$name] == $i) {
										$names = gca('form_item_'.$iii.'_price_titles')[$i];
										
										$exn = explode(',', $names);
										$first = @$exn[0] ? @$exn[0] : $names;
          					$sec = @$exn[1] ? @$exn[1] : $names;
										
										$pt = $s == 1 ? $first : $sec;

										$ex = explode(',', $ss);

										if (@$ex[1]) {
											

											foreach ($ex as $ei => $es) {
												if  (count($ex) == ($ei + 1)) {
													if ($s >= ($ei + 1)) {
														$p = $es;
														//echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
														$total += ($s * $p);
													}

												}
												else {
													if ($s == ($ei + 1)) {
														$p = $es;
// 														echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
														$total += ($s * $p);
													}
												}
											}
											




											
											

										}
										else {

											if (@explode('+', $ss)[1]) {

												$p = str_replace('+', '', $ss);
												$s = 1;
// 												echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
												$total += ($s * $p);
												

											}
											else {
												$p = $ss;
												
// 												echo '<br>'. $s .'*'. $p . ' = ' .($s * $p);
												$total += ($s * $p);
												

											}
											
											
											
										}



										

									}
								
								
								
								
								

				}


			}
			}



					
							$coapd = 0;
	$_val = gc('discount_just_in_person_val') ? gc('discount_just_in_person_val') : 0;
	if (count($data['co_authors_present']) > 0 && $data[gc('discount_just_in_person_name')] == $_val) {
		
		foreach ($data['co_authors_present'] as $coi => $cos) {
			if ($cos != "yes") $coapd++;
		}
				
				if ($coapd == 1) $coapdup = gc('discount_eq_1');
				if ($coapd > 1) $coapdup = gc('discount_more_t_1');
				
				
				$total += ($coapdup * -1) * $coapd;
	}
			
			if (isset($data['additional_amount']) && is_numeric($data['additional_amount'])) {
				$total += $data['additional_amount'] * 1;
			}



        return $total;


    }



	function js($code) {
		return '<script>'.$code.'</script>';
	}

	function alert($code) {
		echo '<h2 style="padding: 15px; font-size: 17px; float: left; width: 100%; font-family: helvetica; text-align: center;">'.$code.'</h2>';
	}

	function _title($par) {
		echo '<script>document.title="'.$par.' - '.TITLE.'";</script>';
	}

	function getServicePrice($id) {
		if ($id == 1) $r = SERVICE_1_PRICE;
		if ($id == 2) $r = SERVICE_2_PRICE;
		if ($id == 3) $r = SERVICE_3_PRICE;
		if ($id == 4) $r = SERVICE_4_PRICE;
		if ($id == 5) $r = SERVICE_5_PRICE;
		return $r;
	}

	function myhash() {
		if (@$_SESSION['myhash']) return $_SESSION['myhash'];
		else {
			$_SESSION['myhash'] = substr(md5(rand(1,6).time()), rand(1, 5), 8).date('dmy');
			return $_SESSION['myhash'];
		}
	}

	function invoiceNo() {
		return substr(md5(rand(1,6).time()), 0, 3).'-'.substr(md5(rand(1,6).time()), 6, 3);
	}

	function _filetype($file) {
		if ($file == "application/msword" || $file == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") return true;
		else return false;
	}

	function _filesize($file) {
		if (($file / 1024) < (2048 * 5)) return true;
		else return false;
	}

	function _path() {
		return ROOT.PANEL."/files/";
	}

	function create_folder($path) {
		if (!file_exists($path)) {
		    mkdir($path, 0777, true);
		}
	}

	function _filename($name) {
		$rando = rand(1, 1000).'_';
		$ext = pathinfo($name, PATHINFO_EXTENSION);
		return $rando.sef($name).'.'.$ext;
	}

	function simple($price) {
		return str_replace(',', '', $price);
	}

	function price($price) {
		return number_format($price, 2, '.', ',');
	}

	

	function totalChar($file, $type) {

		// include ROOT."system/doccounter/class.doccounter.php";

		// $doc = new DocCounter();
		// $doc->setFile($file);

		// print_r($doc->getInfo());
		// print_r($doc->getInfo());
		if ($type == 'word') {

			$docObj = new DocxConversion($file);
			$output = $docObj->convertToText();
		}
		if ($type == 'pdf') {

			$reader = new Pdf2text;
			$output = $reader->decode($file);
		}

		// $output = preg_replace('/\s+/', '', $output); // white space
		// $output = preg_replace('/[^A-Za-z0-9\-]/', '', $output); // , . = -

		// echo $file;
		$exp = explode(' ', $output);

		$num = strlen($output);
		$num = count($exp);
		// $format = ($doc->getInfo()->wordCount);
		$format = number_format($num, 0, '', '');
		return $format;

	}

	function cats($a = array(), $text) {
		$a[sef($text)] = $text;
		return $a;
	}

	


	function sef($s) {
		 $tr = array('\'', '"','ş','Ş','ı','I','İ','î','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
		 $eng = array('-', '-', 's','s','i','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
		 $s = str_replace($tr,$eng,$s);
		 $s = strtolower($s);
		 $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
		 $s = preg_replace('/\s+/', '_', $s);
		 $s = preg_replace('|-+|', '_', $s);
		 $s = preg_replace('/#/', '', $s);
		 $s = str_replace('.', '', $s);
		 $s = trim($s, '-');
		 return $s;
	}



	  class DocxConversion{
    private $filename;

    public function __construct($filePath) {
        $this->filename = $filePath;
    }

    private function read_doc() {
        $fileHandle = fopen($this->filename, "r");
        $line = @fread($fileHandle, filesize($this->filename));   
        $lines = explode(chr(0x0D),$line);
        $outtext = "";
        foreach($lines as $thisline)
          {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE)||(strlen($thisline)==0))
              {
              } else {
                $outtext .= $thisline." ";
              }
          }
         $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
        return $outtext;
    }

    private function read_docx(){

        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }// end while

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }

 /************************excel sheet************************************/

function xlsx_to_text($input_file){
    $xml_filename = "xl/sharedStrings.xml"; //content file name
    $zip_handle = new ZipArchive;
    $output_text = "";
    if(true === $zip_handle->open($input_file)){
        if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $output_text = strip_tags($xml_handle->saveXML());
        }else{
            $output_text .="";
        }
        $zip_handle->close();
    }else{
    $output_text .="";
    }
    return $output_text;
}

/*************************power point files*****************************/
function pptx_to_text($input_file){
    $zip_handle = new ZipArchive;
    $output_text = "";
    if(true === $zip_handle->open($input_file)){
        $slide_number = 1; //loop through slide files
        while(($xml_index = $zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $output_text .= strip_tags($xml_handle->saveXML());
            $slide_number++;
        }
        if($slide_number == 1){
            $output_text .="";
        }
        $zip_handle->close();
    }else{
    $output_text .="";
    }
    return $output_text;
}


    public function convertToText() {

        if(isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];
        if($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx")
        {
            if($file_ext == "doc") {
                return $this->read_doc();
            } elseif($file_ext == "docx") {
                return $this->read_docx();
            } elseif($file_ext == "xlsx") {
                return $this->xlsx_to_text();
            }elseif($file_ext == "pptx") {
                return $this->pptx_to_text();
            }
        } else {
            return "Invalid File Type";
        }
    }

}



class Pdf2text
{
	/**
	 * @var  int
	 */
	private $multibyte = 4;
	/**
	 * ENT_COMPAT (double-quotes), ENT_QUOTES (Both), ENT_NOQUOTES (None)
	 *
	 * @var  int
	 */
	private $convertquotes = ENT_QUOTES;
	/**
	 * @var  bool
	 */
	private $showprogress = false;
	/**
	 * Property filename.
	 *
	 * @var  string
	 */
	private $filename = '';
	/**
	 * Property decodedtext.
	 *
	 * @var  string
	 */
	private $decodedtext = '';
	/**
	 * Set file name.
	 * @deprecated Use "decode" method instead
	 * @param string $filename
	 *
	 * @return  void
	 */
	public function setFilename($filename)
	{
		// Reset
		$this->decodedtext = '';
		$this->filename    = $filename;
	}
	/**
	 * Get output text.
	 * @deprecated Use "decode" method instead
	 * @param boolean $echo True to echo it.
	 *
	 * @return  string
	 */
	public function output($echo = false)
	{
		if ($echo)
		{
			echo $this->decodedtext;
		}
		else
		{
			return $this->decodedtext;
		}
	}
	/**
	 * Using unicode.
	 * @deprecated Use "decode" method instead
	 * @param boolean $input True or not to use unicode.
	 *
	 * @return  void
	 */
	public function setUnicode($input)
	{
		// 4 for unicode. But 2 should work in most cases just fine
		if ($input)
		{
			$this->multibyte = 4;
		}
		else
		{
			$this->multibyte = 2;
		}
	}
	/**
	 * Method to set property showprogress
	 * @deprecated Use "decode" method instead
	 * @param   boolean $showprogress
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function showProgress($showprogress)
	{
		$this->showprogress = $showprogress;
		return $this;
	}
	/**
	 * Method to set property convertquotes
	 * @deprecated Use "decode" method instead
	 * @param   int $convertquotes
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function convertQuotes($convertquotes)
	{
		$this->convertquotes = $convertquotes;
		return $this;
	}
	/**
	 * Decode PDF
	 *
	 * @param string $fileName
	 * @param int $convertQuotes ENT_COMPAT (double-quotes), ENT_QUOTES (Both), ENT_NOQUOTES (None)
	 * @param bool $showProgress TRUE if you have problems with time-out
	 * @param bool $multiByteUnicode
	 * @return string
	 */
	public function decode($fileName, $convertQuotes = ENT_QUOTES, $showProgress = false, $multiByteUnicode = true)
	{
		$this->convertquotes = $convertQuotes;
		$this->showprogress = $showProgress;
		$this->multibyte = $multiByteUnicode ? 4 : 2;
		$this->filename = $fileName;
		$this->decodePDF();
		return $this->output();
	}
	/**
	 * Decode PDF
	 *
	 * @deprecated Use "decode" method instead
	 * @return string
	 */
	public function decodePDF()
	{
		// Read the data from pdf file
		$fileContents = @file_get_contents($this->filename, FILE_BINARY);
		if (empty($fileContents))
		{
			return '';
		}
		// Get all text data.
		$transformations = array();
		$texts           = array();
		// Get the list of all objects.
		preg_match_all("#obj[\n|\r](.*)endobj[\n|\r]#ismU", $fileContents . "endobj\r", $objects);
		$objects = @$objects[1];
		// Select objects with streams.
		for ($i = 0; $i < count($objects); $i++)
		{
			$currentObject = $objects[$i];
			// Prevent time-out
			@set_time_limit(0);
			if ($this->showprogress)
			{
				flush();
				ob_flush();
			}
			// Check if an object includes data stream.
			if (preg_match("#stream[\n|\r](.*)endstream[\n|\r]#ismU", $currentObject . "endstream\r", $stream))
			{
				$stream = ltrim($stream[1]);
				// Check object parameters and look for text data.
				$options = $this->getObjectOptions($currentObject);
				if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"])))
				{
					continue;
				}
				// Hack, length doesnt always seem to be correct
				unset($options["Length"]);
				// So, we have text data. Decode it.
				$data = $this->getDecodedStream($stream, $options);
				if (strlen($data))
				{
					if (preg_match_all("#BT[\n|\r| ](.*)ET[\n|\r| ]#ismU", $data . "ET\r", $textContainers))
					{
						$textContainers = @$textContainers[1];
						$this->getDirtyTexts($texts, $textContainers);
					}
					else
					{
						$this->getCharTransformations($transformations, $data);
					}
				}
			}
		}
		// Analyze text blocks taking into account character transformations and return results.
		$this->decodedtext = $this->getTextUsingTransformations($texts, $transformations);
		// Analyze text blocks taking into account character transformations and return results.
		return $this->getTextUsingTransformations($texts, $transformations);
	}
	/**
	 * Decode ASCII Hex.
	 *
	 * @param string $input ASCII string.
	 *
	 * @return  string
	 */
	private function decodeAsciiHex($input)
	{
		$output    = "";
		$isOdd     = true;
		$isComment = false;
		for ($i = 0, $codeHigh = -1; $i < strlen($input) && $input[$i] !== '>'; $i++)
		{
			$c = $input[$i];
			if ($isComment)
			{
				if ($c === '\r' || $c === '\n')
				{
					$isComment = false;
				}
				continue;
			}
			switch ($c)
			{
				case '\0':
				case '\t':
				case '\r':
				case '\f':
				case '\n':
				case ' ':
					break;
				case '%':
					$isComment = true;
					break;
				default:
					$code = hexdec($c);
					if ($code === 0 && $c != '0')
					{
						return "";
					}
					if ($isOdd)
					{
						$codeHigh = $code;
					}
					else
					{
						$output .= chr($codeHigh * 16 + $code);
					}
					$isOdd = !$isOdd;
					break;
			}
		}
		if ($input[$i] !== '>')
		{
			return "";
		}
		if ($isOdd)
		{
			$output .= chr($codeHigh * 16);
		}
		return $output;
	}
	/**
	 * Descode ASCII 85.
	 *
	 * @param string $input ASCII string.
	 *
	 * @return  string
	 */
	private function decodeAscii85($input)
	{
		$output = "";
		$isComment = false;
		$ords      = array();
		for ($i = 0, $state = 0; $i < strlen($input) && $input[$i] !== '~'; $i++)
		{
			$c = $input[$i];
			if ($isComment)
			{
				if ($c === '\r' || $c === '\n')
				{
					$isComment = false;
				}
				continue;
			}
			if ($c === '\0' || $c === '\t' || $c === '\r' || $c === '\f' || $c === '\n' || $c === ' ')
			{
				continue;
			}
			if ($c === '%')
			{
				$isComment = true;
				continue;
			}
			if ($c === 'z' && $state === 0)
			{
				$output .= str_repeat(chr(0), 4);
				continue;
			}
			if ($c < '!' || $c > 'u')
			{
				return "";
			}
			$code           = ord($input[$i]) & 0xff;
			$ords[$state++] = $code - ord('!');
			if ($state == 5)
			{
				$state = 0;
				for ($sum = 0, $j = 0; $j < 5; $j++)
					$sum = $sum * 85 + $ords[$j];
				for ($j = 3; $j >= 0; $j--)
					$output .= chr($sum >> ($j * 8));
			}
		}
		if ($state === 1)
		{
			return "";
		}
		elseif ($state > 1)
		{
			for ($i = 0, $sum = 0; $i < $state; $i++)
				$sum += ($ords[$i] + ($i == $state - 1)) * pow(85, 4 - $i);
			for ($i = 0; $i < $state - 1; $i++)
			{
				try
				{
					if (false == ($o = chr($sum >> ((3 - $i) * 8))))
					{
						throw new \Exception('Error');
					}
					$output .= $o;
				} catch (\Exception $e)
				{ /*Dont do anything*/
				}
			}
		}
		return $output;
	}
	/**
	 * Decode Flate
	 *
	 * @param $data
	 *
	 * @return  string
	 */
	private function decodeFlate($data)
	{
		return @gzuncompress($data);
	}
	/**
	 * Get Object Options
	 *
	 * @param $object
	 *
	 * @return  array
	 */
	private function getObjectOptions($object)
	{
		$options = array();
		if (preg_match("#<<(.*)>>#ismU", $object, $options))
		{
			$options = explode("/", $options[1]);
			@array_shift($options);
			$o = array();
			for ($j = 0; $j < @count($options); $j++)
			{
				$options[$j] = preg_replace("#\s+#", " ", trim($options[$j]));
				if (strpos($options[$j], " ") !== false)
				{
					$parts        = explode(" ", $options[$j]);
					$o[$parts[0]] = $parts[1];
				}
				else
				{
					$o[$options[$j]] = true;
				}
			}
			$options = $o;
			unset($o);
		}
		return $options;
	}
	/**
	 * Get Decode Stream.
	 *
	 * @param $stream
	 * @param $options
	 *
	 * @return  string
	 */
	private function getDecodedStream($stream, $options)
	{
		$data = "";
		if (empty($options["Filter"]))
		{
			$data = $stream;
		}
		else
		{
			$length  = !empty($options["Length"]) ? $options["Length"] : strlen($stream);
			$_stream = substr($stream, 0, $length);
			foreach ($options as $key => $value)
			{
				if ($key === "ASCIIHexDecode")
				{
					$_stream = $this->decodeAsciiHex($_stream);
				}
				elseif ($key === "ASCII85Decode")
				{
					$_stream = $this->decodeAscii85($_stream);
				}
				elseif ($key === "FlateDecode")
				{
					$_stream = $this->decodeFlate($_stream);
				}
				elseif ($key === "Crypt")
				{ // TO DO
				}
			}
			$data = $_stream;
		}
		return $data;
	}
	/**
	 * Get Dirty Texts
	 *
	 * @param array $texts
	 * @param array $textContainers
	 *
	 * @return  void
	 */
	private function getDirtyTexts(&$texts, $textContainers)
	{
		for ($j = 0; $j < count($textContainers); $j++)
		{
			if (preg_match_all("#\[(.*)\]\s*TJ[\n|\r| ]#ismU", $textContainers[$j], $parts))
			{
				$texts = array_merge($texts, array(@implode('', $parts[1])));
			}
			elseif (preg_match_all("#T[d|w|m|f]\s*(\(.*\))\s*Tj[\n|\r| ]#ismU", $textContainers[$j], $parts))
			{
				$texts = array_merge($texts, array(@implode('', $parts[1])));
			}
			elseif (preg_match_all("#T[d|w|m|f]\s*(\[.*\])\s*Tj[\n|\r| ]#ismU", $textContainers[$j], $parts))
			{
				$texts = array_merge($texts, array(@implode('', $parts[1])));
			}
		}
	}
	/**
	 * Get Char Transformations
	 *
	 * @param $transformations
	 * @param $stream
	 *
	 * @return  void
	 */
	private function getCharTransformations(&$transformations, $stream)
	{
		preg_match_all("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", $stream, $chars, PREG_SET_ORDER);
		preg_match_all("#([0-9]+)\s+beginbfrange(.*)endbfrange#ismU", $stream, $ranges, PREG_SET_ORDER);
		for ($j = 0; $j < count($chars); $j++)
		{
			$count   = $chars[$j][1];
			$current = explode("\n", trim($chars[$j][2]));
			for ($k = 0; $k < $count && $k < count($current); $k++)
			{
				if (preg_match("#<([0-9a-f]{2,4})>\s+<([0-9a-f]{4,512})>#is", trim($current[$k]), $map))
				{
					$transformations[str_pad($map[1], 4, "0")] = $map[2];
				}
			}
		}
		for ($j = 0; $j < count($ranges); $j++)
		{
			$count   = $ranges[$j][1];
			$current = explode("\n", trim($ranges[$j][2]));
			for ($k = 0; $k < $count && $k < count($current); $k++)
			{
				if (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+<([0-9a-f]{4})>#is", trim($current[$k]), $map))
				{
					$from  = hexdec($map[1]);
					$to    = hexdec($map[2]);
					$_from = hexdec($map[3]);
					for ($m = $from, $n = 0; $m <= $to; $m++, $n++)
					{
						$transformations[sprintf("%04X", $m)] = sprintf("%04X", $_from + $n);
					}
				}
				elseif (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+\[(.*)\]#ismU", trim($current[$k]), $map))
				{
					$from  = hexdec($map[1]);
					$to    = hexdec($map[2]);
					$parts = preg_split("#\s+#", trim($map[3]));
					for ($m = $from, $n = 0; $m <= $to && $n < count($parts); $m++, $n++)
					{
						$transformations[sprintf("%04X", $m)] = sprintf("%04X", hexdec($parts[$n]));
					}
				}
			}
		}
	}
	/**
	 * Get Text Using Transformations
	 *
	 * @param $texts
	 * @param $transformations
	 *
	 * @return  string
	 */
	private function getTextUsingTransformations($texts, $transformations)
	{
		$document = "";
		for ($i = 0; $i < count($texts); $i++)
		{
			$isHex   = false;
			$isPlain = false;
			$hex   = "";
			$plain = "";
			for ($j = 0; $j < strlen($texts[$i]); $j++)
			{
				$c = $texts[$i][$j];
				switch ($c)
				{
					case "<":
						$hex     = "";
						$isHex   = true;
						$isPlain = false;
						break;
					case ">":
						$hexs = str_split($hex, $this->multibyte); // 2 or 4 (UTF8 or ISO)
						for ($k = 0; $k < count($hexs); $k++)
						{
							$chex = str_pad($hexs[$k], 4, "0"); // Add tailing zero
							if (isset($transformations[$chex]))
							{
								$chex = $transformations[$chex];
							}
							$document .= html_entity_decode("&#x" . $chex . ";");
						}
						$isHex = false;
						break;
					case "(":
						$plain   = "";
						$isPlain = true;
						$isHex   = false;
						break;
					case ")":
						$document .= $plain;
						$isPlain = false;
						break;
					case "\\":
						$c2 = $texts[$i][$j + 1];
						if (in_array($c2, array("\\", "(", ")")))
						{
							$plain .= $c2;
						}
						elseif ($c2 === "n")
						{
							$plain .= '\n';
						}
						elseif ($c2 === "r")
						{
							$plain .= '\r';
						}
						elseif ($c2 === "t")
						{
							$plain .= '\t';
						}
						elseif ($c2 === "b")
						{
							$plain .= '\b';
						}
						elseif ($c2 === "f")
						{
							$plain .= '\f';
						}
						elseif ($c2 >= '0' && $c2 <= '9')
						{
							$oct = preg_replace("#[^0-9]#", "", substr($texts[$i], $j + 1, 3));
							$j += strlen($oct) - 1;
							$plain .= html_entity_decode("&#" . octdec($oct) . ";", $this->convertquotes);
						}
						$j++;
						break;
					default:
						if ($isHex)
						{
							$hex .= $c;
						}
						elseif ($isPlain)
						{
							$plain .= $c;
						}
						break;
				}
			}
			$document .= "\n";
		}
		return $document;
	}
}


// Get the _POST values with @param
    function _post($param, $value = null) {
        if (@sec($_POST['post']) == $param && !$value) return true;
        else if (@sec($_POST[$param]) && $value == @sec($_POST[$param])) return true;
        else return false;
    }

    // Get the _POST value
    function vpost($param = null) {
        return sec(@$_POST[@$param]);
    }

    // Get the _GET values with @param
    function _get($param, $value = null) {
        if (@sec($_GET[$param]) == $value && $value) return true;
        else if (@sec($_GET[$param]) && $value == @sec($_GET[$param])) return true;
        else return false;
    }

    // Get the _GET value
    function vget($param = null) {
        return sec(@$_GET[@$param]);
    }

    // Security for _POST and _GET 
    function sec($post) {
        return addslashes(htmlspecialchars(@$post));
    }

    // Go 
    function go($url = null) {
        // echo '<script>$(location).attr("href", "'.@$url.'");</script>';
        // echo '<script>$(window.location).attr("href", "'.@$url.'");</script>';
        // $e = explode('#', $url);
        // if (@$e[1]) {
        //     header('Location: '.@$e[0].'#'.$e[1]);
        // }
        // else echo '<script>window.location.href="'.@$url.'";</script>';
        echo '<script>window.location.href="'.@$url.'";</script>';
    }

    // Go 
    function _go($url = null) {
        // echo '<script>$(location).attr("href", "'.@$url.'");</script>';
        // echo '<script>$(window.location).attr("href", "'.@$url.'");</script>';
        // $e = explode('#', $url);
        // if (@$e[1]) {
        //     header('Location: '.@$e[0].'#'.$e[1]);
        // }
        // else echo '<script>window.location.href="'.@$url.'";</script>';
        echo '<script>window.location.href="'.URL.@$url.'";</script>';
    }

    // Do small
    function do_small($var){
        $first  = mb_strtolower($var, "UTF-8");
        return $first;
    }

    // Name and Surname editor - Uppercase
    function nasu($var) {

        $result = '';
        $words = explode(" ", $var);

        foreach ($words as $word) {
            $lengthWord = strlen($word);
            $firstCharacter = mb_substr($word, 0, 1, 'UTF-8');

            if ($firstCharacter == 'Ç' or $firstCharacter == 'ç'){
              $firstCharacter = 'Ç';
            } elseif ($firstCharacter == 'Ğ' or $firstCharacter == 'ğ') {
              $firstCharacter = 'Ğ';
            } elseif ($firstCharacter == 'I' or $firstCharacter == 'ı'){
              $firstCharacter = 'I';
            } elseif ($firstCharacter == 'İ' or $firstCharacter == 'i'){
              $firstCharacter = 'İ';
            } elseif ($firstCharacter == 'Ö' or $firstCharacter == 'ö'){
              $firstCharacter = 'Ö';
            } elseif ($firstCharacter == 'Ş' or $firstCharacter == 'ş'){
              $firstCharacter = 'Ş';
            } elseif ($firstCharacter == 'Ü' or $firstCharacter == 'ü'){
              $firstCharacter = 'Ü';
            } else {
              $firstCharacter = strtoupper($firstCharacter);
            }

            $others  = mb_substr($word, 1, $lengthWord, 'UTF-8');
            $result .= $firstCharacter.do_small($others).' ';
        }

        $end = trim(str_replace('  ', ' ', $result));
        return $end;
    }
?>