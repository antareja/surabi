<?php
class MY_Loader extends CI_Loader {
	public function template($template_name, $vars = array(), $return = FALSE)
	{
		$content  = $this->view('templates/header', $vars, $return);
// 		echo empty($this->uri->segment(1)) ? 'home': $this->uri->segment(1) ;exit;
		if (empty($this->uri->segment(1)) || $this->uri->segment(1) == 'home') {
// 			echo 'masuk';exit;
			$content .= $this->view('templates/sidebar', $vars, $return);
		}
		$content .= $this->view('templates/breadcrump', $vars, $return);
		$content .= $this->view($template_name, $vars, $return);
		$content .= $this->view('templates/footer', $vars, $return);

		if ($return)
		{
			return $content;
		}
	}
}