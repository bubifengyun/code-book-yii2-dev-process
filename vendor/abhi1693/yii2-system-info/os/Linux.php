<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 16-02-2015
	 * Time: 00:06
	 */

	namespace abhimanyu\systemInfo\os;

	use abhimanyu\systemInfo\interfaces\InfoInterface;
	use Exception;
	use PDO;
	use Yii;

	class Linux implements InfoInterface
	{
		public function __construct()
		{
			if (!is_dir('/sys') || !is_dir('/proc'))
				throw new Exception('Needs access to /proc and /sys to work.');
		}

		/**
		 * Gets the name of the Operating System
		 *
		 * @return string
		 */
		public static function getOS()
		{
			return 'Linux';
		}

		/**
		 * Gets the Kernel Version of the Operating System
		 *
		 * @return string
		 */
		public static function getKernelVersion()
		{
			return shell_exec('/usr/bin/lsb_release -ds');
		}

		/**
		 * Gets the hostname
		 *
		 * @return string
		 */
		public static function getHostname()
		{
			return php_uname('n');
		}

		/**
		 * Gets Processor's Model
		 *
		 * @return string
		 */
		public static function getCpuModel()
		{
			return Linux::getCpuInfo()['Model'];
		}

		private static function getCpuInfo()
		{
			// File that has it
			$file = '/proc/cpuinfo';

			// Not there?
			if (!is_file($file) || !is_readable($file)) {
				return 'Unknown';
			}

			/*
			 * Get all info for all CPUs from the cpuinfo file
			 */

			// Get contents
			$contents = trim(@file_get_contents($file));

			// Lines
			$lines = explode("\n", $contents);

			// Holder for current CPU info
			$cur_cpu = [];

			// Go through lines in file
			$num_lines = count($lines);

			for ($i = 0; $i < $num_lines; $i++) {
				// Info here
				$line = explode(':', $lines[$i], 2);

				if (!array_key_exists(1, $line))
					continue;

				$key   = trim($line[0]);
				$value = trim($line[1]);


				// What we want are MHZ, Vendor, and Model.
				switch ($key) {

					// CPU model
					case 'model name':
					case 'cpu':
					case 'Processor':
						$cur_cpu['Model'] = $value;
						break;

					// Speed in MHz
					case 'cpu MHz':
						$cur_cpu['MHz'] = $value;
						break;

					case 'Cpu0ClkTck': // Old sun boxes
						$cur_cpu['MHz'] = hexdec($value) / 1000000;
						break;

					// Brand/vendor
					case 'vendor_id':
						$cur_cpu['Vendor'] = $value;
						break;

					// CPU Cores
					case 'cpu cores':
						$cur_cpu['Cores'] = $value;
						break;
				}

			}

			// Return them
			return $cur_cpu;
		}

		/**
		 * Gets Processor's Vendor
		 *
		 * @return string
		 */
		public static function getCpuVendor()
		{
			return Linux::getCpuInfo()['Vendor'];
		}

		/**
		 * Gets Processor's Frequency
		 *
		 * @return string
		 */
		public static function getCpuFreq()
		{
			return Linux::getCpuInfo()['MHz'];
		}

		/**
		 * Gets Processor's Architecture
		 *
		 * @return string
		 */
		public static function getCpuArchitecture()
		{
			return shell_exec('getconf LONG_BIT') . 'Bit';
		}

		/**
		 * Gets system average load
		 *
		 * @return string
		 */
		public static function getLoad()
		{
			return round(array_sum(sys_getloadavg()) / count(sys_getloadavg()), 2);
		}

		/**
		 * Gets system up-time
		 *
		 * @return string
		 */
		public static function getUpTime()
		{
			return shell_exec('uptime -p');
		}

		/**
		 * Gets total number of cores
		 *
		 * @return integer
		 */
		public static function getCpuCores()
		{
			return Linux::getCpuInfo()['Cores'];
		}

		/**
		 * Gets Current PHP Version
		 *
		 * @return string
		 */
		public static function getPhpVersion()
		{
			return phpversion();
		}

		/**
		 * Gets Server Name
		 *
		 * @return string
		 */
		public static function getServerName()
		{
			return $_SERVER['SERVER_NAME'];
		}

		/**
		 * Gets Server Protocol
		 *
		 * @return string
		 */
		public static function getServerProtocol()
		{
			return $_SERVER['SERVER_PROTOCOL'];
		}

		/**
		 * Gets the type of server e.g. apache
		 *
		 * @return string
		 */
		public static function getServerSoftware()
		{
			return $_SERVER['SERVER_SOFTWARE'];
		}

		/**
		 * Gets total physical memory
		 *
		 * @return array|null
		 */
		public static function getTotalMemory()
		{
			// todo
		}

		/**
		 * Gets the current DB Type of Yii2
		 *
		 * @return mixed
		 */
		public static function getDbType()
		{
			return Yii::$app->db->driverName;
		}

		/**
		 * * Gets the current DB Version of Yii2
		 *
		 * @return mixed
		 */
		public static function getDbVersion()
		{
			return Yii::$app->db->pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
		}

		private static function getMemoryInfo()
		{
			$data = @explode("\n", file_get_contents("/proc/meminfo"));

		}
	}