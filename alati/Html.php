<?php

class Html {
	protected static function startInput() {
		return '<input ';
	}

	protected static function endInput() {
		return ' />';
	}

	protected static function startTag($tag) {
		return '<' . $tag . ' ';
	}

	protected static function attr($attrName, $attrValue) {
		if(strlen($attrValue)!=0){
			return $attrName . '="' . $attrValue . '" ';
		}
	}

	protected static function endTag() {
		return '>';
	}

	protected static function br() {
		return '<br />';
	}

	protected static function closeTag($tag) {
		return '</' . $tag . '>';
	}

	protected static function label($label, $id) {
		return '<label for="' . $id . '">' . $label . '</label>';
	}

	protected static function text($text) {
		return $text;
	}

	protected static function parseClasses($cssClassesArray) {
		$classes = '';
		foreach ($cssClassesArray as $key => $value) {
			$classes .= $value . ' ';
		}
		$classes = substr($classes, 0, -1);
		return self::attr('class', $classes);
	}

	protected static function parseStyle($styleArray) {
		$style = '';
		foreach ($styleArray as $key => $value) {
			$style .= $key . ': ' . $value . '; ';
		}
		$style = substr($style, 0, -1);
		return self::attr('style', $style); ;
	}

	protected static function determineValIfPost($name, $value) {
		if (isset($_POST) && isset($_POST[$name])) {
			return $_POST[$name];
		} else {
			return $value;
		}
	}

	protected static function selectIfOptionPost($name, $value) {
		if (isset($_POST) && isset($_POST[$name])) {
			return ($_POST[$name] == $value) ? self::attr('selected', 'selected') : '';
		}
	}

	protected static function checkRadioIfPost($name, $value) {
		if (isset($_POST) && isset($_POST[$name])) {
			return ($_POST[$name] == $value) ? self::attr('checked', 'checked') : '';
		}
	}

	protected static function checkBoxIfPost($name, $value) {
		if (isset($_POST) && isset($_POST[$name])) {
			foreach ($_POST[$name] as $key => $postValue) {
				$checked = ($postValue == $value) ? self::attr('checked', 'checked') : '';
			}
			return $checked;
		}
	}

	protected static function parseAttrs($attrArray) {
		$attributes = '';
		foreach ($attrArray as $key => $value) {
			$attributes .= self::attr($key, $value);
		}
		return $attributes;
	}

	protected static function parseOptions($name, $optionsArray) {
		//array opcije sadrži: 0=id i value, 1=text
		$options = '';
		foreach ($optionsArray as $option) {
			$options .= self::startTag('option');
			foreach ($option as $key => $value) {//slaganje atributa
				($key != 'text') ? $options .= self::attr($key, $value) : $text = $value;
				($key == 'value') ? $optValue = $value : null;				
				//definiranje $value da se označi checked ako je POST
			}
			$options .= self::selectIfOptionPost($name, $optValue) . self::endTag() . self::text($text) . self::closeTag('option');
		}
		return $options;
	}

	public static function Input($label, $type, $name, $id, $cssClassesArray = null, $styleArray = null, $value = null, $attrArray = null, $showLabel = true) {
		$input = ($showLabel == true) ? self::label($label, $id) : '';
		$input .= self::startInput() . self::attr('type', $type) . self::attr('name', $name) . self::attr('id', $id);
		$input .= ($cssClassesArray != null || $cssClassesArray != '') ? self::parseClasses($cssClassesArray) : '';
		$input .= ($styleArray != null || $styleArray != '') ? self::parseStyle($styleArray) : '';
		$input .= self::attr('value', self::determineValIfPost($name, $value));
		$input .= ($attrArray != null || $attrArray != '') ? self::parseAttrs($attrArray) : '';
		$input .= self::endInput();
		echo $input;
	}

	public static function Select($label, $name, $id, $cssClassesArray = null, $optionsArray, $styleArray = null, $attrArray = null) {
		$select = self::label($label, $id) . self::startTag('select') . self::attr('name', $name) . self::attr('id', $id);
		$select .= ($cssClassesArray != null || $cssClassesArray != '') ? self::parseClasses($cssClassesArray) : '';
		$select .= ($styleArray != null || $styleArray != '') ? self::parseStyle($styleArray) : '';
		$select .= ($attrArray != null || $attrArray != '') ? self::parseAttrs($attrArray) : '';
		$select .= self::endTag();
		$select .= self::parseOptions($name, $optionsArray);
		$select .= self::closeTag('select');
		echo $select;
	}

	public static function Radio($name, $buttonsArray, $br = false) {
		foreach ($buttonsArray as $radio) {//svakom radio buttonu treba zadati id, value i labelu
			$attrs = '';
			foreach ($radio as $key => $value) {
				($key == 'id') ? $id = $value : null;
				($key == 'value') ? $radioVal = $value : null;
				($key != 'labela') ? $attrs .= self::attr($key, $value) : $labela = self::label($value, $id);
			}
			$radioB = self::startInput() . self::attr('type', 'radio') . self::attr('name', $name) . $attrs . self::checkRadioIfPost($name, $radioVal) . self::endInput() . $labela;
			$radioB .= ($br == true) ? self::br() : '';
			echo $radioB;
		}
	}

	public static function Checkbox($name, $checkboxArray, $br = false) {
		foreach ($checkboxArray as $checkbox) {//svakom checkboxu treba zadati id, value i labelu
			$attrs = '';
			$check = '';
			$postName = substr($name, 0, -2);
			foreach ($checkbox as $key => $value) {
				($key == 'id') ? $id = $value : null;
				($key != 'labela') ? $attrs .= self::attr($key, $value) : $labela = self::label($value, $id);
				if ($key == 'value') {
					if ($_POST) {
						foreach ($_POST[$postName] as $postValue) {
							($postValue == $value) ? $check .= self::attr('checked', 'checked') : '';
						}
					}
				}
			}
			$box = self::startInput() . self::attr('type', 'checkbox') . self::attr('name', $name) . $attrs . $check . self::endInput() . $labela;
			$box .= ($br == true) ? self::br() : '';
			echo $box;
		}
	}

	public static function Textarea($label, $name, $id, $cssClassesArray = null, $styleArray = null, $value = null, $attrArray = null) {
		$input = self::label($label, $id) . self::startTag('textarea') . self::attr('name', $name) . self::attr('id', $id);
		$input .= ($cssClassesArray != null || $cssClassesArray != '') ? self::parseClasses($cssClassesArray) : '';
		$input .= ($styleArray != null || $styleArray != '') ? self::parseStyle($styleArray) : '';
		$input .= ($attrArray != null || $attrArray != '') ? self::parseAttrs($attrArray) : '';
		$input .= self::endTag() . self::determineValIfPost($name, $value) . self::closeTag('textarea');
		echo $input;
	}

	public static function InputSaGreskom($greske, $naziv, $labela, $value, $type, $attrArray=null) {
		$input = self::startTag('label') . self::attr('id', 'for' . $naziv) . self::attr('for', $naziv);

		$poruka = "";
		foreach ($greske as $g) {
			if ($g -> element == $naziv) {
				$poruka = $g -> poruka;
				break;
			}
		}
		if (strlen($poruka) > 0) {
			$input .= self::parseClasses(array('error'));
		}
		$input .= self::endTag() . $labela . self::startTag('span') . self::attr('class', 'red'). self::endTag() . '*' . self::closeTag('span') . self::startInput() . self::attr('type', $type) . self::attr('id', $naziv) . self::attr('name', $naziv) . self::attr('value', self::determineValIfPost($naziv, $value));
		$input .= ($attrArray != null || $attrArray != '') ? self::parseAttrs($attrArray) : '';
		$input .= self::endInput() . self::closeTag('label');

		if (strlen($poruka) > 0) {
			$input .= self::startTag('small') . self::parseClasses(array('error')) . self::endTag() . $poruka . self::closeTag('small');
		}
		echo $input;
	}

	public static function Submit($value, $cssClassesArray, $attrArray=null,$styleArray=null) {
		$input = self::startInput() . self::attr('type', 'submit');
		$input .= ($cssClassesArray != null || $cssClassesArray != '') ? self::parseClasses($cssClassesArray) : '';
		$input .= ($attrArray != null || $attrArray != '') ? self::parseAttrs($attrArray) : '';
		$input .= ($styleArray != null || $styleArray != '') ? self::parseStyle($styleArray) : '';		
		$input .= self::attr('value', $value) . self::endInput();
		echo $input;
	}

	public static function Button($value, $cssClassesArray, $attrArray = null, $styleArray = null) {
		$button = self::startTag('button') . self::attr('type', 'button');
		$button .= ($cssClassesArray != null || $cssClassesArray != '') ? self::parseClasses($cssClassesArray) : '';
		$button .= ($attrArray != null || $attrArray != '') ? self::parseAttrs($attrArray) : '';
		$button .= ($styleArray != null || $styleArray != '') ? self::parseStyle($styleArray) : '';
		$button .= self::endTag() . $value . self::closeTag('button');
		echo $button;
	}
	
	public static function a($href, $value, $cssClassesArray = null, $styleArray = null, $attrArray = null, $id=null) {
		$a	= self::startTag('a') . self::attr('href', $href);
		$a .= (!empty($id)) ? self::attr('id', $id) : '';
		$a .= ($cssClassesArray != null || $cssClassesArray != '') ? self::parseClasses($cssClassesArray) : '';
		$a .= ($styleArray != null || $styleArray != '') ? self::parseStyle($styleArray) : '';
		$a .= ($attrArray != null || $attrArray != '') ? self::parseAttrs($attrArray) : '';
		$a .= self::endTag();
		$a .= $value;
		$a .= self::closeTag('a');
		echo $a;
	}
	
	public static function SpremiOdustani($odustani){	
		echo '<div class="row pt40">
				<div class="large-6 columns">';
		echo self::Submit('Spremi',array('siroko', 'secondary', 'button'));
		echo '</div>
				<div class="large-6 columns">';
		echo self::startTag('a') . self::attr('href', $odustani) . self::endTag();
		echo self::Button("Odustani", array('siroko','alert'));
		echo self::closeTag('a');
		echo   '</div>	
			  </div>';
	}

}
