<?php
namespace Biblioteca\HTMLHelper;

class HTMLHelperMenu {

   //{["link"=>"link.html","icone"=>"fa-dashboard","text":"","subItems":[]]}
	private $menuArray = [];

	public function addItem($item){
		$this->menuArray[] = $item; 
	}

	public function novoItem($text,$link,$subItems = [] ,$icone = ""){
		return ["link"=>$link,"text"=>$text,"icone"=>$icone,"subItems"=>$subItems];
	}

	public function gerarMenu(){
		return $this->menuRecursivo($this->menuArray);
	}

	public static function gerarMenuStatic($menu){
		$menu = new HTMLHelperMenu;
		$menu->addItem($menu);
		return $menu->gerarMenu();
	}

	public static function novoItemStatic($text,$link,$subItems = [] ,$icone = ""){
		return ["link"=>$link,"text"=>$text,"icone"=>$icone,"subItems"=>$subItems];
	}

	public function pegarItems(){
		return $this->menuArray;
	}

	private function menuRecursivo($menus,$nivel = 1){
		$html = '';
		
		if($nivel > 1)
			$html .= $this->getulNivel($nivel);

		foreach ($menus as $key => $value) {
			$html .= '<li>';
			$html .= $this->montarLink($value['link'],$value['icone'],$value['text'],!empty($value['subItems']) ? true : false );

			if(!empty($value['subItems'])){
				$html .= $this->menuRecursivo($value['subItems'],$nivel + 1);
			}

			$html .= '</li>';	
		}

		if($nivel > 1)
			$html .= '</ul>';
		return $html;
	}

	private function montarLink($link,$icone,$texto,$seta = false){
		$html = '<a href="'.$link.'">';
		
		if(!empty($icone)){
			$html .= '<i class="fa '.$icone.' fa-fw"></i>';
		}

		$html .= $texto;

		if($seta)
			$html .='<span class="fa arrow"></span>';

		$html .= '</a>';
		return $html;
	}

	private function getulNivel($nivel){
		switch ($nivel) {
			case 2:
				return '<ul class="nav nav-second-level">';
				break;
			case 3:
				return '<ul class="nav nav-third-level">';
				break;
		}
	}

}