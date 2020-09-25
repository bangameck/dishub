<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers   = ['text', 'url', 'array', 'date'];
	protected $libraries = ['database', 'session', 'form_validation'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		session();

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		timezone_select('custom-select', 'Asia/Jakarta');
		$this->userModel = new \App\Models\UserModel();
		// function aut($level = array())
		// {
		// 	$base_url = base_url();
		// 	//aut(array(1,4));penggunaan
		// 	global $base_url;
		// 	if (!in_array(session()->get('level', $level))) {
		// 		return redirect()->to('/');
		// 	}
		// }


		function tgl_indo($tanggal)
		{
			$bulan = array(
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tanggal);

			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun

			return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
		}

		function pid($pk)
		{
			$karakter = '1234567890';
			$string = '';
			for ($i = 0; $i < $pk; $i++) {
				$pos = rand(0, strlen($karakter) - 1);
				$string .=
					$karakter[$pos];
			}
			return $string;
		}

		function ip_user()
		//mengambil ID acak
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}
		/**
		 * @see http://php.net/manual/en/function.get-browser.php;
		 * @return
		 */
		function browser_user()
		{
			$browser = _userAgent();
			return $browser['name'] . ' v.' . $browser['version'];
		}
		/**
		 * Deteksi UserAgent / Browser yang digunakan
		 * @return [type] [description]
		 */
		function _userAgent()
		{
			$u_agent 	= $_SERVER['HTTP_USER_AGENT'];
			$bname   	= 'Unknown';
			$platform 	= 'Unknown';
			$version 	= "";
			$os_array   =   array(
				'/windows nt 10.0/i'     =>  'Windows 10',
				'/windows nt 6.2/i'     =>  'Windows 8',
				'/windows nt 6.1/i'     =>  'Windows 7',
				'/windows nt 6.0/i'     =>  'Windows Vista',
				'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
				'/windows nt 5.1/i'     =>  'Windows XP',
				'/windows xp/i'         =>  'Windows XP',
				'/windows nt 5.0/i'     =>  'Windows 2000',
				'/windows me/i'         =>  'Windows ME',
				'/win98/i'              =>  'Windows 98',
				'/win95/i'              =>  'Windows 95',
				'/win16/i'              =>  'Windows 3.11',
				'/macintosh|mac os x/i' =>  'Mac OS X',
				'/mac_powerpc/i'        =>  'Mac OS 9',
				'/linux/i'              =>  'Linux',
				'/ubuntu/i'             =>  'Ubuntu',
				'/iphone/i'             =>  'iPhone',
				'/ipod/i'               =>  'iPod',
				'/ipad/i'               =>  'iPad',
				'/android/i'            =>  'Android',
				'/blackberry/i'         =>  'BlackBerry',
				'/webos/i'              =>  'Mobile'
			);
			foreach ($os_array as $regex => $value) {
				if (preg_match($regex, $u_agent)) {
					$platform    =   $value;
					break;
				}
			}
			// Next get the name of the useragent yes seperately and for good reason
			if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
				$bname = 'Internet Explorer';
				$ub = "MSIE";
			} elseif (preg_match('/Firefox/i', $u_agent)) {
				$bname = 'Mozilla Firefox';
				$ub = "Firefox";
			} elseif (preg_match('/Chrome/i', $u_agent)) {
				$bname = 'Google Chrome';
				$ub = "Chrome";
			} elseif (preg_match('/Safari/i', $u_agent)) {
				$bname = 'Apple Safari';
				$ub = "Safari";
			} elseif (preg_match('/Opera/i', $u_agent)) {
				$bname = 'Opera';
				$ub = "Opera";
			} elseif (preg_match('/Netscape/i', $u_agent)) {
				$bname = 'Netscape';
				$ub = "Netscape";
			}
			//  finally get the correct version number
			$known = array('Version', $ub, 'other');
			$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

			if (!preg_match_all($pattern, $u_agent, $matches)) {
				// we have no matching number just continue
			}

			// see how many we have
			$i = count($matches['browser']);
			if ($i != 1) {
				//we will have two since we are not using 'other' argument yet
				//see if version is before or after the name
				if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
					$version = $matches['version'][0];
				} else {
					$version = $matches['version'][1];
				}
			} else {
				$version = $matches['version'][0];
			}

			// check if we have a number
			$version = ($version == null || $version == "") ? "?" : $version;

			return array(
				'userAgent' => $u_agent,
				'name'      => $bname,
				'version'   => $version,
				'platform'  => $platform,
				'pattern'   => $pattern
			);
		}
		/**
		 * @return name Operating System*/
		function os_user()
		{
			$OS = _userAgent();
			return $OS['platform'];
		}
	}
}
