<?php
class MY_Loader extends CI_Loader {
	public function template($template_name, $vars = array(), $return = FALSE)
	{
		$content  = $this->view('templates/header', $vars, $return);
		$content .= $this->view('templates/sidebar', $vars, $return);
		$content .= $this->view('templates/breadcrump', $vars, $return);
		$content .= $this->view($template_name, $vars, $return);
		$content .= $this->view('templates/footer', $vars, $return);

		if ($return)
		{
			return $content;
		}
	}
}