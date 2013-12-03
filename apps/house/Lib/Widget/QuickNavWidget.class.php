<?php
class QuickNavWidget extends Widget {
	public function render($data) {
		return $this->renderFile ( 'QuickNav', $data );
	}
	public function edit($data) {
		return $this->renderFile ( 'QuickNavEdit', $data );
	}
}
