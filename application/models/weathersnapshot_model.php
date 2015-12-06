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

	public function get_weather_snapthosts($startDay, $endDay = 0)
	{
		$rainSum = 0;
		$snapshots = array ();

		if (! preg_match ( '/^\d+$/', $startDay ) || ! preg_match ( '/^\d+$/', $endDay )) {
			throw new Exception ( 'Unsafe arguments passed' );
		}

		$query = $this->db->select ()->from ( 'WeatherSnapshots' )->where (
                sprintf ( 'Date BETWEEN (CURDATE() - INTERVAL %d DAY) AND (CURDATE() - INTERVAL %d DAY) ',
                $startDay ,
                $endDay),
        NULL, false )->order_by( 'Date', 'ASC' )->get ();

		$today = getdate ();
		$startDate = strtotime ( sprintf ( '%s-%s-%s', $today ['year'], $today ['mon'], $today ['mday'] ) );
		foreach ( $query->result_array () as $snapshot ) {
			$snapshotDate = strtotime ( $snapshot ['Date'] );
			if ($snapshotDate > $startDate) {
				$snapshot ['Rain'] = $snapshot ['RainSum'] - $rainSum;
				$snapshots [] = $snapshot;
			}
			$rainSum = $snapshot ['RainSum'];
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
