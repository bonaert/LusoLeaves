<?php
class Weather extends CI_CONTROLLER {

	public function __construct()
	{
		parent::__construct ();
		$this->lang->load ( 'lusoleaves' );
		$this->load->model ( 'weathersnapshot_model' );
	}

	public function index()
	{
		$data ['is_admin'] = $this->session->userdata ( 'is_admin' );
		$data ['is_logged_in'] = $this->session->userdata ( 'is_logged_in' );
		$data ['content_view'] = 'weather/index';
		$data ['_internal_js'] [] = 'Chart.Core.js';
		$data ['_internal_js'] [] = 'Chart.Scatter.js';

		$timeInterval = $this->input->get('timeInterval', TRUE);
		$possibilities = array("1", "2", "7", "31");
		if (in_array($timeInterval, $possibilities)){
			$timeInterval = (int) $timeInterval;
		} else {
			$timeInterval = 1;
		}

		$data ['latest'] = $this->weathersnapshot_model->get_latest_weathersnapshot ();
		$snapshots = $this->weathersnapshot_model->get_weather_snapshots(0, $timeInterval);
		$data ['snapshots'] = $snapshots;
		$this->load->view ( 'template', $data );
	}

	public function update()
	{
		$upload_key = $this->config->item ( 'upload_key' );

		$content = json_decode ( file_get_contents ( 'php://input' ), true );
		if ($content ['upload_key'] === $upload_key) {
			foreach ( $content ['snapshots'] as $snapshot ) {
				$date = new DateTime ( $snapshot ['Date'] );
				$snapshot ['Station'] = 'Rogil';
				$snapshot ['Date'] = $date->format ( 'Y-m-d H:i:s' );
				try {
					$this->weathersnapshot_model->add_snapshot ( $snapshot );
				} catch ( Exception $e ) {
					echo "Oh oh ... ";
				}
			}
		}
	}
}
