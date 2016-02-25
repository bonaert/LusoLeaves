<?php
class Weathersnapshot_model extends CI_MODEL {

	public function __construct() {
		$this->load->database ();
	}

	public function get_latest_weathersnapshot()
	{
		$query = $this->db->select ()->from ( 'WeatherSnapshots' )->order_by ( 'Date', 'DESC' )->limit ( '1' )->get ();
		$queryYesterday = $this->db->select ()->from ( 'WeatherSnapshots' )->where ('Date < CURDATE()')->order_by( 'Date', 'DESC' )->limit('1')->get ();
		$queryTwoDaysAgo = $this->db->select()->from('WeatherSnapshots')
			->where("Date < DATE_SUB(CURDATE(), INTERVAL 1 DAY)")->order_by('Date', 'DESC')->limit('1')->get();
		$queryStartOfTheMonth = $this->db->select()->from('WeatherSnapshots')
			->where("Date between DATE_FORMAT(NOW(), '%Y-%m-01') and NOW()")->order_by('Date', 'ASC')->limit('1')->get();
		$queryStartOfTheTwoMonthAgo = $this->db->select()->from('WeatherSnapshots')
			->where("Date between DATE_SUB(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH) and NOW()")->order_by('Date', 'ASC')->limit('1')->get();
		$queryStartOfTheYear = $this->db->select()->from('WeatherSnapshots')
			->where("Date between DATE_FORMAT(NOW(), '%Y-01-01') and NOW()")->order_by('Date', 'ASC')->limit('1')->get();
		$result = null;
		foreach ( $query->result () as $snapshot ) {
			$result = $snapshot;
		}

		if ($queryYesterday->num_rows() > 0 && $result){
			foreach ($queryYesterday->result() as $snapshotFromYesterday)
			{
				$result->Rain = $result->RainSum - $snapshotFromYesterday->RainSum;
				foreach ($queryTwoDaysAgo->result() as $snapshotTwoDaysAgo)
				{
					$result->RainYesterday = $snapshotFromYesterday->RainSum - $snapshotTwoDaysAgo->RainSum;
				}
			}
		}

		if ($queryStartOfTheMonth->num_rows() > 0 && $result){
			foreach ($queryStartOfTheMonth->result() as $snapshotFromStartOfTheMonth)
			{
				$result->RainSinceStartOfMonth = $result->RainSum - $snapshotFromStartOfTheMonth->RainSum;
				foreach ($queryStartOfTheTwoMonthAgo->result() as $snapshotStartOfTheTwoMonthAgo)
				{
						$result->RainLastMonth = $snapshotFromStartOfTheMonth->RainSum - $snapshotStartOfTheTwoMonthAgo->RainSum;
				}
			}
		}



		if ($queryStartOfTheYear->num_rows() > 0 && $result){
			foreach ($queryStartOfTheYear->result() as $snapshotFromStartOfTheYear)
			{
				$result->RainSinceStartOfYear = $result->RainSum - $snapshotFromStartOfTheYear->RainSum;
			}
		}

		return $result;
	}

    public function get_last_n_days_of_weather_snapshots($n){
        return $this->db->select()
            ->from('WeatherSnapshots')
            ->where(sprintf('Date BETWEEN NOW() AND DATE_SUB(NOW(), INTERVAL %d DAY)', $n))
            ->order_by('Date', 'DESC')
            ->get();
    }

    public function get_last_n_days_of_weather_snapshots_till_midnight($n){
        return $this->db->select()
            ->from('WeatherSnapshots')
            ->where(sprintf('Date BETWEEN NOW() AND (CURDATE() - INTERVAL %d DAY)', $n))
            ->order_by('Date', 'DESC')
            ->get();
    }

	public function get_weather_snapshots($startDay, $endDay = 1)
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

		$query = $this->get_last_n_days_of_weather_snapshots($endDay);
		$today = getdate ();
		$startDate = strtotime ( sprintf ( '%s-%s-%s', $today ['year'], $today ['mon'], $today ['mday'] ));

		foreach ( $query->result_array () as $snapshot ) {

			$snapshotDate = strtotime ( $snapshot ['Date']) + 3600;

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
				if ($snapshotDate > $startDate + 3600) {
					$snapshots[$field][$type][] = $entry;
				}
			}

			$entry = array(
				'Date' => $snapshotDate,
				'Rain' => $snapshot ['RainSum'] - $rainSum
			);
			if ($snapshotDate > $startDate + 3600) {
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
