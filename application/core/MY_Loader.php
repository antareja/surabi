<?php
class MY_Loader extends CI_Loader {
	public function template($template_name, $vars = array(), $return = FALSE)
	{
		$content  = $this->view('templates/header', $vars, $return);
		// bugs in php5.4
// 		echo empty($this->uri->segment(1)) ? 'home': $this->uri->segment(1) ;exit;
		$use_sidebar = array('home', 'map');
		$simple = array('map', 'replay');
		if (empty($this->uri->segment(1)) ||  in_array($this->uri->segment(1), $use_sidebar)) {
// 			echo 'masuk';exit;
			$content .= $this->view('templates/sidebar', $vars, $return);
		}
		if(!in_array($this->uri->segment(1), $simple)) {
			$content .= $this->view('templates/breadcrump', $vars, $return);
		}
		$content .= $this->view($template_name, $vars, $return);
		$content .= $this->view('templates/footer', $vars, $return);

		if ($return)
		{
			return $content;
		}
	}
}