<?php
class Weathersnapshot_model extends CI_MODEL {

	public function __construct() {
		$this->load->database ();
	}

	public function get_latest_weathersnapshot()
	{
		$query = $this->db->select()
			->from ( 'WeatherSnapshots' )
			->order_by ( 'Date', 'DESC' )
			->limit ( '1' )
			->get();

		$queryYesterday = $this->db->select()
			->from ( 'WeatherSnapshots' )
			->where ('Date < CURDATE()')
			->order_by( 'Date', 'DESC' )
			->limit('1')
			->get ();

		$queryTwoDaysAgo = $this->db->select()
			->from('WeatherSnapshots')
			->where("Date < DATE_SUB(CURDATE(), INTERVAL 1 DAY)")
			->order_by('Date', 'DESC')
			->limit('1')
			->get();

		$queryStartOfTheMonth = $this->db->select()
			->from('WeatherSnapshots')
			->where("Date between DATE_FORMAT(NOW(), '%Y-%m-01') and NOW()")
			->order_by('Date', 'ASC')
			->limit('1')
			->get();

		$queryStartOfTheTwoMonthAgo = $this->db->select()
			->from('WeatherSnapshots')
			->where("Date between DATE_SUB(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH) and NOW()")
			->order_by('Date', 'ASC')
			->limit('1')
			->get();

		$queryStartOfTheYear = $this->db->select()
			->from('WeatherSnapshots')
			->where("Date between DATE_FORMAT(NOW(), '%Y-01-01') and NOW()")
			->order_by('Date', 'ASC')
			->limit('1')
			->get();

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

        // The timestamp for "February 15 2017 12:00" is 1487156400
        $rainDifferenceDueToBreakdown = 847.9;
        $firstApril2017TimeStamp = 1490997600;
        $firstJanuary2018TimeStamp = 1514761200;

		if ($queryStartOfTheMonth->num_rows() > 0 && $result){
			foreach ($queryStartOfTheMonth->result() as $snapshotFromStartOfTheMonth)
			{
				$result->RainSinceStartOfMonth = $result->RainSum - $snapshotFromStartOfTheMonth->RainSum;
				foreach ($queryStartOfTheTwoMonthAgo->result() as $snapshotStartOfTheTwoMonthAgo)
				{
					$result->RainLastMonth = $snapshotFromStartOfTheMonth->RainSum - $snapshotStartOfTheTwoMonthAgo->RainSum;

					// Fixes pluviometer breakdown problem
                    $snapshotDate = strtotime($result->Date);
                    if ($snapshotDate < $firstApril2017TimeStamp)  {
                        $result->RainLastMonth += $rainDifferenceDueToBreakdown;
                    }
				}
			}
		}



		if ($queryStartOfTheYear->num_rows() > 0 && $result){
			foreach ($queryStartOfTheYear->result() as $snapshotFromStartOfTheYear)
			{
                $result->RainSinceStartOfYear = $result->RainSum - $snapshotFromStartOfTheYear->RainSum;

                // Fixes pluviometer breakdown problem
                $snapshotDate = strtotime($result->Date);
                if ($snapshotDate < $firstJanuary2018TimeStamp)  {
                    $result->RainSinceStartOfYear += $rainDifferenceDueToBreakdown;
                }
			}
		}

		return $result;
	}

	public function get_weather_snapshots_between_days($startDay, $endDay)
	{
		return $this->db->select()
			->from('WeatherSnapshots')
			->where(sprintf('Date BETWEEN DATE_SUB(NOW(), INTERVAL %d DAY) AND DATE_SUB(NOW(), INTERVAL %d DAY)', $endDay, $startDay))
			->order_by('Date', 'ASC')
			->get();
	}

	public function get_last_n_days_of_weather_snapshots($n)
	{
		return $this->db->select()
			->from('WeatherSnapshots')
			->where(sprintf('Date BETWEEN DATE_SUB(NOW(), INTERVAL %d DAY) AND NOW()', $n))
			->order_by('Date', 'ASC')
			->get();
	}

	public function get_last_n_days_of_weather_snapshots_till_midnight($n)
	{
		return $this->db->select()
			->from('WeatherSnapshots')
			->where(sprintf('Date BETWEEN DATE_SUB(CURDATE(), INTERVAL %d DAY) AND NOW()', $n))
			->order_by('Date', 'ASC')
			->get();
	}

	public function get_weather_snapshots($startDay = 0, $endDay = 1)
	{
		$previousSnapshot = array (
			'Temperature' => 0,
			'Humidity' => 0,
			'Dew' => 0,
			'AtmosphericPressure' => 0,
			'WindTemperature' => 0,
			'WindGust' => 0,
			'WindSpeed' => 0,
			'WindDirection' => 0,
		);

		$snapshots = array ();
		$fields = array('Temperature', 'Humidity', 'Dew', 'AtmosphericPressure', 'WindTemperature', 'WindGust', 'WindSpeed', 'WindDirection');

		if (! preg_match ( '/^\d+$/', $startDay ) || ! preg_match ( '/^\d+$/', $endDay )) {
			throw new Exception ( 'Unsafe arguments passed' );
		}

		$query = $this->get_weather_snapshots_between_days($startDay, $endDay + 1);
		$startDate = time() - 86400 * $startDay;
		$endDate = time() - 86400 * $endDay;
		$rainSum = 0;
        $rainSumStartValue = -1;

		$count = 0;
		$ratioOfSelection = round($endDay / 2);

		// The timestamp for "February 15 2017 10:00" is 1487156400
		$pluviometerBreakdownDate = 1487149200;
		$rainDifferenceDueToBreakdown = 847.9;

		foreach ( $query->result_array () as $snapshot ) {
			$snapshotDate = strtotime($snapshot['Date']);



			$isInCorrectTimeInterval = $endDate < $snapshotDate && $snapshotDate < $startDate;

            if ($rainSumStartValue == -1 && $isInCorrectTimeInterval) {
                $rainSumStartValue = $snapshot['RainSum'];
            }

			foreach ($fields as $field) {
				$entry = array('Date' => $snapshotDate + 3600);
				$type = 'Real';

                if ($field == "WindDirection" && !is_null($snapshot["WindDirection"]) && $snapshot["WindDirection"] == 0){
                    if ($previousSnapshot["WindDirection"] > 180) {
                        $snapshot["WindDirection"] = 360;
                    } else {
                        $snapshot["WindDirection"] = 0;
                    }
                }

                if (!is_null($snapshot[$field])) {
					$previousSnapshot[$field] = $snapshot[$field];
					$type = 'Real';
				} else {
					$snapshot[$field] = $previousSnapshot[$field];
					$type = 'Generated';
				}

				$entry[$field] = $snapshot[$field];



				if ($isInCorrectTimeInterval && ($count % $ratioOfSelection == 0)) {
					$snapshots[$field][$type][] = $entry;
				} else if ($snapshot['RainSum'] > $rainSum) {
					$rainSum = $snapshot['RainSum'];
				}
			}


            // $snapshotData is something like "1485963600", e.g. num seconds since the epoch
			if ($snapshotDate > $pluviometerBreakdownDate) {
                $snapshot['RainSum'] += $rainDifferenceDueToBreakdown; // La difference
            }

			$entry = array(
				'Date' => $snapshotDate + 3600,
				'Rain' => $snapshot ['RainSum'] - $rainSum
			);

            $entryCumulative = array(
                'Date' => $snapshotDate + 3600,
                'RainCumulative' => $snapshot['RainSum'] - $rainSumStartValue
            );


			if ($isInCorrectTimeInterval && ($count % $ratioOfSelection == 0)) {
				// Only register snapshots after the start date
				$snapshots['Rain']['Real'][] = $entry;
                $snapshots['RainCumulative']['Real'][] = $entryCumulative;
			} else {
				// Memorize last sum before we start registering the snapshots
				$rainSum = $snapshot ['RainSum'];
			}
			$count++;
		}

		return $snapshots;
	}

	public function add_snapshot($data)
	{
		if (is_array($data)) 
		{
			// We do not want to escape nulls since they will end up as zeros
			// in the database.
			foreach ($data as $key => $value) 
			{
				if ($data[$key] !== NULL)
				{
					$data[$key] = $this->security->xss_clean ( $data[$key] );
				}
			}
			$sql = $this->db->insert_string ( 'WeatherSnapshots', $data );
			$sql.= ' ON DUPLICATE KEY UPDATE Date=Date;';
			$this->db->query ( $sql );
		}
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
