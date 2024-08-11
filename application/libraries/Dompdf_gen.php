<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Name:  DOMPDF
 * 
 * Author: Jd Fiscus
 * 	 	  jdfiscus@gmail.com
 *         @iamfiscus
 *          
 *
 * Origin API Class: http://code.google.com/p/dompdf/
 * 
 * Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
 *          
 * Created:  06.22.2010 
 * 
 * Description:  This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
 * 
 */

class Dompdf_gen
{

	private $dompdf;

	public function __construct()
	{
		// Pastikan path sesuai dengan lokasi file autoload.php Composer
		require_once APPPATH . '../vendor/autoload.php';

		// Inisialisasi DOMPDF
		$this->dompdf = new \Dompdf\Dompdf();
	}

	public function load_html($html)
	{
		$this->dompdf->loadHtml($html);
	}

	public function set_paper($size = 'A4', $orientation = 'portrait')
	{
		$this->dompdf->setPaper($size, $orientation);
	}

	public function render()
	{
		$this->dompdf->render();
	}

	public function stream($filename, $options = array())
	{
		$this->dompdf->stream($filename, $options);
	}
}
