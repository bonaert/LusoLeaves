<?php
class Weathersnapshot_model extends CI_MODEL {

	public function __construct() {
		$this->load->database ();
	}

	public function get_latest_weathersnapshot()
	{
		$query = $this->db->select ()->from ( 'WeatherSnapshots' )->order_by ( 'Date', 'DESC' )->limit ( '1' )->get ();
		foreach ( $query->result () as $snapshot ) {
			return $snapshot;
		}
		return null;
	}

	public function get_weather_snapshots($startDay, $endDay = 0)
	{
		$previousSnapshot = array (
			'Temperature' => 0,
			'Humidity' => 0,
			'Dew' => 0,
			'AtmosphericPressure' => 0,
		);
		$rainSum = 0;
		$snapshots = array ();
		$fields = array('Temperature', 'Humidity', 'Dew', 'AtmosphericPressure');

		if (! preg_match ( '/^\d+$/', $startDay ) || ! preg_match ( '/^\d+$/', $endDay )) {
			throw new Exception ( 'Unsafe arguments passed' );
		}

		$queryStartDays = $startDay + 1;
		$query = $this->db->select ()->from ( 'WeatherSnapshots' )->where (
			sprintf ( 'Date BETWEEN (CURDATE() - INTERVAL %d DAY) AND (CURDATE() - INTERVAL %d DAY) ',
			$queryStartDays - 1 ,
			$endDay - 1 ),
			NULL, false )->order_by( 'Date', 'ASC' )->get ();

		$today = getdate ();
		$startDate = strtotime ( sprintf ( '%s-%s-%s', $today ['year'], $today ['mon'], $today ['mday'] ) );

		foreach ( $query->result_array () as $snapshot ) {
			$snapshotDate = strtotime ( $snapshot ['Date'] );
			
			foreach ($fields as $field) {
				$entry = array('Date' => $snapshotDate);
				$type = 'Real';
				if ($snapshot[$field]) {
					$previousSnapshot[$field] = $snapshot[$field];
					$type = 'Real';
				} else {
					$snapshot[$field] = $previousSnapshot[$field];
					$type = 'Generated';
				}
				$entry[$field] = $snapshot[$field];
				if ($snapshotDate > $startDate) { 
					$snapshots[$field][$type][] = $entry;
				}
			}

			$entry = array(
				'Date' => $snapshotDate,
				'Rain' => $snapshot ['RainSum'] - $rainSum
			);
			if ($snapshotDate > $startDate) {
				// Only register snapshots after the start date
				$snapshots['Rain']['Real'][] = $entry;
			} else {
				// Memorize last sum before we start registering the snapshots
				$rainSum = $snapshot ['RainSum']; 
			}
		}

		return $snapshots;
	}

	public function add_snapshot($data)
	{
		$data = $this->security->xss_clean ( $data );
		$sql = $this->db->insert_string ( 'WeatherSnapshots', $data );
		$sql .= ' ON DUPLICATE KEY UPDATE Date=Date;';
		$this->db->query ( $sql );
	}
}


/*

CREATE TABLE WeatherSnapshot (
`Id` BIGINT NOT NULL AUTO_INCREMENT,
`Date` TIMESTAMP,
`Station` VARCHAR(20),
`Temperature` FLOAT,
`Humidity` FLOAT,
`Dew` FLOAT,
`AtmosphericPressure` FLOAT,
`WindChill` FLOAT,
`WindTemperature` FLOAT,
`WindGust` FLOAT,
`WindSpeed` FLOAT,
`WindDirection` FLOAT,
`RainSum` FLOAT,
PRIMARY KEY (`Id`),
UNIQUE KEY `date_station` (`Date`,`Station`)
)

 */
